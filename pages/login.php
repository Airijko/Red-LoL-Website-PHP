<div id="login-form" class="container-login container-fluid d-none">
    <form class="login-form col-md-4 mx-auto" method="post">
        <button class="exit-button" onclick="exitButton()">X</button>
        <h2 class="text-center mb-4">LOGIN</h2>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="login-username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="login-password" name="password" required>
        </div>
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
        <p class="text-center">Don't have an account?<button class="link-button"
                onclick="toggleRegisterForm()">Register</button></p>
    </form>
</div>

<div id="register-form" class="container-register container-fluid d-none">
    <form class="register-form col-md-4 mx-auto" method="post">
        <button class="exit-button" onclick="exitButton()">X</button>
        <h2 class="text-center mb-4">REGISTER</h2>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="register-username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="register-password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="confirm-password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label d-block">Gender</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                <label class="form-check-label" for="male">pp?</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                <label class="form-check-label" for="female">no pp</label>
            </div>
        </div>
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
        <p class="text-center">Already have an account?<button class="link-button"
                onclick="toggleLoginForm()">Login</button></p>
    </form>
</div>