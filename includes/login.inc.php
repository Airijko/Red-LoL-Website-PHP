<?php

    function loginUser($username, $password) {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        require __DIR__ . '/../backend/db_connect.php';

        // Check if user exists
        $sql = "SELECT * FROM users WHERE username=:username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if (count($result) == 0) {
            return "Username does not exist.";
        }

        // Verify password
        $row = $result[0];
        if (password_verify($password, $row['password'])) {
            $_SESSION["id"] = $row['id'];
            $_SESSION["username"] = $row['username'];
            return "Login successful!";
        } else {
            return "Invalid password.";
        }
    }


