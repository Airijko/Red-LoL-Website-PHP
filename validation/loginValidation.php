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

if (isset($_POST['password'])) {
    $passwordValidator = v::notEmpty()->length(8, 128);
    if (!$passwordValidator->validate($_POST['password'])) {
        $errors['password'] = "Invalid Password";
    }
}

?>