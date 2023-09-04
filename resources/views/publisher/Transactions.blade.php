

@extends('admin.dashboard')
<head>
    <!-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>
<style>

.width_card_2{
width: 25%;
    }
.width_card{
width: 50%;
    }
@media screen and (max-width: 700px) {
    .img{
        width: 90px;
        height: 90px;
    }
    .width_card{
width: 75%;
    }
    .width_card_2{
width: 50%;
    }

    }
</style>
@section('admin')
    <div class="page-content">
      <div class=" d-flex justify-content-center ">
      <div class=" width_card h4 d-flex justify-content-center card p-4">
     <div class="d-flex justify-content-center">Votre solde actuel : <br/>  </div> 
     <hr/>
     <div class="d-flex justify-content-center text-primary">{{ (Auth::user()->balance)}} DNT  </div> 
     <div class="d-flex justify-content-center text-primary"><img src="{{ asset('assets/images/wallet.png') }}" width="200" height="200" alt=""> </div> 
   
      </div>
      </div>

<br/>
<div class=" d-flex justify-content-center ">

      <a href="{{ route('payads') }}" class="ms-3 width_card_2 h4 d-flex justify-content-center card p-4" style="cursor:pointer">
      <div >
   
     <div class="d-flex justify-content-center text-primary"><img src="{{ asset('assets/images/add_wallet.png') }}" width="150" height="150" alt="" class="img"> </div> 
     <div class="d-flex justify-content-center text-primary mt-3 text-center " style="cursor:pointer">                   
Charge Wallet</div> 
      </div> </a> 
   
      
      

          <a href="{{ route('Financalsummary') }}" class="ms-3 width_card_2 h4 d-flex justify-content-center card p-4" style="cursor:pointer">

      <div >

     <div class="d-flex justify-content-center text-primary"><img src="{{ asset('assets/images/financial-profit.png') }}" width="150" height="150" alt="" class="img"> </div> 
     <div class="d-flex justify-content-center text-primary mt-3 text-center" style="cursor:pointer">                    
     Financal summary</div> 
 </div>           </a>
       
      </div>
    </div>
@endsection