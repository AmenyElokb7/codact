@extends('admin.dashboard')

@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Roles/New role </h4>
                            <form id="my-form" action="{{ route('admin.permissions.store') }}" method="POST"
                                style="margin-top:50px">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label for="name">Permission Name:</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                    <div style="margin-top: 50px;">
                                        <button type="submit" class="btn btn-primary"
                                            style="margin-bottom:50px">Create</button>

                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
