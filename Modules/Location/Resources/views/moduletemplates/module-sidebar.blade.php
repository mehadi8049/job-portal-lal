@can('admin')
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocationAttributes" aria-expanded="false" aria-controls="collapseTwo">
		<i class="fas fa-search-location"></i>
		<span>@lang('Location')</span>
	</a>
	<div id="collapseLocationAttributes" class="collapse {{ (request()->is('settings/location*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
		
		<div class="bg-white py-2 collapse-inner rounded">
			<a class="collapse-item {{ routeName() == 'settings.location.cities.index' ? 'active' : '' }}" href="{{ route('settings.location.cities.index') }}">
				<span>@lang('Cities')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.location.states.index' ? 'active' : '' }}" href="{{ route('settings.location.states.index') }}">
				<span>@lang('States')</span>
			</a>
			<a class="collapse-item {{ routeName() == 'settings.location.countries.index' ? 'active' : '' }}" href="{{ route('settings.location.countries.index') }}">
				<span>@lang('Countries')</span>
			</a>
		</div>
	</div>
	
</li>
@endcan
