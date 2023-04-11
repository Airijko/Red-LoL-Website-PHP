<div class="modal fade" id="toggleLoginModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="toggleLoginModalLabel">LOGIN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" class="login-form" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="login-username" name="username">
                        <div id="loginUsernameError" style="display: none; color: red; text-shadow: 0 0 10px black;">
                            Please
                            enter a username</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="login-password" name="password">
                        <div id="loginPasswordError" style="display: none; color: red; text-shadow: 0 0 10px black;">
                            Please
                            enter a password</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
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
<div class="modal fade" id="toggleRegisterModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="toggleRegisterModalLabel">REGISTER</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" class="register-form" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="register-username" name="username">
                        <div id="usernameError" style="display: none; color: red; text-shadow: 0 0 10px black;">Please
                            enter
                            a
                            username (3 - 25 characters)</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <div id="emailError" style="display: none; color: red; text-shadow: 0 0 10px black;">Please
                            enter a
                            valid
                            email address</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="register-password" name="password">
                        <div id="passwordError" style="display: none; color: red; text-shadow: 0 0 10px black;">Please
                            enter
                            a
                            password (8 - 128 characters)</div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password">
                        <div id="confirmPasswordError" style="display: none; color: red; text-shadow: 0 0 10px black;">
                            Passwords do
                            not match</div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                        <div id="phoneError" style="display: none; color: red; text-shadow: 0 0 10px black;">Please
                            enter a
                            valid
                            phone number</div>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label d-block">Gender</label>
                        <div class="form-check form-check-inline">
                            <label for="male"></label>
                            <input class="form-check-input" type="radio" name="gender" id="male" />pp?
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="female"></label>
                            <input class="form-check-input" type="radio" name="gender" id="female" />no pp
                        </div>
                        <div id="genderError" style="display: none; color: red; text-shadow: 0 0 10px black;">Please
                            choose
                            a gender
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
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

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="validation/AJAX.js"></script>