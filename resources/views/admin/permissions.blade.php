@extends('admin.dashboard')


@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Permissions Managment </h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Permissions</a></li>
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
                            <a href="{{ route('admin.permissions.create') }}" style="float:right"
                                class="btn btn-dark btn-rounded waves-effect waves-light"><i class="mdi mdi-plus"></i>
                                Create Permission</a>
                            <br><br>
                            @if ($permissions->isEmpty())
                                <p>No permissions found.</p>
                            @else
                                <table id=>
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive"
                                        style="border-collapse: collapse; border-spacing: 1; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <style>
                                            .rounded {
                                                border-radius: 30px;
                                            }
                                        </style>
                                        <tbody>
                                            @foreach ($permissions as $permission)
                                                <tr>
                                                    <td>{{ $permission->id }}</td>

                                                    <td>{{ $permission->name }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.permissions.edit', $permission) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                        <form action="{{ route('admin.permissions.destroy', $permission) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this permission?')">Delete</button>
                                                        </form>
                                                    </td>
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
