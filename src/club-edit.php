<!DOCTYPE html>

<html>

<head>

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
</head>

<body>
    <?php
    include "./auth-club.php";

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $conn = mysqli_connect("localhost", "root", "", "my_db");

    $username = $_SESSION['username'];
    $username = mysqli_real_escape_string($conn, $username);
    $name = $_SESSION['name'];
    $name = mysqli_real_escape_string($conn, $name);

    $query = "SELECT * FROM club WHERE user_id = '$username'";
    $result = mysqli_query($conn, $query);
    $result_assoc = mysqli_fetch_assoc($result);

    $query2 = "SELECT * FROM clublisting WHERE name = '$name'";
    $result2 = mysqli_query($conn, $query2);
    $result_assoc2 = mysqli_fetch_assoc($result2);

    $applications_open = $result_assoc['applications_open'];
    $question1 = $result_assoc2['question1'];
    $question2 = $result_assoc2['question2'];
    $question3 = $result_assoc2['question3'];
    ?>
    <form id="editQuestions" action="club-edit.php" method="POST">
        <p>Question 1</p>
        <textarea name="question1"><?= $question1; ?></textarea>
        <p>Question 2</p>
        <textarea name="question2"><?= $question2; ?></textarea>
        <p>Question 3</p>
        <textarea name="question3"><?= $question3; ?></textarea>
        <input type="checkbox" name="applications_open" <?php $applications_open == "1" ? print("checked") : print(""); ?>>
        <input type="submit" value="Submit" name="submit">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $question1 = $_POST['question1'];
        $question1 = mysqli_real_escape_string($conn, $question1);
        $question2 = $_POST['question2'];
        $question2 = mysqli_real_escape_string($conn, $question2);
        $question3 = $_POST['question3'];
        $question3 = mysqli_real_escape_string($conn, $question3);

        $applications_open = isset($_POST['applications_open']) ? 1 : 0;

        $query = "UPDATE clublisting SET question1 = '$question1', question2 = '$question2', question3 = '$question3' WHERE name = '$name'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $query2 = "UPDATE club SET applications_open = '$applications_open' WHERE user_id = '$username'";
        $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
        echo "Successfully edited the club";
    }
    ?>
</body>

</html>