@extends('admin.dashboard')

<head>
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/payment2.css') }}">
</head>
@section('admin')
<div>
<div class="page-content">
        <div class="container-fluid mt-3">
<div class="mt-2 mb-3">Financial documents</div>

<div class="d-flex justify-content-center">
<div class="card  rounded-5 ms-3" style="cursor:pointer;width:55%" >
        <div class=" d-flex justify-content-center  ">
    <img src="{{ asset('assets/images/—Pngtree—cute cartoon wallet icon_4421120.png') }}" width="190" height="150" alt="" >
</div>    
<div class=" d-flex justify-content-center h5">{{ Auth::user()->balance }}<span class='ms-1'>DNT</span></div>

        <div class=" d-flex justify-content-center  mb-2 mt-1 ">
        Account charge</div>    
     </div>

</div>
<div class="d-flex justify-content-center  ">
   
    <div class="card   carding" style="cursor:pointer" id='bank' onclick="showPaymentForm('bank')">
        <div class=" d-flex justify-content-center  mt-2 mb-2">
    <img src="{{ asset('assets/images/bank.png') }}" width="90" height="90" alt="" >
</div>    
        <div class=" d-flex justify-content-center h5 mb-2 mt-1">
        Bank</div>    
     </div>
    <div class="card  carding" style="cursor:pointer" id='rib' onclick="showPaymentForm('rib')">
        <div class=" d-flex justify-content-center  mt-2 mb-2">
    <img src="{{ asset('assets/images/cheque-bancaire.png') }}" width="90" height="90" alt="" >
</div>    
        <div class=" d-flex justify-content-center h5 mb-2 mt-1 ">
        Transaction</div>    
     </div>
  
</div>

<!--transaction -->

<div class="wrapper mt-3" id="ribshow" style="display: none;">
@if(session('error'))
        <div id="error-message0"  class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
 
    @if(session('successMessage'))
    <div id="successalert" class="alert alert-success">
        {{ session('successMessage') }}
    </div>
@endif
    @if(session('successMessageupdate'))
    <div id="successMessageupdate" class="alert alert-success">
        {{ session('successMessageupdate') }}
    </div>
@endif
    @if(session('successdelete'))
    <div id="successdelete" class="alert alert-success">
        {{ session('successdelete') }}
    </div>
@endif


    <div class="card p-5">
        <div class="d-flex justify-content-center">
            <!-- Transaction content -->
            <h5>Finaliser le paiement</h5>
        </div>
        <form action="{{ route('transaction_offline') }}" method="POST" enctype="multipart/form-data">
                      @csrf

            <div class=" mt-3">
                <div class="d-flex justify-content-center row">
                    <div class="col-12 col-sm-3 mb-3">
                        <div for="">Montant</div>
                        <div class="input-group  width_input">
                            <input type="text" name="Montant" class="form-control" aria-describedby="basic-addon2"  value="{{ old('Montant') ?: '' }}">
                            <span class="input-group-text" id="basic-addon2">TND</span>
                        </div>
                        @error('Montant')
        <div class="text-danger mt-3">{{ $message }}</div>
        @enderror
                    </div>
                 
                    <div class="col-12 col-sm-3 mb-3">
                        <div for="">Compte</div>
                        <select name="compte" class="form-select width_input" aria-label="Default select example">
    <option value="" disabled @if(old('compte') == '') selected @endif>Open this select menu</option>
    <option value="Attijari Bank" @if(old('compte') == 'Attijari Bank') selected @endif>Attijari Bank</option>
    <option value="Qatar National Bank" @if(old('compte') == 'Qatar National Bank') selected @endif>Qatar National Bank</option>
    <option value="Biat Bank" @if(old('compte') == 'Biat Bank') selected @endif>Biat Bank</option>
    <option value="Amen Bank" @if(old('compte') == 'Amen Bank') selected @endif>Amen Bank</option>
