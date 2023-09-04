document.addEventListener('DOMContentLoaded', function() {
    // Get the countdown elements
    var minutesElement = document.getElementById('minutes');
    var secondsElement = document.getElementById('seconds');
  
    // Set the countdown time (in minutes)
    var countdownTime = 2; // Adjust this value as needed
  
    // Calculate the total duration in seconds
    var totalSeconds = countdownTime * 60;
  
    // Get the stored countdown start time from local storage
    var storedCountdownStart = localStorage.getItem('countdownStart');
  
    // Check if the countdown start time is stored
    if (storedCountdownStart) {
      // Calculate the elapsed time since the countdown started
      var currentTime = Math.floor(Date.now() / 1000);
      var elapsedSeconds = currentTime - storedCountdownStart;
  
      // Calculate the remaining seconds
      totalSeconds -= elapsedSeconds;
  
      // If the countdown has already finished, reset it to the initial value
      if (totalSeconds < 0) {
        totalSeconds = countdownTime * 60;
      }
    } else {
      // Store the countdown start time in local storage
      var countdownStart = Math.floor(Date.now() / 1000);
      localStorage.setItem('countdownStart', countdownStart);
    }
  
    // Function to update the countdown timer
    function updateCountdown() {
      // Calculate the remaining minutes and seconds
      var minutes = Math.floor(totalSeconds / 60);
      var seconds = totalSeconds % 60;
  
      // Add leading zeros if necessary
      minutes = String(minutes).padStart(2, '0');
      seconds = String(seconds).padStart(2, '0');
  
      // Update the countdown elements
      minutesElement.innerText = minutes;
      secondsElement.innerText = seconds;
  
      // Decrement the totalSeconds value
      totalSeconds--;
  
      // Check if the countdown is finished
      if (totalSeconds < 0) {
        clearInterval(intervalId);
        // Redirect to the login page
        retourne();
  
        // Clear the stored countdown start time from local storage
        localStorage.removeItem('countdownStart');
      }
    }
  
    // Start the countdown initially
    updateCountdown();
  
    // Update the countdown every second
    var intervalId = setInterval(updateCountdown, 1000);
  });
  
  function retourne() {
    // Clear the stored countdown start time from local storage
    localStorage.removeItem('countdownStart');
    // Navigate to the login page
    deleteUser();
    navigateToLogin();
  }
  
  function deleteUser() {
    // Get the CSRF token from the meta tag
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    // Get the email of the user
    var email = document.getElementById('email').value;
  
    // Send an AJAX request to delete the user from the password_resets table
    fetch('/deleteUser', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({ email: email })
    })
      .then(function(response) {
        if (response.ok) {
          // Redirect to the login page
          navigateToLogin();
        } else {
          throw new Error('Failed to delete user.');
        }
      })
      .catch(function(error) {
        console.error(error);
      });
  }
  
  function navigateToLogin() {
    // Redirect to the login page
    window.location.href = '/login';
  }
  
  var cancelButton = document.getElementById('cancelButton');
  cancelButton.addEventListener('click', retourne);
  