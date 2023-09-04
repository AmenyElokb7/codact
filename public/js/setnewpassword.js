const show_password=()=>{
        
    const password1=document.getElementById('pass1');
    const password2=document.getElementById('pass2');
     if(password1.type==="text"){
        password1.type="password";
        password2.type="password";
     }
     else{
        password1.type="text";
        password2.type="text";
    
     }
    }

  
   
        function navigateToLogin() {
            // Redirect to the login page
            window.location.href = '/login';
        }
    
        // Function to cancel the countdown and navigate to the login page
       
        // ... Your existing code ...
    
       
        function deleteUser() {
            // Get the CSRF token from the meta tag
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Get the email of the user
            var id = document.getElementById('id').value;
          
            // Send an AJAX request to delete the user from the password_resets table
            fetch('/deleteUserbyid', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
              },
              body: JSON.stringify({ id: id })
            })
            .then(function(response) {
              if (response.ok) {
                // Redirect to the login page
                window.location.href = '/login';
               //console.log(response.json())
          
              } else {
                throw new Error('Failed to delete user.');
              }
            })
            .catch(function(error) {
              console.error(error);
            });
          }
           function retourne() {
           
            localStorage.removeItem('countdownStart');
            // Navigate to the login page
            deleteUser();
        }
    
        // Attach the 'retourne' function to the cancel button click event
        var cancelButton = document.getElementById('canceledButton');
        cancelButton.addEventListener('click', retourne);