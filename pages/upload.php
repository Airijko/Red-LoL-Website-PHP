<?php

    require('../backend/db_connect.php');

    if (isset($_POST['submit'])) {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $file = $_FILES['file'];
    
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileType = $_FILES['file']['type'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
    
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
    
        $allowed = array('jpg', 'png', 'gif', 'jpeg'); 
    
        if (!in_array($fileActualExt, $allowed)) {
            echo "Your file is not allowed!";
            exit;
        }
        
        if ($fileError !== 0) {
            echo "There was an error uploading your file!";
            exit;
        }
        
        if ($fileSize >= 1000000) {
            echo "Your file is too big!";
            exit;
        }
        
        $fileNameNew = uniqid('', true).".".$fileActualExt;
        $fileDestination = 'uploads/'.$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
    
        $query = "INSERT INTO posts (title, content, image) VALUES (:title, :content, :image)";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':image', $fileDestination);
        $result = $statement->execute();
        if($result){
            echo "success";
        } else {
            echo "error";
        }
    
        header("Location: Posts?uploadsuccess");
    }

?>