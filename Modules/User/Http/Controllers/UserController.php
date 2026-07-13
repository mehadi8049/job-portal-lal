<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Modules\User\Entities\Skill;
use Illuminate\Routing\Controller;
use Modules\Saas\Entities\Package;
use Modules\Jobs\Entities\Industry;
use Modules\Location\Entities\City;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\Experience;
use Modules\User\Entities\Qualification;
use Modules\User\Entities\LanguageProficiency;
use Modules\User\Entities\PreferredJobCategory;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::query();

        if ($request->filled('search')) {
            $data->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $data = $data->paginate(10);

        return view('user::users.index', compact(
            'data'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = [];

        if (Module::find('Saas')) {
            $packages = Package::all();
        }

        return view('user::users.create', compact(
            'packages'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'role'            => 'required|string|max:255',
            'email'           => 'required|email|max:255|unique:users',
            'password'        => 'required|string|min:6|same:password_confirmation',
            'package_ends_at' => 'nullable|date',
        ]);

        $request->request->add([
            'password' => Hash::make($request->password),
        ]);


        $user = User::create($request->all());

        return redirect()->route('settings.users.index')
            ->with('success', __('Created successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $packages = [];
        if (Module::find('Saas')) {
            $packages = Package::all();
        }
        return view('user::users.edit', compact(
            'user',
            'packages'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'role'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'password'        => 'nullable|string|min:6|same:password_confirmation',
            'package_ends_at' => 'nullable|date',

        ]);

        if ($request->filled('password')) {
            $request->request->add([
                'password' => Hash::make($request->password),
            ]);
        } else {
            $request->request->remove('password');
        }


        $user->update($request->all());

        return redirect()->route('settings.users.edit', $user)
            ->with('success', __('Updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->user()->id == $user->id) {
            return redirect()->route('settings.users.index')
                ->with('error', __("You can't remove yourself."));
        }
        if ($user->company()->count() > 0) {
            return redirect()->back()->with('error', "Can't delete because it has company in it");
        }

        $user->delete();

        return redirect()->route('settings.users.index')
            ->with('success', __('Deleted successfully'));
    }

    public function accountSettings(Request $request)
    {
        $user = $request->user()->load('experiences', 'qualifications', 'skills', 'preferredJobCategories', 'languageProficiencies');
        $cities = City::active()->orderBy('is_default', 'desc')->get();
        $industries = Industry::active()->orderBy('is_default', 'desc')->get();
        return view('user::auth.profile', compact(
            'user',
            'cities',
            'industries'
        ));
    }

    public function accountSettingsUpdate(Request $request)
    {
        if ($request->need_update == "personal") {
            $request->validate([
                'name'     => 'required|max:255',
                'password' => 'same:password_confirmation',
            ]);

            if ($request->filled('password')) {
                $request->request->add([
                    'password' => Hash::make($request->password),
                ]);
            } else {
                $request->request->remove('password');
            }
            $inputData = $request->except('need_update');
            $image = $request->file('photo');
            if ($image != '') {
                $path_folder = public_path('storage/user_storage/' . $request->user()->id);
                $path = $path_folder . "/" . $request->user()->photo;
                deleteImageWithPath($path);
                $image_name = "user_photo_" . rand() . '.' . $image->getClientOriginalExtension();
                $image->move($path_folder, $image_name);

                $inputData['photo'] = $image_name;
            }
            $request->user()->update($inputData);
        }
        if (in_array($request->need_update, ["address", "career_application", "other_relavand"])) {
            if (isset($request->keywords)) {
                $keywords = array_values(array_filter($request->keywords, function ($v) {
                    return !is_null($v) && $v !== "";
                }));
                $request->request->add([
                    'keywords' => $keywords,
                ]);
            }

            $data = $request->except('need_update');
            $request->user()->update($data);
        }
        $tab = 'personal';

        $method = $request->need_update;
        if (method_exists($this, $method)) {
            $tab = $this->$method($request);
        }

        return redirect()->route('accountsettings.index', ['tab' => $tab])
            ->with('success', __('Updated successfully'));
    }

    protected function experience($request)
    {
        $request->validate([
            'company_name'    => 'required|string|max:255',
            'designation'     => 'required|string|max:255',
            'employment_from' => 'required|date',
            'employment_to'   => 'nullable|date|after_or_equal:employment_from',
        ]);
        $request->merge(['user_id' => $request->user()->id]);
        Experience::create($request->all());
        return 'experience';
    }

    public function experienceUpdate(Request $request, $id)
    {
        $request->validate([
            'company_name'    => 'required|string|max:255',
            'designation'     => 'required|string|max:255',
            'employment_from' => 'required|date',
            'employment_to'   => 'nullable|date|after_or_equal:employment_from',
        ]);
        $experience = Experience::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $experience->update($request->all());
        return redirect()->route('accountsettings.index', ['tab' => 'experience'])
            ->with('success', __('Updated successfully'));
    }


    protected function qualification($request)
    {
        $request->validate([
            'education_level' => 'required|string|max:255',
            'degree_title'    => 'required|string|max:255',
            'passing_year'    => 'nullable|integer|min:1950|max:' . date('Y'),
        ]);
        $request->merge(['user_id' => $request->user()->id]);
        Qualification::create($request->all());
        return 'qualification';
    }

    public function qualificationUpdate(Request $request, $id)
    {
        $request->validate([
            'education_level' => 'required|string|max:255',
            'degree_title'    => 'required|string|max:255',
            'passing_year'    => 'nullable|integer|min:1950|max:' . date('Y'),
        ]);
        $qualification = Qualification::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $qualification->update($request->all());
        return redirect()->route('accountsettings.index', ['tab' => 'qualification'])
            ->with('success', __('Updated successfully'));
    }


    protected function skill($request)
    {
        $request->validate([
            'skill_name' => 'required|string|max:255',
        ]);
        $data = $request->all();
        if (!$request->has('skill_learned_from')) {
            $data['skill_learned_from'] = [];
        }
        $data['user_id'] = $request->user()->id;
        Skill::create($data);
        return 'skill';
    }

    public function skillUpdate(Request $request, $id)
    {
        $request->validate([
            'skill_name' => 'required|string|max:255',
        ]);
        $skill = Skill::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $data = $request->all();
        if (!$request->has('skill_learned_from')) {
            $data['skill_learned_from'] = [];
        }
        $skill->update($data);
        return redirect()->route('accountsettings.index', ['tab' => 'skill'])
            ->with('success', __('Updated successfully'));
    }

    protected function preferredJobCategory($request)
    {
        $request->merge(['user_id' => $request->user()->id]);
        PreferredJobCategory::create($request->all());
        return 'preferred-job-category';
    }

    public function preferredJobCategoryUpdate(Request $request, $id)
    {
        $category = PreferredJobCategory::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $category->update($request->all());
        return redirect()->route('accountsettings.index', ['tab' => 'preferred-job-category'])
            ->with('success', __('Updated successfully'));
    }

    protected function LanguageProficiency($request)
    {
        $request->validate([
            'language_name' => 'required|string|max:255',
        ]);
        $request->merge(['user_id' => $request->user()->id]);
        LanguageProficiency::create($request->all());
        return 'language-proficiency';
    }

    public function LanguageProficiencyUpdate(Request $request, $id)
    {
        $request->validate([
            'language_name' => 'required|string|max:255',
        ]);
        $language = LanguageProficiency::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $language->update($request->all());
        return redirect()->route('accountsettings.index', ['tab' => 'language-proficiency'])
            ->with('success', __('Updated successfully'));
    }
}
