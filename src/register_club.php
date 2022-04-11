<!DOCTYPE html>
<html>

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
    <div class="navbarz">
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
    </div>


    <!-- register form  -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">

                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="register_club.php" method="post" role="form" style="display: block;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="name_club" name="name_club" id="name_club" tabindex="2" class="form-control" placeholder="Name of the Club">
                                    </div>
                                    <!-- take inputs for numberofevents,registeration number,description-->
                                    <div class="form-group">
                                        <input type="number" name="numberofevents" id="numberofevents" tabindex="2" class="form-control" placeholder="Number of Events">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="registration_number" id="registration_number" tabindex="2" class="form-control" placeholder="Registration Number">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="description" id="description" tabindex="2" class="form-control" placeholder="Description"></textarea>
                                    </div>

                                    <!-- take input of image as url-->
                                    <div class="form-group">
                                        <input type="url" name="image" id="image" tabindex="2" class="form-control" placeholder="Image">
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="reg-club-submit" id="eg-club-submit" tabindex="4" class="form-control btn btn-login" value="Register">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<?php



if (isset($_POST['reg-club-submit'])) {

    $conn = mysqli_connect("localhost", "root", "", "my_db");
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $name_club = $_POST['name_club'];
    $numberofevents = $_POST['numberofevents'];
    $registration_number = $_POST['registration_number'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $usr = "INSERT INTO user (user_id, password, type) VALUES ('$username', '$password', 'student' )";

    if (mysqli_query($conn, $usr)) {
        $club = "INSERT INTO club (user_id, name, num_events, regno, linkforimage, description) VALUES ('$username', '$name_club', '$numberofevents', '$registration_number', '$description', '$image')";
        if (mysqli_query($conn, $club)) {
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