<?php

namespace Modules\Jobs\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Jobs\Entities\Company;
use Modules\Jobs\Http\Resources\CompanyResource;

class CompanyController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = Company::with(['industry', 'city'])
            ->active()
            ->withCount('jobs');

        if ($search = $request->input('search')) {
            $query->where('company_name', 'like', "%{$search}%");
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('industry_id')) {
            $query->where('industry_id', $request->industry_id);
        }

        if ($request->boolean('featured')) {
            $query->orderBy('is_featured', 'desc');
        }

        $query->orderBy('created_at', 'desc');

        $perPage = min((int) $request->input('per_page', 15), 50);
        $companies = $query->paginate($perPage);

        return $this->paginated($companies, CompanyResource::class);
    }

    public function show($slug): JsonResponse
    {
        $company = Company::with(['industry', 'city', 'state', 'country', 'ownership_type'])
            ->withCount('jobs')
            ->where('slug', $slug)
            ->firstOrFail();

        return $this->success(new CompanyResource($company));
    }
}
