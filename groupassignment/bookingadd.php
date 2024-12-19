<?PHP
include('config.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
</head>

<body>
    <div class="header">
        <h1>Booking</h1>
    </div>
    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
    </nav>
    <div style="padding:0 10px;" id="kpiDiv">
        <form method="POST" action="bookingaction.php" enctype="multipart/form-data" id="myForm">
                <table border="1" id="myTable">
                    <tr>
                        <td>Room ID:</td>
                        <td><input type="text" name="roomID" size="20"></td>
                    </tr>
                    <tr>
                        <td>Booking Date:</td>
                        <td><input type="date" name="booking_Date" size="20"></td>
                    </tr>
                    <tr>
                        <td>Booking Time Start:</td>
                        <td><input type="time" name="booking_Time_Start" size="20"></td>
                    </tr>
                    <tr>
                        <td>Booking Time End:</td>
                        <td><input type="time" name="booking_Time_End" size="20"></td>
                    </tr>
                    <div class="col-right">
                        <td colspan="10" align="middle">
                            <input type="submit" value="Submit" style="background-color: #00FF00" name="B1">
                            <input type="reset" value="Reset" style="background-color: #FF0000" name="B2">
                        </td>
                    </div>
                </table>
            </form>
        </table>
        <p></p>

        <footer>
            <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
        </footer>
</body>

</html>