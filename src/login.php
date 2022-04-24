<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>RecruitGuru</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <?php include "./scripts.php"; ?>
        <link rel="stylesheet" href="css/template.css">
    </head>

    <body>
        <?php
        session_start();
        if (session_id() != '') {
            $conn = mysqli_connect("localhost", "root", "", "my_db");
            $username = $_SESSION['username'];
            $username = mysqli_real_escape_string($conn, $username);
            $query = "SELECT * FROM user WHERE user_id = '$username'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $result_assoc = mysqli_fetch_assoc($result);
                $type = $result_assoc['type'];
                if ($type == "student") {
                    die(header("Location: populate.php"));
                } else {
                    die(header("Location: clubportal.php"));
                }
            }
        }
        ?>
        <?php include "./basic-navbar-template.php"; ?>

        <!--create signup form -->
        <div class="container-row">
            <div class="layer1">
                <div class="smthin">
                    <div class="container">
                        <br>
                        <form action="auth-redirect.php" method="post" role="form">
                            <input type="text" class="input" name="username" id="username" placeholder="Username"
                                   required>
                            <br>
                            <input type="password" class="input" name="password" id="password" placeholder="Password"
                                   required>
                            <br> <br>
                            <input type="submit" name="login-submit" id="login-submit" class="login" value="Log In">
                        </form>
                        <br>
                        <a href="register_student.php" class="register">Register Student</a>
                        <a href="register_club.php" class="register">Register Club</a>
                    </div>
                </div>
            </div>
            <div id="particles-js" class="layer2"></div>
        </div>

        <?php include "./particles.php"; ?>

    </body>

</html>