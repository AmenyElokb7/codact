var passwordVisible = false;

    const togglePasswordVisibility = () => {
        const passwordInput = document.getElementById('password');
        const showHideSpan = document.getElementById('showHideSpan');

        passwordVisible = !passwordVisible;
        passwordInput.type = passwordVisible ? 'text' : 'password';
        showHideSpan.innerHTML = passwordVisible ? '<i class="fas fa-eye-slash"></i> Hide' : '<i class="fas fa-eye"></i> Show';
      };