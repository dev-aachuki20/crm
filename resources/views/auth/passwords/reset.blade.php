@extends('layouts.auth')
@section('title','Reset Password')
@section('content')
<div class="gridblock-divide h-100vh">
    <div class="column-1 d-flex justify-content-center align-items-center">
        <div class="content-inner">
            <div class="logoimg"><img src="{{ asset('images/logo.png') }}" class="img-fluid" /></div>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
        </div>
    </div>
    <div class="column-2 d-flex justify-content-center align-items-center">
        <div class="account-card">
            <h3>New password</h3>
            <p class="text-center">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
            <form class="mt-5" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <input type="password" name="password" placeholder="generate" class="form-control @error('password') is-invalid @enderror" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-login btn-primary">Send</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection