<?php

require __DIR__ . '/../vendor/autoload.php';

use Respect\Validation\Validator as v;

// Respect Validation Documents: https://respect-validation.readthedocs.io/en/latest/

$errors = array();

if (isset($_POST['username'])) {
    $usernameValidator = v::notEmpty()->length(3, 35);
    if (!$usernameValidator->validate($_POST['username'])) {
        $errors['username'] = "Invalid Username";
    }
}

if (isset($_POST['email'])) {
    $emailValidator = v::notEmpty()->email();
    if (!$emailValidator->validate($_POST['email'])) {
        $errors['email'] = "Invalid Email";
    }
}

if (isset($_POST['password'])) {
    $passwordValidator = v::notEmpty()->length(8, 128);
    if (!$passwordValidator->validate($_POST['password'])) {
        $errors['password'] = "Invalid Password";
    }
}

if (isset($_POST['password']) && isset($_POST['confirm-password'])) {
    if ($_POST['password'] !== $_POST['confirm-password']) {
        $errors['confirm-password'] = "Passwords Don't Match";
    }
}

if (isset($_POST['phone'])) {
    $phoneValidator = v::notEmpty()->phone();
    if (!$phoneValidator->validate($_POST['phone'])) {
        $errors['phone'] = "Invalid Phone Number";
    }
}

$genderOptions = ['male', 'female'];
if (isset($_POST['gender'])) {
    $genderValidator = v::in($genderOptions);
    if (!$genderValidator->validate($_POST['gender'])) {
        $errors['gender'] = "Must Choose a Gender";
    }
}

echo json_encode($errors);


?>
