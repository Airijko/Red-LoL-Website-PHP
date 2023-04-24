 <?php

    require('../backend/db_connect.php');
        
    if ($_POST && isset($_POST['id']) && isset($_POST['title']) && isset($_POST['content'])) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $title   = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (strlen($title) < 1 || strlen($content) < 1) {
            echo "cannot leave title or content blank.";
            exit;
        }

        if ($_POST['command'] == "Update") {
            $query = "UPDATE blog SET title = :title, content = :content WHERE id = :id";
            $statement = $db->prepare($query);

            $statement->bindValue(':title', $title);
            $statement->bindValue(':content', $content);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            
            $statement->execute();

            header("Location: index.php?id={$id}");
            exit;
        }

        if ($_POST['command'] == "Delete") {
            $query = "DELETE FROM blog WHERE id = :id";
            $statement = $db->prepare($query);
            
            $statement->bindValue(':id', $id, PDO::PARAM_INT);

            $statement->execute();

            header("Location: index.php");
            exit;
        }
        
    } 
    if (isset($_GET['id'])) { // Retrieve blog to be edited, if id GET parameter is in URL.
        // Sanitize the id. Like above but this time from INPUT_GET.
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        // Build the parametrized SQL query using the filtered id.
        $query = "SELECT * FROM blog WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
        // Execute the SELECT and fetch the single row returned.
        $statement->execute();
        $row = $statement->fetch();

    } else {
        $id = false; // False if we are not UPDATING or SELECTING.
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>PDO Insert</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
</head>

<body>
    <?= $id ?>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Epic Blogs - New Post</a></h1>
        </div>
        <?php include('navbar.php'); ?>
        <form method="post" action="edit.php">
            <fieldset>
                <legend>New Blog Post</legend>
                <p>
                    <label for="title">Title</label>
                    <input name="title" id="title" value="<?= $row['title']?>">
                </p>
                <p>
                    <label for="content">Content</label>
                    <textarea name="content" id="content"> <?= $row['content']?></textarea>
                </p>
                <p>
                    <input type="hidden" name="id" value="<?= $row['id']?>">
                    <input type="submit" name="command" value="Update">
                    <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you want to delete the post?')">
                </p>
            </fieldset>
        </form>
    </div>
</body>

</html>