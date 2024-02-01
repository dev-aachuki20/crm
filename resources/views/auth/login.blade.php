@extends('layouts.auth')

@section('content')
<div class="gridblock-divide h-100vh">
    <div class="column-1 d-flex justify-content-center align-items-center">
        <div class="content-inner">
            <div class="logoimg"><img src="images/logo.png" class="img-fluid" /></div>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
        </div>
    </div>
    <div class="column-2 d-flex justify-content-center align-items-center">
        <div class="account-card">
            <h3>Login Form</h3>
            @php
                // $userLoginRequest = session('userLoginRequest');
            @endphp
            <p class="text-center">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
            <form class="mt-5" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <input id="email" type="email" name="email" placeholder="Email ID" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" autofocus />
                            {{-- @if(session()->has('userLoginRequest'))
                                    <span style="color:#f50909;">
                                        @if ($userLoginRequest['email'] === null)
                                            Email is required!
                                        @endif
                                    </span>
                            @endif --}}
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="form-group {{-- @error('password') invalidGroup @enderror --}}">
                            <input id="password" type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password" />
                            <span toggle="#password-field" class="form-icon-password toggle-password"><img src="images/view.svg" class="img-fluid" /></span>
                            {{-- @if(session()->has('userLoginRequest'))
                                <span style="color:#f50909;">
                                    @if ($userLoginRequest['password'] === null)
                                        Password is required.
                                    @endif
                                </span>
                            @endif --}}
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                            
                            <?php 
                                /* \Session()->forget('userLoginRequest');  */
                            ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-login btn-primary">{{ __('Login') }}</button>

                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forget-pass">{{ __('Forgot Your Password?') }}</a>
                            @endif

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection