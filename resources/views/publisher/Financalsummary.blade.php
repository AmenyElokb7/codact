@extends('admin.dashboard')

@section('admin')
<style>
 .justify-elements{
justify-content:end;
    }
@media screen and (max-width: 700px) {
    .justify-elements{
justify-content:start;
    }
    }
</style>
    <div class="page-content">
        <div class=" d-flex justify-content-center ">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <!-- ... -->
                    <h5>Financial documents</h5>
                </div>
                <!-- end page title -->
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- ... -->
                                <div class="row d-flex justify-elements mb-3">
                                    <!-- Checkboxes for each table header -->
                                    <label class="checkbox-inline col-sm-1  col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='title'  name="filter" value="Title" checked> Title
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-3 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='description'  name="filter" value="Description" checked> Description
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-5 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='amount'  name="filter" value="Amount (TND)" checked> Amount (TND)
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-3 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='date'  name="filter" value="Date" checked> Date
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-3 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='time'  name="filter" value="Time" checked> Time
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-3 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='creator'  name="filter" value="Creator" checked> Creator
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-3 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='doc'  name="filter" value="Doc" checked> Doc
                                    </label>
                                </div>
                                <table id="datatable" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 1; width: 100%;">
                                <thead>
                                        <tr>
                                            <th class="tdtitle" >Title</th>
                                            <th class='tddescription'>Description</th>
                                            <th class="tdamount">Amount (TND)</th>
                                            <th class="tddate">Date</th>
                                            <th class="tdtime">Time</th>
                                            <th class="tdcreator">Creator</th>
                                            <th class="tddoc">Doc</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($walletHistoric as $wallet)
                                            <tr>
                                                <td class='tdtitle' >{{ $wallet->title }}</td>
                                                <td class='tddescription'>{{ $wallet->description }}</td>
                                                <td class="text-success tdamount">+ {{ $wallet->amount }}</td>
                                                <td class="tddate">{{ $wallet->created_at->format('Y-m-d') }}</td>
                                                <td class="tdtime">{{ $wallet->created_at->format('H:i:s') }}</td>
                                                <td class="tdcreator">{{ $wallet->Creator }}</td>
                                                <td class="tddoc">
                                                    <a href="{{ asset($wallet->pdf_path) }}" download>
                                                        <img src="{{ asset('assets/images/pdf.png') }}" width="27" height="27" alt="Download PDF">
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>
    <script>
        const checkboxFilters = ['title', 'description', 'amount', 'date', 'time', 'creator', 'doc'];

        checkboxFilters.forEach(filter => {
            const checkbox = document.getElementById(filter);

            checkbox.addEventListener('change', function() {
                const tdElements = document.querySelectorAll(.td${filter});

                tdElements.forEach(td => {
                    td.style.display = this.checked ? 'table-cell' : 'none';
                });
            });
        });
    </script>
@endsection