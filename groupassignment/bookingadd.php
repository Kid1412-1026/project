<?php
include('config.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
</head>

<body>
    <div class="header">
        <h1>Booking</h1>
    </div>
    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
    </nav>
    <div style="padding: 0 10px;" id="kpiDiv">
        <form method="POST" action="bookingaction.php" enctype="multipart/form-data" id="myForm">
            <table border="1" id="myTable">
                <tr>
                    <td>Room ID:</td>
                    <td><input type="text" name="roomID" size="20" required></td>
                </tr>
                <tr>
                    <td>Booking Date:</td>
                    <td><input type="date" name="booking_Date" required></td>
                </tr>
                <tr>
                    <td>Booking Time Start:</td>
                    <td><input type="time" name="booking_Time_Start" required></td>
                </tr>
                <tr>
                    <td>Booking Time End:</td>
                    <td><input type="time" name="booking_Time_End" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit" style="background-color: #00FF00; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Submit</button>
                        <button type="reset" style="background-color: #FF0000; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Reset</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>
</body>

</html>
