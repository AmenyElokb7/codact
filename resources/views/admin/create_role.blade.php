@extends('admin.dashboard')

@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Roles/New role </h4>
                            <form id="my-form" action="{{ route('admin.roles.store') }}" method="POST"
                                style="margin-top:50px">
                                @csrf
                                <div class="row">
                                    <script>
                                        $(document).ready(function() {
                                            // Initialize Select2 on the select element
                                            $('#permissions').select2();
                                        });
                                    </script>
                                    <div class="form-group w-50">
                                        <label for="name">Role Name:</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                    
                                    <div class="form-group w-50">
                                        <label for="permissions">Permissions:</label>
                                        <select name="permissions[]" id="permissions" class="select2 form-select select2-multiple" multiple
                                            required>
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
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
