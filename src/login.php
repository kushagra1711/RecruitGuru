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
            <a class="navbar-brand" href="index.php"> <span class="mainlogoname"> RecruitGuru</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li><a class="nav-link nav-item" href="index.php">HOME <span class="sr-only">(current)</span></a></li>

                </ul>
            </div>
        </nav>
    </div>

    <!--create signup form -->
    <center>
        <div class="container">
            <br>
            <form action="auth-redirect.php" method="post" role="form">
                <input type="text" class="input" name="username" id="username" placeholder="Username" required>
                <br>
                <input type="password" class="input" name="password" id="password" placeholder="Password" required>
                <br> <br>
                <input type="submit" name="login-submit" id="login-submit" class="login" value="Log In">
            </form>
            <br>
            <a href="register_student.php" class="register">Register Student</a>
            <a href="register_club.php" class="register">Register Club</a>
        </div>
    </center>

</body>

</html>