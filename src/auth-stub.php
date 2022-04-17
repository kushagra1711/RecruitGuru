<html>

<?php session_start() ?>

<?php
if (!isset($_SESSION['username'])) {
    die(header("Location: login.php"));
} else {
?>
    <form action="auth-logout.php" method="post">
        <input type="submit" name="logout-submit" value="Logout">
    </form>
<?php
}
?>

</html>