<?php

namespace Modules\Location\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Location\Http\Requests\StateStoreRequest;
use Modules\Location\Http\Requests\StateUpdateRequest;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Country;

class StatesController extends Controller
{
    public function index(Request $request)
    {
        $query = State::query()->with('country');

        if ($request->filled('search'))
        {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $paginationData = $query->paginate(10);

        return view('location::states.index', [
            'paginationData' => $paginationData,
        ]);
    }

    public function create(Request $request)
    {
        $countries = Country::get();
        return view('location::states.create', [
            'countries' => $countries,
        ]);
    }

    public function store(StateStoreRequest $request)
    {
        $data = $request->validated();
        Country::findOrFail($data['country_id']);

        $item = State::create($data);
        
        if($item->is_default) {
            State::where('id', '!=', $item->id)->update(['is_default' => false]);
        }

        return redirect()->route('settings.location.states.edit', ['id' => $item->id])->with('success', __('Created success !'));
    }

    public function edit(Request $request, $id)
    {
        $item = State::findOrfail($id);
        $countries = Country::get();

        return view('location::states.edit', [
            'item' => $item,
            'countries' => $countries,
        ]);
    }

    public function update(StateUpdateRequest $request, $id)
    {
        $item = State::findOrFail($id);
        $data = $request->validated();
        Country::findOrFail($data['country_id']);

        $item->update($data);

        if($item->is_default) {
            State::where('id', '!=', $item->id)->update(['is_default' => false]);
        }

        return redirect()->route('settings.location.states.edit', ['id' => $item->id])->with('success', __('Updated success !'));
    }

    public function destroy(Request $request, $id)
    {
        $item = State::findOrFail($id);
        $item->deleteChain();
        return redirect()->back()->with('success', __('Deleted success !'));
    }

    public function show(Request $request, $id)
    {
      abort(404);
    }

    public function ajaxGetStates(Request $request)
    {
        $result = [];
        $country_id = $request->input('country_id');
        if(isset($country_id)) {
            $result = State::where('country_id', '=', $country_id)->select('id', 'name')->get()->toArray();
        }
        return response()->json($result);
    }
}
