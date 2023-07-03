@extends('admin.dashboard')

@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Ashtrays for {{ $user->cafeName }} </h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Support</a></li>
                                <li class="breadcrumb-item active">Ashtrays List</li>
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
                                            <th>Reference</th>
                                            <th>Cafe Name</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $value = 1;
                                        @endphp
                                        @foreach ($ashtrays as $ashtray)
                                            <tr>
                                                <td># {{ $value++ }} </td>
                                                <td>{{ $ashtray->reference }}</td>
                                                <td><div class="badge bg-secondary">{{ $user->cafeName }}</div></td>
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
    </div>

@endsection
