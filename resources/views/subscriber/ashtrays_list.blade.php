@extends('admin.dashboard')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Ashtrays for {{ $user->cafeName }} </h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Support</a></li>
                                <li class="breadcrumb-item active">Ashtrays List</li>
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
             <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Ashtray's breakdown</span> 
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Claim</span> 
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="home-1" role="tabpanel">
                                    <p class="mb-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <br><br>
                                                        <form action="{{ route('sendAshtrayBreakdownNotification') }}" method="post">
                                                            @csrf
                                                            <script>
                                                                $(document).ready(function() {
                                                                    // Initialize Select2 on the select element
                                                                    $('#AshtraySelect').select2();
                                                                });
                                                            </script>
                                                            <label for="">Ashtrays</label>
                                                            <select name="ashtray[]" id="AshtraySelect" class="select2 form-select select2-multiple" multiple>
                                                                @foreach ($ashtrays as $ashtray)
                                                                    <option>{{ $ashtray->reference }}</option>
                                                                </tr>
                                                            @endforeach
                                                            </select>
                                                            <label for="">Message(Optional)</label>
                                                            <textarea type="text" name="msg" id="" class="form-control"></textarea>
                                                            <br>
                                                            <button type="submit" class="btn btn-primary">Send</button>
                                                        </form>
                                                        <br><br>
                                                        <table>
                                                            <table id="datatable" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 1; width: 100%;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Id</th>
                                                                        <th>Reference</th>
                                                                        <th>Cafe Name</th> 
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $value = 1;
                                                                    @endphp
                                                                    @foreach ($ashtrays as $ashtray)
                                                                        <tr>
                                                                            <td># {{ $value++ }} </td>
                                                                            <td>{{ $ashtray->reference }}</td>
                                                                            <td><div class="badge bg-secondary">{{ $user->cafeName }}</div></td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </p>
                                </div>
                                <div class="tab-pane" id="profile-1" role="tabpanel">
                                    <div>
                                        <form action="{{ route('sendNewClaimNotification') }}" method="post">
                                            @csrf
                                            <label for="message">Message</label>
                                            <textarea type="text" name="message" id="message" class="form-control"></textarea>
                                            <br>
                                            <button class="btn btn-primary" type="submit">Send message</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
@endsection
