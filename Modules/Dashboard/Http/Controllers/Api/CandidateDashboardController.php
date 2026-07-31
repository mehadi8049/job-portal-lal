<?php

namespace Modules\Dashboard\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Entities\JobApplicant;
use Modules\Jobs\Http\Resources\JobResource;
use Modules\ResumeCV\Entities\Resumecv;

class CandidateDashboardController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $stats = $this->computeStats($user);

        $recentResumes = Resumecv::where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();

        $recentApplications = $this->recentApplicationsQuery($user)
            ->limit(5)
            ->get();

        $recommendedJobs = $this->recommendedJobsQuery($user)
            ->limit(5)
            ->get();

        return $this->success([
            'profile_completion' => $this->computeProfileCompletion($user),
            'stats'              => $stats,
            'recent_resumes'     => $recentResumes,
            'recent_applications' => $recentApplications->map(function ($applicant) {
                return $this->formatApplication($applicant);
            })->values(),
            'recommended_jobs'   => JobResource::collection($recommendedJobs),
        ]);
    }

    public function stats(Request $request): JsonResponse
    {
        return $this->success($this->computeStats($request->user()));
    }

    public function profileCompletion(Request $request): JsonResponse
    {
        return $this->success($this->computeProfileCompletion($request->user()));
    }

    public function recentResumes(Request $request): JsonResponse
    {
        $perPage = min((int) $request->input('per_page', 10), 50);
        $resumes = Resumecv::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);

        return $this->success(
            $resumes->items(),
            'Recent resumes.',
            200,
            [
                'meta' => [
                    'current_page' => $resumes->currentPage(),
                    'last_page'    => $resumes->lastPage(),
                    'per_page'     => $resumes->perPage(),
                    'total'        => $resumes->total(),
                ],
            ]
        );
    }

    public function recentApplications(Request $request): JsonResponse
    {
        $perPage = min((int) $request->input('per_page', 10), 50);
        $applications = $this->recentApplicationsQuery($request->user())
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);

        return $this->success(
            collect($applications->items())->map(function ($applicant) {
                return $this->formatApplication($applicant);
            })->values(),
            'Recent applications.',
            200,
            [
                'meta' => [
                    'current_page' => $applications->currentPage(),
                    'last_page'    => $applications->lastPage(),
                    'per_page'     => $applications->perPage(),
                    'total'        => $applications->total(),
                ],
            ]
        );
    }

    public function recommendedJobs(Request $request): JsonResponse
    {
        $perPage = min((int) $request->input('per_page', 10), 50);
        $jobs = $this->recommendedJobsQuery($request->user())
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);

        return $this->paginated($jobs, JobResource::class, 'Recommended jobs.');
    }

    protected function computeStats($user): array
    {
        return [
            'total_resumes'      => Resumecv::where('user_id', $user->id)->count(),
            'total_views'        => (int) Resumecv::where('user_id', $user->id)->sum('view_count'),
            'total_applications' => JobApplicant::where('email', $user->email)->count(),
            'profile_completion' => $this->computeProfileCompletion($user)['percentage'],
        ];
    }

    protected function computeProfileCompletion($user): array
    {
        $criteria = [
            'photo'             => !empty($user->photo),
            'primary_mobile'    => !empty($user->primary_mobile),
            'date_of_birth'     => !empty($user->date_of_birth),
            'gender'            => !empty($user->gender),
            'present_address'   => !empty($user->present_address),
            'objective'         => !empty($user->objective),
            'career_summary'    => !empty($user->career_summary),
            'expected_salary'   => !empty($user->expected_salary),
            'job_level'         => !empty($user->job_level),
            'job_nature'        => !empty($user->job_nature),
            'experiences'       => $user->experiences()->count() > 0,
            'qualifications'    => $user->qualifications()->count() > 0,
            'skills'            => $user->skills()->count() > 0,
            'languages'         => $user->languageProficiencies()->count() > 0,
        ];

        $completed = array_filter($criteria);

        return [
            'percentage' => count($criteria) > 0 ? round((count($completed) / count($criteria)) * 100) : 0,
            'completed'  => count($completed),
            'total'      => count($criteria),
            'checklist'  => $criteria,
        ];
    }

    protected function recentApplicationsQuery($user)
    {
        return JobApplicant::with(['job.company', 'job.city', 'job.job_type'])
            ->where('email', $user->email)
            ->orderBy('created_at', 'DESC');
    }

    protected function recommendedJobsQuery($user)
    {
        $preferredCategoryIds = $user->preferredJobCategories()
            ->pluck('functional_area_id')
            ->filter()
            ->values();

        $query = Job::with(['company', 'city', 'job_type', 'functional_area'])
            ->active();

        $query->where(function ($q) use ($preferredCategoryIds, $user) {
            if ($preferredCategoryIds->isNotEmpty()) {
                $q->whereIn('functional_area_id', $preferredCategoryIds);
            }

            if ($user->expected_salary) {
                $q->orWhere(function ($salaryQ) use ($user) {
                    $salaryQ->whereNull('salary_to')->orWhere('salary_to', '>=', $user->expected_salary);
                });
            }

            if ($user->job_level) {
                $q->orWhere('career_level_id', $user->job_level);
            }
        });

        return $query->latest();
    }

    protected function formatApplication($applicant): array
    {
        $job = $applicant->job;

        return [
            'id'          => $applicant->id,
            'job_id'      => $applicant->job_id,
            'company_id'  => $applicant->company_id,
            'job_title'   => $job->title ?? null,
            'job_slug'    => $job->slug ?? null,
            'company'     => $job->company ? [
                'id'           => $job->company->id,
                'company_name' => $job->company->company_name,
                'logo'         => $job->company->logo ? $job->company->getLogoLink() : null,
            ] : null,
            'status'      => null,
            'applied_at'  => $applicant->created_at,
        ];
    }
}
