<?php

namespace Modules\Jobs\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Jobs\Entities\DegreeLevel;
use Modules\Jobs\Entities\DegreeType;
use Illuminate\Routing\Controller;
use Modules\Jobs\Http\Requests\DegreeTypeStoreRequest;
use Modules\Jobs\Http\Requests\DegreeTypeUpdateRequest;

class DegreeTypesController extends Controller
{

    public function index(Request $request)
    {
        $query = DegreeType::query()->with(['degreeLevel']);

        if ($request->filled('search'))
        {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $paginationData = $query->paginate(10);

        return view('jobs::degree_types.index', [
            'paginationData' => $paginationData,
        ]);
    }

    public function create(Request $request)
    {
        $degree_levels = DegreeLevel::get();
        return view('jobs::degree_types.create', [
            'degree_levels' => $degree_levels,
        ]);
    }

    public function store(DegreeTypeStoreRequest $request)
    {
        $data = $request->validated();
        DegreeLevel::findOrFail($data['degree_level_id']);
        
        $item = DegreeType::create($data);
        
        if($item->is_default) {
            DegreeType::where('id', '!=', $item->id)->update(['is_default' => false]);
        }

        return redirect()->route('settings.job.attributes.degree_types.edit', ['id' => $item->id])->with('success', __('Created success !'));
    }

    public function edit(Request $request, $id)
    {
        $item = DegreeType::findOrfail($id);
        $degree_levels = DegreeLevel::get();

        return view('jobs::degree_types.edit', [
            'item' => $item,
            'degree_levels' => $degree_levels,
        ]);
    }

    public function update(DegreeTypeUpdateRequest $request, $id)
    {
        $item = DegreeType::findOrFail($id);
        $data = $request->validated();
        DegreeLevel::findOrFail($data['degree_level_id']);

        $item->update($data);

        if($item->is_default) {
            DegreeType::where('id', '!=', $item->id)->update(['is_default' => false]);
        }

        return redirect()->route('settings.job.attributes.degree_types.edit', ['id' => $item->id])->with('success', __('Updated success !'));
    }

    public function destroy(Request $request, $id)
    {
        $item = DegreeType::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('success', __('Deleted success !'));
    }

    public function show(Request $request, $id)
    {
      abort(404);
    }
}
