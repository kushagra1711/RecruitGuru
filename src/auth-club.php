<!DOCTYPE html>

<?php include "./navbar-template.php";
$conn = mysqli_connect("localhost", "root", "", "my_db");

$username = $_SESSION['username'];
$username = mysqli_real_escape_string($conn,    $username);

$query = "SELECT COUNT(*) FROM club WHERE user_id = '$username'";
$result = mysqli_query($conn, $query);

if (mysqli_fetch_array($result)[0] < 1) {
    die(header("Location: login.php"));
}
mysqli_close($conn);
?>