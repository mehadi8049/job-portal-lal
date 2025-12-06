<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use DateTimeZone;
use JoeDixon\Translation\Drivers\Translation;
use Modules\Jobs\Entities\Company;
use Modules\Jobs\Entities\Industry;
use Modules\Jobs\Entities\OwnershipType;
use Modules\Jobs\Entities\Job;
use Modules\Saas\Entities\Package;

use Modules\User\Entities\User;

class QuickLinkController extends Controller
{

    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
    }


    public function index(Request $request)
    {
        $links = [];
        return view('settings::quick_link.index', compact('links'));
    }
}
