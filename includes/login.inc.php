<?php

    function loginUser($username, $password) {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        include __DIR__ . '/../backend/db_connect.php';

        // Check if user exists
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            mysqli_close($conn);
            return "Username does not exist.";
        }

        // Verify password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION["username"] = $row['username'];
            mysqli_close($conn);
            return "Login successful!";
        } else {
            mysqli_close($conn);
            return "Invalid password.";
        }

        // Close database connection
        mysqli_close($conn);
    }

?>
