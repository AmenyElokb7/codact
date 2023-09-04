@extends('layouts.app')

<head>
    <link rel="stylesheet" href="{{ asset('css/checkkey.css') }}">
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

@section('content')
    <div>
        <div class="d-flex justify-content-center times pt-5">
            <div>
                <div id="countdown" class="d-flex justify-content-start pe-4">
                    <ul>

                        <li class="card_time me-3"><span class="d-flex justify-content-center" id="minutes"></span>Minutes
                        </li>
                        <li class="card_time"><span class="d-flex justify-content-center" id="seconds"></span>Seconds</li>
                    </ul>
                </div>

                <div class="d-flex justify-content-center me-2">
                    <i class="fas fa-2x fa-lock"></i>
                </div>
                <div class="text-center mt-3">
                    <p class="text-center little">Please put the key.</p>
                    <form id="checkKeyForm" action="{{ route('postcheckkey') }}" method="POST">
                        @csrf
                        <input type="hidden" id="email" name="email" value="{{ $email }}">
                        <input type="hidden" id="remainingTime" value="{{ $remainingTime ?? '' }}">

                        <input id="key" name="key" placeholder="Key" class="form-control" type="text" required>



                </div>
                @error('error')
                    <div class="d-flex justify-content-center">
                        <div class="text-danger fw-bold h6">
                            {{ $message }}
                        </div>
                    </div>
                @enderror
                <div class="d-flex justify-content-end mt-3">
                    <button class="btn-20 h6 me-2" id="cancelButton">Annuler</button>
                    <button class="btn-99 h6 text-nowrap" type="submit">Reset Password</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <script src="{{ asset('js/checkkey.js') }}"></script>
@endsection
