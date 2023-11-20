@extends('Auth.Layout.main')
@section('content')
<div class="form login">
  <div class="form-content">
    <header>Login</header>
    <form action="{{ route('auth.login') }}" method="POST">
      @csrf
      <div class="field input-field" style="display: none;
      padding-top:10px;
      background:red;
      color:white;
      text-align:center;
      " id="error">
      </div>
      <div class="field input-field">
        <input type="email" name="email" placeholder="Email" class="input">
      </div>
      @error('email')
      <p style="color: red">{{ $message }}</p>
      @enderror
      <div class="field input-field">
        <input type="password" name="password" placeholder="Password" class="password">
        <i class='bx bx-hide eye-icon'></i>
      </div>
      @error('password')
      <p style="color: red">{{ $message }}</p>
      @enderror
      <div class="form-link">
        <a href="#" class="forgot-pass">Forgot password?</a>
      </div>

      <div class="field button-field">
        <button>Login</button>
      </div>
    </form>

    <div class="form-link">
      <span>Don't have an account? <a href="{{ route('auth.index.register') }}"
          class="link signup-link">Signup</a></span>
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
  {{-- @php
  dd($errors->login->first());
  @endphp --}}
</div>
@endsection
@push('js')
<script>
  if ("{{ $errors->login->first() }}") {
        $('#error').text("{{ $errors->login->first()}}").slideDown().delay(3000).slideUp();
      }
</script>
@endpush