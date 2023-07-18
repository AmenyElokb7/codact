@extends('admin.dashboard')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Categories Managment </h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Categories</li>
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
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float:right"
                                class="btn btn-dark btn-rounded waves-effect waves-light"><i class="mdi mdi-plus"></i>
                                Create Category</button>
                            <br><br>
                            <table id=>
                                <table id="datatable" class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 1; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Action</th>
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
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>#{{ $value++ }} </td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" id="delete" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
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
    </div>
    <!-- Button trigger modal -->
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var modal = $(this)
        })
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="createUserForm" action="{{ route('admin.category.create') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" name="name" type="text" class="form-control" required>
                            </div>
                        </div>
                     

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
