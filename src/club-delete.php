<!DOCTYPE html>

<html>

<head>
    <title>
        Document
    </title>
</head>

<body>
    <?php
    if (isset($_POST['theRemoved'])) {
        $theRemoved = $_POST['theRemoved'];
        $userInput = $_POST['userInput'];
        if ($theRemoved == $userInput) {
            echo "Successfully deleted the club '$theRemoved'";
        } else {
            echo "Error: Club name is incorrect";
            echo "<a href='login.php'>Go back</a>";
        }
    }
    ?>
</body>

</html>