<?php use Carbon\Carbon;
?>
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Rejected Ads</a></li>
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
                            @if ($rejectededAds->isEmpty())
                                <p>No Rejeted ads at the moment.</p>
                            @else
                                <table id=>
                                    <table id="datatable" class="table table-striped table-bordered dt-responsive"
                                        style="border-collapse: collapse; border-spacing: 1; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Ad ID</th>
                                                <th>User</th>
                                                <th>Cafe</th>
                                                <th>Video</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Time</th>
                                                <th>Period</th>
                                                <th>Cost</th>
                                                <th>status</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rejectededAds as $ad)
                                                <tr>

                                                    <td>{{ $ad->id }}</td>
                                                    <td>{{ $ad->user->name }}</td>
                                                    <td>
                                                        @foreach ($ad->cafeOwners as $cafeOwner)
                                                          <span class="badge bg-success">
                                                            {{ $cafeOwner->cafeName }}  </span>  
                                                        @endforeach
                                                    </td>                                                    <td><a href="storage/{{ $ad->video }}">Open Ad</a></td>
                                                    <td>{{ $ad->startdate }}</td>
                                                    <td>{{ $ad->enddate }}</td>
                                                    <td>{{ $ad->time }}</td>
                                                    <td> @if ($ad->period==1) {{ $ad->period }} Day @else {{ $ad->period }} Days @endif </td>
                                                    <td>{{ $ad->cost }}</td>
                                                    <?php $currentDate = Carbon::now();
                                                    $formattedDate = $currentDate->format('Y-m-d');?>
                                                    <td> @if($formattedDate> $ad->enddate) <i class="fas fa-toggle-off" style="color: rgb(79, 79, 79)"> </i> Desactivate @else <i class="fas fa-toggle-on" style="color: rgb(61, 255, 61)"> </i> Active @endif </td>
                                                   
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </table>
                            @endif
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
@endsection
