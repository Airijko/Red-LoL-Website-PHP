<?php

    session_start();

    require __DIR__ . '/../backend/db_connect.php';

    if ($_POST && isset($_POST['title']) && isset($_POST['content'])) {
        $query = "INSERT INTO posts (title, content, image) VALUES (:title, :content, :file)";
        $stmt = $db->prepare($query);
    
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':file', $image);
        $stmt->bindValue(':user_id', $_SESSION['user_id']);
        
        $stmt->execute();
    
        if (strlen($title) < 1 || strlen($content) < 1) {
            echo "cannot leave title or content blank.";
            exit;
        }
    }

    // SORT DATA FROM DROP MENU
    $sort_option = "date DESC"; // sets default option
    if(isset($_GET['sort']))
    {
        if ($_GET['sort'] == "latest")
        {
            $sort_option = "date DESC";
        }
        elseif ($_GET['sort'] == "oldest")
        {
            $sort_option = "date ASC";
        }
        elseif ($_GET['sort'] == "a-z")
        {
            $sort_option = "title ASC";
        }
        elseif($_GET['sort'] == "z-a")
        {
            $sort_option = "title DESC";
        }
    }

    $stmt = $db->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY $sort_option");
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
    <?php include '../pages/login.php'; ?>
    <div class="container container-fluid main-container">
        <div class="row">
            <div class="col-md-2 position-relative">
                <div class="container container-sm options-container">
                    <form action="" method="GET">
                        <div class="input-group">
                            <select name="sort" class="form-control">
                                <option value="latest" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'latest');?>>
                                    Latest</option>
                                <option value="oldest" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'oldest');?>>
                                    Oldest</option>
                                <option value="a-z" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'a-z');?>>
                                    A-Z</option>>A-Z</option>
                                <option value="z-a" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'z-a');?>>
                                    A-Z</option>
                            </select>
                            <button type="submit" class="input-group-text btn btn-primary">Sort</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7 position-relative">
                <div class="container container-lg post-container">
                    <?php if ($stmt->rowCount() > 0): ?>
                    <div class="posts">
                        <!-- fetch data from the database and loop through it -->
                        <?php while($row = $stmt->fetch()): ?>
                        <div class="card" style="padding: 10px;">
                            <?php if ($row['file'] == NULL): ?>
                            <?php else: ?>
                            <img class="object-fit-cover" src="pages/images/<?= $row['file'] ?>" class="card-img-top"
                                alt="<?= $row['title'] ?>">
                            <?php endif ?>
                            <div class="card-body">
                                <h3 class="card-title fw-bold"><?= $row['title'] ?></h3>
                                <p class="card-text">
                                    <?= substr($row['content'], 0, 100) ?>
                                    <?php if (strlen($row['content']) > 100): ?>
                                    ...
                                    <?php endif ?>
                                </p>
                                <p class="card-text"><small>Submitted by: <?= $row['username'] ?>
                                        on <?= $row['date'] ?></small></p>
                                <a href="FullPost?id=<?= $row['id'] ?>" class="btn fw-bold text-primary">View Full
                                    Post</a>
                                <?php if (isset($_SESSION['id']) && isset($row['user_id']) && $_SESSION['id'] == $row['user_id']): ?>
                                <a href="./Edit?id=<?= $row['id'] ?>" class="btn btn-info">Edit</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <br>
                        <?php endwhile ?>
                    </div>

                    <!-- if there are no posts -->
                    <?php else: ?>
                    <div class="card">
                        <div class="card-body">
                            <?php if (isset($_SESSION["id"])): ?>
                            <p class="text-center fw-bold">Be the first one to post!</p>
                            <button type="button" class="btn btn-success w-100 createPostButton" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Create Post
                            </button>
                            <?php else: ?>
                            <p class="text-center fw-bold">Login and be the first one to post!</p>
                            <?php endif ?>
                        </div>
                    </div>
                    <?php endif ?>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="./Upload" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Title">
                                            <div id="postTitleError"
                                                style="display: none; color: red; text-shadow: 0 0 10px black;">
                                                Missing a title</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <input type="text" class="form-control" id="content" name="content"
                                                placeholder="Content">
                                            <div id="contentTitleError"
                                                style="display: none; color: red; text-shadow: 0 0 10px black;">
                                                Missing a content</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="file" class="form-label">Upload File</label>
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
                </div>
            </div>
            <!-- Side bar -->
            <div class="col-md-3 position-relative">
                <div class="container container-sm sidebar-container">
                    <!-- Button trigger modal -->
                    <?php if (isset($_SESSION["id"])): ?>
                    <button type="button" class="btn btn-danger w-100 createPostButton" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Create Post
                    </button>
                    <?php else: ?>
                    <button type="button" class="btn btn-success w-100 elsePostButton" data-bs-toggle="modal"
                        data-bs-target="#toggleLoginModal">
                        Login
                    </button>
                    <?php endif ?>
                    <?php if (isset($_SESSION["username"])): ?>
                    <h4 class="text-uppercase fw-bold">Welcome, <?= $_SESSION["username"]; ?>!</h4>
                    <?php else: ?>
                    <h4>Not logged in</h4>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>