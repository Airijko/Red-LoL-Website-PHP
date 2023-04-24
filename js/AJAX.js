const loginForm = document.querySelector('.login-form');

loginForm.addEventListener('submit', (e) => {

    const username = document.getElementById('loginUsername');
    const password = document.getElementById('loginPassword');

    const usernameError = document.getElementById('loginUsernameError');
    const passwordError = document.getElementById('loginPasswordError');

    let errors = false;

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
    
    if (errors) {
        e.preventDefault();

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
    }
});

const registerForm = document.querySelector('.register-form');

registerForm.addEventListener('submit', (e) => {

    const username = document.getElementById('registerUsername');
    const email = document.getElementById('email');
    const password = document.getElementById('registerPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    const phone = document.getElementById('phone');
    const gender = document.querySelector('input[name="gender"]:checked');

    const usernameError = document.getElementById('usernameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');
    const phoneError = document.getElementById('phoneError');
    const genderError = document.getElementById('genderError');

    let errors = false;

    // Validate Username
    if (username.value.trim().length < 3 || username.value.trim().length > 25 || username.value.trim() === '') {
        // Display the username error message and set its display to block
        usernameError.style.display = "block";
        errors = true;
    } else {
        // Hide the username error message by setting its display to none
        usernameError.style.display = "none";
    }

    // Validate Email
    if (!email.value.match(/^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/) || email.value.trim() ===
        '') {
        emailError.style.display = 'block';
        errors = true;
    } else {
        emailError.style.display = 'none';
    }

    // Validate Password
    if (password.value.trim().length < 6 || password.value.trim().length > 20 || password.value.trim() === '') {
        passwordError.style.display = "block";
        errors = true;
    } else {
        passwordError.style.display = 'none';
    }
    if (password.value.trim().length < 8 || password.value.trim().length > 128 || password.value.trim() ===
        '') {
        passwordError.style.display = 'block';
        errors = true;
    } else {
        passwordError.style.display = 'none';
    }

    // Validate Confirm Password
    if (confirmPassword.value.trim() === '') {
        confirmPasswordError.style.display = 'block';
        errors = true;
    } else if (confirmPassword.value !== password.value) {
        confirmPasswordError.style.display = 'block';
        errors = true;
    } else {
        confirmPasswordError.style.display = 'none';
    }

    // Validate Phone
    if (!phone.value.match(/^\d{10}$/)) {
        phoneError.style.display = 'block';
        errors = true;
    } else {
        phoneError.style.display = 'none';
    }

    // Validate Gender
    // if (gender === null) {
    //     genderError.style.display = 'block';
    //     genderError.textContent = 'Please select a gender';
    //     errors = true;
    // }

    if (errors) {
        e.preventDefault();

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
                        // if (response.hasOwnProperty('gender')) {
                        //     genderError.style.display = 'block';
                        //     genderError.textContent = response.gender;
                        // }
                    } else {
                        loginForm.submit();
                    }
                }
            });
        }
    }
});

