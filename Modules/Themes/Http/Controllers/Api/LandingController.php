<?php

namespace Modules\Themes\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Jobs\Entities\Company;
use Modules\Jobs\Entities\FunctionalArea;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Entities\OwnershipType;
use Modules\Jobs\Http\Resources\CompanyResource;
use Modules\Jobs\Http\Resources\JobResource;
use Modules\Location\Entities\City;
use Modules\QuickLink\Entities\QuickLink;

class LandingController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $featuredCompanies = Company::with('jobs')
            ->active()
            ->featured()
            ->limit(12)
            ->get();

        $totalCompanies = Company::active()->count();

        $jobStats = Job::selectRaw("
            COUNT(*) AS total_jobs,
            SUM(CASE WHEN created_at >= ? THEN 1 ELSE 0 END) AS last_7_days_jobs,
            SUM(CASE WHEN expiry_date >= ? THEN 1 ELSE 0 END) AS not_expired_jobs
        ", [now()->subDays(7), now()])
            ->active()
            ->first();

        $featuredJobs = Job::with(['company', 'city', 'job_type', 'functional_area'])
            ->active()
            ->featured()
            ->limit(12)
            ->get();

        $latestJobs = Job::with(['company', 'city', 'job_type', 'functional_area'])
            ->active()
            ->orderBy('created_at', 'desc')
            ->limit(12)
            ->get();

        $functionalAreas = FunctionalArea::withCount('jobs')
            ->active()
            ->orderBy('is_default', 'desc')
            ->orderBy('jobs_count', 'desc')
            ->limit(30)
            ->get();

        $cities = City::active()
            ->orderBy('is_default', 'desc')
            ->orderBy('name', 'asc')
            ->get()
            ->map(function ($city) {
                return [
                    'id'   => $city->id,
                    'name' => $city->name,
                ];
            });

        $organizationTypes = OwnershipType::active()
            ->orderBy('is_default', 'desc')
            ->get()
            ->map(function ($type) {
                return [
                    'id'   => $type->id,
                    'name' => $type->name,
                ];
            });

        $quickLinks = QuickLink::where('is_active', true)
            ->orderBy('serial', 'asc')
            ->get()
            ->map(function ($link) {
                return [
                    'id'      => $link->id,
                    'title'   => $link->title,
                    'url'     => $link->link_url,
                ];
            });

        return $this->success([
            'stats' => [
                'current_jobs'          => (int) $jobStats->total_jobs,
                'opportunities'         => (int) $jobStats->total_jobs,
                'last_7_days_jobs'      => (int) $jobStats->last_7_days_jobs,
                'not_expired_jobs'      => (int) $jobStats->not_expired_jobs,
                'total_companies'       => $totalCompanies,
                'total_functional_areas'=> $functionalAreas->count(),
                'total_cities'          => $cities->count(),
            ],
            'featured_companies' => CompanyResource::collection($featuredCompanies),
            'featured_jobs'      => JobResource::collection($featuredJobs),
            'latest_jobs'        => JobResource::collection($latestJobs),
            'functional_areas'   => $functionalAreas->map(function ($area) {
                return [
                    'id'         => $area->id,
                    'name'       => $area->name,
                    'jobs_count' => $area->jobs_count,
                ];
            }),
            'cities'             => $cities,
            'organization_types' => $organizationTypes,
            'quick_links'        => $quickLinks,
        ]);
    }
}
