<?php

    function registerUser($username, $email, $password, $phone, $gender) {

        include __DIR__ . '/../backend/db_connect.php';

        // Check if email is already in use
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            mysqli_close($conn);
            return "Username already in use.";
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password, phone, gender) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $hashed_password, $phone, $gender);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            mysqli_close($conn);
            return "Registration successful!";
        } else {
            mysqli_close($conn);
            return "Error: " . mysqli_error($conn);
        }

        // Close database connection
        mysqli_close($conn);
    }

?>