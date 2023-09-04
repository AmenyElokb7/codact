@extends('admin.dashboard')

@section('admin')

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
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Filter cafes </h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">New Ad</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                th {
                    display: table-cell !important;
                    font-size: 12px !important;
                }
            </style>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="msform">
                                <!-- progressbar -->
                                <ul id="progressbar" class="d-flex justify-content-center">
                                    <li class="active" id="account"><strong>Filter </strong></li>
                                    <li  id="personal"><strong>Create</strong></li>
                                    <li id="confirm"><strong>Checkout</strong></li>
                                </ul>
                                <!-- fieldsets -->

                            </form>
                            <br><br>
                            <script>
                                $(document).ready(function() {
                                    $('#cafeNameSelect').select2();
                                    $('#cafeAddressSelect').select2();
                                    $('#cafeProfessionSelect').select2();
                                });
                            </script>
                            <form action="{{ route('filteredAds') }}" method="GET">
                                @csrf
                                <div class="d-flex justify-content-center row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center label-input-container">
                                                <label class="form-label text-nowrap me-3">Category</label>
                                                <select name="cafeCategories[]" id="cafeNameSelect"
                                                        class="select2 form-select select2-multiple input-field" multiple required>
                                                    <option>Select</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-center row mt-3">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center label-input-container">
                                                <label class="form-label text-nowrap me-3">Address</label>
                                                <select name="cafeAddresses[]" id="cafeAddressSelect"
                                                        class="select2 form-select select2-multiple input-field" multiple required>
                                                    <option>Select</option>
                                                    @foreach ($addresses as $address)
                                                        <option value="{{ $address->address }}">{{ $address->address }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-center row mt-3">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center label-input-container">
                                                <label class="form-label text-nowrap me-3">Profession</label>
                                                <select name="cafeProfession[]" id="cafeProfessionSelect"
                                                        class="select2 form-select select2-multiple input-field" multiple required>
                                                    <option>Select</option>
                                                    @foreach ($professions as $profession)
                                                        <option value="{{ $profession->profession }}">{{ $profession->profession }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <style>
                                    .label-input-container {
                                        display: flex;
                                        align-items: center;
                                    }
                                
                                    .input-field {
                                        flex: 1;
                                        margin-left: 10px; /* Adjust this value for spacing between label and input */
                                    }
                                </style>
                                
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-submit" style="margin-bottom:50px" type="submit">Submit
                                        form</button>
                                </div>
                                </div>
                            </form>
                  
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
@endsection
