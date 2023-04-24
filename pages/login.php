<?php 

    include __DIR__ . '/../validation/loginValidation.php';
    include __DIR__ . '/../includes/login.inc.php';

    function sanitize_input($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $form_name = sanitize_input($_POST["formType"]);
        
        if ($form_name == "loginForm") {
            $username = sanitize_input($_POST["loginUsername"]);
            $password = sanitize_input($_POST["loginPassword"]);
            $result = loginUser($username, $password);
        } elseif ($form_name == "registerForm") {
            $username = sanitize_input($_POST["registerUsername"]);
            $email = sanitize_input($_POST["email"]);
            $password = sanitize_input($_POST["registerPassword"]);
            $phone = sanitize_input($_POST["phone"]);
            $gender = sanitize_input($_POST["gender"]);
            $result = registerUser($username, $email, $password, $phone, $gender);
        } elseif ($form_name == "playerSearchForm") {
            $playerSearch = sanitize_input($_POST["searchProfile"]);
        }
    }
    
?>

<div class="modal login-modal fade" id="toggleLoginModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="toggleLoginModalLabel">LOGIN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="loginForm" class="login-form">
                    <input type="hidden" name="formType" value="loginForm">
                    <div class="input-box">
                        <label for="username" class="form-label">Username</label>
                        <input class="user-input" type="text" id="loginUsername" name="loginUsername">
                        <div id="loginUsernameError" style="display: none; color: red; text-shadow: 0 0 10px black;">
                            Please
                            enter a username</div>
                    </div>
                    <div class="input-box">
                        <label for="password" class="form-label">Password</label>
                        <input class="user-input" type="password" id="loginPassword" name="loginPassword">
                        <div id="loginPasswordError" style="display: none; color: red; text-shadow: 0 0 10px black;">
                            Please
                            enter a password</div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100 btn-outline-light">Login</button>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <p class="text-center text-white">Don't have an account?<button class="link-button"
                        data-bs-target="#toggleRegisterModal" data-bs-toggle="modal"
                        data-bs-dismiss="modal">Register</button></p>
            </div>
        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>