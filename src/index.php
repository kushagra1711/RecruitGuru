<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>RecruitGuru</title>
        <?php include "./scripts.php"; ?>
        <link rel="stylesheet" href="css/template.css"/>
        <link rel="stylesheet" href="css/index.css"/>
    </head>

    <body>
        <?php include "./basic-navbar-template.php"; ?>

        <div class="container-row">
            <div class="layer1">
                    <div class="smthin">
                        <h1>Welcome to {<span class="name">RecruitGuru</span>}</h1>
                        <br/>
                        <br/>
                        <h3>
                            Apply for <span class="name1">any</span> number of clubs, the easy
                            way.
                        </h3>
                        <br><br>
                        <h3>Make your exploration of the
                            <span class="name1"> technical, management and design</span> domains
                            <span class="name"> easier</span>.
                        </h3>
                    </div>
                    <br><br>
                    <a href="login.php">
                        <button class="sign-in">Sign In</button>
                    </a>
            </div>
            <div id="particles-js" class="layer2"></div>
        </div>

        <footer>
            <div class="footer">
                <p class="made">Made by Dhruv, Kushagra and Prashant</p>
            </div>
        </footer>

        <?php include "./particles.php"; ?>

    </body>
</html>