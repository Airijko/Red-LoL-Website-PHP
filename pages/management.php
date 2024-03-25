<?php

    ob_start();

    require_once('../backend/authenticate.php');

    require __DIR__ . '/../backend/db_connect.php';

    $stmt = $db->query("SELECT * FROM users");

    // if ($_POST['command'] == "View") {
    //     $query = "UPDATE users SET title = :title, content = :content, edited_date = NOW() WHERE id = :id";
    //     $stmt = $db->prepare($query);

    //     $stmt->bindParam(':title', $title);
    //     $stmt->bindParam(':content', $content);
    //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    //     $stmt->execute();

    //     header("Location: Posts?id={$id}");
    //     exit;
    // } 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['command']) == 'Delete') {
            $post_id = $_POST['id'];
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $post_id);
            $result = $stmt->execute();
            if ($result) {
                header("Location: ./Management?success=delete");
                exit;
            } else {
                header("Location: ./Management?error=delete");
                exit;
            }
        }
    }

    ob_end_flush();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/global.css" type="text/css" rel="stylesheet">
    <link href="css/management.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/createAJAX.js"></script>
</head>

<body>
    <?php include '../includes/register.inc.php'; ?>
    <?php include '../validation/registerValidation.php'; ?>
    <div class="container main-container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUser">
            Add New User
        </button>

        <!-- Modal -->
        <div class="modal register-modal fade" id="createUser" aria-hidden="true" aria-labelledby="toggleRegisterModal"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="create-modal-content modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="toggleRegisterModalLabel">CREATE USER</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="registerForm" class="register-form">
                            <input type="hidden" name="formType" value="register">
                            <div class="input-box">
                                <label for="registerUsername" class="form-label">Username</label>
                                <input class="user-input" type="text" id="registerUsername" name="registerUsername">
                                <div id="usernameError" style="display: none; color: red; text-shadow: 0 0 10px black;">
                                    Please
                                    enter
                                    a
                                    username (3 - 25 characters)</div>
                            </div>
                            <div class="input-box">
                                <label for="email" class="form-label">Email</label>
                                <input class="user-input" type="email" id="email" name="email">
                                <div id="emailError" style="display: none; color: red; text-shadow: 0 0 10px black;">
                                    Please
                                    enter a
                                    valid
                                    email address</div>
                            </div>
                            <div class="input-box">
                                <label for="registerPassword" class="form-label">Password</label>
                                <input class="user-input" type="password" id="registerPassword" name="registerPassword">
                                <div id="passwordError" style="display: none; color: red; text-shadow: 0 0 10px black;">
                                    Please
                                    enter
                                    a
                                    password (8 - 128 characters)</div>
                            </div>
                            <div class="input-box">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input class="user-input" type="password" id="confirmPassword" name="confirmPassword">
                                <div id="confirmPasswordError"
                                    style="display: none; color: red; text-shadow: 0 0 10px black;">
                                    Passwords do
                                    not match</div>
                            </div>
                            <div class="input-box">
                                <label for="phone" class="form-label">Phone</label>
                                <input class="user-input" type="tel" id="phone" name="phone">
                                <div id="phoneError" style="display: none; color: red; text-shadow: 0 0 10px black;">
                                    Please
                                    enter a
                                    valid
                                    phone number</div>
                            </div>
                            <div class="input-box">
                                <label class="form-label d-block">Gender</label>
                                <div class="form-check form-check-inline">
                                    <label for="male"></label>
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">M
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female"
                                        value="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div id="genderError" style="display: none; color: red; text-shadow: 0 0 10px black;">
                                    Please
                                    choose
                                    a gender
                                </div>
                            </div>
                            <button type="submit" name="submit"
                                class="btn btn-primary w-100 btn-outline-light">CREATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="container management-container">
                <div class="rows justify-content-center">
                    <div class="card">
                        <h5 class="card-header">User Management</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-light table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                    <?php if ($stmt->rowCount() > 0): ?>
                                    <tbody>
                                        <?php while ($row = $stmt->fetch()): ?>
                                        <tr>
                                            <td><?= $row['id']; ?></td>
                                            <td><?= $row['username']; ?></td>
                                            <td><?= $row['email']; ?></td>
                                            <td><?= $row['password']; ?></td>
                                            <td><?= $row['phone']; ?></td>
                                            <td><?= $row['gender']; ?></td>
                                            <td>
                                                <form method="post" action="./Management">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" name="command" class="btn btn-success"
                                                        value="View">
                                                        View
                                                    </button>
                                                    <button type="submit" name="command" class="btn btn-danger"
                                                        value="Delete">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endwhile ?>
                                    </tbody>
                                    <?php endif ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>