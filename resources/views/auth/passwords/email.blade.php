@extends('layouts.auth')
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
            <h3>Lost your password</h3>
            <p class="text-center">Enter the email address associated with your account, and we'll email you a link to reset your password
            </p>

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form class="mt-5" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <input type="email" placeholder="Email ID" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus />
                            @error('email')
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