<?php

    ob_start();

    session_start();

    require_once('../backend/authenticate.php');

    require __DIR__ . '/../backend/db_connect.php';

    if ($_POST && isset($_POST['name']) && isset($_POST['content'])) {
        $query = "INSERT INTO reviews (name, content) VALUES (:name, :content)";
        $stmt = $db->prepare($query);
    
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':content', $content);
        
        $stmt->execute();
    
        if (strlen($name) < 1 || strlen($content) < 1) {
            echo "cannot leave title or content blank.";
            exit;
        }
    }

    $stmt = $db->query("SELECT * FROM reviews");

    ob_end_flush();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/global.css" type="text/css" rel="stylesheet">
    <link href="css/reviews.css" type="text/css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/AJAX.js"></script>
    <title>Document</title>
</head>

<body>
    <?php include '../navbar.php'; ?>
    <?php include '../pages/login.php'; ?>
    <div id="container" class="container container-fluid main-container">
        <div class="rows">
            <div class="col-md-12">
                <div class="container container-lg reviews-container">
                    <div class="review-head d-flex justify-content-center align-items-center flex-column">
                        <h1>Reviews</h1>
                        <!-- Button trigger modal -->
                        <a href="./Reviews" class="btn btn-primary">Return to Reviews</a>
                    </div>
                    <div class="review-content">
                        <?php if ($stmt->rowCount() > 0): ?>
                        <div class="reviews">
                            <?php while($row = $stmt->fetch()): ?>
                            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                                <div class="card-header rows justify-content-between align-items-center">
                                    <form method="post" action="DeleteReview">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                    <h2><?=$row['name']?></h2>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?=$row['content']?></p>
                                </div>
                                <div class="card-footer">
                                    <small>Submitted on: <?= $row['date'] ?></small>
                                </div>
                            </div>
                            <?php endwhile ?>
                        </div>
                        <?php else: ?>
                        <p class="text-center text-white">No reviews yet.</p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Submit a Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="./SubmitReview">
                        <div class="modal-body">
                            <div>
                                <label for="name">Name</label>
                                <input name="name" type="text" id="name" class="form-control">
                            </div>
                            <div>
                                <label for="content">Review</label>
                                <textarea name="content" type="text" id="content" class="form-control"
                                    style="min-height: 100px;"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>