<?php

    session_start();

    require('../backend/db_connect.php');

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    
        $stmt = $db->prepare("DELETE FROM reviews WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    
        header("Location: ManageFeedback?delete=success");
        exit;

    }

?>