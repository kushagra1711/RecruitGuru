<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <?php
    include "./navbar-template.php";
    ?>

    <!-- print 3 text inputs with questions and a submit button -->
    <form id="createClub" action="clubportal.php" method="post">

        <p><?php echo "Question 1"; ?></p>
        <input type="text" name="answer1" id="answer1">
        <p><?php echo "Question 2"; ?></p>
        <input type="text" name="answer2" id="answer2">
        <p><?php echo "Question 3"; ?></p>
        <input type="text" name="answer3" id="answer3">

        <input type="submit" value="apply">

    </form>

    <?php

    $conn = mysqli_connect("localhost", "root", "", "my_db");
    $name = $_SESSION('username');
    $name = mysqli_real_escape_string($conn, $name);
    $query = "insert into answers (name,regno,answer1, answer2, answer3) values (name,regno,'$answer1', '$answer2', '$answer3')";
    $query2 = "insert into registered_club (user_id, name, regno) values ('$name', '$club_id', '$regno')";
    ?>



</body>

</html>