@extends('layouts.app')

<head>
    <link rel="stylesheet" href="{{ asset('css/setnewpassword.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forgetpassword.css') }}">
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

@section('content')
    <div>


        <div class="d-flex justify-content-center pt-5">
            <div>
                <div class="text-center">
                    <div class="text-center title">Set a new password</div>
                    <div class="d-flex my-1 mb-2 justify-content-center">
                        <i class="fa-solid fa-key-password" style="font-size: 40px;"></i>
                    </div>
                    <form action="{{ route('newpassword') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id='id' value="{{ $id }}">
                        <input type="hidden" name="link" value="{{ $link }}">
                        <div class="form-group">
                            <div class="">

                                <input id="pass1" name="pass1" placeholder="Set new Password" class="form-control"
                                    type="password" required>
                            </div>
                            <br />
                            <div class="">

                                <input id="pass2" name="pass2" placeholder="Confirm the new Password"
                                    class="form-control" type="password" required>
                            </div>

                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            @if (isset($error))
                                <div class="text-danger fw-bold h6">
                                    {{ $error }}
                                </div>
                            @endif
                        </div>
                        <div class="pe-3 d-flex justify-content-center mt-3 col-6 little_checkbox">
                            <input type="checkbox" onchange="show_password(event)" class="me-1" style="width: 17px;">
                            <label class="text-nowrap" style="font-size: 17px;">Show password</label>
                        </div>
                        <br />
                        <div class="d-flex justify-content-end mt-3">
                            <button class="btn-20 me-2" id='canceledButton' type="button">Annuler</button>
                            <button class="btn-21 text-nowrap" type='submit'>Valide</button>
                        </div>
                </div>
                </form>
            </div>
        </div>

    </div>
    <script src="{{ asset('js/setnewpassword.js') }}"></script>
@endsection
