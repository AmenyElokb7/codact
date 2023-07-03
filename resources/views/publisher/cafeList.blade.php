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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ads</a></li>
                                <li class="breadcrumb-item active">Cafes</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                @foreach ($cafe as $c)
                    <div class="col-lg-4">
                        <div class="card m-b-30">
                            <div class="card-body">

                                <div class="d-flex align-items-center">
                                    <img class="d-flex me-3 rounded-circle img-thumbnail avatar-lg"
                                        src="{{ asset('storage/' . $c->image) }}" alt="{{ $c->cafeName }}">

                                    <div class="flex-grow-1">
                                        <h5 class="mt-0 font-size-18 mb-1">{{ $c->cafeName }}</h5>
                                        <p class="text-muted font-size-14">{{ $c->address }}</p>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end col -->
                @endforeach
            </div>
        </div>
    @endsection
