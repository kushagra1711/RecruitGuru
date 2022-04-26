<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RecruitGuru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php include "./scripts.php"; ?>
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "my_db");
    ?>
    <?php include "./basic-navbar-template.php"; ?>

    <!--create signup form -->
    <div class="container-row">
        <div class="layer1">
            <div class="smthin">
                <div class="container">
                    <br>
                    <form action="changePass.php" method="post" role="form">
                        <input type="text" class="input" name="username" id="username" placeholder="Username" required>
                        <br>
                        <input type="password" class="input" name="password" id="password" placeholder="Password" required>
                        <br>
                        <input type="password" class="input" name="password-confirm" id="password" placeholder="Confirm Password" required>
                        <br>
                        <br>
                        <input type="submit" name="change-submit" id="login-submit" class="login" value="change password">
                    </form>
                    <?php

                    if (isset($_POST['change-submit'])) {
                        $username = $_POST['username'];
                        $password = md5($_POST['password']);
                        $password_confirm = md5($_POST['password-confirm']);
                        if ($password == $password_confirm) {
                            $password = mysqli_real_escape_string($conn, $password);
                            $username = mysqli_real_escape_string($conn, $username);
                            $query = "UPDATE user SET password='$password' WHERE user_id = '$username'";
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                echo "<script>alert(Password changed successfully)</script>";
                                die(header("Location: login.php"));
                            } else {
                                echo "<script>alert(Password change failed)</script>";
                            }
                        }
                    }
                    ?>
                </div>
                <br>
            </div>
        </div>
        <div id="particles-js" class="layer2"></div>
    </div>

    <?php include "./particles.php"; ?>

</body>

</html>