function navigateToLogin() {
    // Redirect to the login page
    window.location.href = '/login';
}

var cancelButton = document.getElementById('canceledButton');
cancelButton.addEventListener('click', navigateToLogin);