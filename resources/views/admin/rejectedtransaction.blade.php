@extends('admin.dashboard')
<head>
    <!-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>
<style>
 .justify-elements{
justify-content:end;
    }
@media screen and (max-width: 700px) {
    .justify-elements{
justify-content:start;
    }
    }
</style>
@section('admin')
    <div class="page-content">
      <div class=" d-flex justify-content-center ">


      <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Rejected offline Transactions  </h4>
                        
                    </div>
                </div>
            </div>
           
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        <div class="   row d-flex justify-elements mb-3">
                                    <!-- Checkboxes for each table header -->
                                    <label class="checkbox-inline col-sm-1  col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='id' name="filter" value="Bank" checked> Id
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-4 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='senderid' name="filter" value="Amount" checked> Sender ID
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-5 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='sendername' name="filter" value="Reference" checked> Sender Name
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-5 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='amount' name="filter" value="Date" checked> Amount (TND)
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-3 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='compte' name="filter" value="Attachment" checked> Compte
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-3 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='reference' name="filter" value="Status" checked> Reference
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-3 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='date' name="filter" value="Actions" checked> Date
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-3 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='time' name="filter" value="Actions" checked> Time
                                    </label>
                                    <label class="checkbox-inline col-sm-1 me-3 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='photo' name="filter" value="Actions" checked> Photo
                                    </label>
                                  
                                    <label class="checkbox-inline col-sm-1 me-3 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='stat' name="filter" value="Actions" checked> Status
                                    </label>
                                </div>
                        
                            <table id=>
                                <table id="datatable" class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 1; width: 100%;">
                                    <thead>
                                    <tr>
                                            <th class="tdid">Id</th>
                                            <th class="tdsenderid">Sender ID</th>
                                            <th class="tdsendername">Sender Name</th>
                                            <th class="tdamount">Amount</th>
                                            <th class="tdcompte">Compte</th>
                                            <th class="tdreference">Reference</th>
                                            <th class="tddate">Date</th>
                                            <th class="tdtime">Time</th>
                                            <th class="tdphoto">Photo</th>
                                            <th class="tdstat">Status</th>

                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $value = 1;
                                        @endphp


              
                                        @foreach($offlineTransactions as $transaction)
                                            <tr>
                                            <td class="tdid">{{ $transaction->id }}</td>
                                               <td class="tdsenderid">{{ $transaction->user_id }}</td> 
                                               <td class="tdsendername"> @php
        $user = \App\Models\User::find($transaction->user_id);
    @endphp
    {{ $user ? $user->name : 'N/A' }}</td> 

                                             
                                                <td class="tdamount">{{ $transaction->montant  }} DNT</td>
                                                <td class="tdcompte">{{ $transaction->compte  }} </td>
                                                <td class="tdreference">{{ $transaction->reference  }} </td>

                                                <td class="tddate">
            @php
                $dateTime = new DateTime($transaction->created_at);
                $date = $dateTime->format('Y-m-d');
                echo $date;
            @endphp
        </td>
        <td class="tdtime">
            @php
                $dateTime = new DateTime($transaction->created_at);
                $hour = $dateTime->format('H:i:s');
                echo $hour;
            @endphp
        </td>
        
        <td class="tdphoto">
    <a href="{{ asset($transaction->photo_paiement) }}"  download>
        <img src="{{ asset('assets/images/picture.png') }}"  width="27" height="27" alt="Download PDF">
    </a>
</td>


                                                    <td class="tdstat">{{ $transaction->status  }} </td>


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
    </div>
    <script>
        const checkboxFilters = ['id', 'senderid', 'sendername', 'amount', 'compte', 'reference', 'date','time','photo','stat'];

        checkboxFilters.forEach(filter => {
            const checkbox = document.getElementById(filter);

            checkbox.addEventListener('change', function() {
                const tdElements = document.querySelectorAll(.td${filter});

                tdElements.forEach(td => {
                    td.style.display = this.checked ? 'table-cell' : 'none';
                });
            });
        });
    </script>
@endsection