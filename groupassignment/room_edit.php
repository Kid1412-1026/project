<?php 
    include("include/config.php");
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
        <?php 
            $roomID = "";
            $roomType = "";
            $roomCapacity = "";
            $roomPrice = "";
            $roomStatus = "";

            if(isset($_GET["id"]) && $_GET["id"] != ""){
                $id = $_GET['id'];
                $sql = "SELECT * FROM room WHERE room_ID= '$id'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $roomID = $row["room_ID"];
                    $roomType = $row["room_Type"];
                    $roomCapacity = $row["room_Capacity"];
                    $roomPrice = $row["room_Price_Per_Hour"];
                    $roomStatus = $row["room_Availability_Status"];
                }
            }
            mysqli_close($conn);
        ?>

        <div class="pageTitle">
            <h1>Update Room</h1>
        </div>
        <br>
        <div class="updateRoom">
            <form method="POST" action="room_edit_action.php" id="updateForm" enctype="multipart/form-data">
                <!--<input type="text" id="cid" name="cid" value="<?=$_GET['id']?>" hidden>-->
                <table border="1" id="roomForm">
                    <colgroup>
                        <col>
                    </colgroup>
                    <tr>
                        <td><b>Room ID</b></td>
                        <td>
                            <input type="text" name="roomID" value="<?=$roomID?>">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Room Type</b></td>
                        <td>
                            <select name="roomType">
                                <?php
                                    if($roomType == "Board Room") {
                                        echo '<option value="Board Room" selected>Board Room</option>';
                                    } else {
                                        echo '<option value="Board Room">Board Room</option>';
                                    }

                                    if($roomType == "Breakout Room") {
                                        echo '<option value="Breakout Room" selected>Breakout Room</option>';
                                    } else {
                                        echo '<option value="Breakout Room">Breakout Room</option>';
                                    }

                                    if($roomType == "Conference Room") {
                                        echo '<option value="Conference Room" selected>Conference Room</option>';
                                    } else {
                                        echo '<option value="Conference Room">Conference Room</option>';
                                    }

                                    if($roomType == "Huddle Room") {
                                        echo '<option value="Huddle Room" selected>Huddle Room</option>';
                                    } else {
                                        echo '<option value="Huddle Room">Huddle Room</option>';
                                    }

                                    if($roomType == "Seminar Room") {
                                        echo '<option value="Seminar Room" selected>Seminar Room</option>';
                                    } else {
                                        echo '<option value="Seminar Room">Seminar Room</option>';
                                    }

                                    if($roomType == "Video Conference Room") {
                                        echo '<option value="Video Conference Room" selected>Video Conference Room</option>';
                                    } else {
                                        echo '<option value="Video Conference Room">Video Conference Room</option>';
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Room Capacity</b></td>
                        <td>
                            <input type="number" name="roomCapacity" value="<?=$roomCapacity?>">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Room Price (Per Hour) </b></td>
                        <td>
                            <input type="text" name="roomPrice" value="<?=$roomPrice?>">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Room Status </b></td>
                        <td>
                            <select id="roomStatus" name="roomStatus">
                                <?php
                                    if ($roomStatus == "Not Booked") {
                                        echo '<option value="Not Booked" selected>Not Booked</option>';
                                    } else {
                                        echo '<option value="Not Booked">Not Booked</option>';
                                    }

                                    if ($roomStatus == "Booked") {
                                        echo '<option value="Booked" selected>Booked</option>';
                                    } else {
                                        echo '<option value="Booked">Booked</option>';
                                    }

                                    if ($roomStatus == "Occupied") {
                                        echo '<option value="Occupied" selected>Occupied</option>';
                                    } else {
                                        echo '<option value="Occupied">Occupied</option>';
                                    }
                                ?>
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

    <script>
        function resetForm() {
            document.getElementById("updateForm").reset();
        }

        function clearForm() {
            var form = document.getElementById("updateForm");
            if (form) {
                var inputs = form.getElementsByTagName("input");

                form.getElementsByTagName("select")[0].selectedIndex=0;

                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].type !== "button" && inputs[i].type !== "submit" && 
                    inputs[i].type !== "reset") {
                    inputs[i].value = "";
                    }
                }

            } else {
                console.error("Form not found");
            }
        }
    </script>
</body>
</html>