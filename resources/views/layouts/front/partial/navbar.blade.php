<nav class="navbar navbar-expand-md fixed-top navbar-default">
    <div class="container-fluid">
        <div class="navbar-translate">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('img/logo.png') }}" class="img-fluid" title="Yowis Ben" alt="">
                </a>
            <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-bar"></span>
                <span class="navbar-toggler-bar"></span>
                <span class="navbar-toggler-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" style="display:none;">{{ __('Login') }}</a>
                    </li>
                    @else
                        @if (Auth::user()->role->id == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }} ">Dashboard</a>
                            </li>
                        @endif
                        @if (Auth::user()->role->id == 2)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('author.dashboard') }}">Dashboard</a>
                            </li>
                        @endif
                    
                    <div class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>

                        <ul class="dropdown-menu dropdown-danger" aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-header">Leave this site</li>
                                
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                @endguest

                <li class="nav-item {{Request::is('post') ? 'active' : ''}}">
                    <a href="{{ route('post.index') }}" class="nav-link"><i class="nc-icon nc-paper"></i> Yowis Post</a>
                </li>

                <li class="nav-item {{Request::is('gallery') ? 'active' : ''}}">
                    <a href="{{ route('gallery.index') }}" class="nav-link"><i class="nc-icon nc-album-2"></i>  Gallery</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
                        <i class="fa fa-twitter"></i>
                        <p class="d-lg-none">Twitter</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank">
                        <i class="fa fa-facebook-square"></i>
                        <p class="d-lg-none">Facebook</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank">
                        <i class="fa fa-instagram"></i>
                        <p class="d-lg-none">Instagram</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>