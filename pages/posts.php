<?php 

  include '../validation/registerValidation.php';
  include 'login.php'; 
  include 'register.php'; 

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/global.css" type="text/css" rel="stylesheet">
        <script src="js/login-register-form.js"></script>
    </head>
    <body>
        <?php include '../navbar.php'; ?>
        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form method="POST">
            <label for="username">Username</label>
            <input type="text" name="username"><br><br>

            <label for="email">Email</label>
            <input type="email" name="email"><br><br>

            <label for="password">Password</label>
            <input type="password" name="password"><br><br>

            <label for="confirm-password">Confirm Password</label>
            <input type="password" name="confirm-password"><br><br>

            <label for="phone">Phone Number</label>
            <input type="text" name="phone"><br><br>

            <label for="gender">Gender</label><br>
            <input type="radio" name="gender" value="male"> Male<br>
            <input type="radio" name="gender" value="female"> Female<br><br>

            <input type="submit" value="Submit">
        </form>
    </body>
</html>
