<!DOCTYPE html>

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
    session_start();
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
        } else {
            echo "Error: Club name is incorrect";
            echo "<a href='login.php'>Go back</a>";
        }
    }
    ?>
</body>

</html>