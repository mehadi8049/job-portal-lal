<?php

namespace Modules\User\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\User\Entities\Qualification;
use Modules\User\Http\Resources\QualificationResource;

class QualificationController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $qualifications = $request->user()->qualifications()->orderBy('passing_year', 'desc')->get();
        return $this->success(QualificationResource::collection($qualifications));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'education_level' => 'required|string|max:255',
            'degree_title'    => 'required|string|max:255',
            'major'           => 'sometimes|nullable|string|max:255',
            'institute_name'  => 'sometimes|nullable|string|max:255',
            'result_type'     => 'sometimes|nullable|string|max:50',
            'cgpa'            => 'sometimes|nullable|numeric',
            'scale'           => 'sometimes|nullable|numeric',
            'passing_year'    => 'nullable|integer|min:1950|max:' . date('Y'),
            'duration_years'  => 'sometimes|nullable|numeric',
            'achievement'     => 'sometimes|nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $qualification = Qualification::create($data);

        return $this->success(new QualificationResource($qualification), 'Qualification added successfully', 201);
    }

    public function show(Request $request, $id): JsonResponse
    {
        $qualification = Qualification::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        return $this->success(new QualificationResource($qualification));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $qualification = Qualification::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();

        $request->validate([
            'education_level' => 'sometimes|required|string|max:255',
            'degree_title'    => 'sometimes|required|string|max:255',
            'major'           => 'sometimes|nullable|string|max:255',
            'institute_name'  => 'sometimes|nullable|string|max:255',
            'result_type'     => 'sometimes|nullable|string|max:50',
            'cgpa'            => 'sometimes|nullable|numeric',
            'scale'           => 'sometimes|nullable|numeric',
            'passing_year'    => 'nullable|integer|min:1950|max:' . date('Y'),
            'duration_years'  => 'sometimes|nullable|numeric',
            'achievement'     => 'sometimes|nullable|string',
        ]);

        $qualification->update($request->all());

        return $this->success(new QualificationResource($qualification->fresh()), 'Qualification updated successfully');
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        $qualification = Qualification::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $qualification->delete();

        return $this->success(null, 'Qualification deleted successfully');
    }
}
