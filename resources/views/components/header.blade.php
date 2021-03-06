<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      {{ config('app.name') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    @if (auth()->check())
      <!-- Left Side Of Navbar -->
        <div class="search-container di">
          <div class="navbar-nav mr-auto header-search pa0" style="position:relative;">
            <form class="relative form-inline mt-2 my-lg-0" method="POST" action="/user/search" role="search">
              @csrf
              <input class="header-search-input pa2 br1 bn outline-0" id="header-search-input" type="search" placeholder="Search..." aria-label="Search">
            </form>
            <ul class="header-search-results absolute pa0 ma0 list bg-white"></ul>
          </div>
        </div>
    @endif
    <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto my-2">
        <!-- Authentication Links -->
        @guest
          <li>
            <a class="nav-link" href="{{ route('login') }}">
              {{ __('auth.login-cta') }}
            </a>
          </li>
          <li>
            <a class="nav-link" href="{{ route('register') }}">
              {{ __('auth.signup-cta') }}
            </a>
          </li>
        @else
          <li>
            <a class="nav-link" href="/dashboard">
              {{ __('app.header_dashboard_link') }}
            </a>
          </li>
          <li>
            <a class="nav-link" href="/contacts">
              {{ __('app.header_contacts_link') }}
            </a>
          </li>
          <li>
            <a class="nav-link" href="/settings">
              {{ __('app.header_settings_link') }}
            </a>
          </li>
          <li>
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('app.header_logout_link') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
