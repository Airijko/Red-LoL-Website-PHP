<?php

    session_start();

    require('../backend/db_connect.php');

    if(isset($_POST['submit'])){
        $file = $_FILES['file'];
        print_r($file);
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        if (!in_array($fileActualExt, $allowed)) {
            $error = "Invalid file type";
            header("Location: Posts?error=" . urlencode($error));
        } elseif ($fileError !== 0) {
            $error = "There was an error uploading your file";
            header("Location: Posts?error=" . urlencode($error));
        } elseif ($fileSize >= 8000000) {
            $error = "Your file is too large";
            header("Location: Posts?error=" . urlencode($error));
        } else {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = 'images/' . $fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);

            // Inserts submission to database
            $stmt = $db->prepare("INSERT INTO posts (user_id, title, content, file) VALUES (:user_id, :title, :content, :file)");
            $user_id = $_SESSION['id'];
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':file', $fileNameNew);
        
            $stmt->execute();
            header("Location: Posts?uploadsuccess");
        }
    }

?>