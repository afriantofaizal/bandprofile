@extends('layouts.back_design')

@section('title', 'Dashboard')

@section('breadcrumb', 'Dashboard')

@section('content')

<div class="row">

  {{-- posts --}}
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-danger card-header-icon">
        <div class="card-icon">
          <i class="material-icons">library_books</i>
        </div>
        <p class="card-category">Total Posts</p>
        <h3 class="card-title">{{ $posts->count() }}
          <small>Posts</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-danger">library_books</i>
          <strong>
              <a href="{{ route('author.post.index') }}" class="text-danger">
                 All Posts are created
              </a>
          </strong>
        </div>
      </div>
    </div>
  </div>

  {{-- pending posts --}}
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-danger card-header-icon">
        <div class="card-icon">
          <i class="material-icons">notification_important</i>
        </div>
        <p class="card-category">Pending Posts</p>
        <h3 class="card-title">{{ $totalPenPost }}
          <small>Posts</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-danger">notifications</i>
          <strong class="text-danger">
                  Approval of Post is Pending
          </strong>
        </div>
      </div>
    </div>
  </div>

  {{-- galleries --}}
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
          <i class="material-icons">collections</i>
        </div>
        <p class="card-category">Total Galleries</p>
        <h3 class="card-title">{{ $galleries->count() }}
          <small>Galleries</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-rose">visibility</i>
          <strong>
              <a href="{{ route('author.gallery.index') }}" class="text-rose">
                  All Galleries are created
              </a>
          </strong>
        </div>
      </div>
    </div>
  </div>

  {{-- pending galleries --}}
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
          <i class="material-icons">notification_important</i>
        </div>
        <p class="card-category">Pending Posts</p>
        <h3 class="card-title">{{ $totalPenGall }}
          <small>Galleries</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-rose">notifications</i>
          <strong class="text-rose">
                  Approval of Galleries is Pending
          </strong>
        </div>
      </div>
    </div>
  </div>

  {{-- viewers --}}
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
          <i class="fa fa-eye"></i>
        </div>
        <p class="card-category">Total Views</p>
        <h3 class="card-title">{{ $allViews }}
          <small>Views</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <strong class="text-info">
            <i class="material-icons">visibility</i> All of Post Viewers
          </strong>
        </div>
      </div>
    </div>
  </div>
  
</div>

@endsection