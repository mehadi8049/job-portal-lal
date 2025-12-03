@can('admin')
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompanies" aria-expanded="false" aria-controls="collapseTwo">
		<i class="fas fa-building"></i>
		<span>@lang('Companies')</span>
	</a>
	<div id="collapseCompanies" class="collapse {{ (request()->is('settings/companies*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
		<div class="bg-white py-2 collapse-inner rounded">
			<a class="collapse-item {{ routeName() == 'settings.companies.index' ? 'active' : '' }}" href="{{ route('settings.companies.index') }}">
				<span>@lang('List')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.companies.create' ? 'active' : '' }}" href="{{ route('settings.companies.create') }}">
				<span>@lang('Create')</span>
			</a>
		</div>
	</div>
</li>
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseJobs" aria-expanded="false" aria-controls="collapseTwo">
		<i class="fas fa-briefcase"></i>
		<span>@lang('Jobs')</span>
	</a>
	<div id="collapseJobs" class="collapse {{ (request()->is('settings/jobs*')) && routeName() != 'settings.jobs.applicants.index' ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
		<div class="bg-white py-2 collapse-inner rounded">
			<a class="collapse-item {{ routeName() == 'settings.jobs.index' ? 'active' : '' }}" href="{{ route('settings.jobs.index') }}">
				<span>@lang('List')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.jobs.create' ? 'active' : '' }}" href="{{ route('settings.jobs.create') }}">
				<span>@lang('Create')</span>
			</a>
		</div>
	</div>
</li>
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseJobAttributes" aria-expanded="false" aria-controls="collapseTwo">
		<i class="fas fa-briefcase-medical"></i>
		<span>@lang('Job Attributes')</span>
	</a>
	<div id="collapseJobAttributes" class="collapse {{ (request()->is('settings/job-attributes*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
		<div class="bg-white py-2 collapse-inner rounded">
			
			<a class="collapse-item {{ routeName() == 'settings.job.attributes.career_levels.index' ? 'active' : '' }}" href="{{ route('settings.job.attributes.career_levels.index') }}">
				<span>@lang('Career levels')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.job.attributes.functional_areas.index' ? 'active' : '' }}" href="{{ route('settings.job.attributes.functional_areas.index') }}">
				<span>@lang('Functional Areas')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.job.attributes.genders.index' ? 'active' : '' }}" href="{{ route('settings.job.attributes.genders.index') }}">
				<span>@lang('Genders')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.job.attributes.industries.index' ? 'active' : '' }}" href="{{ route('settings.job.attributes.industries.index') }}">
				<span>@lang('Industries')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.job.attributes.job_experiences.index' ? 'active' : '' }}" href="{{ route('settings.job.attributes.job_experiences.index') }}">
				<span>@lang('Job experiences')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.job.attributes.job_types.index' ? 'active' : '' }}" href="{{ route('settings.job.attributes.job_types.index') }}">
				<span>@lang('Job types')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.job.attributes.job_shifts.index' ? 'active' : '' }}" href="{{ route('settings.job.attributes.job_shifts.index') }}">
				<span>@lang('Job shifts')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.job.attributes.degree_levels.index' ? 'active' : '' }}" href="{{ route('settings.job.attributes.degree_levels.index') }}">
				<span>@lang('Degree levels')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.job.attributes.ownership_types.index' ? 'active' : '' }}" href="{{ route('settings.job.attributes.ownership_types.index') }}">
				<span>@lang('Ownership types')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.job.attributes.salary_periods.index' ? 'active' : '' }}" href="{{ route('settings.job.attributes.salary_periods.index') }}">
				<span>@lang('Salary periods')</span>
			</a>

		</div>
	</div>
</li>
<li class="nav-item {{ (request()->is('settings/jobs/applicants')) ? 'active' : '' }}">
	<a class="nav-link" href="{{ route('settings.jobs.applicants.index') }}">
		<i class="fas fa-bullhorn"></i>
		<span>@lang('Applicants Job')</span></a>
</li>
@endcan



@can('employer')
	<li class="nav-item {{ (request()->is('company/dashboard')) ? 'active' : '' }}">
	<a class="nav-link" href="{{ url('company/dashboard') }}">
		<i class="fas fa-tachometer-alt"></i>
		<span>@lang('Dashboard')</span></a>
	</li>
	<li class="nav-item {{ (request()->is('accountsettings')) ? 'active' : '' }}">
	<a class="nav-link" href="{{ url('accountsettings') }}">
		<i class="fa fa-user"></i>
		<span>@lang('My profile')</span></a>
	</li>
	<li class="nav-item {{ (request()->is('company/profile')) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('company.profile') }}">
		<i class="fab fa-black-tie"></i>
		<span>@lang('Profile Company')</span></a>
	</li>
	<li class="nav-item {{ (request()->is('company/jobs/create')) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('company.jobs.create') }}">
		<i class="fas fa-user-plus"></i>
		<span>@lang('Post job')</span></a>
	</li>
	<li class="nav-item {{ (request()->is('company/jobs')) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('company.jobs.index') }}">
		<i class="fas fa-building"></i>
		<span>@lang('Company jobs')</span></a>
	</li>
	<li class="nav-item {{ (request()->is('company/applicants')) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('company.applicants.index') }}">
		<i class="fas fa-bullhorn"></i>
		<span>@lang('Applicants Jobs')</span></a>
	</li>
	@if(Module::find('Saas'))
	<li class="nav-item {{ (request()->is('company/packages')) ? 'active' : '' }}">
		<a class="nav-link" href="{{ route('company.packages') }}">
		<i class="fas fa-box"></i>
		<span>@lang('Packages')</span></a>
	</li>
	@endif
	<li class="nav-item">
		<a class="nav-link" href="{{ url('logout') }}">
		<i class="fas fa-sign-out-alt"></i>
		<span>@lang('Logout')</span></a>
	</li>
@endcan