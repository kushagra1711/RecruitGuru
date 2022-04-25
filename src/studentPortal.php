<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RecruitGuru</title>
    <?php include "./scripts.php"; ?>
    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/card.css">

    <style>
        .cutie {
            background-color: #37BEB0;
            width: fit-content;
            padding: .5rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            color: white;
        }
    </style>

</head>

<body>
    <?php include "./auth-stud.php"; ?>
    <div class="container-row">
        <center>

            <div class="layer1">
                <div class="marginer w-90%">
                    <div>
                        <br>
                        <br>
                        <div class="pl-1 rounded-xl mr-4 group sm:flex flex-col space-x-6 w-fit bg-white
                        bg-opacity-50 shadow-xl hover:rounded-2xl club-card items-center justify-center min-w-fit">
                            <div class="sm:flex flex-row items-center justify-center w-full">
                                <div id="clubControls">
                                    <form id="showRegistrations" action="studentPortal.php" method="post">
                                        <input type="hidden" name="doShowRegs" hidden>
                                        <input type="submit" value="Show Registrations">
                                    </form>
                                    <!-- remove the club from club domains,club and user -->
                                    <form id="editDetails" action="stud-edit.php" method="post">
                                        <input type="hidden" name="doEditDetails" hidden>
                                        <input type="submit" value="Edit Details">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <br><br><br>

                    <!-- extracting names of clubs registered for by the students from registered_club when show registrations is clicked -->
                    <?php
                    if (isset($_POST['doShowRegs'])) {
                        $conn = mysqli_connect("localhost", "root", "", "my_db");
                        $username = $_SESSION['username'];
                        $username = mysqli_real_escape_string($conn, $username);
                        $sql = "SELECT * FROM registered_club where user_id = '$username'";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if ($resultCheck > 0) {
                            echo "<div class='styledTable'><table class='table-bordered table-hover'>";
                            echo "<tr>";
                            echo "<th class='cols'>Club Name</th>";
                            echo "<th class='cols'>Student Name</th> <th class='cols'>Withdraw Registration</th>";
                            echo "</tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td class='cols'>" . $row['name'] . "</td>";
                                echo "<td class='cols'>" . $row['regno'] . "</td>";
                                echo "<td class='cols'><form id='removeRegistration' class='cutie' action='studentPortal.php' method='post'> <input type='hidden' value = '" . $row['name'] . "' name='doRemove' hidden><input type='submit' value='Yes'> </form></td>";
                                echo "</tr>";
                            }
                            echo "</table></div>";
                        }
                    }
                    if (isset($_POST['doRemove'])) {
                        $conn = mysqli_connect("localhost", "root", "", "my_db");
                        $clubname = $_POST['doRemove'];
                        $clubname = mysqli_real_escape_string($conn, $clubname);
                        $username = $_SESSION['username'];
                        $regno = $_SESSION['regno'];
                        $username = mysqli_real_escape_string($conn, $username);
                        $regno = mysqli_real_escape_string($conn, $regno);
                        $sql = "DELETE FROM registered_club WHERE name = '$clubname' AND user_id = '$username'";
                        $sql2 = "delete from answers where name = '$clubname' and regno = '$regno'";
                        if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
                            echo "<script>alert('Registration Removed')</script>";
                            die(header("Location: studentPortal.php"));
                        }
                    }
                    ?>
                </div>
            </div>
        </center>
        <div id="particles-js" class="layer2"></div>
    </div>

    <?php include "./particles.php"; ?>
</body>

</html>