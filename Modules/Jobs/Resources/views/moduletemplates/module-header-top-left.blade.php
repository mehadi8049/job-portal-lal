@can('candidate')
<li class="nav-item">
      <a class="nav-link" href="{{ url('alltemplates')}}">
        <i class="fas fa-plus fa-lg"></i>
        <span class="d-none d-sm-inline-block ml-2">@lang('New ResumeCV')</span>
      </a>
</li>
@endcan

@can('employer')
<li class="nav-item">
      <a class="nav-link" href="{{ route('company.jobs.create')}}">
        <i class="fas fa-plus fa-lg"></i>
        <span class="d-none d-sm-inline-block ml-2">@lang('New Job')</span>
      </a>
</li>
@endcan

@can('admin')
<li class="nav-item">
      <a class="nav-link" href="{{ url('settings/companies/create')}}">
        <i class="fas fa-plus fa-lg"></i>
        <span class="d-none d-sm-inline-block ml-2">@lang('New Job')</span>
      </a>
</li>
@endcan