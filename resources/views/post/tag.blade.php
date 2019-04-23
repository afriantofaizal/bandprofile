@extends('layouts.front.front_design')

@section('title')
{{ $tag->name }} Tag
@endsection

@section('content')

<div class="main">

  <!-- Section 1 -->
  <div class="section section-dark-blue">

      <div class="page-header bg-warning page-header-xs mb-5">
            <h2 class="text-white">{{ $tag->name }}</h2>
      </div>

    <div class="container-fluid">

      <div class="row">

        <div class="col-lg-9 col-md-12">

          @if ($posts->count() > 0) 
          
          @foreach ($posts as $post)

            <div class="row">
              <div class="col-md-6 col-sm-12">
                <img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" class="img-rounded img-responsive" alt="Rounded Image">
                <div class="img-details">
                  <div class="author">
                      <a href="{{ route('author.profile', $post->user->username) }}">
                        <img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                    </a>
                  </div>
                    <p>Posted by <strong>{{ $post->user->name }}</strong></p>
                    <i class="nc-icon nc-calendar-60"></i> &nbsp;
                    {{ $post->created_at->format('d M Y') }}
                    <p class="pull-right">
                        <i class="fa fa-eye"></i>
                        {{ $post->view_count }}
                        views
                    </p>
                </div>
              </div>

              <div class="col-md-6 col-sm-12">
                  <h3 class="images-title mt-0">{{ $post->title }}</h3>
                  <a href="{{ route('post.detail',$post->slug) }}" class="btn btn-outline-warning btn-lg mt-5">See Details</a>
              </div>

            </div>

            <div class="progress mt-2">
                <div class="progress-bar progress-bar-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div><br/>

          @endforeach
          
            <div class="pull-right">
                {{ $posts->links() }}
            </div>

          @else

          <div class="row">
            <div class="col-md-12">
                <h3 class="images-title mt-0">
                  Posts Not Available for this Tag
                </h3>
            </div>
          </div>

          @endif

        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">

          <!-- Search -->
          <div class="card bg-warning text-white text-center">
            <div class="card-body text-white">
              <h4 class="card-title text-white">Search Post</h4>
              <form class="contact-form" method="GET" action="{{ route('search') }}">
                @csrf
                <div class="input-group form-group-no-border">
                  <span class="input-group-addon">
                      <i class="nc-icon nc-zoom-split"></i>
                  </span>
                  <input type="text" class="form-control" name="query" value="{{ isset($query) ? $query : '' }}" placeholder="Search">
                </div>
                  <button class="btn btn-danger btn-block" type="submit">Search</button>
              </form>
            </div>
          </div>
          <!-- End Search -->

          <div class="card bg-warning text-center">
            <div class="card-body text-white">
              <h4 class="card-title text-white">About Yowis Band</h4>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque, vero? Porro sunt vel maiores itaque veritatis nostrum deserunt alias corporis doloremque quibusdam perspiciatis tempora odit totam est explicabo, accusamus doloribus.</p>
            </div>
          </div>

          <div class="card bg-warning text-white text-center">
            <div class="card-body text-white">
                <h4 class="card-title text-white">All Categories</h4>
                <div class="card page-carousel">
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($categories as $category)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}">
                            </li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach ($categories as $category)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                          <a href="{{ route('category.post', $category->slug) }}">
                            <img class="d-block img-fluid" src="{{ Storage::disk('public')->url('category/slider/'.$category->image) }}" alt="{{ $category->name }}">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>{{ $category->name }}</h3>
                                <p>{{ $category->posts->count() }} Postingan</p>
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

          <!-- Tag Postingan -->
          <div class="card bg-warning text-center">
              <div class="card-body">
                  <h4 class="card-title text-white">Tag</h4>
                  @foreach ($post->tags as $tag)
                      <a href="{{ route('tag.post', $tag->slug) }}" class="btn btn-sm btn-danger btn-round">{{ $tag->name }}</a>
                  @endforeach
              </div>
          </div>
          <!-- End Tag Postingan -->

          <!-- Subscribe -->
          <div class="card bg-warning text-white text-center">
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

              <h4 class="card-title text-white">Follow our social media</h4>
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
          
      </div>

    </div>
  </div>
  <!-- End Section 1 -->
  
</div>
    
@endsection