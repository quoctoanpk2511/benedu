@extends('layouts.master')

@section('content')
<div class="slider_area ">
    <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-6">
                    <div class="slider_info mt-5">
                        <h3>Over 100,000 <br>
                            Online Courses <br>
                        </h3>
                        <h4 class="mb-5 text-white">Choose from over 100,000 online video courses with new additions published every month</h4>
                        <a href="{{ route('register') }}" class="boxed_btn">Sign Up For Free</a>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card login-form mt-5">
                        <div class="card-body">
                            <h3 class="card-title mb-4">{{ __('Sign Up') }}</h3>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group ">
                                    <input placeholder="Your name" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group ">
                                    <input placeholder="Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group ">
                                    <input placeholder="Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input placeholder="Password confirm" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary login-btn mt-3">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