</select>

                        @error('compte')
        <div class="text-danger mt-3">{{ $message }}</div>
        @enderror
                    </div>
                    <div class="col-12 col-sm-3 mb-3">
                        <div for="">Reference</div>
                        <input type="text" name="reference" value="{{ old('reference') ?: '' }}" class="form-control width_input" id="">
                        @error('reference')
        <div class="text-danger mt-3">{{ $message }}</div>
        @enderror
                    </div>
                </div>
            </div>
            <div class=" ">
                <div class="d-flex justify-content-center row">
                    <div class="col-12 col-sm-3 mb-3">
                    <div class="form-group">
    <div for="date_heure">Date and Time:</div>
    <div class="input-group width_input">
            <span class="input-group-text">
                <i class="fas fa-calendar"></i> <!-- Assuming you're using Font Awesome for icons -->
            </span>
        <input type="datetime-local" id="date_heure" name="date_heure" class="form-control" 
        value="{{ old('date_heure', date('Y-m-d\TH:i')) }}" onclick="showPicker()" >
    </div>
</div>
<script>
function showPicker() {
    var input = document.getElementById('date_heure');
    input.type = 'text';
    input.focus();
    input.type = 'datetime-local';
}
</script>



@error('date_heure')
        <div id="error-message2" class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror

                    </div>
                    <div class="col-12 col-sm-3 mb-3">
                        <div for="">Joindre la photo de paiement</div>
                        <input type="file" name="photo_paiement" class="form-control width_input" id="file" accept=".jpeg, .jpg, .png, .gif">
                        @error('photo_paiement')
        <div i class="text-danger mt-3">{{ $message }}</div>
        @enderror
                    </div>
                    <div class="col-12 col-sm-3 mt-3 ps-5 pt-1 flexing">
                        <button class="btn btn-primary width_btn" type="submit">Payer</button>
                    </div>
                </div>
            </div>
        </form>



    </div>
    

<section class="mt-5">

<div class="row ">

<div class="col-12 col-lg-3 mb-30 mb-lg-0">
  <div class="py-25 px-20 rounded-sm panel-shadow mb-3  bg-white p-4 " style="    box-shadow: 0 12px 23px 0 rgba(62, 73, 84, 0.04);">
 <div class="d-flex flex-column align-items-center justify-content-center">
  <img src="{{ asset('assets/images/Attijarilogo.png') }}" width="140" height="70" alt="" ></div>
  <div class="mt-4 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">Name:</span>
  <span class="font-14 font-weight-500 text-dark">Attijari Bank</span>
  </div>
  <div class="mt-3 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">Card ID:</span>
  <span class="font-14 font-weight-500 text-dark">1543-2374-32</span>
  </div>
  <div class="mt-3 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">Account ID:</span>
  <span class="font-14 font-weight-500 text-dark">241-35213325</span>
  </div>
  <div class="mt-3 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">IBAN:</span>
  <span class="font-14 font-weight-500 text-dark">RBD3NBD6VRS3</span>
  </div>
  </div>
</div>
<div class="col-12 col-lg-3 mb-30 mb-lg-0">
  <div class="py-25 px-20 rounded-sm panel-shadow mb-3  bg-white p-4 " style="    box-shadow: 0 12px 23px 0 rgba(62, 73, 84, 0.04);">
 <div class="d-flex flex-column align-items-center justify-content-center">
  <img src="{{ asset('assets/images/Qatar National Bank.png') }}" width="140" height="70" alt="" ></div>
  <div class="mt-4 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">Name:</span>
  <span class="font-14 font-weight-500 text-dark">Qatar National Bank</span>
  </div>
  <div class="mt-3 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">Card ID:</span>
  <span class="font-14 font-weight-500 text-dark">2578-4910-3682-6288
</span>
  </div>
  <div class="mt-3 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">Account ID:</span>
  <span class="font-14 font-weight-500 text-dark">38152294372</span>
  </div>
  <div class="mt-3 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">IBAN:</span>
  <span class="font-14 font-weight-500 text-dark">RBD3NBD6VRS3</span>
  </div>
  </div>
