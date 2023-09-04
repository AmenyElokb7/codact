@extends('admin.dashboard')

<head>
    <!-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>
<style>
    .justify-elements {
        justify-content: end;
    }

    @media screen and (max-width: 700px) {
        .justify-elements {
            justify-content: start;
        }
    }
</style>
@section('admin')
    <div class="page-content">

        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">

                </div>
            </div>

            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger pt-4" role="alert" id='errorAlert'>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert" id="successAlert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <script>
                        // Hide error and success messages after 5 seconds
                        setTimeout(function() {
                            var errorAlert = document.getElementById('errorAlert');
                            var successAlert = document.getElementById('successAlert');
                            if (errorAlert) {
                                errorAlert.style.display = 'none';
                            }
                            if (successAlert) {
                                successAlert.style.display = 'none';
                            }
                        }, 3100);
                    </script>
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex justify-elements mb-3">
                                <!-- Checkboxes for each table header -->
                                <label class="checkbox-inline col-sm-1  col-3 text-nowrap">
                                    <input type="checkbox" class="column-filter" id='id' name="filter"
                                        value="Title" checked> Id
                                </label>
                                <label class="checkbox-inline col-sm-1 me-5 col-3 text-nowrap">
                                    <input type="checkbox" class="column-filter" id='name' name="filter"
                                        value="Description" checked> Name
                                </label>
                                <label class="checkbox-inline col-sm-1 me-3  col-3 text-nowrap">
                                    <input type="checkbox" class="column-filter" id='email' name="filter"
                                        value="User ID" checked> Email
                                </label>
                                <label class="checkbox-inline col-sm-1 me-4 col-3 text-nowrap">
                                    <input type="checkbox" class="column-filter" id='address' name="filter"
                                        value="User Name" checked> Address
                                </label>
                                <label class="checkbox-inline col-sm-1 me-5 col-3 text-nowrap">
                                    <input type="checkbox" class="column-filter" id='phone' name="filter"
                                        value="Amount (TND)" checked> Phone number
                                </label>
                                <label class="checkbox-inline col-sm-1 me-2  col-3 text-nowrap">
                                    <input type="checkbox" class="column-filter" id='action' name="filter"
                                        value="Date" checked> Action
                                </label>

                            </div>
                            <!-- ... -->

                            <table id="datatable" class="table table-striped table-bordered dt-responsive"
                                style="border-collapse: collapse; border-spacing: 1; width: 100%;">

                                <thead>
                                    <tr>
                                        <th class="tdid">Id</th>
                                        <th class="tdname">Name</th>
                                        <th class="tdemail">Email</th>
                                        <th class="tdaddress">Address</th>
                                        <th class="tdphone">Phone number</th>
                                        <th class="tdaction">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $value = 1;
                                    @endphp
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="tdid">{{ $user->id }} </td>
                                            <td class="tdname">{{ $user->name }}</td>
                                            <td class="tdemail">{{ $user->email }}</td>
                                            <td class="tdaddress">{{ $user->address }}</td>
                                            <td class="tdphone">{{ $user->phoneno }}</td>

                                            <td style="white-space:nowrap" class="tdaction">
                                                <a class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    onclick="updateModalContent('{{ $user->id }}', '{{ $user->name }}')"
                                                    href="send?send={{ $user->id }}" name="edit" value="edit"
                                                    class="settings" title="Settings" data-toggle="tooltip"><img
                                                        src="{{ asset('assets/images/send.png') }}" width="20"
                                                        height="20" alt=""> Send Money</a>


                                            </td>
                                        </tr>
                                    @endforeach

                                    <script>
                                        function updateModalContent(userId, userName) {
                                            // Set the User ID and Name fields with the selected user's details
                                            document.getElementsByName('id').forEach(function(el) {
                                                el.value = userId;
                                            });

                                            document.getElementsByName('name').forEach(function(el) {
                                                el.value = userName;
                                            });
                                        }
                                    </script>
                                    <script>
                                        function updateNameAndId(input, fieldName) {
                                            var nameInput = document.getElementById('nameInput');
                                            var nameValue = nameInput.value;

                                            if (fieldName === 'id') {
                                                // Find the publisher by ID in the $publishers array
                                                var publisher = @json($users->keyBy('id'));
                                                var idValue = input.value;

                                                // Update the ID input field with the entered ID
                                                document.getElementsByName('id').forEach(function(el) {
                                                    el.value = idValue;
                                                });

                                                // Update the Name input field with the found Name
                                                nameInput.value = publisher[idValue] ? publisher[idValue].name : nameValue;
                                            } else if (fieldName === 'name') {
                                                // Find the publisher by Name in the $publishers array
                                                var publisher = @json($users->keyBy('name'));
                                                var nameValue = input.value;

                                                // Update the Name input field with the entered Name
                                                document.getElementsByName('name').forEach(function(el) {
                                                    el.value = nameValue;
                                                });

                                                // Update the ID input field with the found ID
                                                document.getElementsByName('id').forEach(function(el) {
                                                    el.value = publisher[nameValue] ? publisher[nameValue].id : '';
                                                });
                                            }
                                        }
                                    </script>
                                </tbody>
                            </table>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Send Money</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body ms-2">
                                            <form action="{{ route('sendtouser') }}" method="POST">
                                                @csrf


                                                <div class="d-flex">
                                                    <label for="" class="form-label mt-2 me-2">User ID</label>
                                                    <input type="text" class="form-control w-50 ms-3" name="id"
                                                        value="{{ $user->id }}"
                                                        oninput="updateNameAndId(this, 'id')">
                                                </div>

                                                <div class="d-flex mt-2">
                                                    <label for="" class="form-label mt-2 me-2 ms-1">Name</label>
                                                    <input type="text" class="form-control w-50 ms-4" name="name"
                                                        value="{{ $user->name }}" id="nameInput"
                                                        oninput="updateNameAndId(this, 'name')">
                                                </div>

                                                <div class="d-flex mt-2"> <label for=""
                                                        class="form-label mt-2 me-2 ">Montant </label>

                                                    <div class="input-group  w-50 ms-2"
                                                        style="    position: relative;left: 5px;">
                                                        <input type="text" class="form-control " name="montant"
                                                            aria-describedby="basic-addon2">
                                                        <span class="input-group-text" id="basic-addon2">DNT</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex mt-2"> <label for=""
                                                        class="form-label mt-2 me-2 ">Password </label>
                                                    <input type="password" class="form-control w-50 ms-1" name="password"
                                                        id="password">
                                                </div>



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const checkboxFilters = ['id', 'name', 'email', 'address', 'phone', 'action'];

        checkboxFilters.forEach(filter => {
            const checkbox = document.getElementById(filter);

            checkbox.addEventListener('change', function() {
                const tdElements = document.querySelectorAll(.td$ {
                    filter
                });

                tdElements.forEach(td => {
                    td.style.display = this.checked ? 'table-cell' : 'none';
                });
            });
        });
    </script>
@endsection
