@extends('Auth.Layout.main')
@section('content')
<div class="form login">
  <div class="form-content">
    <header>Signup</header>
    <form action="{{ route('auth.register') }}" method="POST">
      @csrf
      <div class="field input-field">
        <input type="text" name="name" placeholder="Name" class="input">
      </div>
      @error('name')
      <p style="color: red">{{ $message }}</p>
      @enderror
      <div class="field input-field">
        <input type="email" name="email" placeholder="Email" class="input">
      </div>
      @error('email')
      <p style="color: red">{{ $message }}</p>
      @enderror
      <div class="field input-field">
        <input type="password" name="password" placeholder="Create password" class="password">
      </div>
      @error('password')
      <p style="color: red">{{ $message }}</p>
      @enderror
      <div class="field input-field">
        <input type="password" name="password_confirmation" placeholder="Confirm password" class="password">
        <i class='bx bx-hide eye-icon'></i>
      </div>
      @error('password_confirmation')
      <p style="color: red">{{ $message }}</p>
      @enderror
      <div class="field button-field">
        <button>Signup</button>
      </div>
    </form>

    <div class="form-link">
      <span>Already have an account? <a href="{{ route('auth.index.login') }}" class="link login-link">Login</a></span>
    </div>
  </div>

  <div class="line"></div>

  <div class="media-options">
    <a href="#" class="field facebook">
      <i class='bx bxl-facebook facebook-icon'></i>
      <span>Login with Facebook</span>
    </a>
  </div>

  <div class="media-options">
    <a href="#" class="field google">
      <img src="{{ asset('assets/img/google.png') }}" alt="" class="google-img">
      <span>Login with Google</span>
    </a>
  </div>

</div>
@endsection