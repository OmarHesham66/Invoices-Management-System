@extends('Auth.Layout.main')
@section('content')
<div class="form login">
  <div class="form-content">
    <header>Verification Code</header>
    <form action="{{ route('auth.post_verify') }}" method="POST">
      @csrf
      <div class="field input-field">
        <input type="text" name="code" placeholder="Verification Code.." class="input">
      </div>
      @error('code')
      <p style="color:red">{{ $message }}</p>
      @enderror
      <a style="cursor: pointer;" id="resend">Resend Code</a>
      <div class="field button-field">
        <button>Confirm</button>
      </div>
    </form>

  </div>
</div>
@endsection
@push('js')
<script>
  $(function(){
    $('#resend').on('click',function(e){
    e.preventDefault();
      $.ajax({
      type: "get",
      url: "{{ route('auth.resend') }}",
      success: function (response) {
        if (response.message == 'done') {
          $("#resend")
          .fadeOut()
          .delay(90000)
          .fadeIn();
        }
      }
    });
  });
});
</script>
@endpush