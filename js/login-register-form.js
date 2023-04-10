function toggleLoginForm() {
    var loginForm = document.getElementById("login-form");
    var registerForm = document.getElementById("register-form");

    loginForm.classList.remove("d-none");
    registerForm.classList.add("d-none");
}

function toggleRegisterForm() {
    var loginForm = document.getElementById("login-form");
    var registerForm = document.getElementById("register-form");

    registerForm.classList.remove("d-none");
    loginForm.classList.add("d-none");
}

function exitButton() {
    var loginForm = document.getElementById("login-form");
    var registerForm = document.getElementById("register-form");
    
    loginForm.classList.add("d-none");
    registerForm.classList.add("d-none");
}
