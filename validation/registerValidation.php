<?php

    require __DIR__ . '/../vendor/autoload.php';

    use Respect\Validation\Validator as v;

    // Respect Validation Documents: https://respect-validation.readthedocs.io/en/latest/

    $errors = array();

    // Validate Username
    if (isset($_POST['registerUsername'])) {
        $usernameValidator = v::notEmpty()->length(3, 25);
        if (!$usernameValidator->validate($_POST['registerUsername'])) {
            $errors['registerUsername'] = "Invalid Username";
        }
    }

    // Validate Email
    if (isset($_POST['email'])) {
        $emailValidator = v::notEmpty()->email();
        if (!$emailValidator->validate($_POST['email'])) {
            $errors['email'] = "Invalid Email";
        }
    }

    // Validate Password
    if (isset($_POST['registerPassword'])) {
        $passwordValidator = v::notEmpty()->length(8, 128);
        if (!$passwordValidator->validate($_POST['registerPassword'])) {
            $errors['registerPassword'] = "Invalid Password";
        }
    }

    // Validate Confirm Password
    if (isset($_POST['registerPassword']) && isset($_POST['confirmPassword'])) {
        if ($_POST['registerPassword'] !== $_POST['confirmPassword']) {
            $errors['confirmPassword'] = "Passwords Don't Match";
        }
    }

    // Validate Phone
    if (isset($_POST['phone'])) {
        $phoneValidator = v::notEmpty()->phone();
        if (!$phoneValidator->validate($_POST['phone'])) {
            $errors['phone'] = "Invalid Phone Number";
        }
    }

    if (isset($_POST['gender'])) {
        $genderValidator = v::notEmpty();
        if (!$genderValidator->validate($_POST['gender'])) {
            $errors['gender'] = "Please select a gender";
        }
    }

    if (!empty($errors)) {
        echo json_encode($errors);
    }

?>