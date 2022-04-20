<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=ed ge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RecruitGuru</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/template.css">
  <link rel="stylesheet" href="css/populate.css">

</head>

<body>

  <?php include "./navbar-template.php"; ?>

  <div class="theCont">
    <center>
      <!-- trying this out, lets see if this works  -->
      <div class="py-16 bg-gradient-to-br from-green-50 to-cyan-100">
        <div class="container m-auto px-6 text-gray-600 md:px-12 xl:px-6">
          <div class="mb-12 space-y-2 text-center">
          </div>

          <div class="grid gap-12 lg:grid-cols-3">

            <?php
            $conn = mysqli_connect("localhost", "root", "", "my_db");
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM club ";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);

            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            while ($k = mysqli_fetch_array($result)) {
              extract($k);

              if ($applications_open == false) {
                continue;
              }

              $username = $_SESSION['username'];
              $username = mysqli_real_escape_string($conn, $username);
              $regno = $_SESSION['regno'];
              $name = mysqli_real_escape_string($conn, $name);
              $query = "SELECT * FROM registered_club WHERE user_id = '$username' AND name = '$name'";
              $result3 = mysqli_query($conn, $query);

              $escaped = mysqli_real_escape_string($conn, $user_id);
              $domain = "SELECT * FROM club_domain WHERE user_id = '$escaped' ORDER BY domain_offering";
              $result2 = mysqli_query($conn, $domain);
            ?>


              <div class="pl-1 rounded-xl group sm:flex flex-col space-x-6 bg-white bg-opacity-50 shadow-xl hover:rounded-2xl">
                <div class="sm:flex flex-row">
                  <img src="<?= $linkforimage ?>  " alt="art cover" loading="lazy" width="1000" height="667" class="h-36 mt-5 ml-5 sm:h-half w-half sm:w-5/12 object-cover object-center rounded-lg">
                  <div class="sm:w-7/12 pt-5 pr-5 pl-5">
                    <div class="space-y-2">
                      <div class="space-y-4">
                        <div class="alignment">
                          <h4 class="clubName"><?= $name ?></h4>
                          <div class="dom">
                            <?php
                            while ($domain = mysqli_fetch_assoc($result2)) {
                              $domain = $domain['domain_offering'];
                            ?>
                              <h6 class="domains"><?= $domain ?></h6>
                            <?php
                            }
                            ?>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="m-6">
                  <p class="description"><?= $description ?></p>
                  <br><br>
                  <form method="post" action="auth-redirect.php">
                    <?php
                    if (mysqli_num_rows($result3) > 0) {
                    ?>
                      <div class="applied" name="apply-club"><a href="javascript:void(0)" class="block w-max text-cyan-600"> Applied </a></div>
                    <?php
                    } else {
                    ?>
                      <div class="apply" name="apply-club"><input type="submit" value="Apply" name="apply-club" class="block w-max text-cyan-600"></div>
                    <?php
                    }
                    ?>
                    <input type="hidden" name="clubname" value="<?= $name ?>" hidden>
                  </form>
                </div>
              </div>
            <?php
            }
            mysqli_close($conn);
            ?>

    </center>
  </div>
  </div>

  <style>

  </style>

  </div>