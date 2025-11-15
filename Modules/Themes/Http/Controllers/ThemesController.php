<?php

namespace Modules\Themes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\App;
use JoeDixon\Translation\Drivers\Translation;
use Module;
use Modules\ResumeCV\Entities\Resumecvtemplate;
use Modules\ResumeCV\Entities\Resumecvcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Blogs\Entities\Blog;
use Modules\Blogs\Entities\Category;
use Modules\Contacts\Entities\Contact;
use Modules\Jobs\Entities\Company;
use Modules\Jobs\Entities\FunctionalArea;
use Modules\Jobs\Entities\Industry;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Entities\JobType;
use Modules\Location\Entities\City;
use Modules\Tracklink\Entities\Tracklink;

class ThemesController extends Controller
{
    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
    }
    
    public function getLandingPage(Request $request)
    {
        $skin            = config('app.SITE_LANDING');
        $currency_symbol         = config('app.CURRENCY_SYMBOL');
        $currency_code   = config('app.CURRENCY_CODE');
        $user            = $request->user();
        $companies = Company::active()->featured()->limit(12)->get();
        $featuredJobs = Job::active()->featured()->limit(12)->get();
        $lastestJobs = Job::active()->orderBy('created_at', 'desc')->limit(12)->get();
        $cities = City::active()->orderBy('is_default', 'desc')->get();
        $functional_areas = FunctionalArea::active()->orderBy('is_default', 'desc')->get();
        return view('themes::' . $skin . '.home', compact(
            'user','currency_symbol','currency_code', 'companies', 'cities', 'functional_areas', 'featuredJobs', 'lastestJobs'
        ));

    }
    
    public function localize($locale)
    {
        
        $languages = $this->translation->allLanguages();
        $locale = $languages->has($locale) ? $locale : config('app.fallback_locale');

        App::setLocale($locale);

        session()->put('locale', $locale);

        return redirect()->back();
    }
}
