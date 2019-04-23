@extends('layouts.front.front_design')

@section('title', 'Gallery')

@section('content')

<div class="main">

  <!-- Section 1 -->
  <div class="section section-space">

    <!-- Header -->
    <div class="page-header page-header-xs mb-5"
    style="background-image: url(' {{ asset('img/gallery.jpg') }}')">
      <div class="filter"></div>
      {{-- <h2 class="text-danger">GALLERY</h2> --}}
    </div>
    <!-- End Header -->

    <div class="container">
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

          <!-- Pagination --> 
          <div class="pull-right">
              {{ $galleries->links() }}
          </div>  
          
        </div>  
      </div>
    </div>
  </div>
  <!-- End Section 1 -->

</div>
    
@endsection