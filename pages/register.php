<?php

    require __DIR__ . '/../vendor/autoload.php';

    use Respect\Validation\Validator as v;
    use libphonenumber\PhoneNumberUtil;
    
$username = v::alnum('-')->noWhitespace()->length(3, 20);
if (!$username->validate($_POST['email'])) {
    echo 'Invalid Username';
}

$email = v::email();
if (!$email->validate($_POST['email'])) {
    echo 'Invalid Email';
}

$password = v::alnum('-')->noWhitespace()->length(5, 20);
if (!$password->validate($_POST['password'])) {
    echo "Invalid Password. Must be between 5-20 characters and have no space.";
}

if ($_POST['password'] !== $_POST['confirm-password']) {
    echo "Passwords Don't Match";
}

$phone = v::phone();
if (!$phone->validate($_POST['phone'])) {
    echo "Invalid Phone Number";
}

$gender = $_POST['gender'];
if (!$gender == NULL) {
    echo "Choose a Gender";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/global.css" type="text/css" rel="stylesheet">
    <link href="css/login.css" type="text/css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <?php include '../navbar.php'?>
    <div class="container container-lg">
        <form class="register-form col-md-6 mx-auto" action="./Register" method="post">
            <h2 class="text-center mb-4">REGISTER</h2>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
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
            <p class="text-center">Already have an account? <a href="./Login">Login</a></p>
        </form>
    </div>
</body>

</html>