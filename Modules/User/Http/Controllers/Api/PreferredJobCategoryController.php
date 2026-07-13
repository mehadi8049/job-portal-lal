<?php

namespace Modules\User\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\User\Entities\PreferredJobCategory;
use Modules\User\Http\Resources\PreferredJobCategoryResource;

class PreferredJobCategoryController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $categories = $request->user()->preferredJobCategories()->orderBy('created_at', 'desc')->get();
        return $this->success(PreferredJobCategoryResource::collection($categories));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'functional_area'              => 'sometimes|nullable|string|max:255',
            'special_skills'               => 'sometimes|nullable|string',
            'preferred_locations_inside'   => 'sometimes|nullable|array',
            'preferred_locations_outside'  => 'sometimes|nullable|array',
            'preferred_organization_types' => 'sometimes|nullable|array',
        ]);

        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $category = PreferredJobCategory::create($data);

        return $this->success(new PreferredJobCategoryResource($category), 'Preferred job category added successfully', 201);
    }

    public function show(Request $request, $id): JsonResponse
    {
        $category = PreferredJobCategory::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        return $this->success(new PreferredJobCategoryResource($category));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $category = PreferredJobCategory::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();

        $request->validate([
            'functional_area'              => 'sometimes|nullable|string|max:255',
            'special_skills'               => 'sometimes|nullable|string',
            'preferred_locations_inside'   => 'sometimes|nullable|array',
            'preferred_locations_outside'  => 'sometimes|nullable|array',
            'preferred_organization_types' => 'sometimes|nullable|array',
        ]);

        $category->update($request->all());

        return $this->success(new PreferredJobCategoryResource($category->fresh()), 'Preferred job category updated successfully');
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        $category = PreferredJobCategory::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $category->delete();

        return $this->success(null, 'Preferred job category deleted successfully');
    }
}
