<?php

    function registerUser($username, $email, $password, $phone, $gender) {

        include __DIR__ . '/../backend/db_connect.php';

        // Check if email is already in use
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        if ($stmt->rowCount() > 0) {
            return 'Username already exists. Please choose a different username.';
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password, phone, gender) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([$username, $email, $hashed_password, $phone, $gender]);

        if ($result) {
            return "Registration successful!";
        } else {
            return "Error: " . $db->errorInfo()[2];
        }
    }

