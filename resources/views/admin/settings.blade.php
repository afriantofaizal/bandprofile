@extends('layouts.back_design')

@section('title', 'Setting')

@section('breadcrumb', 'Setting')

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-info">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                            <i class="material-icons">face</i>
                            Akun Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                            <i class="material-icons">lock</i>
                            Password
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                    
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="bmd-label-floating">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email" class="bmd-label-floating">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="name" class="bmd-label-floating">About</label>
                                <textarea name="about" id="about" rows="5" class="form-control">{{ Auth::user()->about }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-info">Update</button>
                        </form>
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{ route('admin.password.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="old_assword" class="bmd-label-floating">Password Lama</label>
                                <input type="password" class="form-control" id="old_assword" name="old_password">
                            </div>
                            <div class="form-group">
                                <label for="new_password" class="bmd-label-floating">Password Baru</label>
                                <input type="password" class="form-control" id="new_password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" class="bmd-label-floating">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="confirm_password" name="password_confirmation">
                            </div>
                            <button type="submit" class="btn btn-info">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-profile">
            <div class="card-avatar">
            <a href="#pablo">
                <img class="img" src="{{ Storage::disk('public')->url('profile/'.Auth::user()->image) }}" />
            </a>
            </div>
            <div class="card-body">
            <h6 class="card-category">{{ Auth::user()->name }}</h6>
            <h4 class="card-title">{{ Auth::user()->email }}</h4>
            <p class="card-description">
                {{ Auth::user()->about }}
            </p>
            </div>
        </div>
    </div>
</div>

@endsection