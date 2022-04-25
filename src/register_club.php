<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>RecruitGuru</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <?php include "./scripts.php" ?>
        <link rel="stylesheet" href="css/template.css">
        <style>
            .containers {
                width: 50%;
                text-align: center;
                align-items: center;
                margin-top: 1%;
            }
        </style>
    </head>

    <body>
        <?php include "./basic-navbar-template.php"; ?>

        <!-- register form  -->
        <div class="container-row">
            <div class="layer1">
                <div class="containers">
                    <form id="club-apply" action="register_club.php" method="post" role="form">
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" required>
                                <option value="club" default>Club</option>
                                <option value="chapter">Chapter</option>
                                <option value="team">Team</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="username" id="username" tabindex="1" class="form-control"
                                   placeholder="Username" value="" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" tabindex="2"
                                   class="form-control"
                                   placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <input type="name_club" name="name_club" id="name_club" tabindex="2"
                                   class="form-control" placeholder="Name of the Club" required>
                        </div>
                        <!-- take inputs for numberofevents,registeration number,description-->
                        <div class="form-group">
                            <input type="number" name="numberofevents" id="numberofevents" tabindex="2"
                                   class="form-control" placeholder="Number of Events" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="registration_number" id="registration_number"
                                   tabindex="2"
                                   class="form-control" placeholder="Registration Number" required>
                        </div>
                        <div class="form-group">
                                <textarea name="description" id="description" tabindex="2" class="form-control"
                                          placeholder="Description" required></textarea>
                        </div>

                        <!-- take input of image as url-->
                        <div class="form-group">
                            <input type="url" name="image" id="image" tabindex="2" class="form-control"
                                   placeholder="Image" required>
                        </div>

                        <div class="form-group domains">
                            <div class="domains-box">
                                Domains Recruiting:
                            </div>
                            <br>
                            <div class="domain-checks">
                                <div>
                                    <input type="checkbox" name="design" id="design" tabindex="2" value="design">
                                    <label for="design">Design</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="management" id="management" tabindex="2"
                                           value="management">
                                    <label for="management">Management</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="technical" id="technical" tabindex="2"
                                           value="technical">
                                    <label for="technical">Technical</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <input type="submit" name="reg-club-submit" id="eg-club-submit" value="Register">
                    </form>
                </div>
            </div>
            <div id="particles-js" class="layer2"></div>
        </div>

        <?php include "./particles.php"; ?>


    </body>
    <?php
    if (isset($_POST['reg-club-submit'])) {
        $conn = mysqli_connect("localhost", "root", "", "my_db");
        $username = $_POST['username'];
        $username = mysqli_real_escape_string($conn, $username);
        $password = md5($_POST['password']);
        $name_club = $_POST['name_club'];
        $name_club = mysqli_real_escape_string($conn, $name_club);
        $numberofevents = $_POST['numberofevents'];
        $registration_number = $_POST['registration_number'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $type = $_POST['type'];
        $usr = "INSERT INTO user (user_id, password, type) VALUES ('$username', '$password', '$type' )";

        if (mysqli_query($conn, $usr)) {
            $club = "INSERT INTO club (user_id, name, num_events, regno, linkforimage, description, applications_open) VALUES ('$username', '$name_club', '$numberofevents', '$registration_number', '$image', '$description', false)";
            $clublisting = "INSERT INTO clublisting VALUES ('$name_club', '', '', '');";
            if (mysqli_query($conn, $club) && mysqli_query($conn, $clublisting)) {
                if ($_POST['design'] != "") {
                    $domain = $_POST['design'];
                    $query = "INSERT INTO club_domain VALUES('$username', '$domain', 0);";
                    mysqli_query($conn, $query);
                }
                if (isset($_POST['management'])) {
                    $domain = $_POST['management'];
                    $query = "INSERT INTO club_domain VALUES('$username', '$domain', 0);";
                    mysqli_query($conn, $query);
                }
                if (isset($_POST['technical'])) {
                    $domain = $_POST['technical'];
                    $query = "INSERT INTO club_domain VALUES('$username', '$domain', 0);";
                    mysqli_query($conn, $query);
                }

                echo "Successfully registered";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }


    ?>

</html>