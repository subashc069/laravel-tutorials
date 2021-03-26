<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" 
                data-toggle="dropdown" 
                href="#" 
                role="button" 
                aria-haspopup="true" 
                aria-expanded="false">Browse</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('threads.index') }}">
                    {{ __('All Threads') }}
                </a>
                @auth
                    <a class="dropdown-item" href="/threads?by={{ auth()->user()->name }}">My Threads</a>
                @endauth 
                <a class="dropdown-item" href="/threads?popular=1">
                    {{ __('All Time Popular') }}
                </a>
                
            </div>
        </div>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" 
                data-toggle="dropdown" 
                href="#" 
                role="button" 
                aria-haspopup="true" 
                aria-expanded="false">Channels</a>
            <div class="dropdown-menu">
                @foreach ($channels as $channel)
                    <a class="dropdown-item" href="/threads/{{ $channel->slug }}">{{ $channel->slug }}</a>
                @endforeach
            </div>
        </div>
        <a class="" href="{{ route('threads.create') }}">
            {{ __('Create Thread') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" 
                                href="{{ route('profiles.show', Auth::user()) }}"
                            >
                                My Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>