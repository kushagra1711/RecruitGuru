<!DOCTYPE html>

<?php session_start() ?>

<html>

    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>RecruitGuru</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <?php include "./scripts.php" ?>
        <link rel="stylesheet" href="css/template.css">
        <style>
            .marginer {
                margin-top: 5%;
                font-family: "IBM Plex Mono", monospace;
                font-size: 1.6rem;
                width: 100%;
            }

            .result {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .result p {
                margin-bottom: 2rem;
            }

            .result a {
                background-color: var(--green);
                padding: 1rem;
                color: white;
                border-radius: 5px;
                /*margin: 5px 1rem 1rem;*/
                margin-bottom: 1rem;
                font-family: "IBM Plex Mono", monospace;
            }

            .result a:hover {
                color: var(--dark);
                text-decoration: none;
            }
        </style>
    </head>

    <body>

        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        if (isset($_POST['login-submit'])) {
            $conn = mysqli_connect("localhost", "root", "", "my_db");
            $username = $_POST['username'];
            $username = mysqli_real_escape_string($conn, $username);
            $password = md5($_POST['password']);
            $query = "SELECT * FROM user WHERE user_id = '$username' AND password = '$password'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 1) {
                echo "You are being redirected.";
                $result_assoc = mysqli_fetch_assoc($result);
                $_SESSION['username'] = $_POST['username'];
                $type = $result_assoc['type'];
                if ($type == "student") {
                    $query = "SELECT * FROM student WHERE user_id = '$username'";
                    $result = mysqli_query($conn, $query);
                    $result_assoc = mysqli_fetch_assoc($result);
                    $_SESSION['name'] = $result_assoc['fname'] . " " . $result_assoc['lname'];
                    $_SESSION['fname'] = $result_assoc['fname'];
                    $_SESSION['lname'] = $result_assoc['lname'];
                    $_SESSION['regno'] = $result_assoc['regno'];

                    die(header("Location: populate.php"));
                } else {
                    $query = "SELECT * FROM club WHERE user_id = '$username'";
                    $result = mysqli_query($conn, $query);
                    $result_assoc = mysqli_fetch_assoc($result);
                    $_SESSION['name'] = $result_assoc['name'];

                    die(header("Location: clubportal.php"));
                }
            } else {
                include "./basic-navbar-template.php";
                ?>
                <div class="marginer">
                    <div class="result">
                        <p>Error: Username or password is incorrect</p>
                        <a href="login.php">
                            Go back
                        </a>
                    </div>
                </div>
                <?php
            }
        } else if (isset($_POST["apply-club"]) && isset($_SESSION['name'])) {
            $_SESSION['clubname'] = $_POST['clubname'];
            die(header("Location: apply.php"));
        }
        ?>
    </body>

</html>