</div>
<div class="col-12 col-lg-3 mb-30 mb-lg-0">
  <div class="py-25 px-20 rounded-sm panel-shadow mb-3  bg-white p-4 " style="    box-shadow: 0 12px 23px 0 rgba(62, 73, 84, 0.04);">
 <div class="d-flex flex-column align-items-center justify-content-center">
  <img src="{{ asset('assets/images/BIATlogo.png') }}" width="140" height="70" alt="" ></div>
  <div class="mt-4 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">Name:</span>
  <span class="font-14 font-weight-500 text-dark">Attijari Bank</span>
  </div>
  <div class="mt-3 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">Card ID:</span>
  <span class="font-14 font-weight-500 text-dark">1543-2374-32</span>
  </div>
  <div class="mt-3 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">Account ID:</span>
  <span class="font-14 font-weight-500 text-dark">241-35213325</span>
  </div>
  <div class="mt-3 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">IBAN:</span>
  <span class="font-14 font-weight-500 text-dark">RBD3NBD6VRS3</span>
  </div>
  </div>
</div>
<div class="col-12 col-lg-3 mb-30 mb-lg-0">
  <div class="py-25 px-20 rounded-sm panel-shadow mb-3  bg-white p-4 " style="    box-shadow: 0 12px 23px 0 rgba(62, 73, 84, 0.04);">
 <div class="d-flex flex-column align-items-center justify-content-center">
  <img src="{{ asset('assets/images/AMANlogo.png') }}" width="140" height="70" alt="" ></div>
  <div class="mt-4 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">Name:</span>
  <span class="font-14 font-weight-500 text-dark">Attijari Bank</span>
  </div>
  <div class="mt-3 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">Card ID:</span>
  <span class="font-14 font-weight-500 text-dark">1543-2374-32</span>
  </div>
  <div class="mt-3 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">Account ID:</span>
  <span class="font-14 font-weight-500 text-dark">241-35213325</span>
  </div>
  <div class="mt-3 d-flex align-items-center justify-content-evenly">
  <span class="font-14 font-weight-500 text-secondary">IBAN:</span>
  <span class="font-14 font-weight-500 text-dark">RBD3NBD6VRS3</span>
  </div>
  </div>
</div>


</div>
</section>



<div class="card">
                        <div class="card-body">
                        <div class="    mb-3 dontshow justify-content-end">
                                    <!-- Checkboxes for each table header -->
                                    <label class="checkbox-inline me-3">
                                        <input type="checkbox" class="column-filter" id='bankk' name="filter" value="Bank" checked> Bank
                                    </label>
                                    <label class="checkbox-inline me-3">
                                        <input type="checkbox" class="column-filter" id='amount' name="filter" value="Amount" checked> Amount (TND)
                                    </label>
                                    <label class="checkbox-inline me-3">
                                        <input type="checkbox" class="column-filter" id='reference' name="filter" value="Reference" checked> Reference
                                    </label>
                                    <label class="checkbox-inline me-3">
                                        <input type="checkbox" class="column-filter" id='date' name="filter" value="Date" checked> Date
                                    </label>
                                    <label class="checkbox-inline me-3">
                                        <input type="checkbox" class="column-filter" id='attachment' name="filter" value="Attachment" checked> Attachment
                                    </label>
                                    <label class="checkbox-inline me-3">
                                        <input type="checkbox" class="column-filter" id='stat' name="filter" value="Status" checked> Status
                                    </label>
                                    <label class="checkbox-inline me-3">
                                        <input type="checkbox" class="column-filter" id='actions' name="filter" value="Actions" checked> Actions
                                    </label>
                                </div>
                        
                            <table id=>
                                <table id="datatable" class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 1; width: 100%;">
                                   
                                    <thead>
                                        <tr>
                                            <th class="tdbankk">Bank</th>
                                            <th class="tdamount">Amount (TND)</th>
                                            <th class="tdreference">Reference</th>
                                            <th class="tddate">Date</th>
                                            <th class="tdattachment">Attachment</th>
                                            <th class="tdstat">Status</th>
                                            <th class="tdactions">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($offlineTransactions as $transaction)
                                            <tr>
                                                <td class="tdbankk">{{ $transaction->compte }}</td>
                                                <td class="text-success  tdamount">{{ $transaction->montant }}</td>
                                                <td class="tdreference">{{ $transaction->reference }}</td>
                                                <td class="tddate">
                                                    @php
                                                        $dateTime = new DateTime($transaction->created_at);
                                                        $date = $dateTime->format('Y-m-d');
                                                        echo $date;
                                                    @endphp
                                                </td>
                                                <td class="tdattachment">
                                                    <a href="{{ asset($transaction->photo_paiement) }}" style="text-decoration:none" download>
                                                        View
                                                    </a>
                                                </td>
                                                <td class="tdstat">
                                                    @if ($transaction->status == 'Waiting')
                                                        <span class="text-warning">{{ $transaction->status }}</span>
                                                    @elseif ($transaction->status == 'Accepted')
                                                        <span class="text-success">{{ $transaction->status }}</span>
                                                    @elseif ($transaction->status == 'Rejected')
                                                        <span class="text-danger">{{ $transaction->status }}</span>
                                                    @endif
                                                </td>
                                                    @if ($transaction->status == 'Waiting')
                                                    <td class="tdactions">

                                                        <div class="d-flex justify-content-center gap-2">
                                                            <form action="{{ route('editofflinetransaction', ['id' => $transaction->id]) }}" >
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm" style="width: 40px;height:40px">
                                                                    <img src="{{ asset('assets/images/icons8-edit-50.png') }}" width="18" height="18" alt="">
                                                                </button>
                                                            </form>
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2{{ $transaction->id }}"
                                                                    data-transaction-id="{{ $transaction->id }}" class="btn btn-danger btn-sm" style="width: 40px;height:40px">
                                                                <i class="fas fa-times mx-1"></i>
                                                            </button>
                                                        </div>
                                                        </td>
                                                    @else
                                                        <!-- Render an alternative message or leave the cell empty -->
                                                        <td class="tdactions">
                <!-- Render an alternative message or leave the cell empty -->
            </td>
                                                    @endif
                                              
                                            </tr>
