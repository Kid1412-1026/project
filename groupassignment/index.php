<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <header>
        <div class="header">
            <h1>Meeting Room Booking System</h1>
        </div>
    </header>

    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
        <a href="javascript:void(0);" class="icon" onClick="regulateNavMenu"><i class="fa fa-bars"></i></a>
    </nav>
    
    <main>
        <div class="greeting">
            <?php
            if (isset($_SESSION["UID"])) {
                echo "<h1 style='text-align: center'>Welcome Back</h1>";
            } else {
                echo "<h1 style='text-align: center'>Welcome to Meeting Room Booking System</h1>";
            }
            ?>
        </div>
        <div class="info">
            <div class="briefInfo">
                <a href="landingpage.php" style="text-decoration: none; color: inherit; display: block;">
                    <p><b>Login</b><br>Login to your profile.</p>
                </a>
            </div>

            <div class="briefInfo">
                <p><b>My Profile: </b><br>An interface for you to overview your information in a portfolio webpage.</p>
            </div>
            <div class="briefInfo">
                <p><b>My Profile: </b><br>An interface for you to overview your information in a portfolio webpage.</p>
            </div>
            <div class="briefInfo">
                <p><b>My Profile: </b><br>An interface for you to overview your information in a portfolio webpage.</p>
            </div>
        </div>
        <br><br><br>
    </main>

    <footer style="position: fixed; bottom: 0;">
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
    </footer>
</body>

</html>