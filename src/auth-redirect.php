<!DOCTYPE html>

<?php session_start() ?>

<html>

<head>
    <title>
        Document
    </title>
</head>

<body>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if (isset($_POST['login-submit'])) {
        $conn = mysqli_connect("localhost", "root", "", "my_db");
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $query = "SELECT * FROM user WHERE user_id = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            echo "You are being redirected.";
            $_SESSION['username'] = $_POST['username'];
            die(header("Location: populate.php"));
        } else {
            echo '<p class="text-center">Username or password is incorrect</p>';
        }
    }
    ?>
</body>

</html>