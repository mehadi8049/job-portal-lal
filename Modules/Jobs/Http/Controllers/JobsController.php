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
use Modules\Jobs\Http\Requests\ApplyJobRequest;
use Modules\Location\Entities\City;
use Modules\Tracklink\Entities\Tracklink;

class JobsController extends Controller
{

    public function getJobsList(Request $request, $q = '')
    {
        $skin            = config('app.SITE_LANDING');
        $currency_symbol         = config('app.CURRENCY_SYMBOL');
        $currency_code   = config('app.CURRENCY_CODE');
        $user            = $request->user();

        $cities = City::active()->orderBy('is_default', 'desc')->get();
        $functional_areas = FunctionalArea::active()->orderBy('is_default', 'desc')->get();
        $job_types = JobType::active()->orderBy('is_default', 'desc')->get();

        $filter_city_id = $request->input('city');
        $filter_functional_area_id = $request->input('functionalarea');
        $filter_job_type_id = $request->input('jobtype');
        $filter_salary_from = $request->input('salaryfrom');
        $filter_salary_to = $request->input('salaryto');
        $filter_featured = $request->input('featured');
        $filter_lastest = $request->input('lastest');

        $queryJobs = Job::query()->active()->where('title', 'like', '%' . $q . '%');
        if(isset($filter_city_id)) {
            $queryJobs->where('city_id', '=', $filter_city_id);
        }
        if(isset($filter_functional_area_id)) {
            $queryJobs->where('functional_area_id', '=', $filter_functional_area_id);
        }
        if(isset($filter_job_type_id)) {
            $queryJobs->where('job_type_id', '=', $filter_job_type_id);
        }
        if(isset($filter_salary_from)) {
            $queryJobs->where('salary_to', '>=', $filter_salary_from);
        }
        if(isset($filter_salary_to)) {
            $queryJobs->where('salary_from', '<=', $filter_salary_to);
        }

        if(isset($filter_featured) && $filter_featured == '1') {
           $queryJobs->orderBy('is_featured', 'desc');
        }
        if(isset($filter_lastest) && $filter_lastest == '1') {
            $queryJobs->orderBy('created_at', 'desc');
        }

        $data = $queryJobs->paginate(10);


        return view('themes::' . $skin . '.jobs_list', compact(
            'currency_code','currency_symbol','user', 'q', 'filter_city_id', 'filter_functional_area_id', 'filter_job_type_id', 'filter_salary_from', 'filter_salary_to', 'data', 'cities', 'functional_areas', 'job_types'
        ));

    }

    public function getJobDetail(Request $request, $slug)
    {
        $skin            = config('app.SITE_LANDING');
        $currency_symbol         = config('app.CURRENCY_SYMBOL');
        $currency_code   = config('app.CURRENCY_CODE');
        $user            = $request->user();

        $job = Job::where('slug', $slug)->active()->firstOrFail();

        $siblings = Job::active()->where('id', '!=', $job->id)
                                ->where('functional_area_id', '=', $job->functional_area_id)
                                ->orderBy('is_featured', 'desc')->limit(8)->get();

        Tracklink::save_from_request($request, Job::class, $job->id);
        return view('themes::' . $skin . '.job_details', compact(
            'currency_code','currency_symbol','user', 'job', 'siblings'
        ));

    }
    
    public function index(Request $request)
    {
        $data = Job::orderBy('created_at', 'DESC');
        
        if ($request->filled('search'))
        {
            $data->where('title', 'like', '%' . $request->search . '%');
        }
        $data = $data->paginate(10);

        return view('jobs::jobs.index', compact('data'));
    }

    public function create(Request $request)
    {
        $companies = Company::active()->get();
        $cities = City::active()->get();
        $careerLevels = CareerLevel::active()->get();
        $salaryPeriods = SalaryPeriod::active()->get();
        $functionalAreas = FunctionalArea::active()->get();
        $genders = Gender::active()->get();
        $jobTypes = JobType::active()->get();
        $jobShifts = JobShift::active()->get();
        $degreeLevels = DegreeLevel::active()->get();
        $jobExperiences = JobExperience::active()->get();
        return view('jobs::jobs.create', compact('companies', 'cities', 'careerLevels', 'salaryPeriods', 'functionalAreas', 'genders', 'jobTypes', 'jobShifts', 'degreeLevels', 'jobExperiences'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'title' => 'required', 
            'city_id' => 'required', 
            'description' => 'required',
            'responbilities' => 'required',
            'requirements' => 'required'
        ]);
        $inputData = $request->all();

        !$request->filled('is_active') ?  $inputData['is_active'] = false : $inputData['is_active'] = true;
        !$request->filled('is_featured') ?  $inputData['is_featured'] = false : $inputData['is_featured'] = true;
        !$request->filled('is_freelance') ?  $inputData['is_freelance'] = false : $inputData['is_freelance'] = true;
        !$request->filled('hide_salary') ?  $inputData['hide_salary'] = false : $inputData['hide_salary'] = true;

        $item = Job::create($inputData);
        
        $item->slug = Str::slug($item->title, '-') . '-' . $item->id;
        $item->update();

        return redirect()
            ->route('settings.jobs.index')
            ->with('success', __('Created successfully'));
    }

    public function edit(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        $companies = Company::active()->get();
        $cities = City::active()->get();
        $careerLevels = CareerLevel::active()->get();
        $salaryPeriods = SalaryPeriod::active()->get();
        $functionalAreas = FunctionalArea::active()->get();
        $genders = Gender::active()->get();
        $jobTypes = JobType::active()->get();
        $jobShifts = JobShift::active()->get();
        $degreeLevels = DegreeLevel::active()->get();
        $jobExperiences = JobExperience::active()->get();

        return view('jobs::jobs.edit', compact('job', 'companies', 'cities', 'careerLevels', 'salaryPeriods', 'functionalAreas', 'genders', 'jobTypes', 'jobShifts', 'degreeLevels', 'jobExperiences'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'company_id' => 'required',
            'title' => 'required', 
            'city_id' => 'required', 
            'description' => 'required',
            'responbilities' => 'required',
            'requirements' => 'required'
        ]);
        $inputData = $request->all();
        $item = Job::findorFail($id);
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
        $item = Job::findOrFail($id);

        if ($item->applicants()->count() > 0) {
            return redirect()->back()->with('error',"Can't delete because it has applicants in it");
        }

        $item->delete();

        return redirect()->route('settings.companies.index')
            ->with('success', __('Deleted successfully'));
    }

}
