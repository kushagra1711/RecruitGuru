<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>RecruitGuru</title>
        <?php include "./scripts.php"; ?>
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
        <!-- <div class="marginer"> -->
        <?php include "./auth-stud.php";
        $conn = mysqli_connect("localhost", "root", "", "my_db");
        $username = $_SESSION['username'];
        $username = mysqli_real_escape_string($conn, $username);

        if (isset($_POST['submit'])) {
            $conn = mysqli_connect("localhost", "root", "", "my_db");
            if (!$conn) {
                die(mysqli_error($conn));
            }
            $userid = $_SESSION['username'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $regno = $_POST['regno'];
            $age = $_POST['age'];
            $yearofstudy = $_POST['yearofstudy'];

            $query = "UPDATE student SET fname= '$firstname', lname = '$lastname', regno = '$regno' WHERE user_id = '$username'";
            mysqli_query($conn, $query) or die(mysqli_error($conn));

            $success = true;
        }

        $sql = "select * from student where user_id = '$username'";
        $result = mysqli_query($conn, $sql);
        $sql2 = "select * from user where user_id = '$username'";
        $row = mysqli_fetch_array($result);

        ?>

        <!-- take input for userid, firstname, lastname, regno, age and year of study-->
        <div class="container-row">
            <div class="layer1">
                <div class="containers">
                    <form action="stud-edit.php" method="post" id="student-apply">
                        <div class="form-group">
                            <label for="exampleInputEmail1">User ID</label>
                            <input type="text" class="form-control" id="username" name="userid" disabled
                                   value="<?php echo $row['user_id']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                   value="<?php echo $row['fname']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                   value="<?php echo $row['lname']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Registration Number</label>
                            <input type="text" class="form-control" id="registration_number" name="regno"
                                   value="<?php echo $row['regno']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Age</label>
                            <input type="text" class="form-control" id="age" name="age"
                                   value="<?php echo $row['age']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Year of Study</label>
                            <input type="text" class="form-control" id="yearofstudy" name="yearofstudy"
                                   value="<?php echo $row['year_of_study']; ?>" required>
                        </div>
                        <br>
                        <input type="submit" name="submit" value="Submit">
                        <br>
                    </form>
                    <?php
                    if (isset($success) && $success) {
                        ?>
                        <center>
                            <div id="editSuccess">
                                <p>Successfully edited the profile!</p>
                                <br>
                                <a href="studentPortal.php"> Return to student portal </a>
                            </div>
                        </center>
                        <br>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div id="particles-js" class="layer2"></div>
        </div>

        <?php include "./particles.php"; ?>

        <!-- </div> -->


    </body>

</html>