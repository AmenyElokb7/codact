@extends('layouts.app')
<head>
    <link rel="stylesheet" href="{{ asset('css/resetmethod.css') }}">

</head>

@section('content')
<div>
<form action="{{ route('methodreset') }}" method="POST">
    @csrf
<div class="d-flex justify-content-center mt-5">
<div class="card width_card p-4 d-flex justify-content-center shadow_card" >
  <h5>Reset password via :</h5>
<div class="form-check">
  <input class="form-check-input" value='sms' type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  SMS
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" value='email' type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
  <label class="form-check-label" for="flexRadioDefault2">
EMAIL  </label>
</div>
<div class="d-flex justify-content-end mt-3">
                <button class="btn-20 me-2" id='canceledButton' type="button">Annuler</button>
                <button class="btn-21 text-nowrap" type='submit'>Valide</button>
            </div>
</div>

</div>

</form>
</div>
<script src="{{ asset('js/resetmethod.js') }}"></script>

@endsection