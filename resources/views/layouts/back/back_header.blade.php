<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">

            {{-- content menu --}}
            
            <a class="navbar-brand">
                @yield('breadcrumb')
            </a>

        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                
                <!-- Authentication Links -->
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

                @if(Request::is('admin*'))
                    <li class="nav-item dropdown">
                        <a id="navbarDropdownMenuLink" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="material-icons">exit_to_app</i>&nbsp;
                                {{ __( 'Cabut') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <a class="dropdown-item  text-white" href="{{ Auth::user()->role->id == 1 ?  route('admin.settings') : route('author.settings') }}">
                                <i class="material-icons">settings</i>&nbsp;
                                {{ __('Setting') }}
                            </a>

                        </div>
                    </li>
                @endif

                @if(Request::is('author*'))
                    <li class="nav-item dropdown">
                        <a id="navbarDropdownMenuLink" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="material-icons">exit_to_app</i> &nbsp;
                                {{ __( 'Cabut') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <a class="dropdown-item  text-white" href="{{ Auth::user()->role->id == 1 ?  route('admin.settings') : route('author.settings') }}">
                                <i class="material-icons">settings</i> &nbsp;
                                {{ __('Setting') }}
                            </a>

                        </div>
                    </li>
                @endif

            @endguest
            <!-- your navbar here -->
            </ul>
        </div>

    </div>
</nav>
<!-- End Navbar -->