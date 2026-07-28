<?php

namespace Modules\Jobs\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Jobs\Entities\JobApplicant;

class EmployerApplicantController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $company = $request->user()->company()->firstOrFail();
        $query = JobApplicant::where('company_id', $company->id)
            ->with('job')
            ->orderBy('created_at', 'desc');

        if ($search = $request->input('search')) {
            $query->where('fullname', 'like', "%{$search}%");
        }

        if ($request->filled('job_id')) {
            $query->where('job_id', $request->job_id);
        }

        $perPage = min((int) $request->input('per_page', 15), 50);
        $applicants = $query->paginate($perPage);

        return $this->paginated($applicants, 'Modules\Jobs\Http\Resources\ApplicantResource');
    }

    public function show(Request $request, $id): JsonResponse
    {
        $company = $request->user()->company()->firstOrFail();
        $applicant = JobApplicant::where('company_id', $company->id)
            ->with('job')
            ->findOrFail($id);

        return $this->success([
            'id'          => $applicant->id,
            'job_id'      => $applicant->job_id,
            'fullname'    => $applicant->fullname,
            'email'       => $applicant->email,
            'description' => $applicant->description,
            'resume_link' => $applicant->resume_link,
            'resume_pdf'  => $applicant->resume_pdf
                ? url('storage/resume_cvs_apply/' . $applicant->resume_pdf)
                : null,
            'created_at'  => $applicant->created_at,
            'job'         => $applicant->job ? [
                'id'    => $applicant->job->id,
                'title' => $applicant->job->title,
                'slug'  => $applicant->job->slug,
            ] : null,
        ]);
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        $company = $request->user()->company()->firstOrFail();
        $applicant = JobApplicant::where('company_id', $company->id)->findOrFail($id);
        $applicant->delete();

        return $this->success(null, 'Applicant deleted successfully.');
    }
}
