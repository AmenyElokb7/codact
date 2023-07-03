@extends('admin.dashboard')

@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ads/New Ad </h4>
                            <form id="my-form" action="{{ route('createAd') }}" method="POST" style="margin-top:50px"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="mb-0">
                                            <script>
                                                $(document).ready(function() {
                                                    // Initialize Select2 on the select element
                                                    $('#cafeNameSelect').select2();
                                                });
                                            </script>
                                            <label class="form-label">Cafe's Name</label>
                                            <select name="cafeName" id="cafeNameSelect" class="select2 form-select select2-multiple"
                                                multiple required>
                                                <option>Select</option>
                                                @foreach ($cafe as $item)
                                                    <option data-cafeownerid="{{ $item->id }}"
                                                        value="{{ $item->cafeName }}">{{ $item->cafeName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="cafeOwnerId" id="cafeOwnerId">
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-0">
                                            <label class="form-label">Start date & End date</label>

                                            <div class="input-daterange input-group" id="datepicker6"
                                                data-date-autoclose="true" data-date-container='#datepicker6'>
                                                <input type="date" class="form-control" id="start" name="start"
                                                    placeholder="Start date" required />
                                                <input type="date" class="form-control" min="#start" name="end"
                                                    placeholder="End date" required />
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        const startDateInput = document.querySelector('#start');
                                        const endDateInput = document.querySelector('[name="end"]');

                                        startDateInput.addEventListener('change', () => {
                                            endDateInput.min = startDateInput.value;
                                        });
                                    </script>
                                    <div class="col-lg-3">
                                        <div class="mb-0">
                                            <label for="time">Time</label>
                                            <input id="time" type="time" name="time" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <input id="period_" type="hidden" name="period" class="form-control">

                                    <div class="col-lg-3">
                                        <div class="mb-0">
                                            <label for="cost">Cost (DT)</label>
                                            <input id="cost" disabled class="form-control">
                                            <input type="hidden" name="cost" id="cost_">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-0">
                                            <label for="cost">Upload video here</label>
                                            <input type="file" class="form-control" name="video"
                                                accept="video/mp4,video/x-m4v,video/*" required>
                                        </div>
                                    </div>


                                    <div style="margin-top: 50px;">
                                        <button class="btn btn-primary" style="margin-bottom:50px" type="submit">Submit
                                            form</button>
                                    </div>

                            </form>
                        </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
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
                                var selectedCafeName = $('#cafeNameSelect').val()[0];
                                var cafeOwnerId = $('#cafeNameSelect option:selected').data('cafeownerid');
                                $('#cafeOwnerId').val(cafeOwnerId);
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
                    <!-- end select2 -->
                </div>
            </div>
        </div>
    </div>
@endsection
