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
    <?php
    $conn = mysqli_connect("localhost", "root", "", "my_db");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
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
                    <li><a class="nav-link nav-item" href="index.php">HOME <span class="sr-only">(current)</span></a></li>

                </ul>
            </div>
        </nav>
    </div>

    <!-- take input for userid, firstname, lastname, regno, age and year of study-->
    <center>
        <form action="register_student.php" method="post">
            <div class="containers">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">User ID</label> -->
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter User ID" name="userid" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">password</label> -->
                            <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter password" name="password" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">First Name</label> -->
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter First Name" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">Last Name</label> -->
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Last Name" name="lastname" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">Registration Number</label> -->
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Registration Number" name="regno" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">Age</label> -->
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Age" name="age" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">Year of Study</label> -->
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Year of Study" name="yearofstudy" required>
                        </div>
                        <br>
                        <button type="submit" style="background-color: #a4e5e0; color: azure; padding: 5px; border-radius: 5px; font-family: ' IBM Plex Mono', monospace; font-size: 1rem;" name="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </center>

    <?php
    if (isset($_POST['submit'])) {
        $userid = $_POST['userid'];
        $firstname = $_POST['firstname'];
        $password = md5($_POST['password']);
        $lastname = $_POST['lastname'];
        $regno = $_POST['regno'];
        $age = $_POST['age'];
        $yearofstudy = $_POST['yearofstudy'];

        $usr = "INSERT INTO user (user_id, password, type) VALUES ('$userid', '$password', 'student' )";
        if (mysqli_query($conn, $usr)) {
            $sql = "INSERT INTO student (user_id, fname, lname, regno, age, year_of_study) VALUES ('$userid', '$firstname', '$lastname', '$regno', '$age', '$yearofstudy')";
            if (mysqli_query($conn, $sql)) {
                echo "Records inserted successfully.";
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
        } else {
            echo "ERROR: Could not able to execute $usr. " . mysqli_error($conn);
        }
    }
    ?>



</body>

</html>