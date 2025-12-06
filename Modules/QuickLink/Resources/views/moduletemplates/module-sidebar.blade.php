@can('admin')
    <div class="sidebar-heading">
        @lang('Admin Menu')
    </div>
    <li class="nav-item {{ request()->is('settings/dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('settings.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>@lang('Dashboard')</span>
        </a>
    </li>
    <li class="nav-item">
        @php
            $sub_menu = ['quick-link.index', 'quick-link.create', 'quick-link.edit'];
        @endphp
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
            aria-controls="collapseTwo"><i class="fas fa-fw fa-cog"></i><span>@lang('Quick Links')</span>
        </a>
        <div id="collapseTwo" class="collapse {{ in_array(routeName(), $sub_menu) ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ routeName() == 'quick-link.index' ? 'active' : '' }}"
                    href="{{ route('quick-link.index') }}">
                    <span>@lang('Links')</span>
                </a>
                <a class="collapse-item {{ routeName() == 'quick-link.index' ? 'active' : '' }}"
                    href="{{ route('quick-link.create') }}">
                    <span>@lang('Create')</span>
                </a>
            </div>
        </div>
    </li>
@endcan
