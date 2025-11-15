@can('candidate')
<li class="nav-item {{ (request()->is('accountsettings')) ? 'active' : '' }}">
	<a class="nav-link" href="{{ url('accountsettings') }}">
		<i class="fa fa-user"></i>
		<span>@lang('My profile')</span></a>
</li>
<li class="nav-item {{ (request()->is('resumecv*')) ? 'active' : '' }}">
	<a class="nav-link" href="{{ route('resumecv.index') }}">
		<i class="far fa-file-alt"></i>
		<span>@lang('My ResumeCV')</span></a>
</li>

<li class="nav-item {{ (request()->is('alltemplates*')) ? 'active' : '' }}">
	<a class="nav-link" href="{{ url('alltemplates')}}">
		<i class="far fa-window-maximize"></i>
		<span>@lang('Templates')</span></a>
</li>
@endcan
@can('admin')
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseResumeCvs" aria-expanded="false" aria-controls="collapseTwo">
		<i class="fas fa-file-alt"></i>
		<span>@lang('ResumeCvs')</span>
	</a>
	<div id="collapseResumeCvs" class="collapse {{ (request()->is('settings/resumecv*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
		<div class="bg-white py-2 collapse-inner rounded">
			<a class="collapse-item {{ routeName() == 'settings.resumecvtemplate.index' ? 'active' : '' }}" href="{{ route('settings.resumecvtemplate.index') }}">
				<span>@lang('All templates')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.resumecvcategories.index' ? 'active' : '' }}" href="{{ route('settings.resumecvcategories.index') }}">
				<span>@lang('All categories')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.resumecvtemplate.create' ? 'active' : '' }}" href="{{ route('settings.resumecvtemplate.create') }}">
				<span>@lang('New template')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.resumecvcategories.create' ? 'active' : '' }}" href="{{ route('settings.resumecvcategories.create') }}">
				<span>@lang('New category')</span>
			</a>
		</div>
	</div>
</li>
@endcan
