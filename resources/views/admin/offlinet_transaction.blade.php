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
                        <h4 class="mb-sm-0"> offline Transactions Managment </h4>
                        
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
                                    <label class="checkbox-inline col-sm-1 me-1 col-3 text-nowrap">
                                        <input type="checkbox" class="column-filter" id='actions' name="filter" value="Actions" checked> Actions
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
                                            <th class="tdactions">Actions</th>
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

@if ($transaction->status == 'Waiting')
            <td class="tdactions">
                <div class="d-flex justify-content-center gap-2">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $transaction->id }}"
    data-transaction-id="{{ $transaction->id }}" class="btn btn-success btn-sm"><i class="fas fa-check mx-1"></i></button>
<button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2{{ $transaction->id }}"
    data-transaction-id="{{ $transaction->id }}" class="btn btn-danger btn-sm"><i class="fas fa-times mx-1"></i></button>

                </div>
            </td >
        @else
            <td class="tdactions">
                <!-- Render an alternative message or leave the cell empty -->
            </td>
        @endif

                                                    <td class="tdstat">{{ $transaction->status  }} </td>


                                            </tr>
                                      
<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="h5 pt-2">
        Are you sure to accept this transaction ?
      </div>       
      
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

    </div>
     
      <div class="modal-footer">
        <form action="{{ route('sendtouserfromoffline') }}" method="POST">
                       @csrf
                       <input type="hidden" name="user_id" value="{{ $transaction->user_id }}">
                       <input type="hidden" name="montant" value="{{ $transaction->montant }}">
                       <input type="hidden" name="id" value="{{ $transaction->id }}">

        <button type="submit" class="btn btn-primary">Accept</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>


      </div>
    </div>
  </div>
</div>
<!-- Modal2 -->
<div class="modal fade" id="exampleModal2{{ $transaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="h5 pt-2">
        Are you sure to reject this transaction ?
      </div>         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

    </div>
     
      <div class="modal-footer">  
      <form action="{{ route('rejectofflinetransaction') }}" method="POST">
                       @csrf  
                       <input type="hidden" name="id" value="{{ $transaction->id }}">

      <button type="submit" class="btn btn-primary">Accept</button>
      </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Your custom JavaScript code using jQuery here
    $(document).ready(function () {
        // JavaScript code to retrieve transaction ID and populate the form on modal show
        $('#exampleModal{{ $transaction->id }}').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var transactionId = button.data('transaction-id');
            // Use the transactionId to populate the form or perform other actions
            console.log('Transaction ID:', transactionId);
            // You can now use the transactionId to perform actions related to this specific modal.
        });

        $('#exampleModal2{{ $transaction->id }}').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var transactionId = button.data('transaction-id');
            // Use the transactionId to populate the form or perform other actions
            console.log('Transaction ID:', transactionId);
            // You can now use the transactionId to perform actions related to this specific modal.
        });
    });
</script>
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
        const checkboxFilters = ['id', 'senderid', 'sendername', 'amount', 'compte', 'reference', 'date','time','photo','actions','stat'];

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