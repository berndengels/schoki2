<div id="top-navigation">
    <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-black">
        <a class="navbar-brand" href="/events">
            <img src="{{ asset('img/batcow_yellow.png') }}">
            <img src="{{ asset('img/schokoladen_schrift_yellow.png') }}"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNavbar" aria-controls="topNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="topNavbar">
            <!-- left side -->
            <ul class="navbar-nav mr-auto">
                @foreach ($topMenu as $item)
                    <li class="nav-item dropdown">
                        @if($item->children->count())
                            <a class="nav-link dropdown-toggle" href="{{ $item->url }}" id="dropdown{{ $item->name }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $item->name }}<span class="ml-2 sr-only">(current)</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown{{ $item->name }}">
                                @foreach ($item->children as $child)
                                    <a class="dropdown-item" href="{{ $child->url }}">{{ $child->name }}</a>
                                @endforeach
                            </div>
                        @else
                            <a class="nav-link" href="{{ $item->url }}" aria-haspopup="false">{{ $item->name }}<span class="ml-2 sr-only">(current)</span></a>
                        @endif
                    </li>
                @endforeach
            </ul>
            <!--form class="form-inline my-2 my-md-0">
                <input class="form-control" type="text" placeholder="Suchen">
            </form-->
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('public.scard.index') }}">
                        <i class="text-primary d-inline-block fas fa-shopping-cart"></i>
                    </a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item spacer d-none d-md-inline-block">&nbsp</li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
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
    </nav>
</div>
