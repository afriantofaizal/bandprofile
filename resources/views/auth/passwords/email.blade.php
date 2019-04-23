@extends('layouts.front.front_design')

@section('content')

@section('title','Reset Password')

<div class="page-header">
    <div class="filter"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 ml-auto mr-auto">
                    <div class="card card-register bg-info">
                        <h3 class="title text-white">{{ __('Reset Password') }}</h3>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
        
                                <label for="email">{{ __('E-Mail Address') }}</label>
    
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email.." required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                <button type="submit" class="btn btn-danger btn-block btn-round">
                                    {{ __('Send Password Reset Link') }}
                                </button>

                            <div class="forgot">
                                <a href="{{ route('login') }}" class="btn btn-link btn-danger">
                                    {{ __('Back To Login') }}
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection
