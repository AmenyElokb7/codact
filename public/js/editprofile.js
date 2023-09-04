const show_password=()=>{
        
    const password1=document.getElementById('password');
    const password2=document.getElementById('password-confirm');
     if(password1.type==="text"){
        password1.type="password";
        password2.type="password";
     }
     else{
        password1.type="text";
        password2.type="text";
    
     }
    }
    $(document).ready(function(){
        var intials = $('#username').text().charAt(0) ;
        var profileImage = $('#profileImage').text(intials);
      });