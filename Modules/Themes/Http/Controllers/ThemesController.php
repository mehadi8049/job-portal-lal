<?php

namespace Modules\Themes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JoeDixon\Translation\Drivers\Translation;
use Module;
use Modules\Blogs\Entities\Blog;
use Modules\Blogs\Entities\Category;
use Modules\Contacts\Entities\Contact;
use Modules\Jobs\Entities\Company;
use Modules\Jobs\Entities\FunctionalArea;
use Modules\Jobs\Entities\Industry;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Entities\JobType;
use Modules\Jobs\Entities\OwnershipType;
use Modules\Location\Entities\City;
use Modules\QuickLink\Entities\QuickLink;
use Modules\ResumeCV\Entities\Resumecvcategory;
use Modules\ResumeCV\Entities\Resumecvtemplate;
use Modules\Tracklink\Entities\Tracklink;
use Modules\User\Entities\User;

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
        $total_companies = Company::active()->count();
        $total_job = Job::selectRaw("
        SUM(CASE WHEN created_at >= ? THEN 1 ELSE 0 END) AS last_7_days_jobs,
        SUM(CASE WHEN expiry_date >= ? THEN 1 ELSE 0 END) AS not_expired_jobs
    ", [now()->subDays(7), now()])
            ->active()
            ->first();
        $featuredJobs = Job::active()->featured()->limit(12)->get();
        $lastestJobs = Job::active()->orderBy('created_at', 'desc')->limit(12)->get();
        $cities = City::active()->orderBy('is_default', 'desc')->get();
        $total = FunctionalArea::active()->count();
        $functional_areas = FunctionalArea::withCount('jobs')->active()
            ->orderBy('is_default', 'desc')
            ->get();
        $total_functional_areas = $functional_areas->count();
        $functional_areas = $functional_areas->chunk(ceil($total / 3));
        $organization_types = OwnershipType::active()->orderBy('is_default', 'desc')->get();
        $quick_links = QuickLink::where('is_active', true)->orderBy('serial', 'asc')->get();
        return view('themes::' . $skin . '.home', compact(
            'user',
            'currency_symbol',
            'currency_code',
            'companies',
            'total_companies',
            'cities',
            'total_functional_areas',
            'total_job',
            'functional_areas',
            'featuredJobs',
            'lastestJobs',
            'organization_types',
            'quick_links'
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
