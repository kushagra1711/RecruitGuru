<!DOCTYPE html>

<html>
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
                left: 0;
            }

            .copyPasta {
                font-family: "IBM Plex Mono", monospace;
                font-size: 1rem;
            }

            .containers {
                width: 50%;
                text-align: center;
                align-items: center;
                margin-top: 3%;
            }
        </style>
    </head>

    <body>
        <?php include "./navbar-template.php"; ?>

        <?php
        if (isset($_POST['edit-club-submit'])) {
            $conn = mysqli_connect("localhost", "root", "", "my_db");
            $username = $_POST['clubname'];
            $hasDesign = $_POST['hasDesign'];
            $hasManagement = $_POST['hasManagement'];
            $hasTechnical = $_POST['hasTechnical'];
            $design = isset($_POST['design']);
            $management = isset($_POST['management']);
            $technical = isset($_POST['technical']);

            if ($hasDesign == "1") {
                $query = "DELETE FROM club_domain WHERE user_id = '$username' AND domain_offering = 'design'";
                $result = mysqli_query($conn, $query);
            }
            if ($hasManagement == "1") {
                $query = "DELETE FROM club_domain WHERE user_id = '$username' AND domain_offering = 'management'";
                $result = mysqli_query($conn, $query);
            }
            if ($hasTechnical == "1") {
                $query = "DELETE FROM club_domain WHERE user_id = '$username' AND domain_offering = 'technical'";
                $result = mysqli_query($conn, $query);
            }

            if ($design) {
                $query = "INSERT INTO club_domain VALUES('$username', 'design', 0)";
                $result = mysqli_query($conn, $query);
            }
            if ($management) {
                $query = "INSERT INTO club_domain VALUES('$username', 'management', 0)";
                $result = mysqli_query($conn, $query);
            }
            if ($technical) {
                $query = "INSERT INTO club_domain VALUES('$username', 'technical', 0)";
                $result = mysqli_query($conn, $query);
            }
            mysqli_close($conn);
        }
        ?>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "my_db");
        if (!$conn) {
            die(mysqli_error($conn));
        }

        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $username = $_POST['clubname'];
        $query = "SELECT * FROM club WHERE user_id = '$username'";
        $result = mysqli_query($conn, $query);

        $result_assoc = mysqli_fetch_assoc($result);
        extract($result_assoc);

        $query2 = "SELECT * FROM club_domain WHERE user_id = '$username'";
        $result2 = mysqli_query($conn, $query2);
        $domains = array();
        while ($result2_assoc = mysqli_fetch_assoc($result2)) {
            $domains[] = $result2_assoc['domain_offering'];
        }

        $design = in_array("design", $domains);
        $management = in_array("management", $domains);
        $technical = in_array("technical", $domains);
        ?>
        <div class="container-row">
            <div class="layer1 editOuter containers">
                <form id="club-apply" class="editDescForm" action="club-edit-desc.php" method="POST">
                    <p>Edit description</p>
                    <textarea name="question2" class="form-control"><?= $description; ?></textarea>
                    <p>Edit image URL</p>
                    <textarea name="question3" class="form-control"><?= $linkforimage; ?></textarea>
                    <br>
                    <div class="form-group domains">
                        <div class="domains-box">
                            Domains Recruiting:
                        </div>
                        <br>
                        <div class="domain-checks">
                            <div>
                                <input type="checkbox" name="design"
                                       id="design" <?php $design ? print("checked") : print
                                    (""); ?>>
                                <label for="design" class="copyPasta">Design</label>
                            </div>
                            <div>
                                <input type="checkbox" name="management"
                                       id="management" <?php $management ? print("checked") : print("");
                                ?>>
                                <label for="management" class="copyPasta">Management</label>
                            </div>
                            <div>
                                <input type="checkbox" name="technical" id="technical" <?php $technical ? print
                                    ("checked") : print("");
                                ?>>
                                <label for="technical" class="copyPasta">Technical</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="Submit" name="edit-club-submit">
                    <input type="hidden" value="<?= $username ?>" name="clubname" hidden>
                    <input type="hidden" value="<?= $design ?>" name="hasDesign" hidden>
                    <input type="hidden" value="<?= $management ?>" name="hasManagement" hidden>
                    <input type="hidden" value="<?= $technical ?>" name="hasTechnical" hidden>
                </form>

                <?php
                mysqli_close($conn);
                ?>

            </div>
            <div id="particles-js" class="layer2"></div>
        </div>

        <?php include "./particles.php"; ?>
    </body>
</html>