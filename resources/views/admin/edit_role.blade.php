@extends('admin.dashboard')

@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Role</h4>
                            <form id="my-form" action="{{ route('admin.roles.update', $role->id) }}" method="POST"
                                style="margin-top:50px">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group w-50">
                                        <label for="name">Role Name:</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ $role->name }}" required>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            $('#permissions').select2();
                                        });
                                    </script>
                                    <div class="form-group w-50">
                                        <label for="permissions">Permissions:</label>
                                        <select name="permissions[]" id="permissions" class="select2 form-select select2-multiple" multiple required>
                                            <option value="all">Select All</option>
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                        
                                        <script>
                                            // Get the select element
                                            var selectAll = document.getElementById('permissions');
                                            selectAll.addEventListener('change', function(event) {
                                                var options = this.options;
                                                var selectAllOption = options[0];
                                        
                                                // If "Select All" is selected, select all other options
                                                if (selectAllOption.selected) {
                                                    for (var i = 1; i < options.length; i++) {
                                                        options[i].selected = true;
                                                    }
                                                } else {
                                                    // If "Select All" is not selected, deselect all options
                                                    for (var i = 1; i < options.length; i++) {
                                                        options[i].selected = false;
                                                    }
                                                }
                                            });
                                        </script>
                                    </div>
                                    <div style="margin-top: 50px;">
                                        <button type="submit" class="btn btn-primary"
                                            style="margin-bottom:50px">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
