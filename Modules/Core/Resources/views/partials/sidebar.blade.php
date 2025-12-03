<ul class="navbar-nav sidebar background-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="">
          <img src="{{ asset(config('app.logo_frontend'))}}" height="40" alt="">
        </div>
      </a>
      {!! menuSiderbar() !!}

    </ul>
