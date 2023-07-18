@extends('admin.dashboard')

@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Ads </h4>
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
                            <br><br>
                            <script>
                                $(document).ready(function() {
                                    // Initialize Select2 on the select element
                                    $('#cafeNameSelect').select2();
                                    $('#cafeAddressSelect').select2();
                                });
                            </script>
                            <form action="{{ route('filteredAds') }}" method="GET">
                                @csrf
                                <label class="form-label">Category</label>
                                <select name="cafeCategories[]" id="cafeNameSelect" class="select2 form-select select2-multiple" multiple required>
                                    <option>Select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                
                                <label class="form-label">Address</label>
                                <select name="cafeAddresses[]" id="cafeAddressSelect" class="select2 form-select select2-multiple" multiple required>
                                    <option>Select</option>
                                    @foreach ($addresses as $address)
                                        <option value="{{ $address->address }}">{{ $address->address }}</option>
                                    @endforeach
                                </select>
                                
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                            
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
@endsection
