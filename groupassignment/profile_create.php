<?php
include("include/config.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Profile</title>
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
        <?php
        include("include/navMenu.php");
        ?>
        <a href="javascript:void(0);" class="icon" onClick="regulateNavMenu"><i class="fa fa-bars"></i></a>
    </nav>

    <main>
        <?php
        $select = "SELECT * FROM customer WHERE userid=" . $_SESSION["UID"];
        $result = mysqli_query($conn, $select);
        if (mysqli_num_rows($result) > 0) {
            header("location:profile.php");
        } else {
            ?>
            <div class="pageTitle">
                <h1>Create Profile</h1>
            </div>
            <br>
            <div class="profileCreate">
                <form method="POST" action="profile_create_action.php" id="insertForm" enctype="multipart/form-data">
                    <!--<input type="text" id="cid" name="cid" value="<?= $_GET['id'] ?>" hidden>-->
                    <table border="1" id="roomForm">
                        <colgroup>
                            <col>
                        </colgroup>
                        <tr>
                            <td><b>Customer Name</b></td>
                            <td>
                                <input type="text" name="custName">
                            </td>
                        </tr>
                        <tr>
                            <td><b>Customer Contact No</b></td>
                            <td>
                                <input type="text" name="custPhoneNo">
                            </td>
                        </tr>
                    </table>
                    <br>
                    <div class="formButton">
                        <input type="submit" value="Submit" name="Submit"> &nbsp;
                        <input type="reset" value="Reset" name="Reset" onclick="resetForm()"> &nbsp
                        <input type="button" value="Clear" name="Clear" onclick="clearForm()">
                    </div>
                </form>
            </div>
        </main>
        <?php



        }


        ?>



    <footer style="position: fixed; bottom: 0;">
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
    </footer>
</body>

</html>