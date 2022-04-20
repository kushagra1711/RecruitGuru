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
    <?php
    session_start();
    if (session_id() != '') {
        $conn = mysqli_connect("localhost", "root", "", "my_db");
        $username = $_SESSION['username'];
        $username = mysqli_real_escape_string($conn, $username);
        $query = "SELECT * FROM user WHERE user_id = '$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $result_assoc = mysqli_fetch_assoc($result);
            $type = $result_assoc['type'];
            if ($type == "student") {
                die(header("Location: populate.php"));
            } else {
                die(header("Location: clubportal.php"));
            }
        }
    }
    ?>
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

    <!--create signup form -->
    <div class="container">
        <div class="rowm">
            <div class="col-md-6 col-md-offset-3">
                <img src="Vlgpng.png"></img>
                <center>
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <center>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <a href="register_student.php" id="register-form-link">Register student</a>
                                        <br>
                                        <a href="register_club.php" id="register-form-link">Register club</a>
                                    </div>
                                </div>
                            </center>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <hr>
                                    <form id="login-form" action="auth-redirect.php" method="post" role="form" style="display: block;">
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="row" id="rop">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </div>
</body>

</html>