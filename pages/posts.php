<?php

    include '../pages/login.php';
    include '../pages/register.php';
    require('../backend/db_connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/global.css" type="text/css" rel="stylesheet">
    <link href="css/posts.css" type="text/css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/AJAX.js"></script>
</head>
<body>
    <?php include '../navbar.php'; ?>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="Upload" enctype="multipart/form-data">
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
                            <input class="form-control" type="file" id="file" name="file">
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary">
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