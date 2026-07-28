<?php

namespace Modules\Jobs\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Http\Resources\JobResource;

class EmployerJobController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $company = $request->user()->company()->firstOrFail();
        $query = $company->jobs()->with(['city', 'job_type', 'functional_area']);

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        $query->orderBy('created_at', 'desc');
        $perPage = min((int) $request->input('per_page', 15), 50);
        $jobs = $query->paginate($perPage);

        return $this->paginated($jobs, JobResource::class);
    }

    public function store(Request $request): JsonResponse
    {
        $company = $request->user()->company()->firstOrFail();

        $validator = Validator::make($request->all(), [
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'responbilities'    => 'required|string',
            'requirements'      => 'required|string',
            'city_id'           => 'required|integer',
            'benefits'          => 'sometimes|nullable|string',
            'country_id'        => 'sometimes|nullable|integer',
            'state_id'          => 'sometimes|nullable|integer',
            'is_freelance'      => 'sometimes|boolean',
            'career_level_id'   => 'sometimes|nullable|integer',
            'salary_from'       => 'sometimes|nullable|numeric',
            'salary_to'         => 'sometimes|nullable|numeric',
            'hide_salary'       => 'sometimes|boolean',
            'salary_currency'   => 'sometimes|nullable|string|max:10',
            'salary_period_id'  => 'sometimes|nullable|integer',
            'functional_area_id' => 'sometimes|nullable|integer',
            'job_type_id'       => 'sometimes|nullable|integer',
            'job_shift_id'      => 'sometimes|nullable|integer',
            'num_of_positions'  => 'sometimes|nullable|integer',
            'gender_id'         => 'sometimes|nullable|integer',
            'expiry_date'       => 'sometimes|nullable|date',
            'degree_level_id'   => 'sometimes|nullable|integer',
            'job_experience_id' => 'sometimes|nullable|integer',
            'job_skill_id'      => 'sometimes|nullable|integer',
            'is_active'         => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['company_id'] = $company->id;
        $data['is_featured'] = $request->boolean('is_featured', false);
        $data['is_freelance'] = $request->boolean('is_freelance', false);
        $data['hide_salary'] = $request->boolean('hide_salary', false);

        $job = Job::create($data);
        $job->slug = Str::slug($job->title, '-') . '-' . $job->id;
        $job->save();

        return $this->success(new JobResource($job), 'Job created successfully.', 201);
    }

    public function show(Request $request, $id): JsonResponse
    {
        $company = $request->user()->company()->firstOrFail();
        $job = $company->jobs()->with([
            'city', 'job_type', 'functional_area', 'job_experience',
            'gender', 'degree_level', 'career_level', 'job_salary_period', 'job_shift',
        ])->findOrFail($id);

        return $this->success(new JobResource($job));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $company = $request->user()->company()->firstOrFail();
        $job = $company->jobs()->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title'             => 'sometimes|required|string|max:255',
            'description'       => 'sometimes|required|string',
            'responbilities'    => 'sometimes|required|string',
            'requirements'      => 'sometimes|required|string',
            'city_id'           => 'sometimes|required|integer',
            'benefits'          => 'sometimes|nullable|string',
            'country_id'        => 'sometimes|nullable|integer',
            'state_id'          => 'sometimes|nullable|integer',
            'is_freelance'      => 'sometimes|boolean',
            'career_level_id'   => 'sometimes|nullable|integer',
            'salary_from'       => 'sometimes|nullable|numeric',
            'salary_to'         => 'sometimes|nullable|numeric',
            'hide_salary'       => 'sometimes|boolean',
            'salary_currency'   => 'sometimes|nullable|string|max:10',
            'salary_period_id'  => 'sometimes|nullable|integer',
            'functional_area_id' => 'sometimes|nullable|integer',
            'job_type_id'       => 'sometimes|nullable|integer',
            'job_shift_id'      => 'sometimes|nullable|integer',
            'num_of_positions'  => 'sometimes|nullable|integer',
            'gender_id'         => 'sometimes|nullable|integer',
            'expiry_date'       => 'sometimes|nullable|date',
            'degree_level_id'   => 'sometimes|nullable|integer',
            'job_experience_id' => 'sometimes|nullable|integer',
            'job_skill_id'      => 'sometimes|nullable|integer',
            'is_active'         => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['company_id'] = $company->id;
        $data['slug'] = Str::slug($data['title'] ?? $job->title, '-') . '-' . $job->id;

        if (isset($data['is_featured'])) {
            $data['is_featured'] = $request->boolean('is_featured');
        }
        if (isset($data['is_freelance'])) {
            $data['is_freelance'] = $request->boolean('is_freelance');
        }
        if (isset($data['hide_salary'])) {
            $data['hide_salary'] = $request->boolean('hide_salary');
        }

        $job->update($data);

        return $this->success(new JobResource($job->fresh()), 'Job updated successfully.');
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        $company = $request->user()->company()->firstOrFail();
        $job = $company->jobs()->findOrFail($id);

        if ($job->applicants()->count() > 0) {
            return $this->error('Cannot delete because it has applicants.', 409);
        }

        $job->delete();

        return $this->success(null, 'Job deleted successfully.');
    }
}
