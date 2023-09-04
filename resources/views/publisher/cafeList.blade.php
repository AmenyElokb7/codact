@extends('admin.dashboard')

@section('admin')
    <div class="page-content">
        <div class="container-fluid">
           
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Cafes</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button id="createAdButton" class="btn btn-primary" style="display: none;"
                                            onclick="createAdWithSelectedCafes()">Create Ad</button>
                                    </div>
                                </div>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                @foreach ($cafe as $c)
                    @php
                        $opentime = \Carbon\Carbon::createFromTimestamp(strtotime($c->Opentime));
                        $closetime = \Carbon\Carbon::createFromTimestamp(strtotime($c->Closetime));
                        $current_time = \Carbon\Carbon::now();
                    @endphp
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="{{ route('showpreview', ['id' => $c->id]) }}" target="_blank">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    {{-- <input type="checkbox" class="cafeCheckbox" name="selected_cafes[]"
                                        value="{{ $c->id }}" data-cafe="{{ $c->cafeName }}"> --}}
                                    <div class="d-flex flex-row bd-highlight mb-3 justify-content-end">
                                        @if ($current_time->between($opentime, $closetime))
                                            <span class="badge bg-success p-2 bd-highlight">Open</span>
                                        @else
                                            <span class="badge bg-danger p-2 bd-highlight">Close</span>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <img class="d-flex me-3 rounded-circle img-thumbnail avatar-lg"
                                            src="{{ asset('storage/' . $c->image) }}" alt="{{ $c->cafeName }}">
                                        <div class="flex-grow-1">
                                            <h5 class="mt-0 font-size-18 mb-1">{{ $c->cafeName }}</h5>
                                            <p class="text-muted font-size-14">Address: {{ $c->address }}</p>
                                            <p class="text-muted font-size-14">Category : {{ $c->category->name }}</p>
                                            <span class="fas fa-star"> {{ $c->Besttime }}</span>
                                            <span class="fas fa-user"> {{ $c->profession }} | Age : [{{ $c->minAge }},
                                                {{ $c->maxAge }}] </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="pagination-rounded justify-content-center">
                {{ $cafe->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var selectedOptions = [];
            var durationInDays = 1;
            var cafeCategories = {};
            $('#cafeNameSelect').change(function() {
                selectedOptions = $(this).val() || [];
                updateCategory();
            });
            $('#time, #start, [name="end"]').change(function() {
                var startDate = new Date($('#start').val());
                var endDate = new Date($('[name="end"]').val());
                durationInDays = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
                updateCostField();
            });

            function updateCategory() {
                cafeCategories = {};
                var count = selectedOptions.length;
                var processed = 0;
                selectedOptions.forEach(function(cafeName) {
                    $.ajax({
                        url: '/get-category',
                        type: 'GET',
                        data: {
                            cafeName: cafeName
                        },
                        success: function(response) {
                            cafeCategories[cafeName] = response.cafeCategory;
                            processed++;
                            if (processed === count) {
                                updateCostField();
                                updateCafeOwnerId();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                });
            }

            function updateCafeOwnerId() {
                var selectedCafeNames = $('#cafeNameSelect').val();
                var cafeOwnerIds = [];
                selectedCafeNames.forEach(function(cafeName) {
                    var cafeOwnerId = $('#cafeNameSelect option[value="' + cafeName + '"]').data(
                        'cafeownerid');
                    cafeOwnerIds.push(cafeOwnerId);
                });
                $('#cafeOwnerId').val(cafeOwnerIds.join(','));
            }

            function updateCostField() {
                var sumByOption = {};
                var totalCost = 0;
                $('#cafeNameSelect option:selected').each(function() {
                    var cafeName = $(this).val();
                    var formattedTime = $('#time').val().replace(':', '');
                    var numericTime = parseInt(formattedTime, 10);
                    var cost = 0;
                    var cafeCategory = cafeCategories[
                        cafeName];
                    if (cafeCategory === 'lounge') {
                        if ((numericTime >= 2100 && numericTime <= 2359) || (numericTime >= 0 &&
                                numericTime <= 400)) {
                            cost = 10000;
                        } else {
                            cost = 5000;
                        }
                    } else if (cafeCategory === 'caferesto') {
                        if (numericTime >= 1700 && numericTime <= 2100) {
                            cost = 4000;
                        } else {
                            cost = 2000;
                        }
                    } else if (cafeCategory === 'cafe') {
                        if (numericTime >= 800 && numericTime <= 1200) {
                            cost = 2000;
                        } else {
                            cost = 1000;
                        }
                    }
                    cost *= durationInDays;
                    sumByOption[cafeName] = cost;
                    totalCost += cost;
                });
                $('#cost').val(totalCost);
                $('#cost_').val(totalCost);
                $('#period_').val(durationInDays);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".cafeCheckbox").on("click", function() {
                var cafeName = $(this).data("cafe");
                console.log('cafeName');
                var selectElement = $("#cafeNameSelect");
                if ($(this).prop("checked")) {
                    var option = new Option(cafeName, cafeName, true, true);
                    selectElement.append(option).trigger("change");
                } else {
                    selectElement.find('option[value="' + cafeName + '"]').remove();
                    selectElement.trigger("change");
                }
            });
        });
    </script>
    
