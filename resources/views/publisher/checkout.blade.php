@extends('admin.dashboard')

<head>
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/payment2.css') }}">
</head>
<style>
    .width_card_pay,
    .width_button {
        width: 50%;
    }

    @media screen and (max-width: 700px) {
        .width_card_pay {
            width: 100%;
        }

        .width_button {
            width: 75%;
        }

    }
</style>
<style>
    #heading {
        text-transform: uppercase;
        color: #673AB7;
        font-weight: normal
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    .form-card {
        text-align: left
    }

    #msform fieldset:not(:first-of-type) {
        display: none
    }

    #msform input,
    #msform textarea {
        padding: 8px 15px 8px 15px;
        border: 1px solid #ccc;
        border-radius: 0px;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        background-color: #ECEFF1;
        font-size: 16px;
        letter-spacing: 1px
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #673AB7;
        outline-width: 0
    }

    #msform .action-button {
        width: 100px;
        background: #673AB7;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 0px 10px 5px;
        float: right
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        background-color: #311B92
    }

    #msform .action-button-previous {
        width: 100px;
        background: #616161;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px 10px 0px;
        float: right
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        background-color: #000000
    }

    .card {
        z-index: 0;
        border: none;
        position: relative
    }

    .fs-title {
        font-size: 25px;
        color: #673AB7;
        margin-bottom: 15px;
        font-weight: normal;
        text-align: left
    }

    .purple-text {
        color: #673AB7;
        font-weight: normal
    }

    .steps {
        font-size: 25px;
        color: gray;
        margin-bottom: 10px;
        font-weight: normal;
        text-align: right
    }

    .fieldlabels {
        color: gray;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey
    }

    #progressbar .active {
        color: #673AB7
    }

    #progressbar li {
        list-style-type: none;
        font-size: 15px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar #account:before {
        font-family: FontAwesome;
        content: "1"
    }

    #progressbar #personal:before {
        font-family: FontAwesome;
        content: "2"
    }


    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "3"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #673AB7
    }

    .progress {
        height: 20px
    }

    .progress-bar,
    .btn-submit {
        background-color: #673AB7;
        color: white;
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }
</style>
@section('admin')
    <div>
        <div class="page-content">
            <div class="container-fluid mt-3">




                <!--transaction -->

                <div class=" mt-3" id="ribshow">

                    <div class="d-flex justify-content-center">

                        <div class="card p-5 width_card_pay ">
                            <form id="msform">
                                <!-- progressbar -->
                                <ul id="progressbar" class="d-flex justify-content-center">
                                    <li id="account"><strong>Filter </strong></li>
                                    <li id="personal"><strong>Create</strong></li>
                                    <li class="active" id="confirm"><strong>Checkout</strong></li>
                                </ul>
                                <!-- fieldsets -->

                            </form>
                            <div class="d-flex justify-content-center">

                                <!-- Transaction content -->
                                <h5>Finaliser le paiement</h5>
                            </div>
                            <div class=" d-flex justify-content-center  ">
                                <img src="{{ asset('assets/images/—Pngtree—cute cartoon wallet icon_4421120.png') }}"
                                    width="190" height="150" alt="">
                            </div>
                            <div class=" d-flex justify-content-center  mb-2 mt-1 ">
                                Account charge</div>
                            <div class=" d-flex justify-content-center h5">{{ Auth::user()->balance }}<span
                                    class='ms-1'>DNT</span></div>

                            @if ($userBalance >= $cost)
                                <form action="{{ route('processCheckout') }}" method="POST">
                                    @csrf
                                    <div class="d-flex justify-content-center mt-3">
                                        <button class="btn btn-primary width_button p-3 " type="submit">> Pay
                                            {{ $cost }} TND</button>

                                    </div>
                                    <div class="d-flex justify-content-center w-100">
                                        @if (isset($error))
                                            <div class="text-danger mt-3">
                                                {{ $error }}<a href="{{ route('payads') }}">here !</a>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            @else
                            <form action="{{ route('processCheckout') }}" method="POST">
                                @csrf
                                <div class="d-flex justify-content-center mt-3">
                                    <button class="btn btn-primary width_button p-3 " disabled type="submit">> Pay
                                        {{ $cost }} TND</button>

                                </div>
                                <div class="d-flex justify-content-center w-100">
                                    @if (isset($error))
                                        <div class="text-danger mt-3">
                                            {{ $error }}<a href="{{ route('payads') }}">here !</a>
                                        </div>
                                    @endif
                                </div>
                            </form>
                            @endif

                        </div>
                    </div>




                </div>







            </div>
        </div>
    </div>









@endsection
