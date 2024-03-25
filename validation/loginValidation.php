<?php

require __DIR__ . '/../vendor/autoload.php';

use Respect\Validation\Validator as v;

// Respect Validation Documents: -

$errors = array();

if (isset($_POST['loginUsername'])) {
    $usernameValidator = v::notEmpty()->length(3, 25);
    if (!$usernameValidator->validate($_POST['loginUsername'])) {
        $errors['loginUsername'] = "Invalid Username";
    }
}

if (isset($_POST['loginPassword'])) {
    $passwordValidator = v::notEmpty()->length(8, 128);
    if (!$passwordValidator->validate($_POST['loginPassword'])) {
        $errors['loginPassword'] = "Invalid Password";
    }
}

if (!empty($errors)) {
    echo json_encode($errors);
}

?>