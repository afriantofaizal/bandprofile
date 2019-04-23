@extends('layouts.front.front_design')

@section('title', 'Postingan')

@section('content')


<div class="main">

    <!-- Section 1 -->
    <div class="section section-dark-blue">

        <!-- Header -->
        <div class="page-header page-header-xs bg-dark mb-5">
            <h2 class="text-white">yowis posts</h2>
        </div>
        <!-- End Header -->
        
        <div class="container-fluid">
            <div class="row">

                <!-- Kolom kiri -->
                <div class="col-lg-9 col-md-12">

                    <!-- Detil Postingan -->
                    <h1 class="images-title text-white mt-0">{{ $post->title }}</h1>
                    <div class="img-details">
                        <p>Posted by <strong>{{ $post->user->name }}</strong></p>
                        <i class="nc-icon nc-calendar-60"></i> &nbsp;
                        {{ $post->created_at->diffForHumans() }}
                        <p class="pull-right">
                                <i class="fa fa-eye"></i>
                            {{ $post->view_count }}
                            views
                        </p>
                    </div>
                    
                        <!-- Gambar Postingan -->
                        <img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" class="img-thumbnail img-responsive" alt="Rounded Image">

                        <!-- Isi Postingan -->
                        <p>{!! html_entity_decode($post->body) !!}</p>

                        <div class="progress mt-2">
                            <div class="progress-bar progress-bar-black" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div><br/>

                        <!-- Tag Postingan -->
                        
                        @foreach ($post->tags as $tag)

                            <a href="{{ route('tag.post',$tag->slug) }}" class="btn btn-sm btn-danger btn-round mb-5">
                                <i class="nc-icon nc-tag-content"></i> {{ $tag->name }}
                            </a>
                            
                        @endforeach

                        <br />
                </div>
                <!-- End Kolom kiri -->

                <!-- Kolom kanan -->
                <div class="col-lg-3 col-md-4 col-sm-6">

                    <!-- Aubot Author -->
                    <div class="card bg-dark text-white text-center">
                        <div class="card-body text-white">
                            <h4 class="card-title text-white">About Author</h4>
                            
                            <!-- Poto Author Postingan -->
                            <div id="images" class="text-center">
                                <a href="{{ route('author.profile', $post->user->username) }}">
                                    <img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" class="img-circle img-no-padding img-responsive" alt="{{ $post->user->name }}">
                                </a>
                                
                                <!-- Nama Author Postingan -->
                                <p>
                                    <strong class="text-center">{{ $post->user->name }}</strong>
                                </p>
                            </div>

                            <!-- Tentang Author Postingan -->
                            <p>{{ $post->user->about }}</p>

                            <hr>

                            <div class="social-line text-center">
                                <a href="#pablo" class="btn btn-neutral btn-facebook btn-just-icon">
                                    <i class="fa fa-facebook-square"></i>
                                </a>
                                <a href="#pablo" class="btn btn-neutral btn-google btn-just-icon">
                                    <i class="fa fa-instagram"></i>
                                </a>
                                <a href="#pablo" class="btn btn-neutral btn-twitter btn-just-icon">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Aubot Author -->

                    <!-- Kategori Postingan -->
                    <div class="card bg-dark text-center">
                        <div class="card-body">
                            <h4 class="card-title text-white">Category of this post</h4>
                            @foreach ($post->categories as $category)
                                <a href="{{ route('category.post', $category->slug) }}" class="btn btn-sm btn-danger btn-round">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <!-- End Kategori Postingan -->

                    <!-- Subscribe -->
                    <div class="card bg-dark text-white text-center">
                        <div class="card-body text-white">
                            <h4 class="card-title text-white">SUBSCRIBE!!</h4>
                            <form class="contact-form" method="POST" action="{{ route('subscriber.store') }}">
                                @csrf
                                <div class="input-group form-group-no-border">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-email-85"></i>
                                    </span>
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                    <button class="btn btn-danger btn-block" type="submit">Subscribe</button>
                            </form>
                            
                            <hr>

                            <h4 class="card-title text-white">Kategori Postingan</h4>
                            <!-- Sosial Media -->
                            <div class="social-line text-center">
                                <a href="#pablo" class="btn btn-neutral btn-facebook btn-just-icon">
                                    <i class="fa fa-facebook-square"></i>
                                </a>
                                <a href="#pablo" class="btn btn-neutral btn-google btn-just-icon">
                                    <i class="fa fa-instagram"></i>
                                </a>
                                <a href="#pablo" class="btn btn-neutral btn-twitter btn-just-icon">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </div>
                            <!-- End Sosial Media -->
                        </div>
                    </div>
                    <!-- End Subscribe -->

                </div>
                <!-- End Kolom kanan -->
                
            </div>
        </div>

    </div>
    <!-- End Section 1 -->

    <!-- Section 2, Related Post -->
    <div class="section section-space">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title text-white text-center">Other Posts</h2>
                    <div class="row">
                        @foreach ($randomposts as $randompost)
                        <div class="col-md-4 mb-5">
                            <a href="{{ route('post.detail',$randompost->slug) }}">
                                <div class="hovereffect">
                                    <img src="{{ Storage::disk('public')->url('post/'.$randompost->image) }}" class="img-responsive" alt="Rounded Image">
                                    <div class="overlay">
                                        <p>{{ $randompost->title }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Section 2, Related Post -->

</div>
    
@endsection