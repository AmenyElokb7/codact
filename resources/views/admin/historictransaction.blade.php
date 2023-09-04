@extends('admin.dashboard')

<head>
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>
<style>
    .justify-elements {
        justify-content: end;
    }

    @media screen and (max-width: 700px) {
        .justify-elements {
            justify-content: start;
        }
    }
</style>
@section('admin')
    <div class="page-content">
        <div class=" d-flex justify-content-center ">


            <div class="container-fluid">
                <div class="row">
                    <!-- ... -->
                    <h5>Financial Summary</h5>
                </div>
                <!-- end page title -->
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row d-flex justify-elements mb-3">
                                    <!-- Checkboxes for each table header -->
                                    <label class="checkbox-inline col-sm-1  col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='title' name="filter"
                                            value="Title" checked> Title
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-5 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='description' name="filter"
                                            value="Description" checked> Description
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-3  col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='userid' name="filter"
                                            value="User ID" checked> User ID
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-4 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='username' name="filter"
                                            value="User Name" checked> User Name
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-5 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='amount' name="filter"
                                            value="Amount (TND)" checked> Amount (TND)
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-2  col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='date' name="filter"
                                            value="Date" checked> Date
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-3  col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='time' name="filter"
                                            value="Time" checked> Time
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-3 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='doc' name="filter"
                                            value="Doc" checked> Doc
                                    </label>
                                </div>
                                <!-- ... -->

                                <table id="datatable" class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 1; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="tdtitle">Title</th>
                                            <th class='tddescription'>Description</th>
                                            <th class='tduserid'>User ID</th>
                                            <th class="tdusername">User Name</th>
                                            <th class="tdamount">Amount (TND)</th>
                                            <th class="tddate">Date</th>
                                            <th class="tdtime">Time</th>
                                            <th class="tddoc">Doc</th>
                                        </tr>






                                    </thead>
                                    <tbody>
                                        @php
                                            $value = 1;
                                        @endphp



                                        @foreach ($historicalTransactions as $transaction)
                                            <tr>
                                                <td class='tdtitle'>{{ $transaction->title }}</td>
                                                <td class='tddescription'>{{ $transaction->description }}</td>
                                                <td class='tduserid'>{{ $transaction->user_id }} </td>

                                                <td class="tdusername"> @php
                                                    $receiver = \App\Models\User::find($transaction->user_id);
                                                @endphp
                                                    {{ $receiver ? $receiver->name : 'N/A' }}</td>

                                                @if ($transaction->title === 'Charge account')
                                                    <td class="text-success tdamount">+ {{ $transaction->amount }}</td>
                                                @endif
                                                <td class="tddate">
                                                    @php
                                                        $dateTime = new DateTime($transaction->created_at);
                                                        $date = $dateTime->format('Y-m-d');
                                                        echo $date;
                                                    @endphp
                                                </td>
                                                <td class="tdtime">
                                                    @php
                                                        $dateTime = new DateTime($transaction->created_at);
                                                        $hour = $dateTime->format('H:i:s');
                                                        echo $hour;
                                                    @endphp
                                                </td>

                                                <td class=" tddoc">
                                                    <a href="{{ asset($transaction->pdf_path) }}" download>
                                                        <img src="{{ asset('assets/images/pdf.png') }}" width="27"
                                                            height="27" class="" alt="Download PDF">
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                const titleisChecked = document.getElementById('title');

                titleisChecked.addEventListener('change', function() {
                    const tdTitles = document.querySelectorAll('.tdtitle');

                    tdTitles.forEach(td => {
                        td.style.display = this.checked ? 'table-cell' : 'none';
                    });
                });
                //dddddd
                const descriptionisChecked = document.getElementById('description');

                descriptionisChecked.addEventListener('change', function() {
                    const tdTitles = document.querySelectorAll('.tddescription');

                    tdTitles.forEach(td => {
                        td.style.display = this.checked ? 'table-cell' : 'none';
                    });
                });
                //dddddd
                const useridisChecked = document.getElementById('userid');

                useridisChecked.addEventListener('change', function() {
                    const tdTitles = document.querySelectorAll('.tduserid');

                    tdTitles.forEach(td => {
                        td.style.display = this.checked ? 'table-cell' : 'none';
                    });
                });
                //dddddd
                const usernameisChecked = document.getElementById('username');

                usernameisChecked.addEventListener('change', function() {
                    const tdTitles = document.querySelectorAll('.tdusername');

                    tdTitles.forEach(td => {
                        td.style.display = this.checked ? 'table-cell' : 'none';
                    });
                });
                //dddddd
                const amountisChecked = document.getElementById('amount');

                amountisChecked.addEventListener('change', function() {
                    const tdTitles = document.querySelectorAll('.tdamount');

                    tdTitles.forEach(td => {
                        td.style.display = this.checked ? 'table-cell' : 'none';
                    });
                });
                //dddddd
                const dateisChecked = document.getElementById('date');

                dateisChecked.addEventListener('change', function() {
                    const tdTitles = document.querySelectorAll('.tddate');

                    tdTitles.forEach(td => {
                        td.style.display = this.checked ? 'table-cell' : 'none';
                    });
                });
                //dddddd
                const timeisChecked = document.getElementById('time');

                timeisChecked.addEventListener('change', function() {
                    const tdTitles = document.querySelectorAll('.tdtime');

                    tdTitles.forEach(td => {
                        td.style.display = this.checked ? 'table-cell' : 'none';
                    });
                });
                //dddddd

                const docisChecked = document.getElementById('doc');

                docisChecked.addEventListener('change', function() {
                    const tdTitles = document.querySelectorAll('.tddoc');

                    tdTitles.forEach(td => {
                        td.style.display = this.checked ? 'table-cell' : 'none';
                    });
                });
                //dddddd

                console.log(document.getElementById('tdtitle'));
            </script>

        </div>
    </div>
@endsection
