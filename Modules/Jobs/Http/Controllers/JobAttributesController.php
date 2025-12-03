<?php

namespace Modules\Jobs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Jobs\Http\Requests\JobAttributeStoreRequest;
use Modules\Jobs\Http\Requests\JobAttributeUpdateRequest;

abstract class JobAttributesController extends Controller
{

    protected $model_class;

    protected $translates;

    protected $attr_route;

    public function __construct()
    {
        $this->model_class = $this->getmodel_class();
        $this->translates = $this->getTranslates();
        $this->attr_route = $this->getAttrRoute();
        config(['oneresumecv.attributes.model_class' => $this->model_class]);
        config(['oneresumecv.attributes.translates' =>  $this->translates]);
    }

    abstract protected function getmodel_class();

    abstract protected function getTranslates();

    abstract protected function getAttrRoute();

    public function index(Request $request)
    {
        $query = $this->model_class::query();

        if ($request->filled('search'))
        {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $paginationData = $query->paginate(10);

        return view('jobs::job_attributes.index', [
            'paginationData' => $paginationData,
            'translates' => $this->translates,
            'attr_route' => $this->attr_route,
        ]);
    }

    public function create(Request $request)
    {
        return view('jobs::job_attributes.create', [
            'translates' => $this->translates,
            'attr_route' => $this->attr_route,
        ]);
    }

    public function store(JobAttributeStoreRequest $request)
    {
        $data = $request->validated();
        
        $item = $this->model_class::create($data);
        
        if($item->is_default) {
            $this->model_class::where('id', '!=', $item->id)->update(['is_default' => false]);
        }

        return redirect()->route('settings.job.attributes.' . $this->attr_route . '.edit', ['id' => $item->id])->with('success', __('Created success !'));
    }

    public function edit(Request $request, $id)
    {
        $item = $this->model_class::findOrfail($id);

        return view('jobs::job_attributes.edit', [
            'item' => $item,
            'translates' => $this->translates,
            'attr_route' => $this->attr_route,
        ]);
    }

    public function update(JobAttributeUpdateRequest $request, $id)
    {
        $item = $this->model_class::findOrFail($id);
        $data = $request->validated();

        $item->update($data);

        if($item->is_default) {
            $this->model_class::where('id', '!=', $item->id)->update(['is_default' => false]);
        }

        return redirect()->route('settings.job.attributes.' . $this->attr_route . '.edit', ['id' => $item->id])->with('success', __('Updated success !'));
    }

    public function destroy(Request $request, $id)
    {
        $item = $this->model_class::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('success', __('Deleted success !'));
    }

    public function show(Request $request, $id)
    {
      abort(404);
    }
}
