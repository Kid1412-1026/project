<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <title>Meeting Room Booking System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.c loudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="header">
        <h1>Meeting Room Booking System</h1>
    </div>

    <div class="row">
        <div class="col-login">
            <?php
            if (isset($_SESSION["UID"])) {
                ?>

                <div class="imgcontainer">
                    <img src="img/photo.jpg" alt="Avatar" class="avatar">
                </div>
                <?php
                echo '<p align="center">Welcome: ' . $_SESSION["useremail"] . "<p>";
            } else {
                ?>

                <form action="login_action.php" method="post" id="login">
                    <div class="imgcontainer">
                        <img src="img/photo.jpg" alt="Avatar" class="avatar" width="150" height="150"
                            style="border-radius: 50%; object-fit: cover;">
                    </div>

                    <div class="container">
                        <label for="uname"><b>User Email</b></label>
                        <br><input type="text" placeholder="User Email" name="useremail" required
                            style="margin-top: 8px; margin-bottom: 8px;">

                        <br><label for="psw"><b>Password</b></label>
                        <br><input type="password" placeholder="Enter Password" name="userpwd" required
                            style="margin-top: 8px; margin-bottom: 8px;">

                        <br><button type="submit"
                            style="background-color: green; color: white; padding: 10px 20px; margin: 8px 0;border: none; border-radius: 5px; cursor: pointer;">Login</button>

                        <label>
                            <br><input type="checkbox" checked="checked" name="remember" style="margin-bottom: 10px;">
                            Remember me
                        </label>
                    </div>

                    <div class="container" style="background-color:#f1f1f1">
                        <span class="psw">
                            <a onClick="showRegister()" style="cursor: pointer;"> Register</a>
                        </span>
                    </div>
                </form>
                <?php
            }
            ?>
        </div>
            <div id="registerDiv" style="display: none;">
                <h2>| User Registration </h2>
                <form action="register_action.php" method="post">
                    <label for="userrole">Role</label>
                    <select size="1" name="userrole" required>
                        <option value="">&nbsp;</option>
                        <option value="1">Admin</option>;
                        <option value="2">User</option>;
                    </select>

                    <br><br><label for="userEmail">User Email:</label>
                    <input type="email" id="userEmail" name="userEmail" required><br><br>

                    <label for="userPwd">Password:</label>
                    <input type="password" id="userPwd" name="userPwd" required maxlength="8"><br><br>

                    <label for="userPwd">Confirm Password:</label>
                    <input type="password" id="confirmPwd" name="confirmPwd" required><br><br>

                    <input type="submit" value="Register"
                        style="background-color:#00ff00; padding: 10px 20px; border: 1px solid; cursor: pointer;">
                    <input type="reset" value="Reset"
                        style="background-color:#ff0000; padding: 10px 20px; border: 1px solid ; cursor: pointer;">
                    <input type="reset" value="Cancel" onClick="cancelRegister()"
                        style="background-color:#ff0000;padding: 10px 20px; border: 1px solid; cursor: pointer;">

                </form>
            </div>
        </div>
    </div>
    <footer>
        <p>Copyright (c) 2023</p>
    </footer>

    <script>
        //JS to show responsive menu
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }

        //JS to show div Registration id=registerDiv
        function showRegister() {
            var x = document.getElementById("registerDiv");
            x.style.display = 'block';

            var x = document.getElementById("newsDiv");
            x.style.display = 'none';

            var firstField = document.getElementById('matricNo');
            firstField.focus();
        }

        //JS to cancel registration by hiding div (display=none)
        function cancelRegister() {
            var x = document.getElementById("registerDiv");
            x.style.display = 'none';

            var x = document.getElementById("newsDiv");
            x.style.display = 'block';
        }
    </script>
</body>

</html>