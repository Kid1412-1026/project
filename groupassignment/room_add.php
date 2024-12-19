<?php 
    include("include/config.php");
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
        <?php
            include("include/navMenu.php");
        ?>
            <a href="javascript:void(0);" class="icon" onClick="regulateNavMenu"><i class="fa fa-bars"></i></a>
    </nav>

    <main>

        <div class="pageTitle">
            <h1>Add New Room</h1>
        </div>
        <br>
        <div class="insertRoom">
            <form method="POST" action="room_add_action.php" id="insertForm" enctype="multipart/form-data">
                <!--<input type="text" id="cid" name="cid" value="<?=$_GET['id']?>" hidden>-->
                <table border="1" id="roomForm">
                    <colgroup>
                        <col>
                    </colgroup>
                    <tr>
                        <td><b>Room ID</b></td>
                        <td>
                            <input type="text" name="roomID">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Room Type</b></td>
                        <td>
                            <select id="roomType" name="roomType">
                                <option value="None">--Choose Room Type--</option>
                                <option value="Board Room">Board Room</option>
                                <option value="Breakout Room">Breakout Room</option>
                                <option value="Conference Room">Conference Room</option>
                                <option value="Huddle Room">Huddle Room</option>
                                <option value="Seminar Room">Seminar Room</option>
                                <option value="Video Conference Room">Video Conference Room</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Room Capacity</b></td>
                        <td>
                            <input type="number" name="roomCapacity">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Room Price (Per Hour) </b></td>
                        <td>
                            <input type="text" name="roomPrice" value="">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Room Status </b></td>
                        <td>
                            <select id="roomStatus" name="roomStatus">
                                <option value="Not Booked">Not Booked</option>
                                <option value="Booked">Booked</option>
                                <option value="Occupied">Occupied</option>
                            </select>
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

    <footer style="position: fixed; bottom: 0;">
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
    </footer>
</body>

</html>