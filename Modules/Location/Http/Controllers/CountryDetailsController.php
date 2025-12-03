<?php

namespace Modules\Location\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Location\Http\Requests\CountryDetailUpdateRequest;
use Modules\Location\Entities\CountryDetail;

class CountryDetailsController extends Controller
{
    public function index(Request $request)
    {
        $query = CountryDetail::query()->with(['country']);

        if ($request->filled('search'))
        {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $paginationData = $query->paginate(10);

        return view('location::country_details.index', [
            'paginationData' => $paginationData,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $item = CountryDetail::with(['country'])->findOrfail($id);

        return view('location::country_details.edit', [
            'item' => $item,
        ]);
    }

    public function update(CountryDetailUpdateRequest $request, $id)
    {
        $item = CountryDetail::findOrFail($id);
        $data = $request->validated();

        $item->update($data);

        return redirect()->route('settings.location.country_details.edit', ['id' => $item->id])->with('success', __('Updated success !'));
    }
}
