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

<body>
    <?php include "./auth-club.php"; ?>


    <form id="showRegistrations" action="clubportal.php" method="post">
        <input type="hidden" name="doShowRegs" hidden>
        <input type="submit" value="Show Registrations">
    </form>
    <!-- create a table showing all the registrations -->

    <form id="removeClub" action="clubportal.php" method="post">
        <input type="hidden" name="doRemove" hidden>
        <input type="submit" value="Delete club">
    </form>
    <!-- remove the club from club domains,club and user -->

    <form id="showResults" action="clubportal.php" method="post">
        <input type="hidden" name="doShowResults" hidden>
        <input type="submit" value="Show Results">
    </form>

    <form id="editQuestions" action="club-edit.php" method="post">
        <input type="hidden" name="doEditQuestions" hidden>
        <input type="submit" value="Edit Questions">
    </form>

    <?php
    if (isset($_POST['doShowRegs'])) {
        $conn = mysqli_connect("localhost", "root", "", "my_db");
        $name = $_SESSION['name'];
        $name = mysqli_real_escape_string($conn, $name);
        $query = "SELECT * FROM registered_club WHERE name = '$name'";
        $result = mysqli_query($conn, $query);
        $result_assoc = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo "<style>table, th, td { border: 2px solid black; padding: 2px; } </style>";
        echo "<table class='table-sm table-bordered table-hover'>";
        echo "<tr><th scope='col'>Student name</th><th scope='col'>Register number</th></tr>";
        foreach ($result_assoc as $student) {
            $name = mysqli_real_escape_string($conn, $student['user_id']);
            $query2 = "SELECT fname, lname FROM student WHERE user_id = '$name'";
            $result2 = mysqli_query($conn, $query2);
            $result2_assoc = mysqli_fetch_assoc($result2);
            $stuname = $result2_assoc['fname'] . " " . $result2_assoc['lname'];
            $regno = $student['regno'];
            echo "<tr><td>$stuname</td><td>$regno</td></tr>";
        }
        echo "</table>";
    } else if (isset($_POST['doRemove'])) {
        $removed = $_SESSION['username'];
    ?>
        <form action="club-delete.php" method="POST" id="removalForm">
            <input hidden name="theRemoved" value="<?= $removed ?>">
            <input hidden name="userInput" id="theUserInput">
        </form>
        <script>
            result = window.prompt("Are you sure you want to delete the club? Enter the name <?= $removed ?> to proceed.");
            document.getElementById("theUserInput").value = result;
            document.getElementById("removalForm").submit();
        </script>
    <?php
    } else if (isset($_POST['doShowResults'])) {
        $conn = mysqli_connect("localhost", "root", "", "my_db");
        $name = $_SESSION['name'];
        $name = mysqli_real_escape_string($conn, $name);
        $query = "SELECT * FROM registered_club WHERE name = '$name'";
        $result = mysqli_query($conn, $query);
        $results = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo "<table><tr><th>User id</th><th>Register number</th></tr>";
        foreach ($results as $r) {
            $uid = $r['user_id'];
            $regno = $r['regno'];
            echo "<tr><td>$uid</td><td>$regno</td></tr>";
        }
        echo "</table>";
    }
    ?>
</body>

</html>