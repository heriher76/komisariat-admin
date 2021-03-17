@extends('layouts.auth')

@section('contents')
<div class="p-5">
  <div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
  </div>
  <form method="POST" class="user" action="{{ route('login') }}">
      @csrf
      <div class="form-group">
        <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="form-group">
        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" id="exampleInputPassword" placeholder="Password" required autocomplete="current-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="form-group">
        <div class="custom-control custom-checkbox small">
          <input class="form-check-input custom-control-input" type="checkbox" name="remember" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
          <label class="custom-control-label" for="customCheck">Remember Me</label>
        </div>
      </div>
      <button type="submit" class="btn btn-success btn-user btn-block">
        Login
      </button>
  </form>
  <hr>
  <div class="text-center">
    @if (Route::has('password.request'))
        <a class="small" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif
  </div>
</div>
@endsection
