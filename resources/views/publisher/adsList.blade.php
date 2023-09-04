@extends('admin.dashboard')


@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Ads Managment </h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ads</a></li>
                                <li class="breadcrumb-item active">Ads List</li>
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
                            <table id=>
                                <table id="datatable" class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 1; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Cafe Name</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                            <th>Time</th>
                                            <th>Cost</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <style>
                                        .rounded {
                                            border-radius: 30px;
                                        }
                                    </style>
                                    <tbody>
                                        @php
                                            $value = 1;
                                        @endphp
                                        @foreach ($ads as $ad)
                                            <tr>
                                                <td>#{{ $value++ }} </td>
                                                <td>
                                                    @foreach ($ad->cafeOwners as $cafeOwner)
                                                      <span class="badge bg-success">
                                                        {{ $cafeOwner->cafeName }}  </span>  
                                                    @endforeach
                                                </td>
                                                <td>{{ $ad->startdate }}</td>
                                                <td>{{ $ad->enddate }}</td>
                                                <td>{{ $ad->time }}</td>
                                                <td>{{ $ad->cost }}</td>
                                                @if ($ad->status == 'pending')
                                                    <td>
                                                        <span class="badge bg-warning text-light">{{ $ad->status }}</span>
                                                    </td>
                                                @elseif ($ad->status == 'approved')
                                                    <td>
                                                        <span class="badge bg-success text-light">{{ $ad->status }}</span>
                                                    </td>
                                                @elseif ($ad->status == 'rejected')
                                                    <td>
                                                        <span class="badge bg-danger text-light">{{ $ad->status }}</span>
                                                    </td>
                                                @endif
                                                <div class="btn-group">
                                                <td style="white-space:nowrap">
                                                        <form action="{{ route('ads.destroy', ['id' => $ad->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger sm" title="Delete ad" id="delete">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                        
                                                    <button class="btn btn-primary sm" title="View video"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#videoModal{{ $ad->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                               
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="videoModal{{ $ad->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="videoModalLabel{{ $ad->id }}"
                                                        aria-hidden="true">

                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="videoModalLabel">Ad
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div
                                                                        class="embed-responsive embed-responsive-16by9 d-flex justify-content-center align-items-center">
                                                                        <iframe class="embed-responsive-item" autoplay="false"
                                                                            src="storage/{{ $ad->video }}"></iframe>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </div>
                                        @endforeach
                                        </tr>
                                        
                                        {{-- @endforeach --}}

                                    </tbody>
                                </table>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
    <!-- Button trigger modal -->
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

        })
        // ************* Confirm password **************** //
        $(document).ready(function() {
            $('#password-confirm').on('keyup', function() {
                var val = $(this).val();
                var pass = $('#password').val();
                $("#invalidPass").css("display", "none");
                if (val != pass) {
                    $("#password-confirm").css("color", "red");
                    $("#invalidPass").css("display", "block");
                    $("#subAjout").attr("disabled", true);

                }
            })
            $('#password-confirm').on('keydown', function() {
                $("#password-confirm").css("color", "green");
                $("#invalidPass").css("display", "none");
                $("#subAjout").removeAttr("disabled");

            })
        })

        $(document).ready(function() {
            $('#email').on('keyup', function() {
                var val = $(this).val();
                $.ajax({
                    url: "<?php echo url('CHECK'); ?>",
                    data: {
                        em: val,
                        query: "email"
                    },
                    type: "GET",
                    success: function(data) {

                        $("#invalid").css("display", "none");
                        if (data > 0) {
                            $("#email").css("color", "red");
                            $("#invalid").css("display", "block");
                            $("#subAjout").attr("disabled", true);
                        } else if (data == 0) {
                            $("#email").css("color", "green");
                            $("#invalid").css("display", "none");
                            $("#subAjout").removeAttr("disabled");
                        }

                    }
                })
            })
            $('#email').on('keydown', function() {
                $("#email").css("color", "green");
                $("#invalid").css("display", "none");
                $("#subAjout").removeAttr("disabled");
            })
        })
        $(document).ready(function() {
            $('#phoneno').on('keyup', function() {
                var val = $(this).val();
                $.ajax({
                    url: "<?php echo url('CHECK'); ?>",
                    data: {
                        phono: val,
                        query: "phoneno"
                    },
                    type: "GET",
                    success: function(data) {

                        $("#invalidP").css("display", "none");
                        if (data > 0) {
                            $("#phoneno").css("color", "red");
                            $("#invalidP").css("display", "block");
                            $("#subAjout").attr("disabled", true);
                        } else if (data == 0) {
                            $("#phoneno").css("color", "green");
                            $("#invalidP").css("display", "none");
                            $("#subAjout").removeAttr("disabled");
                        }

                    }
                })
            })

            $('#phoneno').on('keydown', function() {
                $("#phoneno").css("color", "green");
                $("#invalidP").css("display", "none");
                $("#subAjout").removeAttr("disabled");

            })
        })
    </script>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add subscriber</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="createUserForm" action="{{ route('admin.subscribers.create') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" name="profile_image" type="file" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" name="name" type="text" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                                <p style="color:red;padding: 5px;display: none;" id="invalid">*Email already exists</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" name="address" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phoneno"
                                class="col-md-4 col-form-label text-md-end">{{ __('Phone number') }}</label>

                            <div class="col-md-6">
                                <input id="phoneno" type="number" oninput="checkLength()"
                                    class="form-control @error('phoneno') is-invalid @enderror" name="phoneno"
                                    value="{{ old('phoneno') }}" required autocomplete="phoneno" autofocus>
                                <p style="color:red;padding: 5px;display: none;" id="invalidP">*Phone Number already
                                    exists
                                </p>
                                <script>
                                    function checkLength() {
                                        var input = document.getElementById("phoneno");
                                        var value = input.value;
                                        if (value.length !== 8) {
                                            input.setCustomValidity("Phone number must be 8 digits");
                                        } else {
                                            input.setCustomValidity("");
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __("Cafe's Name") }}</label>

                            <div class="col-md-6">
                                <input id="cname" type="text" class="form-control" name="cafeName" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __("Cafe's Category") }}</label>

                            <div class="col-md-6">
                                <select name="cafeCategory" id="cafeCategory " class="form-select selectpicker" required
                                    multiple>
                                    <option value="">Select Category</option>
                                    <option value="lounge">Lounge</option>
                                    <option value="caferesto">Café Resto</option>
                                    <option value="cafe">Cafe</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Age Range"
                                class="col-md-4 col-form-label text-md-end">{{ __('Age Range') }}</label>

                            <div class="col-md-6">
                                <div id="slider-outer-div">
                                    <div class="selector">
                                        <div class="price-slider">
                                            <div id="slider-range"
                                                class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                                <span tabindex="0"
                                                    class="ui-slider-handle ui-corner-all ui-state-default"></span><span
                                                    tabindex="0"
                                                    class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                            </div>
                                            <label for="min-age" class="form-label">Min Age: <span
                                                    id="minAgeValue"></span></label>
                                            <input id="min-age" class="form-range" name="minAge" type="range"
                                                min="15" max="80" value="15"
                                                oninput="updateMinMaxValues()">

                                            <label for="max-age" class="form-label">Max Age: <span
                                                    id="maxAgeValue"></span></label>
                                            <input id="max-age" class="form-range" name="maxAge" type="range"
                                                min="15" max="80" value="80"
                                                oninput="updateMinMaxValues()">
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function updateMinMaxValues() {
                                        var minAgeInput = document.getElementById("min-age");
                                        var maxAgeInput = document.getElementById("max-age");
                                        var minAgeValue = parseInt(minAgeInput.value);
                                        var maxAgeValue = parseInt(maxAgeInput.value);

                                        if (minAgeValue > maxAgeValue) {
                                            minAgeValue = maxAgeValue;
                                            minAgeInput.value = minAgeValue;
                                        }

                                        document.getElementById("minAgeValue").textContent = minAgeValue;
                                        document.getElementById("maxAgeValue").textContent = maxAgeValue;
                                    }
                                </script>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" minlength="6" class="form-control"
                                    name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" data-rule-equalTo="#password" required
                                    autocomplete="new-password">
                            </div>
                            <p style="color:red;padding: 5px;display: none;" id="invalidPass">*Password doesn't match</p>

                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="subAjout" class="btn btn-primary">
                                    {{ __('Save changes') }}
                                </button>
                            </div>
                        </div>


                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection


