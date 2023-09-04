@extends('layouts.app')

<head>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>
@section('content')
<div class="container">
<div class="d-flex justify-content-center mt-4" style="margin: auto;">
    <div class="form-box">
        <div class="row">
            <div class="col-6 little_screen_inscription">
                <img src="{{ asset('assets/images/coffe.jpg')  }}" class='w-100' alt="Image" />
            </div>
            <div class="col-6 all_width">
                <div class="mt-4">
                    <div class="d-flex justify-content-center">
                        <div class="h5 text-dark">Sign up </div>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="w-100">
                            <div class="">
                                <div class="d-flex justify-content-center mt-3">
                                    <label class="pure-material-textfield-standard mx-3">
                                        <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus/>
                                        <span>Full Name</span>
                                    </label>
                                   
                                </div>
                                @error('name')
                                <div class="d-flex justify-content-center mt-3"><div class=" text-danger" >
                                        <strong>{{ $message }}</strong>
                                    </div></div>
                                    
                                @enderror
                                <div class="d-flex justify-content-center mt-3">
                                    <label class="pure-material-textfield-standard">
                                        <input id="address" type="text" class=" @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus/>
                                        <span>Address</span>
                                    </label>
                                                                 </div>
                                @error('address')
                                <div class="d-flex justify-content-center mt-2"><div class=" text-danger" >
                                        <strong>{{ $message }}</strong>
                                    </div></div>
                                    
                                @enderror
                                <div class="d-flex justify-content-center mt-3">
                                    <label class="pure-material-textfield-standard">
                                        <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" />
                                        <span>Email Address</span>
                                    </label>
                                   
                                </div>
                                @error('email')
                                <div class="d-flex justify-content-center mt-2"><div class=" text-danger" >
                                        <strong>{{ $message }}</strong>
                                    </div></div>
                                    
                                @enderror
                                <div class="d-flex justify-content-center mt-3">
                                    <label class="pure-material-textfield-standard">
                                        <input  id="phoneno" type="text" class=" @error('phoneno') is-invalid @enderror" name="phoneno" value="{{ old('phoneno') }}" required autocomplete="phoneno" autofocus />
                                        <span>Phone number</span>
                                    </label>
                                    
                                </div>

                                @error('phoneno')
                                <div class="d-flex justify-content-center mt-2"><div class=" text-danger" >
                                        <strong>{{ $message }}</strong>
                                    </div></div>
                                    
                                @enderror
                                <div class="d-flex justify-content-center mt-3">
                                    <label class="pure-material-textfield-standard">
                                        <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"/>
                                        <span>Password</span>
                                    </label>
                                
                                </div>
                                @error('password')
                                <div class="d-flex justify-content-center mt-2"><div class=" text-danger" >
                                        <strong>{{ $message }}</strong>
                                    </div></div>
                                    
                                @enderror
                                <div class="d-flex justify-content-center mt-3">
                                    <label class="pure-material-textfield-standard">
                                        <input id="password-confirm" type="password" class="" name="password_confirmation" required autocomplete="new-password"/>
                                        <span>Confirm Password</span>
                                    </label>
                                </div>
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                <button type="submit" class="boutton-inscription">
                                    {{ __('Register') }}
                                </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection