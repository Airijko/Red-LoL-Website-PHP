const loginForm = document.querySelector('.login-form');

loginForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const username = document.getElementById('login-username');
    const password = document.getElementById('login-password');

    const usernameError = document.getElementById('loginUsernameError');
    const passwordError = document.getElementById('loginPasswordError');

    let errors = {};

    // Validate Username
    if (username.value === '') {
        usernameError.style.display = 'block';
        errors = true;
    }

    // Validate Password
    if (password.value === '') {
        passwordError.style.display = 'block';
        errors = true;
    }

    if (Object.keys(errors).length === 0) {
        $.ajax({
            url: 'validation/loginValidation.php',
            method: 'POST',
            data: {
                username: username.value,
                password: password.value
            },
            dataType: 'json',
            success: function (response) {
                if (Object.keys(response).length > 0) {
                    if (response.hasOwnProperty('username')) {
                        usernameError.style.display = 'block';
                        usernameError.textContent = response.username;
                    }
                    if (response.hasOwnProperty('password')) {
                        passwordError.style.display = 'block';
                        passwordError.textContent = response.password;
                    }
                } else {
                    loginForm.submit();
                }
            }
        });
    }
});

const registerForm = document.querySelector('.register-form');

registerForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const username = document.getElementById('register-username');
    const email = document.getElementById('email');
    const password = document.getElementById('register-password');
    const confirmPassword = document.getElementById('confirm-password');
    const phone = document.getElementById('phone');
    const gender = document.querySelector('input[name="gender"]:checked');

    const usernameError = document.getElementById('usernameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');
    const phoneError = document.getElementById('phoneError');
    const genderError = document.getElementById('genderError');

    let errors = false;


    
    if (!errors) {
        $.ajax({
            url: 'validation/registerValidation.php',
            method: 'POST',
            data: {
                username: username.value,
                email: email.value,
                password: password.value,
                confirmPassword: confirmPassword.value,
                phone: phone.value,
                gender: gender ? gender.value : null
            },
            dataType: 'json',
            success: function (response) {
                if (Object.keys(response).length > 0) {
                    if (response.hasOwnProperty('username')) {
                        usernameError.style.display = 'block';
                        usernameError.textContent = response.username;
                    }
                    if (response.hasOwnProperty('email')) {
                        emailError.style.display = 'block';
                        emailError.textContent = response.email;
                    }
                    if (response.hasOwnProperty('password')) {
                        passwordError.style.display = 'block';
                        passwordError.textContent = response.password;
                    }
                    if (response.hasOwnProperty('confirmPassword')) {
                        confirmPasswordError.style.display = 'block';
                        confirmPasswordError.textContent = response.confirmPassword;
                    }
                    if (response.hasOwnProperty('phone')) {
                        phoneError.style.display = 'block';
                        phoneError.textContent = response.phone;
                    }
                    if (response.hasOwnProperty('gender')) {
                        genderError.style.display = 'block';
                        genderError.textContent = response.gender;
                    }
                } else {
                    loginForm.submit();
                }
            }
        });
    }
});

