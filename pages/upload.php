<?php

    session_start();

    require('../backend/db_connect.php');

    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $file = $_FILES['file'];
        $fileNameNew = NULL;

        if (!empty($file['name'])) {
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'gif');

            if (!in_array($fileActualExt, $allowed)) {
                $error = "Invalid file type";
                header("Location: Posts?error=" . urlencode($error));
                exit();
            } elseif ($fileError !== 0) {
                $error = "There was an error uploading your file";
                header("Location: Posts?error=" . urlencode($error));
                exit();
            } elseif ($fileSize >= 8000000) {
                $error = "Your file is too large";
                header("Location: Posts?error=" . urlencode($error));
                exit();
            } else {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'images/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            }
        }

        // Inserts submission to database
        $stmt = $db->prepare("INSERT INTO posts (user_id, title, content, file) VALUES (:user_id, :title, :content, :file)");
        $user_id = $_SESSION['id'];
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':file', $fileNameNew);
        
        $stmt->execute();
        header("Location: Posts?uploadsuccess");
        exit();
    }

?>
