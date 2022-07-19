@extends('layout.app')
@section('title', 'Login to Your Account')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 bg-light mt-3 br-5 rounded p-3">
                @if (session('status'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" class="form-control @error('email') border-danger @enderror"
                            id="email" value="{{ old('email') }}"placeholder="{{ __('Your Email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" name="password"
                            class="form-control @error('password') border-danger @enderror" id="password"
                            value="{{ old('password') }}"placeholder="{{ __('Your Password') }}">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember_me" id="checkbox">
                        <label class="form-check-label" for="checkbox">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
