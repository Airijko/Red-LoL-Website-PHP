<?php
    session_start();

    require('../backend/db_connect.php');

    if(isset($_POST['submit'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_var($_POST['content'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Inserts submission to database
        $query = "INSERT INTO reviews (name, content) VALUES (:name, :content)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':content', $content);
    
        $stmt->execute();
        header("Location: Reviews?uploadsuccess");

    }

?>