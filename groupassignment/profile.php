<?php
include("include/config.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Profile</title>
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
        <div class="pageTitle">
            <br>
            <h1>My Profile</h1>
        </div>

        <br><br>

        <?php
        $cust_ID = "";
        $cust_Name = "";
        $cust_Phone_No = "";

        $sql = "SELECT * FROM customer WHERE userid=" . $_SESSION["UID"];
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        $cust_ID = $row["cust_ID"];
        $cust_Name = $row["cust_Name"];
        $cust_Phone_No = $row["cust_Phone_No"];

        ?>

        <table border="1" id="profileTable">
            <colgroup>
                <col>
                <col style="background-color: #FFFFFF">
            </colgroup>
            <tr>
                <td><b>Customer ID</b></td>
                <td>
                    <?php
                    echo $cust_ID;
                    ?>
                </td>
            </tr>
            <tr>
                <td><b>Customer Name</b></td>
                <td>
                    <?php
                    echo $cust_Name;
                    ?>
                </td>
            </tr>
            <tr>
                <td><b>Customer Contact No</b></td>
                <td>
                    <?php
                    echo $cust_Phone_No;
                    ?>
                </td>
            </tr>


        </table>

        <br>

        <div class="profileUpdateButton">
            <?php
            echo '<form action="profile_edit.php" method="get">
        <input type="hidden" name="id" value="' . $cust_ID . '">
        <button type="submit">Update Profile</button>
      </form>';

            ?>
        </div>



        <table>
            <form method="POST" action="profile_change_password_action.php" id="insertForm" enctype="multipart/form-data">
                <tr>
                    <td><b>Change Password</b></td>
                    <td><input type="text" name="chgpassword"></td>
                </tr>
                <tr>
                <td><input type="submit" value="Change Password" name="Submit"></td>
                </tr>
            </form>
            </table>
                <br><br><br><br><br>
    </main>

    <footer style="position: fixed; bottom: 0;">
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
    </footer>
</body>

</html>