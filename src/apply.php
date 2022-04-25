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

    <body id="applyBody">
        <?php
        include "./navbar-template.php";
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ?>

        <!-- print 3 text inputs with questions and a submit button -->
        <div class="container-row">
            <div class="layer1">
                <div id="applyForm">
                    <form id="applyClub" action="apply.php" method="post">
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "my_db");
                        $clubname = $_SESSION['clubname'];
                        $clubname = mysqli_real_escape_string($conn, $clubname);

                        $query = "SELECT * FROM clublisting WHERE name = '$clubname'";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        $question1 = $row['question1'];
                        $question2 = $row['question2'];
                        $question3 = $row['question3'];
                        ?>
                        <p>Question 1. <?= $question1 ?></p>
                        <textarea name='answer1' id='answer1'></textarea>
                        <p>Question 2. <?= $question2 ?></p>
                        <textarea name='answer2' id='answer2'></textarea>
                        <p>Question 3. <?= $question3 ?></p>
                        <textarea name='answer3' id='answer3'></textarea>
                        <br>
                        <input type='submit' value='Apply' name='applied' id="applyButton">
                        <?php
                        mysqli_close($conn);
                        ?>
                    </form>
                </div>
            </div>
            <div id="particles-js" class="layer2"></div>
        </div>

        <?php include "./particles.php"; ?>


        <?php
        // print_r($_POST);
        if (isset($_POST['applied'])) {
            $conn = mysqli_connect("localhost", "root", "", "my_db");

            $name = $_SESSION['clubname'];
            $name = mysqli_real_escape_string($conn, $name);

            $regno = $_SESSION['regno'];

            $username = $_SESSION['username'];
            $username = mysqli_real_escape_string($conn, $username);

            $answer1 = $_POST['answer1'];
            $answer1 = mysqli_real_escape_string($conn, $answer1);
            $answer2 = $_POST['answer2'];
            $answer2 = mysqli_real_escape_string($conn, $answer2);
            $answer3 = $_POST['answer3'];
            $answer3 = mysqli_real_escape_string($conn, $answer3);

            $query = "INSERT INTO answers (name, regno, answer1, answer2, answer3) VALUES ('$name','$regno','$answer1', '$answer2', '$answer3')";
            $query2 = "INSERT INTO registered_club (user_id, name, regno) VALUES ('$username', '$name', '$regno')";

            if (mysqli_query($conn, $query2) && mysqli_query($conn, $query)) {
                echo "<script>alert('You have Successfully applied for $name')</script>";
                die(header("Location: populate.php"));
            } else {
                echo "Unable to apply for club: " . mysqli_error($conn) . "<br>";
            }
        }
        ?>
    </body>
</html>