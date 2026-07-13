<?php

namespace Modules\User\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\User\Entities\Experience;
use Modules\User\Http\Resources\ExperienceResource;

class ExperienceController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $experiences = $request->user()->experiences()->orderBy('employment_from', 'desc')->get();
        return $this->success(ExperienceResource::collection($experiences));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'company_name'    => 'required|string|max:255',
            'designation'     => 'required|string|max:255',
            'employment_from' => 'required|date',
            'employment_to'   => 'nullable|date|after_or_equal:employment_from',
            'is_current'      => 'sometimes|boolean',
            'company_business' => 'sometimes|nullable|string',
            'department'      => 'sometimes|nullable|string|max:255',
            'responsibilities' => 'sometimes|nullable|string',
            'area_of_expertise' => 'sometimes|nullable|array',
            'company_location' => 'sometimes|nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $experience = Experience::create($data);

        return $this->success(new ExperienceResource($experience), 'Experience added successfully', 201);
    }

    public function show(Request $request, $id): JsonResponse
    {
        $experience = Experience::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        return $this->success(new ExperienceResource($experience));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $experience = Experience::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();

        $request->validate([
            'company_name'    => 'sometimes|required|string|max:255',
            'designation'     => 'sometimes|required|string|max:255',
            'employment_from' => 'sometimes|required|date',
            'employment_to'   => 'nullable|date|after_or_equal:employment_from',
            'is_current'      => 'sometimes|boolean',
            'company_business' => 'sometimes|nullable|string',
            'department'      => 'sometimes|nullable|string|max:255',
            'responsibilities' => 'sometimes|nullable|string',
            'area_of_expertise' => 'sometimes|nullable|array',
            'company_location' => 'sometimes|nullable|string',
        ]);

        $experience->update($request->all());

        return $this->success(new ExperienceResource($experience->fresh()), 'Experience updated successfully');
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        $experience = Experience::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $experience->delete();

        return $this->success(null, 'Experience deleted successfully');
    }
}
