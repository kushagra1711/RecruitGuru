<!DOCTYPE html>

<html>

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
    include "./auth-club.php";

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    if (session_id() != '' && isset($_POST['theRemoved'])) {
        $theRemoved = $_POST['theRemoved'];
        $userInput = $_POST['userInput'];
        if ($theRemoved == $userInput) {
            $conn = mysqli_connect("localhost", "root", "", "my_db");

            $username = $_SESSION['username'];
            $username = mysqli_real_escape_string($conn, $username);

            $query = "SELECT name FROM club WHERE user_id = '$username'";

            $result = mysqli_query($conn, $query);
            $result_assoc = mysqli_fetch_assoc($result);

            $name = $result_assoc['name'];
            $name = mysqli_real_escape_string($conn, $name);

            $query = "DELETE FROM answers WHERE name = '$name'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

            $query = "DELETE FROM clublisting WHERE name = '$name'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

            $query = "DELETE FROM registered_club WHERE name = '$name'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

            $query = "DELETE FROM club_domain WHERE user_id = '$username'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

            $query = "DELETE FROM club WHERE user_id = '$username'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

            $query = "DELETE FROM user WHERE user_id = '$username'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

            echo "Successfully deleted the club '$theRemoved'";
            echo "<a href='login.php'>Go back</a>";
        } else {
            echo "Error: Club name is incorrect";
            echo "<a href='login.php'>Go back</a>";
        }
    }
    ?>
</body>

</html>