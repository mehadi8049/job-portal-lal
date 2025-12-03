<?php

namespace Modules\Jobs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Jobs\Entities\Company;
use Modules\Jobs\Entities\Industry;
use Modules\Jobs\Entities\OwnershipType;
use Modules\Location\Entities\City;
use Modules\Jobs\Http\Requests\CompanyStoreRequest;
use Modules\User\Entities\User;
use Illuminate\Support\Str;

class CompaniesController extends Controller
{
    public function getCompanies(Request $request, $q = '')
    {
        $skin            = config('app.SITE_LANDING');
        $currency_symbol         = config('app.CURRENCY_SYMBOL');
        $currency_code   = config('app.CURRENCY_CODE');
        $user            = $request->user();

        $cities = City::active()->orderBy('is_default', 'desc')->get();
        $industries = Industry::active()->orderBy('is_default', 'desc')->get();

        $filter_city_id = $request->input('city');
        $filter_industry_id = $request->input('industry');

        $queryCompanies = Company::query()->active()->where('company_name', 'like', '%' . $q . '%');
        if(isset($filter_city_id)) {
            $queryCompanies->where('city_id', '=', $filter_city_id);
        }
        if(isset($filter_industry_id)) {
            $queryCompanies->where('industry_id', '=', $filter_industry_id);
        }

        $data = $queryCompanies->paginate(10);

        return view('themes::' . $skin . '.companies_list', compact(
            'currency_code','currency_symbol','user', 'cities', 'industries', 'data', 'filter_city_id', 'filter_industry_id'
        ));

    }

    public function getCompanyDetail($slug='',Request $request)
    {
        $company = Company::where('slug',$slug)->firstOrFail();

        $skin            = config('app.SITE_LANDING');
        $currency_symbol         = config('app.CURRENCY_SYMBOL');
        $currency_code   = config('app.CURRENCY_CODE');
        $user            = $request->user();

        return view('themes::' . $skin . '.company_detail', compact(
            'currency_code','currency_symbol','user','company'
        ));

    }
    public function index(Request $request)
    {
        $data = Company::orderBy('created_at', 'DESC');
        
        if ($request->filled('search'))
        {
            $data->where('company_name', 'like', '%' . $request->search . '%');
        }
        $data = $data->paginate(10);

        return view('jobs::companies.index', compact('data'));
    }

    public function create(Request $request)
    {
        $employers = User::where('role', 'employer')->get();
        $industries = Industry::active()->get();
        $ownershipType = OwnershipType::active()->get();
        $cities = City::active()->get();

        $no_of_offices = Industry::active()->get();
        $no_of_employees = OwnershipType::active()->get();
        $established_in = City::active()->get();

        return view('jobs::companies.create', compact(
            'industries','ownershipType','cities','employers'
        ));
        
    }
    public function store(Request $request)
    {
       
        $request->validate([
                'user_id' => 'required',
                'logo' => 'required|max:155', 
                'company_name' => 'required|max:155', 
                'company_email' => 'required',
                'industry_id' => 'required',
                'city_id'   => 'required'
            ]
        );
        $inputData = $request->all();

        $user = User::findorFail($inputData['user_id']);

        $image = $request->file('logo');

        !$request->filled('is_active') ?  $inputData['is_active'] = false : $inputData['is_active'] = true;

        !$request->filled('is_featured') ?  $inputData['is_featured'] = false : $inputData['is_featured'] = true;
        
        if ($image != '')
        {
            $request->validate([
                'logo' => 'sometimes|required|mimes:jpg,jpeg,png,svg|max:20000', ], 
                ['logo.mimes' => __('The :attribute must be an jpg,jpeg,png,svg') , ]
            );
            $path_folder = public_path('storage/user_storage/'.$user->id);

            $image_name = "company_logo_" . rand() . '.' . $image->getClientOriginalExtension();
            $image->move($path_folder , $image_name);

            $inputData['logo'] = $image_name;
        }

        $item = Company::create($inputData);
        
        $item->slug = Str::slug($item->company_name, '-') . '-' . $item->id;
        $item->update();

        return redirect()
            ->route('settings.companies.index')
            ->with('success', __('Created successfully'));
    }

    public function edit($id,Request $request)
    {
        $company = Company::findOrFail($id);
        
        $employers = User::where('role', 'employer')->get();
        $industries = Industry::active()->get();
        $ownershipType = OwnershipType::active()->get();
        $cities = City::active()->get();

        $no_of_offices = Industry::active()->get();
        $no_of_employees = OwnershipType::active()->get();
        $established_in = City::active()->get();

        return view('jobs::companies.edit', compact(
            'employers','company','industries','ownershipType','cities'
        ));
        
    }

    public function update($id,Request $request)
    {
        $request->validate([
                'user_id' => 'required',
                'company_name' => 'required|max:155', 
                'company_email' => 'required',
                'industry_id' => 'required',
                'city_id'   => 'required'
            ]
        );
        $item = Company::findorFail($id);

        $inputData = $request->all();

        $user = User::findorFail($inputData['user_id']);

        
        $inputData['slug'] = Str::slug($inputData['company_name'], '-') . '-' . $item->id;
        
        !$request->filled('is_active') ?  $inputData['is_active'] = false : $inputData['is_active'] = true;

        !$request->filled('is_featured') ?  $inputData['is_featured'] = false : $inputData['is_featured'] = true;

        $image = $request->file('logo');

        if ($image != '')
        {
            $request->validate([
                'logo' => 'sometimes|required|mimes:jpg,jpeg,png,svg|max:20000', ], 
                ['logo.mimes' => __('The :attribute must be an jpg,jpeg,png,svg') , ]
            );
            $path_folder = public_path('storage/user_storage/'.$user->id);

            $path = $path_folder."/".$item->logo;
            deleteImageWithPath($path);
            
            $image_name = "company_logo_" . rand() . '.' . $image->getClientOriginalExtension();
            $image->move($path_folder , $image_name);

            $inputData['logo'] = $image_name;
        }
        else $inputData['logo'] = $item->logo;

        $item->update($inputData);

        return redirect()
            ->back()
            ->with('success', __('Updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Company::findOrFail($id);

        if ($item->jobs()->count() > 0) {
            return redirect()->back()->with('error',"Can't delete because it has jobs in it");
        }

        // delete image
        $path = public_path('storage/thumb_templates') . "/" . $item->thumb;
        $path_folder = public_path('storage/user_storage/'.$item->user->id);
        $path = $path_folder."/".$item->logo;
        deleteImageWithPath($path);

        $item->delete();

        return redirect()->route('settings.companies.index')
            ->with('success', __('Deleted successfully'));
    }
    

}
