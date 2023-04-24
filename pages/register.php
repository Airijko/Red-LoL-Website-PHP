<?php 

    include __DIR__ . '/../validation/registerValidation.php';
    include __DIR__ . '/../includes/register.inc.php';

?>

<div class="modal register-modal fade" id="toggleRegisterModal" aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="toggleRegisterModalLabel">REGISTER</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="registerForm" class="register-form">
                <input type="hidden" name="formType" value="register">
                    <input type="hidden" name="formType" value="registerForm">
                    <div class="input-box">
                        <label for="username" class="form-label">Username</label>
                        <input class="user-input" type="text" id="registerUsername" name="registerUsername">
                        <div id="usernameError" style="display: none; color: red; text-shadow: 0 0 10px black;">
                            Please
                            enter
                            a
                            username (3 - 25 characters)</div>
                    </div>
                    <div class="input-box">
                        <label for="email" class="form-label">Email</label>
                        <input class="user-input" type="email" id="email" name="email">
                        <div id="emailError" style="display: none; color: red; text-shadow: 0 0 10px black;">Please
                            enter a
                            valid
                            email address</div>
                    </div>
                    <div class="input-box">
                        <label for="password" class="form-label">Password</label>
                        <input class="user-input" type="password" id="registerPassword" name="registerPassword">
                        <div id="passwordError" style="display: none; color: red; text-shadow: 0 0 10px black;">
                            Please
                            enter
                            a
                            password (8 - 128 characters)</div>
                    </div>
                    <div class="input-box">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <input class="user-input" type="password" id="confirmPassword" name="confirmPassword">
                        <div id="confirmPasswordError" style="display: none; color: red; text-shadow: 0 0 10px black;">
                            Passwords do
                            not match</div>
                    </div>
                    <div class="input-box">
                        <label for="phone" class="form-label">Phone</label>
                        <input class="user-input" type="tel" id="phone" name="phone">
                        <div id="phoneError" style="display: none; color: red; text-shadow: 0 0 10px black;">Please
                            enter a
                            valid
                            phone number</div>
                    </div>
                    <div class="input-box">
                        <label for="gender" class="form-label d-block">Gender</label>
                        <div class="form-check form-check-inline">
                            <label for="male"></label>
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" />pp?
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="female"></label>
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" />no
                            pp
                        </div>
                        <div id="genderError" style="display: none; color: red; text-shadow: 0 0 10px black;">Please
                            choose
                            a gender
                        </div>
                    </div>
                    <button type="submit" name="submit"
                        class="btn btn-primary w-100 btn-outline-light">Register</button>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <p class="text-center text-white">Don't have an account?<button class="link-button"
                        data-bs-target="#toggleLoginModal" data-bs-toggle="modal" data-bs-dismiss="modal">Login</button>
                </p>
            </div>
        </div>
    </div>
</div>
