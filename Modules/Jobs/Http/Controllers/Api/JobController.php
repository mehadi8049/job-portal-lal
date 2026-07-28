<?php

namespace Modules\Jobs\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Jobs\Entities\CareerLevel;
use Modules\Jobs\Entities\DegreeLevel;
use Modules\Jobs\Entities\FunctionalArea;
use Modules\Jobs\Entities\Gender;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Entities\JobApplicant;
use Modules\Jobs\Entities\JobExperience;
use Modules\Jobs\Entities\JobShift;
use Modules\Jobs\Entities\JobType;
use Modules\Jobs\Entities\OwnershipType;
use Modules\Jobs\Entities\SalaryPeriod;
use Modules\Jobs\Http\Resources\JobResource;
use Modules\Location\Entities\City;

class JobController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = Job::with(['company', 'city', 'job_type', 'functional_area'])
            ->active();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('company', function ($cq) use ($search) {
                      $cq->where('company_name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('city', function ($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('job_type', function ($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('functional_area_id')) {
            $query->where('functional_area_id', $request->functional_area_id);
        }

        if ($request->filled('job_type_id')) {
            $query->where('job_type_id', $request->job_type_id);
        }

        if ($request->filled('salary_from')) {
            $query->where('salary_to', '>=', $request->salary_from);
        }

        if ($request->filled('salary_to')) {
            $query->where('salary_from', '<=', $request->salary_to);
        }

        if ($request->filled('career_level_id')) {
            $query->where('career_level_id', $request->career_level_id);
        }

        if ($request->filled('industry_id')) {
            $query->whereHas('company', function ($cq) use ($request) {
                $cq->where('industry_id', $request->industry_id);
            });
        }

        if ($request->boolean('featured')) {
            $query->orderBy('is_featured', 'desc');
        }

        $order = $request->input('order', 'latest');
        if ($order === 'latest') {
            $query->orderBy('created_at', 'desc');
        }

        $perPage = min((int) $request->input('per_page', 15), 50);
        $jobs = $query->paginate($perPage);

        return $this->paginated($jobs, JobResource::class);
    }

    public function show($id): JsonResponse
    {
        $job = Job::with([
            'company', 'city', 'job_type', 'functional_area',
            'job_experience', 'gender', 'degree_level',
            'career_level', 'job_salary_period', 'job_shift',
        ])->active()->findOrFail($id);

        return $this->success(new JobResource($job));
    }

    public function similar(Request $request, $id): JsonResponse
    {
        $job = Job::active()->findOrFail($id);

        $similar = Job::with(['company', 'city', 'job_type'])
            ->active()
            ->where('id', '!=', $job->id)
            ->where('functional_area_id', $job->functional_area_id)
            ->orderBy('is_featured', 'desc')
            ->limit(8)
            ->get();

        return $this->success(JobResource::collection($similar));
    }

    public function filters(): JsonResponse
    {
        return $this->success([
            'functional_areas' => FunctionalArea::active()->orderBy('is_default', 'desc')->get(['id', 'name']),
            'job_types'        => JobType::active()->orderBy('is_default', 'desc')->get(['id', 'name']),
            'cities'           => City::active()->orderBy('is_default', 'desc')->get(['id', 'name']),
            'career_levels'    => CareerLevel::active()->get(['id', 'name']),
            'degree_levels'    => DegreeLevel::active()->get(['id', 'name']),
            'job_experiences'  => JobExperience::active()->get(['id', 'name']),
            'salary_periods'   => SalaryPeriod::active()->get(['id', 'name']),
            'job_shifts'       => JobShift::active()->get(['id', 'name']),
            'genders'          => Gender::active()->get(['id', 'name']),
            'ownership_types'  => OwnershipType::active()->orderBy('is_default', 'desc')->get(['id', 'name']),
        ]);
    }

    public function apply(Request $request, $id): JsonResponse
    {
        $job = Job::active()->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'fullname'    => 'required|string|max:191',
            'email'       => 'required|email|max:191',
            'description' => 'nullable|string|max:255',
            'resume_link' => 'nullable|url|max:191',
            'resume_pdf'  => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        if (!isset($data['resume_link']) && !$request->hasFile('resume_pdf')) {
            return $this->error('Please provide a resume (link or PDF file).', 422);
        }

        $data['job_id'] = $job->id;
        $data['company_id'] = $job->company_id;

        if ($request->hasFile('resume_pdf')) {
            $file = $request->file('resume_pdf');
            $rel_path = 'storage/resume_cvs_apply';
            $path_folder = public_path($rel_path);
            $file_name = 'resume_' . strtotime('now') . '.' . $file->getClientOriginalExtension();
            $file->move($path_folder, $file_name);
            $data['resume_pdf'] = $file_name;
        }

        JobApplicant::create($data);

        return $this->success(null, 'Application submitted successfully.', 201);
    }
}
