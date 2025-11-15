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
use Modules\Tracklink\Entities\Tracklink;

class EmployerJobsController extends Controller
{
    public function index(Request $request)
    {
      $company = $request->user()->company()->firstOrFail();

      $data = $company->jobs()->orderBy('created_at', 'DESC');
      
      if ($request->filled('search'))
      {
          $data->where('title', 'like', '%' . $request->search . '%');
      }
      $data = $data->paginate(10);

      return view('jobs::employer_jobs.index', compact('data'));
    }

    public function create(Request $request)
    {
        $cities = City::active()->get();
        $careerLevels = CareerLevel::active()->get();
        $salaryPeriods = SalaryPeriod::active()->get();
        $functionalAreas = FunctionalArea::active()->get();
        $genders = Gender::active()->get();
        $jobTypes = JobType::active()->get();
        $jobShifts = JobShift::active()->get();
        $degreeLevels = DegreeLevel::active()->get();
        $jobExperiences = JobExperience::active()->get();
        return view('jobs::employer_jobs.create', compact('cities', 'careerLevels', 'salaryPeriods', 'functionalAreas', 'genders', 'jobTypes', 'jobShifts', 'degreeLevels', 'jobExperiences'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required', 
            'city_id' => 'required', 
            'description' => 'required',
            'responbilities' => 'required',
            'requirements' => 'required'
        ]);
        $inputData = $request->all();

        $company = $request->user()->company()->firstOrFail();
        $inputData['company_id'] = $company->id;

        !$request->filled('is_active') ?  $inputData['is_active'] = false : $inputData['is_active'] = true;
        !$request->filled('is_featured') ?  $inputData['is_featured'] = false : $inputData['is_featured'] = true;
        !$request->filled('is_freelance') ?  $inputData['is_freelance'] = false : $inputData['is_freelance'] = true;
        !$request->filled('hide_salary') ?  $inputData['hide_salary'] = false : $inputData['hide_salary'] = true;

        $item = Job::create($inputData);
        
        $item->slug = Str::slug($item->title, '-') . '-' . $item->id;
        $item->update();

        return redirect()
            ->route('company.jobs.index')
            ->with('success', __('Created successfully'));
    }

    public function edit(Request $request, $id)
    {
        $company = $request->user()->company()->firstOrFail();
        $job = $company->jobs()->findOrFail($id);

        $cities = City::active()->get();
        $careerLevels = CareerLevel::active()->get();
        $salaryPeriods = SalaryPeriod::active()->get();
        $functionalAreas = FunctionalArea::active()->get();
        $genders = Gender::active()->get();
        $jobTypes = JobType::active()->get();
        $jobShifts = JobShift::active()->get();
        $degreeLevels = DegreeLevel::active()->get();
        $jobExperiences = JobExperience::active()->get();

        return view('jobs::employer_jobs.edit', compact('job', 'cities', 'careerLevels', 'salaryPeriods', 'functionalAreas', 'genders', 'jobTypes', 'jobShifts', 'degreeLevels', 'jobExperiences'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required', 
            'city_id' => 'required', 
            'description' => 'required',
            'responbilities' => 'required',
            'requirements' => 'required'
        ]);
        $inputData = $request->all();

        $company = $request->user()->company()->firstOrFail();
        $item = $company->jobs()->findOrFail($id);

        $inputData['company_id'] = $company->id;

        $inputData['slug'] = Str::slug($inputData['title'], '-') . '-' . $item->id;

        !$request->filled('is_active') ?  $inputData['is_active'] = false : $inputData['is_active'] = true;
        !$request->filled('is_featured') ?  $inputData['is_featured'] = false : $inputData['is_featured'] = true;
        !$request->filled('is_freelance') ?  $inputData['is_freelance'] = false : $inputData['is_freelance'] = true;
        !$request->filled('hide_salary') ?  $inputData['hide_salary'] = false : $inputData['hide_salary'] = true;

        $item->update($inputData);

        return redirect()
            ->back()
            ->with('success', __('Updated successfully'));
    }

    public function destroy(Request $request, $id)
    {
        $company = $request->user()->company()->firstOrFail();

        $item = $company->jobs()->findOrFail($id);

        if ($item->applicants()->count() > 0) {
            return redirect()->back()->with('error',"Can't delete because it has applicants in it");
        }

        $item->delete();

        return redirect()->route('company.jobs.index')
            ->with('success', __('Deleted successfully'));
    }
}
