<?php

    include 'login.php'; 
    include '../validation/registerValidation.php';

    require('../backend/db_connect.php');
    require('../backend/authenticate.php'); 
    
    if ($_POST && isset($_POST['title']) && isset($_POST['content'])) {

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        $query = "INSERT INTO posts (title, content, image) VALUES (:title, :content, :image)";
        $statement = $db->prepare($query);
    
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':image', $image);
        
        $statement->execute();
    
        if (strlen($title) < 1 || strlen($content) < 1) {
            echo "cannot leave title or content blank.";
            exit;
        }
    }

    $stmt = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/global.css" type="text/css" rel="stylesheet">
    <link href="css/posts.css" type="text/css" rel="stylesheet">
    <script src="js/login-register-form.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/AJAX.js"></script>
</head>

<body>
    <?php include '../navbar.php'; ?>
    <!-- Button trigger modal -->

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <?php if ($stmt): ?>
    <div id="all_posts">
        <div class="posts">
            <?php while($row = $stmt->fetch()): ?>
            <h2><?= $row['title'] ?></h2>
            <p>
                <small>
                    <?= $row['date'] ?>
                    <a href="./Edit?id=<?= $row['id'] ?>">edit</a>
                </small>
            </p>
            <div class="blog_content">
                <?php $truncated_content = substr($row['content'], 0, 200) . '...'; ?>
                <?php if(strlen($row['content']) > 200): ?>
                <p><?=$truncated_content?><a href="fullpost.php?id=<?=$row['id'] ?>">Read Full Blog</a></p>
                <?php else: ?>
                <P><?= $row['content'] ?></p>
                <?php endif ?>
            </div>
            <div>
                <?= $row['image'] ?>
            </div>
            <?php endwhile ?>
        </div>
    </div>
    <?php else: ?>
    <p>There are no blog posts.</p>
    <?php endif ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="upload.php"enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <input type="text" class="form-control" id="content" name="content" placeholder="Content">
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-label">Default file input example</label>
                            <input class="form-control" type="file" id="image" name="image">

                        </div>
                        <input type="submit" name="command" value="Create" class="btn btn-primary">
                    </form>
                </div>
                <div class="modal-footer">
                    FOOTER
                </div>
            </div>
        </div>
    </div>
</body>

</html>