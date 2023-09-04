@extends('admin.dashboard')
<head>
    <!-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/editprofile.css') }}">

    <style>

.img-circle img {
    border-radius: 100%;
    border: 2px solid black;

}
.shadow {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;  height: 100px;
    width: 100px;
    object-fit: cover;
    padding: 2px; 
}

    </style>
</head>

@section('admin')
    <div class="page-content mt-3">
    <div class="container ">
    <div class="h5 text-dark ms-2">Account Settings </div>
    <div class="card rounded-4 ">

<div class="d-flex justify-content-center mt-4 row ">
    <div class=" ">    <div class="  d-flex justify-content-center mt-4  me-2 " >
    <div class="img-circle">
    <div id="profileImage"></div>

<div class="h5 mt-3 d-flex justify-content-center" style='    position: relative; right: 1px;' id='username'>{{Auth::User()->name}}</div>
</div>
</div></div>
<div class="" style="border-left:1px solid"></div>
    <div class="col-10" >               <div class=" mt-4" >
                   
                   
                   <form action="{{ route('updateprofile', Auth::User()->id) }}" method="POST">
                       @csrf
                       <div class="">
                           <div class=" row g-4 d-flex justify-content-center">
                           <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <h5>Personnal information</h5>

    </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body row d-flex justify-content-center  g-4 p-3">

      <div class="col-12 col-sm-5 ">
                               <label for="name" class="form-label">Full Name</label>

                                       <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{  Auth::User()->name  }}" required autocomplete="name" autofocus/>
                                     
                                   @error('name')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                               </div>
                               <div class="col-12 col-sm-5">
                               <label for="address" class="form-label">Address</label>
                                       <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{  Auth::User()->address  }}" required autocomplete="address" autofocus/>
                                  
                                   @error('address')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                               </div>
                               <div class="col-12 col-sm-5">
                               <label for="email" class="form-label">Email Address</label>

                               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{  Auth::User()->email  }}" required autocomplete="email" />
                                       
                                   @error('email')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                               </div>
                               <div class="col-12 col-sm-5">
                               <label for="phoneno" class="form-label">Phone number</label>
                                       <input  id="phoneno" type="text" class="form-control @error('phoneno') is-invalid @enderror" name="phoneno" value="{{  Auth::User()->phoneno  }}" required autocomplete="phoneno" autofocus />
                                       
                                   @error('phoneno')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                               </div>
    </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
      <h5  class='ms-1'>Change password</h5>      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body row d-flex justify-content-center  g-4 p-3  mb-4 mt-1">
      <div class="col-12 col-sm-5">
                               <label for="password" class="form-label">Password</label>
                                       <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"   autocomplete="new-password"/>
                                     
                                   @error('password')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                               <div class="d-flex justify-content-center mt-3"> @if(isset($error))
    <div class="text-danger fw-bold h6">
  {{ $error }}
    </div>
     
@endif
</div>
                               </div>
                               <div class="col-12 col-sm-5">
                               <label for="password-confirm" class="form-label">Confirm password</label>
                                       <input id="password-confirm" type="password" class="form-control" name="password_confirmation"   autocomplete="new-password"/>
                                    
                               </div>        <div class="pe-3 d-flex justify-content-start mt-3 ms-1 col-10 little_checkbox">
                <input type="checkbox" onchange="show_password(event)" class="me-1 mb-2" style="width: 14px;">
                <label class="text-nowrap" style="font-size: 17px;">Show password</label>
            </div> </div>
                            
    </div>
  </div>
</div>
 <div class="d-flex justify-content-center mt-5 mb-5">
                               <button type="submit" class="boutton-edit">
                                   {{ __('Edit') }}
                               </button>
                               </div>
                           </div>
                       </div>
                   </form>
              
       </div></div>

 
    </div>
</div>

</div>


    </div>
    <script src="{{ asset('js/editprofile.js') }}"></script>

@endsection