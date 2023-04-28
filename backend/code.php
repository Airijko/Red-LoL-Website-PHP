<?php

session_start();

require('../backend/db_connect.php');

if(isset($_POST['delete_user']))
{
    $id = $_POST['delete_user'];

    $query = "DELETE FROM users WHERE id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if($stmt->rowCount())
    {
        $_SESSION['message'] = "User Deleted Successfully";
        header("Location: ../");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "User Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update_user']))
{
    $id = $_POST['user_id'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $query = "UPDATE users SET username=:username, email=:email, phone=:phone, gender=:gender WHERE id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if($stmt->rowCount())
    {
        $_SESSION['message'] = "User Updated Successfully";
        header("Location: ../");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "User Not Updated";
        header("Location: ../");
        exit(0);
    }

}


if(isset($_POST['save_user']))
{
    $name = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $query = "INSERT INTO users (username,email,phone,gender) VALUES (:username, :email, :phone, :gender)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':gender', $gender);
    $stmt->execute();

    if($stmt->rowCount())
    {
        $_SESSION['message'] = "User Created Successfully";
        header("Location: create-users.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "User Not Created";
        header("Location: create-users.php");
        exit(0);
    }
}

?>
