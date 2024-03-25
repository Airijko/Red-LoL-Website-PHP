<?php

    session_start();

    require('../backend/db_connect.php');
    
    $post_id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->execute(array(':id' => $post_id));
    $post = $stmt->fetch();

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
            <div class="col-md-8">
                <div class="container container-lg post-container">
                    <form method="post" action="./Edit">
                        <div class="card">
                            <?php if ($post['file'] == NULL): ?>
                            <?php else: ?>
                            <img class="object-fit-cover" src="pages/images/<?= $post['file'] ?>" class="card-img-top"
                                alt="<?= $post['title'] ?>">
                            <?php endif ?>
                            <div class="card-body edit-card-body">
                                <h1><?= $post['title']?></h1>
                                <p><?= $post['content']?></p>
                                <p class="card-text"><small>Last Updated:
                                        <?= $post['edited_date'] ?></small></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>