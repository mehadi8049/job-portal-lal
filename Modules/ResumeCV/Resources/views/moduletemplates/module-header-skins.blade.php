@auth
	@can('candidate')
	<li class="nav-item">
		<a class="nav-link " href="{{ route('templates') }}">
			@lang('Create ResumeCV')
		</a>
	</li>
	@endcan
@else
	<li class="nav-item">
		<a class="nav-link " href="{{ route('templates') }}">
			@lang('Create ResumeCV')
		</a>
	</li>
@endauth