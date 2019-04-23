<div class="sidebar" data-color="purple" data-background-color="black" data-image="{{ asset('assets/back/img/sidebar-2.jpg') }}">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
-->
    <div class="logo">
        <a href="{{ route('home') }}" class="simple-text logo-normal">
        Yowis Ben
        </a>
    </div>
   
    <div class="sidebar-wrapper">
<br>
        <div class="col-md-12">
            <div class="card card-profile">
                <div class="card-avatar">
                
                    {{-- profile admin --}}
                    @if(Request::is('admin*'))
                        <a href="{{ route('admin.settings') }}">
                            <img class="img" src="{{ Storage::disk('public')->url('profile/'.Auth::user()->image) }}" />
                        </a>
                    @endif

                    {{-- profile author --}}
                    @if(Request::is('author*'))
                        <a href="{{ route('author.settings') }}">
                            <img class="img" src="{{ Storage::disk('public')->url('profile/'.Auth::user()->image) }}" />
                        </a>
                    @endif

                </div>
                <div class="card-body">
                    <h6 class="card-category">{{ Auth::user()->name }}</h6>
                    <h4 class="card-title">{{ Auth::user()->email }}</h4>
                </div>
            </div>
        </div>

        {{-- admin menu --}}
        @if(Request::is('admin*'))
        <ul class="nav">

            {{-- dashboard --}}
            <li class="nav-item {{Request::is('admin/dashboard') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
                </a>
            </li>

            {{-- tag --}}
            <li class="nav-item {{Request::is('admin/tag*') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.tag.index') }}">
                <i class="material-icons">label</i>
                <p>Tag</p>
                </a>
            </li>

            {{-- category --}}
            <li class="nav-item {{Request::is('admin/category*') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.category.index') }}">
                <i class="material-icons">category</i>
                <p>Kategori</p>
                </a>
            </li>

            {{-- dropdown posts --}}
            <li class="nav-item dropdown show {{Request::is('admin/post*', 'admin/pending/post') ? 'active' : ''}}">
                <a class="nav-link dropdown-toggle bmd-btn-icon" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="material-icons">library_books</i>
                    <p>Postingan</p>
                </a>
                <div class="dropdown-menu nav-item bg-dark" aria-labelledby="dropdownMenuLink">
                    {{-- all posts --}}
                    <a class="dropdown-item nav-link" href="{{ route('admin.post.index') }}">
                        <i class="material-icons">library_books</i>
                        <p>Semua Postingan</p>
                    </a>
                    {{-- pending posts --}}
                    <a class="dropdown-item nav-link" href="{{ route('admin.post.pending') }}">
                        <i class="material-icons">notification_important</i>
                        <p>Approval Pending</p>
                    </a>
                </div>
            </li>

            {{-- dropdown gallery--}}
            <li class="nav-item dropdown show {{Request::is('admin/gallery*', 'admin/pending/gallery') ? 'active' : ''}}">
                <a class="nav-link dropdown-toggle bmd-btn-icon" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="material-icons">collections</i>
                    <p>Gallery</p>
                </a>
                <div class="dropdown-menu nav-item bg-dark" aria-labelledby="dropdownMenuLink">
                    {{-- all galleries --}}
                    <a class="dropdown-item nav-link" href="{{ route('admin.gallery.index') }}">
                        <i class="material-icons">collections</i>
                        <p>Semua Gallery</p>
                    </a>
                    {{-- pending galleries --}}
                    <a class="dropdown-item nav-link" href="{{ route('admin.gallery.pending') }}">
                        <i class="material-icons">notification_important</i>
                        <p>Approval Pending</p>
                    </a>
                </div>
            </li>

            {{-- Subscribers --}}
            <li class="nav-item {{Request::is('admin/subscriber') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.subscriber.index') }}">
                <i class="material-icons">subscriptions</i>
                <p>Subscribers</p>
                </a>
            </li>

            {{-- Authors --}}
            <li class="nav-item {{Request::is('admin/author') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin.author.index') }}">
                <i class="material-icons">person</i>
                <p>Authors</p>
                </a>
            </li>
        </ul>
        @endif

        {{-- author menu --}}
        @if(Request::is('author*'))
        <ul class="nav">

            {{-- dashboard --}}
            <li class="nav-item {{Request::is('author/dashboard') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('author.dashboard') }}">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
                </a>
            </li>

            {{-- posts --}}
            <li class="nav-item {{Request::is('author/post*') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('author.post.index') }}">
                <i class="material-icons">library_books</i>
                <p>Postingan</p>
                </a>
            </li>
            
            {{-- galleries --}}
            <li class="nav-item {{Request::is('author/gallery*') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('author.gallery.index') }}">
                <i class="material-icons">collections</i>
                <p>Gallery</p>
                </a>

            </li>
        </ul>
        @endif

    </div>
</div>