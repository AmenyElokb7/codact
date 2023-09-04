<?php
$status = false; 
?>

@extends('layouts.app')
<head>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('js/login.js') }}"></script>
</head>

@section('content')
<div class="container">
<div class="background-connexion mt-5">
   

    <div class="item2">
        <img src="{{ asset('assets/images/picture1.png')  }}" alt="pict1" width="450" height="550" class="little_screen_login">
        <div class="card margin-left-form width-card" style="background-color: white">
            <div class="h2 d-flex justify-content-center mt-3">
                Welcome back!
            </div>
            <p class="">Login to continue</p>
            <br />
            <div class="ms-5">
            <form method="POST" action="{{ route('login') }}">
                        @csrf

                <label class="text-muted h6">Email address</label>
                <input id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus type="email" class="mt-2 ps-2 bg-gray-50 border border-stone-900 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-stone-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 input  ">
            
            </div>   
            @error('email')
                <span class="text-danger fw-bold h6">
                    {{ $message }}
                </span>
            @enderror
      
            <div class="d-flex justify-content-end me-5 position-relative" style="top: 23px; right: 7px;">
            @if ($status)
                <span id="showHideSpan" onclick="togglePasswordVisibility()" role="button" class="text-muted">
                    <i class="fas fa-eye"></i> Hide
                </span>
            @else
                <span id="showHideSpan" onclick="togglePasswordVisibility()" role="button" class="text-muted">
                    <i class="fas fa-eye"></i> Show
                </span>
            @endif
            </div>

            <div class="ms-5 mt-4">
                <label class="text-muted h6">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" class="mt-2 ps-2 bg-gray-50 border border-stone-900 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-stone-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 input">
             
            </div>
            @error('password')
                <span class="text-danger fw-bold h6">
                    {{ $message }}
                </span>
            @enderror

            <div class="d-flex justify-content-center mt-3"> 
                @if(session('error'))
                    <div class="text-danger fw-bold h6">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-center mt-3 ms-1">
                <button type="submit" class="btn margin-button btn1 opacity-100 text-white" style="background-color:#1836b2;">
                    {{ __('Log in') }}
                </button>
            </div>
           
            <div class="d-flex justify-content-center mt-3 ms-1">
                <div class="h6 text-danger border-bottom border-dark w-50 ms-3 "></div>
                <span class="mt-2 ms-3 position-relative h6" style="top: 7px;">OR</span>
                <div class="h6 me-4 pe-1 text-danger border-bottom border-dark w-50 ms-3 "></div>
            </div>

            <div class="d-flex justify-content-center mt-3 ms-1">
                <button class="btn2 text-dark margin-button" onclick="window.location.href='/register'">Create Account</button>
            </div>

            <div class="d-flex justify-content-center mb-3 mt-4 ms-1">
                <a href="/resetmethod" class="text-dark">Forget your password?</a>
            </div>
        </div>
    </form>
    </div>
</div>

</div>
@endsection