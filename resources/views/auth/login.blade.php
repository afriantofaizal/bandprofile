@extends('layouts.front.front_design')

@section('content')

@section('title','Login')
    
<div class="page-header">
    <div class="filter"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 ml-auto mr-auto">
                    <div class="card card-register bg-dark">
                        <h3 class="title text-white">{{ __('Login') }}</h3>

                        <!-- form  -->
                        <form method="POST" action="{{ route('login') }}" class="register-form">

                                @csrf

                            <!-- email  -->
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email...">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            
                            <!-- password  -->
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password...">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif

                            <!-- remember me  -->
                            <div class="form-check">
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>

                            <!-- button login  -->
                            <button type="submit" class="btn btn-danger btn-block btn-round">
                                {{ __('Login') }}
                            </button>

                            <!-- forgot password  -->
                            <div class="forgot">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="btn btn-link btn-danger">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection
