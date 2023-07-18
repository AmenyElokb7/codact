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
          
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        <div class="container my-5">
                            <nav>
                                 <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active"   data-bs-toggle="tab" data-bs-target="#nav-reportad" type="button" role="tab" aria-controls="nav-reportad" aria-selected="true">Report Ad</button>
                                     <button class="nav-link"  data-bs-toggle="tab" data-bs-target="#nav-reportbreakdown" type="button" role="tab" aria-controls="nav-reportbreakdown" aria-selected="false">Report for Ashtray's Breakdown</button>
                                 </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                
                                <div class="tab-pane fade show active p-3" id="nav-reportad" role="tabpanel" aria-labelledby="nav-reportad">
                                
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Report Advertisement</label>
                                    <form action="{{ route('CreateReport') }}" method="POST" class="d-inline">
                                        @csrf
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="3"></textarea>
                                    <div style="margin-top: 50px;">
                                        <button class="btn btn-primary" style="margin-bottom:50px" type="submit">Submit
                                            form</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                                <div class="tab-pane fade  p-3" id="nav-reportbreakdown" role="tabpanel" aria-labelledby="nav-reportbreakdown">
                                <div class="mb-3">
                                <div class="row g-2">
                                
                                 <script>
                                                $(document).ready(function() {
                                                    // Initialize Select2 on the select element
                                                    $('#Ashtaryslist').select2();
                                                });
                                            </script>
                                    <form action="{{ route('BreakdownAlert') }}" method="POST" class="d-inline">
                                        @csrf
                                    <label for="exampleFormControlTextarea1" class="form-label">Select Broken Ashtrays</label>

                                 <div class="col-md">
                                 <div class="form-floating">
                                 <select name="reference" id="Ashtaryslist" class="select2 form-select select2-multiple"
                                                multiple required >
                                                <option disabled>Select</option>
                                                @php
                                                $value = 1;
                                                @endphp
                                                @foreach ($ashtrays as $ashtray)
                                                    <option value="1">{{ $ashtray->reference }}</option>
                                                @endforeach
                                                    
                                </select>
                                
                                 </div>
                                 </div>
                                </div>
                                 
                                 
                                
                                    <label for="exampleFormControlTextarea1" class="form-label">Report for Ashtrays Breakdown</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                                    <div style="margin-top: 50px;">
                                        <button class="btn btn-primary" style="margin-bottom:50px" type="submit">Submit
                                            form</button>
                                    </div>
                                     </form>
                                </div>
                                
                                    <br><br>
                            <table id=>
                                <table id="datatable" class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 1; width: 100%;">
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
                            </div>
                            
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>

@endsection
