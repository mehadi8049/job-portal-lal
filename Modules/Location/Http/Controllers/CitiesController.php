<?php

namespace Modules\Location\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Location\Http\Requests\CityStoreRequest;
use Modules\Location\Http\Requests\CityUpdateRequest;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\City;

class CitiesController extends Controller
{
    public function index(Request $request)
    {
        $query = City::query()->with('state.country');

        if ($request->filled('search'))
        {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $paginationData = $query->paginate(10);

        return view('location::cities.index', [
            'paginationData' => $paginationData,
        ]);
    }

    public function create(Request $request)
    {
        $countries = Country::get();
        return view('location::cities.create', [
            'countries' => $countries,
        ]);
    }

    public function store(CityStoreRequest $request)
    {
        $data = $request->validated();
        Country::findOrFail($data['country_id']);
        State::findOrFail($data['state_id']);

        unset($data['country_id']);
        $item = City::with(['state'])->create($data);
        
        if($item->is_default) {
            City::where('id', '!=', $item->id)->update(['is_default' => false]);
        }

        return redirect()->route('settings.location.cities.edit', ['id' => $item->id])->with('success', __('Created success !'));
    }

    public function edit(Request $request, $id)
    {
        $item = City::findOrfail($id);
        $countries = Country::get();

        return view('location::cities.edit', [
            'item' => $item,
            'countries' => $countries,
        ]);
    }

    public function update(CityUpdateRequest $request, $id)
    {
        $item = City::findOrFail($id);
        $data = $request->validated();
        Country::findOrFail($data['country_id']);
        State::findOrFail($data['state_id']);

        unset($data['country_id']);
        $item->update($data);

        if($item->is_default) {
            City::where('id', '!=', $item->id)->update(['is_default' => false]);
        }

        return redirect()->route('settings.location.cities.edit', ['id' => $item->id])->with('success', __('Updated success !'));
    }

    public function destroy(Request $request, $id)
    {
        $item = City::findOrFail($id);
        $item->deleteChain();
        return redirect()->back()->with('success', __('Deleted success !'));
    }

    public function show(Request $request, $id)
    {
      abort(404);
    }

    public function ajaxGetCities(Request $request)
    {
        $result = [];
        $state_id = $request->input('state_id');
        if(isset($state_id)) {
            $result = City::where('state_id', '=', $state_id)->select('id', 'name')->get()->toArray();
        }
        return response()->json($result);
    }
}
