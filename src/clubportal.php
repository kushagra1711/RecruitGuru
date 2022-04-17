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
    <!-- <div class="navbarz">
        <nav class="navbar navbar-expand-lg navbar-light navbarz">
            <a class="navbar-brand" href="#"> <span class="mainlogoname"> RecruitGuru</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li><a class="nav-link nav-item" href="#">Home <span class="sr-only">(current)</span></a></li>
                    <li><a class="nav-link nav-item" href="#">Link</a></li>
                </ul>
            </div>
        </nav>
    </div> -->
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

    <?php
    if (isset($_POST['doShowRegs'])) {
        $conn = mysqli_connect("localhost", "root", "", "my_db");
        $name = $_SESSION['name'];
        $name = mysqli_real_escape_string($conn, $name);
        $query = "SELECT * FROM registered_club WHERE name = '$name'";
        $result = mysqli_query($conn, $query);
        $result_assoc = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo "<style>table, th, td { border: 2px solid black; padding: 2px; } </style>";
        echo "<table>"; // <----------------------------------------------------
        echo "<tr><th>Student name</th><th>Register number</th></tr>";
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
    }
    ?>

    <button>Show Results</button>
</body>

</html>