<!-- Modal2 -->
<div class="modal fade" id="exampleModal2{{ $transaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="">
        <div class="d-flex justify-content-end me-3 mt-2">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
          <div class="h5 pt-2 d-flex justify-content-center">
          Are you sure?</div> 
          <div class="d-flex justify-content-center">This action cannot be undone!</div>
  
      </div>
       
        <div class="modal-footer">  
        <form action="{{ route('deleteofflinetransaction') }}" method="POST">
                         @csrf  
                         <input type="hidden" name="id" value="{{ $transaction->id }}">
  
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  
  @endforeach
  
                                      </tbody>
                                  </table>
                              </table>
  
                          </div>
                      </div>
  </div>
  
  <!--bank -->
  
  
  <div class="wrapper " id="bankshow" style="display: none;">
  
  
  
  <div class="">
       @if(session('error'))
          <div id="error-message"  class="alert alert-danger mt-3">
              {{ session('error') }}
          </div>
      @endif
  
      @error('montant')
          <div id="error-message2" class="alert alert-danger mt-3">{{ $message }}</div>
          @enderror
      @error('cardNumber')
          <div id="error-message3" class="alert alert-danger mt-3">{{ $message }}</div>
          @enderror
      @error('cardCvv')
          <div id="error-message4" class="alert alert-danger mt-3">{{ $message }}</div>
          @enderror
      
    <div class="card-form">
      <div class="card-list">
        <div class="card-item" >
          <div class="">
            <div class=""><img src="https://pngimg.com/uploads/credit_card/credit_card_PNG99.png"  class="card-item__bg"></div>
          </div>
          
        </div>
      </div>
     
      <form action="{{ route('sendpayment') }}" method="POST">
                         @csrf
      <div class="card-form__inner">
        <div class="card-input">
          <label for="cardNumber" class="card-input__label">Montant</label>
          <input type="text" name='montant' value="{{ old('montant') ?: '' }}" id="montant" class="card-input__input" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardNumber" v-model="montant" autocomplete="off" >
        </div>
        <div class="card-input">
          <label for="cardNumber" class="card-input__label">Card Number</label>
          <input type="text"  name='cardNumber' value="{{ old('cardNumber') ?: '' }}" id="cardNumber" class="card-input__input" v-mask="generateCardNumberMask" v-model="cardNumber" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardNumber" autocomplete="off">
        </div>
        <div class="card-input">
          <label for="cardName" class="card-input__label">Cardholder Name</label>
          <input type="text"  name='cardName' value="{{ old('cardName') ?: '' }}" id="cardName" class="card-input__input" v-model="cardName" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardName" autocomplete="off">
        </div>
        <div class="card-form__row">
          <div class="card-form__col">
          <div class="card-form__group">
      <label for="cardMonth" class="card-input__label">Expiration Date</label>
      <select  name='cardMonth' class="card-input__input -select scrollable-select" id="cardMonth" v-model="cardMonth" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
          <option value="" disabled selected>Month</option>
          <option style="cursor: pointer;" value="January">January</option>
                    <option style="cursor: pointer;" value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
      </select>
      
      <select  name='cardYear' class="card-input__input -select scrollable-select" id="cardYear" v-model="cardYear" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
          <option value="" disabled selected>Year</option>
          @foreach(range(0, 15) as $year)
              <option :value="$currentYear + $year" :key="$year">
                  {{ $currentYear + $year }}
              </option>
          @endforeach
      </select>
  </div>
  
          </div>
          <div class="card-form__col -cvv">
            <div class="card-input">
              <label for="cardCvv" class="card-input__label">CVV</label>
              <input  name='cardCvv' value="{{ old('cardCvv') ?: '' }}" type="text" class="card-input__input" id="cardCvv" v-mask="'####'" maxlength="4" v-model="cardCvv" v-on:focus="flipCard(true)" v-on:blur="flipCard(false)" autocomplete="off">
            </div>
          </div>
        </div>
  
        <button class="card-form__button" type="submit">
      Pay <span id="montantDisplay"></span>
      <span v-if="montant"> TND</span>
  </button>
  
   
      </div>
    </div>
  </form>
  </div>
  </div>
  <script>
      // Get the input element and the display div
      const montantInput = document.getElementById('montant');
      const montantDisplay = document.getElementById('montantDisplay');
      const tndSpan = document.querySelector('span[v-if="montant"]');
  
      // Function to update the display value
      function updateDisplay() {
          // Get the input value and trim any whitespace
          const inputValue = montantInput.value.trim();
  
          // Update the content of the div with the input's current value or show 'N/A' if empty or null
          montantDisplay.innerText = inputValue !== '' ? inputValue : '';
  
          // Show/hide the "TND" span based on the input value
          if (inputValue !== '') {
              tndSpan.style.display = 'inline'; // Show "TND"
          } else {
              tndSpan.style.display = 'none'; // Hide "TND"
          }
      }
  
      // Add an event listener to the input field for keypress and initial update
      montantInput.addEventListener('input', updateDisplay);
  
      // Initial update
      updateDisplay();
  </script>
  
  
  
  <script>
      // Hide the error message after 3 seconds
      setTimeout(function () {
          var errorMessage = document.getElementById('error-message0');
          if (errorMessage) {
              errorMessage.style.display = 'none';
          }
      }, 3000); // 3 seconds delay (3000 milliseconds)
      // Hide the error message after 3 seconds
      setTimeout(function () {
          var errorMessage = document.getElementById('error-message');
          if (errorMessage) {
              errorMessage.style.display = 'none';
          }
      }, 3000); // 3 seconds delay (3000 milliseconds)
      setTimeout(function () {
          var errorMessage = document.getElementById('error-message2');
          if (errorMessage) {
              errorMessage.style.display = 'none';
          }
      }, 3200); // 3 seconds delay (3000 milliseconds)
      setTimeout(function () {
          var errorMessage = document.getElementById('error-message3');
          if (errorMessage) {
              errorMessage.style.display = 'none';
          }
      }, 3400); // 3 seconds delay (3000 milliseconds)
      setTimeout(function () {
          var errorMessage = document.getElementById('error-message4');
          if (errorMessage) {
              errorMessage.style.display = 'none';
          }
      }, 3000); // 3 seconds delay (3000 milliseconds)
      setTimeout(function () {
          var errorMessage = document.getElementById('successalert');
          if (errorMessage) {
              errorMessage.style.display = 'none';
          }
      }, 3000); // 3 seconds delay (3000 milliseconds)
      setTimeout(function () {
          var errorMessage = document.getElementById('successMessageupdate');
          if (errorMessage) {
              errorMessage.style.display = 'none';
          }
      }, 3000); // 3 seconds delay (3000 milliseconds)
      setTimeout(function () {
          var errorMessage = document.getElementById('successdelete');
          if (errorMessage) {
              errorMessage.style.display = 'none';
          }
      }, 3000); // 3 seconds delay (3000 milliseconds)
  </script>
   
  </div>
  </div>
  </div>
  
  <!-- ... Your previous HTML code ... -->
  
  <style>
      .selected-card {
          background-color: #a6dbff; /* Change this to the background color you desire for the selected card */
          box-shadow: 8px -1px 17px rgba(0, 0 ,0 ,0.6);/* Shadow effect */
          transform: scale(1.08); /* Scaling effect */
          transition: box-shadow 0.3s, transform 0.3s; 
      }
      input[type="datetime-local"]::-webkit-calendar-picker-indicator {
      display: none;
  }
  </style>
  
  <script>
  
  
      function showPaymentForm(formId, errorMessage = '') {
          // Get the bankshow div element
          var bankshowDiv = document.getElementById('bankshow');
          // Get the ribshow div element
          var ribshowDiv = document.getElementById('ribshow');
  
          // Hide all sections
          bankshowDiv.style.display = 'none';
          ribshowDiv.style.display = 'none';
  
          // Remove the selected-card class from all cards
          var cards = document.querySelectorAll('.card');
          cards.forEach(card => {
              card.classList.remove('selected-card');
          });
  
          // Show the selected section based on formId
          if (formId === 'bank') {
              bankshowDiv.style.display = 'block';
              document.getElementById('bank').classList.add('selected-card');
          } else if (formId === 'rib') {
              ribshowDiv.style.display = 'block';
              document.getElementById('rib').classList.add('selected-card');
          }
  
          // Show the error message if it exists for the bank form
          if (formId === 'bank' && errorMessage !== '') {
              var errorMessageDiv = document.getElementById('error-message-bank');
              errorMessageDiv.innerText = errorMessage;
              errorMessageDiv.style.display = 'block';
  
              // Hide the error message after 3 seconds
              setTimeout(function () {
                  errorMessageDiv.style.display = 'none';
              }, 3000); // 3 seconds delay (3000 milliseconds)
          }
      }
  </script>
  <script>
      // Show the bank div with the error message if the formId is 'bank'
      @if(Session::get('formId') === 'bank')
          showPaymentForm('bank', '{{ Session::get('error') }}');
      @endif
      @if(Session::get('formId') === 'rib')
          showPaymentForm('rib', '{{ Session::get('error') }}');
      @endif
      @if($errors->has('montant'))
          showPaymentForm('bank', 'Montant must be a numeric value.');
      @endif
      @if($errors->has('Montant'))
          showPaymentForm('rib', 'Montant must be a numeric value.');
      @endif
      @if($errors->has('cardNumber'))
          showPaymentForm('bank', 'Montant must be a numeric value.');
      @endif
      @if($errors->has('cardCvv'))
          showPaymentForm('bank', 'Montant must be a numeric value.');
      @endif
      @if($errors->has('compte'))
          showPaymentForm('rib', 'Montant must be a numeric value.');
      @endif
      @if($errors->has('reference'))
          showPaymentForm('rib', 'Montant must be a numeric value.');
      @endif
      @if($errors->has('date_heure'))
          showPaymentForm('rib', 'Montant must be a numeric value.');
      @endif
      @if($errors->has('photo_paiement'))
          showPaymentForm('rib', 'Montant must be a numeric value.');
      @endif
  </script>
  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script>
      $(function(){
          $('#datepicker').datepicker();
      });
  </script>
  <!-- ... Your remaining HTML code ... -->
  
  <script>
          const checkboxFilters = ['bankk', 'amount', 'reference', 'date', 'attachment', 'stat', 'actions'];
  
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