@extends('admin.dashboard')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Notifications </h4>
                    </div>
                </div>
            </div>
            <style>
                th {
                    display: table-cell !important;
                    font-size: 12px !important;
                }

                .card {
                    box-shadow: 0 4px 6px -1px rgb(122, 122, 232), 0 2px 4px -1px rgba(125, 125, 224, 0.511);
                }
            </style>

            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    @if ($notifications->isEmpty())
                        <div class="card ">
                            <div class="card-body">
                                <br><br>
                                <p>No notifications at the moment.</p>
                            </div>
                        </div>
                    @else
                        @foreach ($notifications as $notification)
                            @if ($notification->data['title'] == 'New Ad')
                                <a href="{{ route('pendingAd') }}">
                                    <div class="card mb-3">
                                        <div class="card-body ">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                        <i class="ri-notification-3-line"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <h6 class="mb-1">{{ $notification->data['title'] }}</h6>
                                                    <div class="font-size-12 text-muted">
                                                        <p class="mb-1">{{ $notification->data['message'] }}</p>
                                                        <p class="mb-0">
                                                            <i class="mdi mdi-clock-outline"></i>
                                                            {{ $notification->created_at->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endif
                            @endforeach

                            <div class="pagination-rounded justify-content-center">
                                {{ $notifications->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>
@endsection
