@extends('layouts.app')
<head>
    <link rel="stylesheet" href="{{ asset('css/forgetpassword.css') }}">
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

@section('content')
<div>

<div class="d-flex justify-content-center pt-5">
  <div class="width-small2">
    <div class="d-flex justify-content-center pt-5">
    <i class="fas fa-regular fa-2x fa-key mb-3" ></i>
</div>
    <div class="">
      <div class="text-center title">Forgot Password?</div>
      <p class="text-center little">You can reset your password here.</p>
      <form action="{{ route('sendsms') }}" method="POST">
                        @csrf
                     
      <div class="">
        <label for="phone" class="form-label ms-1 h6">Phone number</label>
        <input id="phone" name="phone" placeholder="Enter your phone number" value="{{ $phone }}"  class="form-control ps-1" style="height: 45px;" type="text" required />
      
      </div>
      <br/>
      <div class="d-flex justify-content-center"> @if(isset($error))
    <div class="text-danger fw-bold h6">
  {{ $error }}
    </div>
     
@endif
</div>
      <div class="d-flex justify-content-center mt-3">
        <button class="btn-21 text-white text-nowrap" onclick="envoyer()">Reset Password</button>
      </div>
</form>
      <div class="d-flex justify-content-center mt-4">
        <a href="/login" style="text-decoration: none; color: black;"><span class="position-relative" style="top: 1px; right: 14px;"><i class="fas fa-arrow-left"></i></span><span class="h6">Back to log in</span></a>
      </div>
    </div>
  </div>
</div>
</div>

@endsection