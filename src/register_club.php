<!DOCTYPE html>
<html>

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
    <style>
        .containers {
            width: 50%;
            text-align: center;
            align-items: center;
            margin-top: 3%;
        }
    </style>
</head>

<body>
    <div class="navbarz">
        <nav class="navbar navbar-expand-lg navbar-light navbarz">
            <a class="navbar-brand" href="#"> <span class="mainlogoname"> RecruitGuru</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li><a class="nav-link nav-item" href="#">Home <span class="sr-only">(current)</span></a></li>

                </ul>
            </div>
        </nav>
    </div>


    <!-- register form  -->
    <center>
        <div class="containers">
            <center>
                <form id="login-form" action="register_club.php" method="post" role="form" style="display: block;">
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" required>
                            <option value="club" default>Club</option>
                            <option value="chapter">Chapter</option>
                            <option value="team">Team</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="name_club" name="name_club" id="name_club" tabindex="2" class="form-control" placeholder="Name of the Club" required>
                    </div>
                    <!-- take inputs for numberofevents,registeration number,description-->
                    <div class="form-group">
                        <input type="number" name="numberofevents" id="numberofevents" tabindex="2" class="form-control" placeholder="Number of Events" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="registration_number" id="registration_number" tabindex="2" class="form-control" placeholder="Registration Number" required>
                    </div>
                    <div class="form-group">
                        <textarea name="description" id="description" tabindex="2" class="form-control" placeholder="Description" required></textarea>
                    </div>

                    <!-- take input of image as url-->
                    <div class="form-group">
                        <input type="url" name="image" id="image" tabindex="2" class="form-control" placeholder="Image" required>
                    </div>

                    <div class="form-group">
                        Domains Recruiting:
                        <br>
                        <input type="checkbox" name="design" id="design" tabindex="2" value="design">
                        <label for="design">Design</label>
                        <input type="checkbox" name="management" id="management" tabindex="2" value="management">
                        <label for="management">Management</label>
                        <input type="checkbox" name="technical" id="technical" tabindex="2" value="technical">
                        <label for="technical">Technical</label>
                    </div>
                    <br>
                    <input type="submit" style="background-color: #a4e5e0; color: azure; padding: 5px; border-radius: 5px; font-family: ' IBM Plex Mono', monospace; font-size: 1rem;" name="reg-club-submit" id="eg-club-submit" value="Register">
                </form>
            </center>
        </div>
    </center>


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