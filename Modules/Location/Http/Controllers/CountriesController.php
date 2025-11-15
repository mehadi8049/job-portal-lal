<?php

namespace Modules\Location\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Location\Http\Requests\CountryStoreRequest;
use Modules\Location\Http\Requests\CountryUpdateRequest;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\CountryDetail;

class CountriesController extends Controller
{
    public function index(Request $request)
    {
        $query = Country::query()->with(['detail']);

        if ($request->filled('search'))
        {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $paginationData = $query->paginate(10);

        return view('location::countries.index', [
            'paginationData' => $paginationData,
        ]);
    }

    public function create(Request $request)
    {
        return view('location::countries.create', []);
    }

    public function store(CountryStoreRequest $request)
    {
        $data = $request->validated();
        
        $item = Country::create($data);
        CountryDetail::create([
            'country_id' => $item->id
        ]);
        
        if($item->is_default) {
            Country::where('id', '!=', $item->id)->update(['is_default' => false]);
        }

        return redirect()->route('settings.location.countries.edit', ['id' => $item->id])->with('success', __('Created success !'));
    }

    public function edit(Request $request, $id)
    {
        $item = Country::with(['detail'])->findOrfail($id);

        return view('location::countries.edit', [
            'item' => $item,
        ]);
    }

    public function update(CountryUpdateRequest $request, $id)
    {
        $item = Country::findOrFail($id);
        $data = $request->validated();

        $item->update($data);

        if($item->is_default) {
            Country::where('id', '!=', $item->id)->update(['is_default' => false]);
        }

        return redirect()->route('settings.location.countries.edit', ['id' => $item->id])->with('success', __('Updated success !'));
    }

    public function destroy(Request $request, $id)
    {
        $item = Country::findOrFail($id);
        $item->deleteChain();
        return redirect()->back()->with('success', __('Deleted success !'));
    }

    public function show(Request $request, $id)
    {
      abort(404);
    }
}
