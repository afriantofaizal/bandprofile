@extends('layouts.front.front_design')

@section('title', 'Home')

@section('content')

<div class="page-header bg-dark">
    {{-- <div class="filter"></div> --}}
    <div class="container">
        <div class="motto text-center">
            <img src="{{ asset('img/first.png') }}" class="img-fluid img-first" alt="" title="Yowis Ben">
        </div>
    </div>
</div>

<div class="main">

    <div class="section bg-danger text-center" id="carousel">
        <div class="container">
                <h2 class="title text-white">POSTINGAN</h2>
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                        
                    <div class="card page-carousel img-thumbnail">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($randomposts as $randompost)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}">
                                    </li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                @foreach ($randomposts as $randompost)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <a href="{{ route('post.detail',$randompost->slug) }}">
                                        <img class="d-block img-fluid" src="{{ Storage::disk('public')->url('post/'.$randompost->image) }}" alt="{{ $randompost->title }}" title="{{ $randompost->title }}">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h3>{{ $randompost->title }}</h3>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>

                            <a class="left carousel-control carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="fa fa-angle-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="fa fa-angle-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section text-center bg-success">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <h2 class="title text-white">Gallery</h2>
                    <h5 class="description text-white">This is the paragraph where you can write more details about your product. Keep you user engaged by providing meaningful information. Remember that by this time, the user is curious, otherwise he wouldn't scroll to get here. Add a button if you want the user to see more.</h5>
                    <br>
                    <a href="{{ route('gallery.index') }}" class="btn btn-default btn-lg btn-round">See More</a>
                </div>
            </div>
            <br/><br/>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <!-- Galleries -->
                        @foreach ($galleries as $gallery)
                            <div class="col-md-4 mb-5">
                                <a href="{{ Storage::disk('public')->url('gallery/'.$gallery->image) }}" data-lightbox="mygallery" data-title="{{ $gallery->title }}" class="example-image-link">
                                <div class="hovereffect">
                                    <img src="{{ Storage::disk('public')->url('gallery/'.$gallery->image) }}" class="img-responsive" alt="Rounded Image">
                                    <div class="overlay">
                                        <p>{{ $gallery->title }}</p>
                                        <p>
                                            Photo by {{ $gallery->user->name }}
                                        </p>
                                    </div>
                                </div>
                                </a>
                            </div>
                        @endforeach
                        <!-- End Galleries -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="section section-nucleo-icons bg-warning">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <h2 class="title text-white">About Yowis Ben</h2><br/>
                    <p class="description text-white">
                        Now UI Kit comes with 100 custom icons made by our friends from NucleoApp. The official package contains over 2.100 thin icons which are looking great in combination with Now UI Kit Make sure you check all of them and use those that you like the most.
                    </p><br/>
                    <a href="#" class="btn btn-default btn-lg btn-round">Let's Talk About Us</a>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="icons-container">
                        <i class="nc-icon nc-headphones"></i>
                        <i class="nc-icon nc-atom"></i>
                        <i class="nc-icon nc-camera-compact"></i>
                        <i class="nc-icon nc-air-baloon"></i>
                        <i class="nc-icon nc-glasses-2"></i>
                        <i class="nc-icon nc-diamond"></i>
                        <i class="nc-icon nc-user-run"></i>
                        <i class="nc-icon nc-spaceship"></i>
                        <i class="nc-icon nc-istanbul"></i>
                        <i class="nc-icon nc-bulb-63"></i>
                        <i class="nc-icon nc-favourite-28"></i>
                        <i class="nc-icon nc-planet"></i>
                        <i class="nc-icon nc-note-03"></i>
                        <i class="nc-icon nc-zoom-split"></i>
                        <i class="nc-icon nc-controller-modern"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section bg-brown text-center">
        <div class="container">
            <h2 class="title text-white">Sponsors</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-profile card-plain">
                        <div class="card-avatar">
                            <a href="#avatar"><img src="../assets/img/faces/clem-onojeghuo-3.jpg" alt="..."></a>
                        </div>
                        <div class="card-body">
                            <a href="#paper-kit">
                                <div class="author">
                                    <h4 class="card-title text-white">Henry Ford</h4>
                                    <h6 class="card-category">Product Manager</h6>
                                </div>
                            </a>
                            <p class="card-description text-center">
                            Teamwork is so important that it is virtually impossible for you to reach the heights of your capabilities or make the money that you want without becoming very good at it.
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-twitter"></i></a>
                            <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-google-plus"></i></a>
                            <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-profile card-plain">
                        <div class="card-avatar">
                            <a href="#avatar"><img src="../assets/img/faces/joe-gardner-2.jpg" alt="..."></a>
                        </div>
                        <div class="card-body">
                            <a href="#paper-kit">
                                <div class="author">
                                    <h4 class="card-title">Sophie West</h4>
                                    <h6 class="card-category">Designer</h6>
                                </div>
                            </a>
                            <p class="card-description text-center">
                            A group becomes a team when each member is sure enough of himself and his contribution to praise the skill of the others. No one can whistle a symphony. It takes an orchestra to play it.
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-twitter"></i></a>
                            <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-google-plus"></i></a>
                            <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-profile card-plain">
                        <div class="card-avatar">
                            <a href="#avatar"><img src="../assets/img/faces/erik-lucatero-2.jpg" alt="..."></a>
                        </div>
                        <div class="card-body">
                            <a href="#paper-kit">
                                <div class="author">
                                    <h4 class="card-title">Robert Orben</h4>
                                    <h6 class="card-category">Developer</h6>
                                </div>
                            </a>
                            <p class="card-description text-center">
                            The strength of the team is each individual member. The strength of each member is the team. If you can laugh together, you can work together, silence isn’t golden, it’s deadly.
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-twitter"></i></a>
                            <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-google-plus"></i></a>
                            <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-image landing-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <h2 class="text-center text-white">Subscribe!!</h2>
                    <h5 class="text-center text-white">Subscribe now for more information from our band like a new Post of performance and much more.</h5>
                    <form class="contact-form" method="POST" action="{{ route('subscriber.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 ml-auto mr-auto">
                                {{-- <label>Email</label> --}}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-email-85"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 ml-auto mr-auto">
                                <button class="btn btn-danger btn-lg btn-fill" type="submit">Subscribe</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }
        </style>
    
@endsection