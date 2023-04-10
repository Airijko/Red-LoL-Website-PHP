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