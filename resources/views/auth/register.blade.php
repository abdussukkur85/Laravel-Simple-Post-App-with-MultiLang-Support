@extends('layout.app')
@section('title', 'Register Your Account')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 bg-light mt-3 br-5 rounded p-3">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control @error('name') border-danger @enderror"
                            id="name" value="{{ old('name') }}" placeholder="Your Name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="username"
                            class="form-control @error('username') border-danger @enderror" id="username"
                            value="{{ old('username') }}" placeholder="Username">
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" class="form-control @error('email') border-danger @enderror"
                            id="email" value="{{ old('email') }}"placeholder="Your Email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" name="password"
                            class="form-control @error('password') border-danger @enderror" id="password"
                            value="{{ old('password') }}"placeholder="Choose a Password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') border-danger @enderror"
                            id="password_confirmation" value="{{ old('password_confirmation') }}"
                            placeholder="Repeat Your Password">
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
            </div>
        </div>
    </div>
@endsection
