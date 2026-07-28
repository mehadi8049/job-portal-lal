<?php

namespace Modules\Jobs\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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

    public function myCompany(Request $request): JsonResponse
    {
        $company = Company::with(['industry', 'city', 'state', 'country', 'ownership_type'])
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$company) {
            return $this->success(null, 'No company profile found.');
        }

        return $this->success(new CompanyResource($company));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'company_name'  => 'required|string|max:155',
            'company_email' => 'required|email|max:155',
            'industry_id'   => 'required|integer',
            'ownership_type_id' => 'sometimes|nullable|integer',
            'description'   => 'sometimes|nullable|string',
            'location'      => 'sometimes|nullable|string|max:255',
            'website'       => 'sometimes|nullable|url|max:255',
            'no_of_offices' => 'sometimes|nullable|integer',
            'no_of_employees' => 'sometimes|nullable|integer',
            'established_in' => 'sometimes|nullable|integer',
            'fax'           => 'sometimes|nullable|string|max:50',
            'phone'         => 'sometimes|nullable|string|max:50',
            'country_id'    => 'sometimes|nullable|integer',
            'state_id'      => 'sometimes|nullable|integer',
            'city_id'       => 'sometimes|nullable|integer',
            'company_ceo'   => 'sometimes|nullable|string|max:255',
            'facebook'      => 'sometimes|nullable|url|max:255',
            'twitter'       => 'sometimes|nullable|url|max:255',
            'linkedin'      => 'sometimes|nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $existing = Company::where('user_id', $request->user()->id)->first();
        if ($existing) {
            return $this->error('You already have a company profile.', 409);
        }

        $data = $validator->validated();
        $data['user_id'] = $request->user()->id;

        $company = Company::create($data);
        $company->slug = 'company_' . $company->id;
        $company->save();

        return $this->success(new CompanyResource($company), 'Company created successfully.', 201);
    }

    public function update(Request $request): JsonResponse
    {
        $company = Company::where('user_id', $request->user()->id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'company_name'  => 'sometimes|required|string|max:155',
            'company_email' => 'sometimes|required|email|max:155',
            'industry_id'   => 'sometimes|required|integer',
            'ownership_type_id' => 'sometimes|nullable|integer',
            'description'   => 'sometimes|nullable|string',
            'location'      => 'sometimes|nullable|string|max:255',
            'website'       => 'sometimes|nullable|url|max:255',
            'no_of_offices' => 'sometimes|nullable|integer',
            'no_of_employees' => 'sometimes|nullable|integer',
            'established_in' => 'sometimes|nullable|integer',
            'fax'           => 'sometimes|nullable|string|max:50',
            'phone'         => 'sometimes|nullable|string|max:50',
            'country_id'    => 'sometimes|nullable|integer',
            'state_id'      => 'sometimes|nullable|integer',
            'city_id'       => 'sometimes|nullable|integer',
            'company_ceo'   => 'sometimes|nullable|string|max:255',
            'facebook'      => 'sometimes|nullable|url|max:255',
            'twitter'       => 'sometimes|nullable|url|max:255',
            'linkedin'      => 'sometimes|nullable|url|max:255',
            'is_active'     => 'sometimes|boolean',
            'is_featured'   => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['slug'] = Str::slug($data['company_name'] ?? $company->company_name, '-') . '-' . $company->id;

        $company->update($data);

        return $this->success(new CompanyResource($company->fresh()), 'Company updated successfully.');
    }

    public function uploadLogo(Request $request): JsonResponse
    {
        $company = Company::where('user_id', $request->user()->id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:jpg,jpeg,png,svg|max:20000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $image = $request->file('logo');
        $path_folder = public_path('storage/user_storage/' . $request->user()->id);

        if (!file_exists($path_folder)) {
            mkdir($path_folder, 0755, true);
        }

        if ($company->logo) {
            $old_path = $path_folder . '/' . $company->logo;
            if (file_exists($old_path)) {
                unlink($old_path);
            }
        }

        $image_name = 'company_logo_' . rand() . '.' . $image->getClientOriginalExtension();
        $image->move($path_folder, $image_name);

        $company->update(['logo' => $image_name]);

        return $this->success(new CompanyResource($company->fresh()), 'Logo uploaded successfully.');
    }
}
