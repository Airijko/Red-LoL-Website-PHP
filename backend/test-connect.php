<?php

require_once 'db_connect.php';

if ($conn) {
    echo 'Database connection successful!';
} else {
    echo 'Could not connect: ' . mysqli_connect_error();
}

mysqli_close($conn);

// if (isset($_POST["registerSubmit"])) {

//     $username = $_POST["username"];
//     $email = $_POST["email"];
//     $password = $_POST["password"];
//     $confirmPassword = $_POST["confirm-password"];
//     $phone = $_POST["phone"];
//     $gender = $_POST["gender"];
    
//     require_once '../backend/db_connect.php';

//     if (emptyInputRegister($username, $email, $password, $confirmPassword, $phone, $gender) !== false) {
//         header("location: ?error=emptyInputRegister");
//         exit();
//     }
//     if (invalidUsername($username) !== false) {
//         header("location: ?error=invalidUsername");
//         exit();
//     }


//     echo "Registered";
// } 

?>

