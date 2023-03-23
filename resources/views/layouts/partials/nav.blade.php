<nav class="navbar navbar-expand-lg navbar-dark bg-blue">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }} Network</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('store') ? 'active' : '' }}" href="{{ route('store') }}">Ranks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('vote') ? 'active' : '' }}" href="{{ route('vote') }}">Votes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('video') ? 'active' : '' }}" href="{{ route('video') }}">Videos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('event') ? 'active' : '' }}" href="{{ route('event') }}">Events</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome Back, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu border-0 bg-transparent" aria-labelledby="navbarDropdown">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route("dashboard.index") }}">
                                    <i class="bi bi-layout-text-window-reverse"></i>
                                    Admin Page
                                </a>
                            </li>
                            <li class="nav-item">
                                <hr class="dropdown-divider">
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('user.logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item btn btn-outline-0 nav-link">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ ($title == "Login") ? 'active' : '' }}" href="{{ route('auth.login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                    </li>
                @endauth
            </ul>
      </div>
    </div>
</nav>