<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RecruitGuru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/template.css">
</head>

<body id="applyBody">
    <?php
    include "./navbar-template.php";
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ?>

    <!-- print 3 text inputs with questions and a submit button -->
    <div id="applyForm">
        <center>
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
                <p><?= $question1 ?></p>
                <textarea name='answer1' id='answer1'></textarea>
                <p><?= $question2 ?></p>
                <textarea name='answer2' id='answer2'></textarea>
                <p><?= $question3 ?></p>
                <textarea name='answer3' id='answer3'></textarea>
                <br>
                <input type='submit' value='Apply' name='applied' style=" background-color: #5E7365; padding: 5px; color:white; border-radius:5px; margin-top:5px;">
                <?php
                mysqli_close($conn);
                ?>
            </form>
        </center> 
    </div>

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