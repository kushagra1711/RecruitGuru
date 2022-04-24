<!DOCTYPE html>

<html>

    <head>

        <head>
            <meta charset="UTF-8"/>
            <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <title>RecruitGuru</title>
            <?php include "./scripts.php"; ?>
            <link rel="stylesheet" href="css/template.css">
            <style>
                .marginer {
                    margin-top: 5%;
                    font-family: "IBM Plex Mono", monospace;
                    font-size: 1rem;
                }

                .copyPasta {
                    font-family: "IBM Plex Mono", monospace;
                    font-size: 1rem;
                }
            </style>
        </head>
    </head>

    <body>
        <?php
        include "./auth-club.php";
        ?>

        <div class="marginer">
            <center>


                <?php
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
                <div class="container-row">
                    <div class="layer1">
                        <form id="editQuestions" action="club-edit.php" method="POST">
                            <p>Question 1</p>
                            <textarea name="question1"><?= $question1; ?></textarea>
                            <p>Question 2</p>
                            <textarea name="question2"><?= $question2; ?></textarea>
                            <p>Question 3</p>
                            <textarea name="question3"><?= $question3; ?></textarea>
                            <br>
                            <input type="checkbox"
                                   name="applications_open" <?php $applications_open == "1" ? print("checked") : print(""); ?>>
                            <label for="applications_open" class="copyPasta">Open for Responses</label>
                            <br>
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
                            ?>
                            <div id="editSuccess">
                                <p>Successfully edited the questions!</p>
                                <br>
                                <a href="clubportal.php"> Return to club portal </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div id="particles-js" class="layer2"></div>

                </div>

                <?php include "./particles.php"; ?>


            </center>
        </div>
    </body>

</html>