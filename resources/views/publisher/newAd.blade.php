@extends('admin.dashboard')

@section('admin')
    <div class="page-content">

        <!-- start step indicators -->





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
        <!-- end step indicators -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <form id="msform">
                                <!-- progressbar -->
                                <ul id="progressbar" class="d-flex justify-content-center">
                                    <li id="account"><strong>Filter </strong></li>
                                    <li class="active" id="personal"><strong>Create</strong></li>
                                    <li id="confirm"><strong>Checkout</strong></li>
                                </ul>
                                <!-- fieldsets -->

                            </form>

                            <form id="my-form" action="{{ route('createAd') }}" method="POST" style="margin-top:50px"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="justify-content-center row gy-3">
                                    <div class="col-lg-4">
                                        <div class="mb-0">
                                            <div class="d-flex">
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#cafeNameSelect').select2();
                                                    });
                                                </script>
                                                <label class="form-label text-nowrap me-3 mt-1">Cafe's Name</label>
                                                <select name="cafeName[]" id="cafeNameSelect"
                                                    class="select2 form-select select2-multiple" multiple required>
                                                    <option>Select</option>
                                                    @foreach ($filteredCafes as $item)
                                                        <option data-cafeownerid="{{ $item->id }}"
                                                            value="{{ $item->cafeName }}">{{ $item->cafeName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="cafeOwnerId" id="cafeOwnerId">
                                    </div>

                                    <div class=" ms-5 col-lg-4">
                                        <div class="mb-0">
                                            <div class="d-flex">
                                                <label class="form-label text-nowrap me-3 mt-1">Start date & End
                                                    date</label>
                                                <div class="input-daterange input-group" id="datepicker6"
                                                    data-date-autoclose="true" data-date-container='#datepicker6'>
                                                    <input type="date" class="form-control" id="start" name="start"
                                                        placeholder="Start date" required />
                                                    <input type="date" class="form-control" min="#start" name="end"
                                                        placeholder="End date" required />
                                                </div>
                                            </div>
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
                                <div class="justify-content-center mt-5 row gy-3">

                                    <div class="col-lg-4">
                                        <div class="mb-0">
                                            <div class="d-flex">
                                                <label class="form-label text-nowrap me-3 mt-1" for="time">Time</label>
                                                <input id="time" type="time" name="time" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <input id="period_" type="hidden" name="period" class="form-control">

                                    <div class="col-lg-4">
                                        <div class="mb-0">
                                            <div class="d-flex ms-5">
                                                <label class="form-label text-nowrap me-3 mt-1" for="cost">Cost
                                                    (DT)</label>
                                                <input id="cost" disabled class="form-control">
                                                <input type="hidden" name="cost" id="cost_">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="justify-content-center mt-5 row gy-3">

                                    <div class="col-lg-4">
                                        <div class="mb-0">
                                            <div class="d-flex">
                                                <label class="form-label text-nowrap me-3 mt-1" for="cost">Upload video
                                                    here</label>
                                                <input type="file" class="form-control" name="video"
                                                    accept="video/mp4,video/x-m4v,video/*">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-0">
                                            <div class="d-none">
                                                <label class="form-label text-nowrap me-3 mt-1">Upload video
                                                    here</label>
                                                <input type="file" class="form-control"
                                                    accept="video/mp4,video/x-m4v,video/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end" style="margin-top: 50px;">
                                    <button class="btn btn-submit " style="margin-bottom:50px" type="submit">Submit
                                        form</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
                    {{-- <script>
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
                            
                            function updateCostField() {
                                var sumByOption = {};
                                var totalCost = 0;

                                $('#cafeNameSelect option:selected').each(function() {
                                    var formattedTime = $('#time').val();
                                    var numericTime = parseInt(formattedTime.replace(':', ''), 10);
                                    var cost = 0;
                                    var cafeName = $(this).val();
                                    var cafeCategory = cafeCategories[cafeName];

                                    console.log('Cafe Name:', cafeName);
                                    console.log('Category:', cafeCategory);
                                    console.log('Formatted Time:', formattedTime);
                                    console.log('Numeric Time:', numericTime);

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

                                    console.log('Cost:', cost);
                                    console.log('Total Cost:', totalCost);
                                });

                                $('#cost').val(totalCost);
                                $('#cost_').val(totalCost);
                                $('#period_').val(durationInDays);

                                console.log('Final Total Cost:', totalCost);
                                console.log('Duration in Days:', durationInDays);
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
                            async function updateCategory() {
                                cafeCategories = {};
                                var count = selectedOptions.length;
                                var processed = 0;
                                async function fetchCategory(cafeName) {
                                    try {
                                        const response = await $.ajax({
                                            url: '/get-category',
                                            type: 'GET',
                                            data: {
                                                cafeName: cafeName
                                            },
                                        });
                                        return response.cafeCategory;
                                    } catch (error) {
                                        console.log('Error:', error);
                                        return null;
                                    }
                                }
                                const categoryPromises = selectedOptions.map(fetchCategory);
                                const results = await Promise.all(categoryPromises);
                                for (let i = 0; i < selectedOptions.length; i++) {
                                    cafeCategories[selectedOptions[i]] = results[i];
                                }

                               
                                updateCafeOwnerId();
                            }

                        });
                    </script> --}}
                    <script>
                        $(document).ready(function() {
                            var selectedOptions = [];
                            var durationInDays = 1;
                            var cafeCategories = {};

                            // Define the update functions
                            function updateCategory() {
                                cafeCategories = {};
                                var count = selectedOptions.length;
                                var processed = 0;

                                async function fetchCategory(cafeName) {
                                    try {
                                        const response = await $.ajax({
                                            url: '/get-category',
                                            type: 'GET',
                                            data: {
                                                cafeName: cafeName
                                            },
                                        });
                                        return response.cafeCategory;
                                    } catch (error) {
                                        console.log('Error:', error);
                                        return null;
                                    }
                                }

                                const categoryPromises = selectedOptions.map(fetchCategory);

                                Promise.all(categoryPromises).then(results => {
                                    for (let i = 0; i < selectedOptions.length; i++) {
                                        cafeCategories[selectedOptions[i]] = results[i];
                                    }

                                    updateCostField(); // Call updateCostField after categories have been retrieved
                                    updateCafeOwnerId();
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
                                    var formattedTime = $('#time').val();
                                    var numericTime = parseInt(formattedTime.replace(':', ''), 10);
                                    var cost = 0;
                                    var cafeName = $(this).val();
                                    var cafeCategory = cafeCategories[cafeName];

                                    console.log('Cafe Name:', cafeName);
                                    console.log('Category:', cafeCategory);
                                    console.log('Formatted Time:', formattedTime);
                                    console.log('Numeric Time:', numericTime);

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

                            $('#cafeNameSelect').change(function() {
                                console.log('Cafe Name Select changed');
                                selectedOptions = $(this).val() || [];
                                updateCategory();
                            });

                            $('#time, #start, [name="end"]').change(function() {
                                console.log('Time or Date changed');
                                var startDate = new Date($('#start').val());
                                var endDate = new Date($('[name="end"]').val());
                                durationInDays = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
                                updateCostField();
                            });
                        });
                    </script> <!-- end select2 -->
                </div>
            </div>
        </div>
    </div>
@endsection
