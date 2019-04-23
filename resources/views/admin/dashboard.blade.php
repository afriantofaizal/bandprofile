@extends('layouts.back_design')

@section('title', 'Dashboard')

@section('breadcrumb', 'Dashboard')

@section('content')

<div class="row">

  {{-- Posts --}}
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-danger card-header-icon">
        <div class="card-icon">
          <i class="material-icons">library_books</i>
        </div>
        <p class="card-category">Total Posts</p>
        <h3 class="card-title">{{ $posts }}
          <small>Posts</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-danger">library_books</i>
          <strong>
              <a href="{{ route('admin.post.index') }}" class="text-danger">
                 All Posts are created
              </a>
          </strong>
        </div>
      </div>
    </div>
  </div>

  {{-- Pending Posts --}}
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
        <div class="stats ">
          <i class="material-icons text-danger">notifications</i> 
          <strong>
            <a href="{{ route('admin.post.pending') }}" class="text-danger">
                Approval of Pending Posts
            </a>
          </strong>
        </div>
      </div>
    </div>
  </div>
  
  {{-- Viewers --}}
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-icon">
        <div class="card-icon">
          <i class="fa fa-eye"></i>
        </div>
        <p class="card-category">Total Viewers</p>
        <h3 class="card-title">{{ $allViews }}
          <small>Viewers</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">visibility</i>
          <strong>
            <a href="{{ route('admin.post.index') }}">
                All of Post Viewers
            </a>
          </strong>
        </div>
      </div>
    </div>
  </div>

  {{-- Author --}}
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-primary card-header-icon">
        <div class="card-icon">
            <i class="material-icons">person</i>
        </div>
        <p class="card-category">Total Post Author</p>
        <h3 class="card-title">{{ $authorCount }}
          <small>People</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-info">people</i>
          <strong>
            <a href="{{ route('admin.author.index') }}" class="text-info">
                All Post Auhtor of Yowis Ben
            </a>
          </strong>
        </div>
      </div>
    </div>
  </div>

  {{-- Gallery --}}
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">collections</i>
        </div>
        <p class="card-category">Total Galleries</p>
        <h3 class="card-title">{{ $galCount }}
          <small>Galleries</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-rose">collections</i>
          <strong>
            <a href="{{ route('admin.gallery.index') }}" class="text-rose">
                All Galleries are created
            </a>
          </strong>
        </div>
      </div>
    </div>
  </div>

  {{-- Pending Gallery  --}}
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">notification_important</i>
        </div>
        <p class="card-category">Pending Galleries</p>
        <h3 class="card-title">{{ $totalPenGall }}
          <small>Galleries</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-rose">notifications</i>
          <strong>
            <a href="{{ route('admin.gallery.pending') }}" class="text-rose">
                Approval of Pending Galleries
            </a>
          </strong>
        </div>
      </div>
    </div>
  </div>

  {{-- Tags --}}
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-warning card-header-icon">
        <div class="card-icon">
            <i class="material-icons">label</i>
        </div>
        <p class="card-category">Total Tags</p>
        <h3 class="card-title">{{ $tagCount }}
          <small>Tags</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-warning">label</i>
          <strong>
            <a href="{{ route('admin.tag.index') }}" class="text-warning">
                All Tags
            </a>
          </strong>
        </div>
      </div>
    </div>
  </div>

   {{-- Categories --}}
   <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-success card-header-icon">
        <div class="card-icon">
          <i class="material-icons">category</i>
        </div>
        <p class="card-category">Total Categories</p>
        <h3 class="card-title">{{ $catCount }}
          <small>Category</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-success">category</i>
          <strong>
            <a href="{{ route('admin.category.index') }}" class="text-success">
                All Categories
            </a>
          </strong>
        </div>
      </div>
    </div>
  </div>

   {{-- Categories --}}
   <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
          <i class="material-icons">subscriptions</i>
        </div>
        <p class="card-category">Total Subscribers</p>
        <h3 class="card-title">{{ $subCount }}
          <small>Subscribers</small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-info">subscriptions</i>
          <strong>
            <a href="{{ route('admin.subscriber.index') }}" class="text-info">
                All Subscribers
            </a>
          </strong>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection