@extends('layouts.app')

@section('content')
    <section class="auth-login container">
        <h3 class="mt-5 ml-4">Login</h3>
        <div class="mt-3">
            @if(Session::has('danger_login_login'))
                <p class="alert alert-danger ml-4">{{ Session::get('danger_login_login') }}</p>
            @endif
            <form action="{{ route('auth.check') }}" class="ml-4" method="POST">
                @csrf
                <label for="email">Email</label>
                <input type="text" name="email_login" class="form-control" value="{{ old('email_login') }}">
                @error('email_login')
                <p class="alert alert-danger form-alert-message">{{ $message }}</p>
                @enderror

                <label for="password">Password</label>
                <input type="password" name="password_login" class="form-control" value="">
                @error('password_login')
                <p class="alert alert-danger form-alert-message">{{ $message }}</p>
                @enderror
                <div class="btn-log mt-3 text-right">
                    <input type="submit" class="btn btn-red-primary" value="Login">
                </div>
            </form>
        </div>

        <h3 class="mt-5 ml-4">Sign up</h3>
        <div class="mt-3">
            @if(Session::has('danger_login'))
                <p class="alert alert-danger ml-4">{{ Session::get('danger_login') }}</p>
            @endif
            <form action="{{ route('auth.store') }}" method="POST" class="ml-4">
                @csrf
                <div class="mt-3">
                    <label for="name">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                    @error('username')
                    <p class="alert alert-danger form-alert-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    @error('name')
                    <p class="alert alert-danger form-alert-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                    @error('email')
                    <p class="alert alert-danger form-alert-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" value="">
                    @error('password')
                    <p class="alert alert-danger form-alert-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-3">
                    <label for="confirm_password">Confirm password</label>
                    <input type="password" class="form-control" name="confirm_password" value="">
                    @error('confirm_password')
                    <p class="alert alert-danger form-alert-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-3">
                    <div class="text-right mt-3">
                        <input type="submit" class="btn" value="Register">
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
