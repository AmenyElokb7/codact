@extends('admin.dashboard')


@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Ads List </h4>
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
                                            <th>Start date</th>
                                            <th>End date</th>
                                            <th>Time</th>
                                            <th>Cost</th>
                                            <th>Status</th>
                                            <th>Video</th>
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
                                                <td style="white-space:nowrap">
                                                   
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
                                                                        <iframe class="embed-responsive-item"
                                                                            src="../storage/{{ $ad->video }}"></iframe>
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



@endsection
