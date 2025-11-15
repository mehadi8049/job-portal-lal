<?php

namespace Modules\Jobs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Jobs\Entities\CareerLevel;
use Modules\Jobs\Entities\Company;
use Modules\Jobs\Entities\DegreeLevel;
use Modules\Jobs\Entities\FunctionalArea;
use Modules\Jobs\Entities\Gender;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Entities\JobExperience;
use Modules\Jobs\Entities\JobShift;
use Modules\Jobs\Entities\JobType;
use Modules\Jobs\Entities\SalaryPeriod;
use Modules\Location\Entities\City;
use Modules\Jobs\Http\Requests\ApplyJobRequest;
use Modules\Jobs\Entities\JobApplicant;

class EmployerApplicantsController extends Controller
{
    public function index(Request $request)
    {
      $company = $request->user()->company()->firstOrFail();
      $data = JobApplicant::where('company_id',$company->id)->orderBy('created_at', 'DESC');

      if ($request->filled('search'))
      {
          $data->where('fullname', 'like', '%' . $request->search . '%');
      }
      $data = $data->paginate(10);

      return view('jobs::employer_applicants.index', compact('data'));
    }

    public function apply(ApplyJobRequest $request)
    {
        $data = $request->validated();

        if(!isset($data['resume_link']) && !isset($data['resume_pdf'])) {
            return back()->withInput()->withErrors([
                'resume_link' => 'Your resume is required',
                'resume_pdf'=> 'Your resume is required',
            ]);
        }

        //$company = Company::findorFail($request->input('company_id'));

        $pdf = $request->file('resume_pdf');

        if ($pdf != '')
        {
            $rel_path = 'storage/resume_cvs_apply';
            
            $path_folder = public_path($rel_path);

            $file_name = "resume_" . strtotime("now") . '.' . $pdf->getClientOriginalExtension();
            $pdf->move($path_folder , $file_name);

            $data['resume_pdf'] = $file_name;
        } 
        else $data['resume_pdf'] = null;

        $jobResume = JobApplicant::create($data);
        return redirect()->back()->with('success', __('Apply success'));
    }

    public function destroy(Request $request, $id)
    {
        $company = $request->user()->company()->firstOrFail();

        $item = JobApplicant::findOrFail($id);

        $item->delete();

        return redirect()->route('company.applicants.index')
            ->with('success', __('Deleted successfully'));
    }
}
