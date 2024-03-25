<?php

    session_start();

    require('../backend/db_connect.php');

    if ($_POST && isset($_POST['id']) && isset($_POST['title']) && isset($_POST['content'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
    
        if (strlen($title) < 1 || strlen($content) < 1) {
            echo "cannot leave title or content blank.";
            exit;
        }
    
        if ($_POST['command'] == "Update") {
            $query = "UPDATE posts SET title = :title, content = :content, edited_date = NOW() WHERE id = :id";
            $stmt = $db->prepare($query);
    
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            $stmt->execute();
    
            header("Location: Posts?id={$id}");
            exit;

        } elseif ($_POST['command'] == "Delete") {
            // Fetch the image file name associated with the post
            $query = "SELECT file FROM posts WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $file = $stmt->fetchColumn();
        
            // Delete the image file from the server directory if it exists
            if (!empty($file)) {
                $filePath = "images/". $file;
                echo $filePath;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Delete the post from the database
            $query = "DELETE FROM posts WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        
            header("Location: Posts");
            exit;

        } elseif ($_POST['command'] == "RemoveIMG") {
            // Fetch the image file name associated with the post
            $query = "SELECT file FROM posts WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $file = $stmt->fetchColumn();
        
            // Delete the image file from the server directory if it exists
            if (!empty($file)) {
                $filePath = "images/" . $file;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        
            // Update the post in the database to set file=NULL
            $query = "UPDATE posts SET file=NULL WHERE id=:id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        
            header("Location: Posts");
            exit;

        } else {
            $query = "INSERT INTO posts (title, content, file, user_id) VALUES (:title, :content, :file, :user_id)";
            $stmt = $db->prepare($query);
    
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':content', $content);
            $stmt->bindValue(':file', $image);
            $stmt->bindValue(':user_id', $_SESSION['id']);
    
            $stmt->execute();
    
            header("Location: Posts");
            exit;
        }
    }

    if (isset($_GET['id'])) { // Retrieve blog to be edited, if id GET parameter is in URL.
        // Sanitize the id. Like above but this time from INPUT_GET.
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        // Build the parametrized SQL query using the filtered id.
        $query = "SELECT * FROM posts WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the SELECT and fetch the single row returned.
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $id = false; // False if we are not UPDATING or SELECTING.
    }


?>


<!DOCTYPE html>
<html>

<head>
    <title>Edit Post</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/global.css" type="text/css" rel="stylesheet">
    <link href="css/posts.css" type="text/css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/AJAX.js"></script>
</head>

<body>
    <?php include '../navbar.php'; ?>
    <?php include '../pages/login.php'; ?>
    <div class="container container-fluid main-container">
        <div class="row">
            <div class="col-md-2">
                <div class="container text-end">
                    <a href="./Posts" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="col md-8">
                <div class="container container-lg post-container">
                    <form method="post" action="./Edit">
                        <div class="card">
                            <?php if ($row['file'] == NULL): ?>
                            <?php else: ?>
                            <img class="object-fit-cover" src="pages/images/<?= $row['file'] ?>" class="card-img-top"
                                alt="<?= $row['title'] ?>">
                            <input class="btn btn-danger" type="submit" name="command" value="RemoveIMG"
                                onclick="return confirm('Are you sure you want to delete the image?')">
                            <?php endif ?>
                            <div class="card-body edit-card-body">
                                <h5>
                                    <input name="title" id="title" value="<?= $row['title']?>">
                                </h5>
                                <p>
                                    <textarea name="content" id="content"
                                        style="width: 80%; height: 150px"> <?= $row['content']?></textarea>
                                </p>
                                <p>
                                    <input type="hidden" name="id" value="<?= $row['id']?>">
                                    <input class="btn btn-primary" type="submit" name="command" value="Update">
                                    <input class="btn btn-danger" type="submit" name="command" value="Delete"
                                        onclick="return confirm('Are you sure you want to delete the post?')">
                                <p class="card-text"><small>Last Updated: <?= $row['edited_date'] ?></small>
                                </p>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>