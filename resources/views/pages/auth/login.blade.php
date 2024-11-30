@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
    </div>
    <form action="{{ route('login.store') }}" method="POST" class="user">
        @csrf
        <div class="form-group">
            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                placeholder="Enter Email Address..." name="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                placeholder="Password" name="password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input type="checkbox" class="custom-control-input" id="customCheck">
                <label class="custom-control-label" for="customCheck">Remember
                    Me</label>
            </div>
        </div>
        <button class="btn btn-primary btn-user btn-block" type="submit">
            Login
        </button>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="forgot-password.html">Forgot Password?</a>
    </div>
    <div class="text-center">
        <a class="small" href="register.html">Create an Account!</a>
    </div>
@endsection
