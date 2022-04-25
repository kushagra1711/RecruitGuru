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
        <?php include "./basic-navbar-template.php"; ?>

        <!-- take input for userid, firstname, lastname, regno, age and year of study-->
        <div class="container-row">
            <div class="layer1">
                <div class="containers">
                    <form action="register_student.php" method="post" id="student-apply">
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">User ID</label> -->
                            <input type="text" class="form-control" id="username" aria-describedby="username"
                                   placeholder="Enter User ID" name="userid" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">password</label> -->
                            <input type="password" class="form-control" id="password"
                                   aria-describedby="password" placeholder="Enter password" name="password" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">First Name</label> -->
                            <input type="text" class="form-control" id="firstname" aria-describedby="firstname"
                                   placeholder="Enter First Name" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">Last Name</label> -->
                            <input type="text" class="form-control" id="lastname" aria-describedby="lastname"
                                   placeholder="Enter Last Name" name="lastname" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">Registration Number</label> -->
                            <input type="text" class="form-control" id="registration_number"
                                   aria-describedby="registernumber"
                                   placeholder="Enter Registration Number" name="regno" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">Age</label> -->
                            <input type="text" class="form-control" id="age" aria-describedby="age"
                                   placeholder="Enter Age" name="age" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="exampleInputEmail1">Year of Study</label> -->
                            <input type="text" class="form-control" id="yearofstudy" aria-describedby="yearofstudy"
                                   placeholder="Enter Year of Study" name="yearofstudy" required>
                        </div>
                        <br>
                        <input type="submit"
                               name="submit" value="Submit">
                    </form>
                </div>
            </div>
            <div id="particles-js" class="layer2"></div>
        </div>

        <?php include "./particles.php"; ?>

        <?php
        if (isset($_POST['submit'])) {
            $conn = mysqli_connect("localhost", "root", "", "my_db");
            if (!$conn) {
                die(mysqli_error($conn));
            }

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