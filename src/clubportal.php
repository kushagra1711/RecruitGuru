<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>RecruitGuru</title>
        <?php include "./scripts.php"; ?>
        <link rel="stylesheet" href="css/template.css">
        <link rel="stylesheet" href="css/populate.css">
        <style>
            .marginer {
                margin-top: 5%;
            }
        </style>
    </head>

    <body>
        <?php include "./auth-club.php"; ?>
        <div class="container-row">
            <div class="layer1">
                <div class="marginer">
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "my_db");
                    $username = $_SESSION['username'];
                    $username = mysqli_real_escape_string($conn, $username);
                    $query = "SELECT * FROM club WHERE user_id = '$username'";
                    $result = mysqli_query($conn, $query);
                    $result_assoc = mysqli_fetch_assoc($result);
                    $name = $result_assoc['name'];
                    $linkforimage = $result_assoc['linkforimage'];
                    $description = $result_assoc['description'];

                    $query2 = "SELECT * FROM club_domain WHERE user_id = '$username'";
                    $result2 = mysqli_query($conn, $query2);
                    ?>
                    <div class="sm:flex flex-row w-full">
                        <div class="pl-1 rounded-xl mr-4 group sm:flex flex-col space-x-6 bg-white bg-opacity-50
                        shadow-xl hover:rounded-2xl club-card min-w-fit">
                            <div class="sm:flex flex-row min-w-fit">
                                <img src="<?= $linkforimage ?>  " alt="art cover" loading="lazy" width="1000"
                                     height="667"
                                     class="h-36 mt-5 ml-5 sm:h-half w-half sm:w-5/12 object-cover object-center rounded-lg">
                                <div class="sm:w-7/12 pt-5 pr-5 pl-5 min-w-fit">
                                    <div class="space-y-2">
                                        <div class="space-y-4">
                                            <div class="alignment min-w-fit">
                                                <h4 class="clubName"><?= $name ?></h4>
                                                <div class="dom min-w-fit">
                                                    <?php
                                                    while ($domain = mysqli_fetch_assoc($result2)) {
                                                        $domain = $domain['domain_offering'];
                                                        ?>
                                                        <h6 class="domains"><?= $domain ?></h6>
                                                        <?php
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-6 sm:flex flex-col">
                                <p class="description"><?= $description ?></p>
                                <br>
                                <form action="club-edit-desc.php" method="post">
                                    <div class="apply" name="apply-club"><input type="submit" value="Edit"
                                                                                name="apply-club"
                                                                                class="block w-max text-cyan-600">
                                    </div>
                                    <input type="hidden" name="clubname" value="<?= $username ?>" hidden>
                                </form>
                            </div>
                        </div>

                        <div class="pl-1 rounded-xl mr-4 group sm:flex flex-col space-x-6 w-fit bg-white
                        bg-opacity-50 shadow-xl hover:rounded-2xl club-card min-w-fit">
                            <div class="sm:flex flex-row w-full">
                                <div id="clubControls">
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

                                    <form id="editClubQuestions" action="club-edit.php" method="post">
                                        <input type="hidden" name="doEditQuestions" hidden>
                                        <input type="submit" value="Edit Questions">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <br><br><br>

                    <?php
                    if (isset($_POST['doShowRegs'])) {
                        $conn = mysqli_connect("localhost", "root", "", "my_db");
                        $name = $_SESSION['name'];
                        $name = mysqli_real_escape_string($conn, $name);
                        $query = "SELECT * FROM registered_club WHERE name = '$name'";
                        $result = mysqli_query($conn, $query);
                        $result_assoc = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        echo "<div class='styledTable'><table class='table-bordered table-hover'>";
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
                        echo "</table></div>";
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
                        $query = "SELECT * FROM answers WHERE name = '$name'";
                        $result = mysqli_query($conn, $query);
                        $results = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        echo "<div class='styledTable'><table class='table-bordered table-hover'><tr><th>Register number</th><th>Answer 1</th><th>Answer 2</th><th>Answer 3</th></tr>";
                        foreach ($results as $r) {
                            $name = $r['regno'];
                            $a1 = $r['answer1'];
                            $a2 = $r['answer2'];
                            $a3 = $r['answer3'];
                            echo "<tr><td>$name</td><td>$a1</td><td>$a2</td><td>$a3</td></tr>";
                        }
                        echo "</table></div>";
                    }
                    ?>
                </div>
            </div>
            <div id="particles-js" class="layer2"></div>
        </div>

        <?php include "./particles.php"; ?>
    </body>

</html>