<?php
include("config.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Study KPI</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header">
        <h1>Edit Booking</h1>
    </div>
    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php");
        echo '</nav>';
        $booking_Date = "";
        $booking_Time_Start = "";
        $booking_Time_End = "";
        $roomID = "";
        $booking_Status = "";

        if (isset($_GET["booking_ID"]) && $_GET["booking_ID"] != "") {
            $sql = "SELECT * FROM booking WHERE booking_ID=" . $_GET["booking_ID"];
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $roomID = $row["room_ID"];
                $booking_ID = $row["booking_ID"];
                $booking_Date = $row["booking_Date"];
                $booking_Time_Start = $row["booking_Time_Start"];
                $booking_Time_End = $row["booking_Time_End"];
                $booking_Status = $row["booking_Status"];
            }
        }

        $sql = "SELECT * FROM user WHERE userid=" . $_SESSION["UID"];
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $userrole = $row["userrole"];
            if ($userrole == 1) {
                ?>
                <div style="padding:0 10px;" id="challengeDiv">
                    <h3 align="center">Booking</h3>
                    <form method="POST" action="bookingeditaction.php" id="myForm" enctype="multipart/form-data">
                        <!--hidden value: id to be submitted to action page-->
                        <input type="text" id="booking_ID" name="booking_ID" value="<?= $_GET['booking_ID'] ?>" hidden>
                        <table border="1" id="myTable">
                            <tr>
                                <td>Room ID:</td>
                                <td><input type="text" name="roomID" value="<?php echo $roomID; ?>" size="20"></td>
                            </tr>
                            <tr>
                                <td>Booking Date:</td>
                                <td><input type="date" name="booking_Date" value="<?php echo $booking_Date; ?>" size="20"></td>
                            </tr>
                            <tr>
                                <td>Booking Time Start:</td>
                                <td><input type="time" name="booking_Time_Start" value="<?php echo $booking_Time_Start; ?>"
                                        size="20"></td>
                            </tr>
                            <tr>
                                <td>Booking Time End:</td>
                                <td><input type="time" name="booking_Time_End" value="<?php echo $booking_Time_End; ?>"
                                        size="20">
                                </td>
                            </tr>
                            <tr>
                                <td>Booking Status:</td>
                                <td>
                                    <select id="booking_Status" name="booking_Status">
                                        <option value="Approved" <?php echo $booking_Status ? 'selected' : ''; ?>>Approved
                                        </option>
                                        <option value="Rejected" <?php echo $booking_Status ? 'selected' : ''; ?>>Rejected
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right">
                                    <input type="submit" value="Submit" name="B1"
                                        style="background-color: #00ff00; padding: 10px 20px;border-radius: 5px;">
                                    <input type="reset" value="Reset" name="B2"
                                        style="background-color: red; padding: 10px 20px; border-radius: 5px;"
                                        onclick="resetForm()">
                                    <input type="button" value="Clear" name="B3"
                                        style="background-color: red; padding: 10px 20px; border-radius: 5px;"
                                        onclick="clearForm()">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <?php
            } else {
                ?>
                <div style="padding:0 10px;" id="challengeDiv">
                    <h3 align="center">Booking</h3>
                    <form method="POST" action="bookingeditaction.php" id="myForm" enctype="multipart/form-data">
                        <!--hidden value: id to be submitted to action page-->
                        <input type="text" id="booking_ID" name="booking_ID" value="<?= $_GET['booking_ID'] ?>" hidden>
                        <table border="1" id="myTable">
                            <tr>
                                <td>Room ID:</td>
                                <td><input type="text" name="roomID" value="<?php echo $roomID; ?>" size="20"></td>
                            </tr>
                            <tr>
                                <td>Booking Date:</td>
                                <td><input type="date" name="booking_Date" value="<?php echo $booking_Date; ?>" size="20"></td>
                            </tr>
                            <tr>
                                <td>Booking Time Start:</td>
                                <td><input type="time" name="booking_Time_Start" value="<?php echo $booking_Time_Start; ?>"
                                        size="20"></td>
                            </tr>
                            <tr>
                                <td>Booking Time End:</td>
                                <td><input type="time" name="booking_Time_End" value="<?php echo $booking_Time_End; ?>"
                                        size="20">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right">
                                    <input type="submit" value="Submit" name="B1"
                                        style="background-color: #00ff00; padding: 10px 20px;border-radius: 5px;">
                                    <input type="reset" value="Reset" name="B2"
                                        style="background-color: red; padding: 10px 20px; border-radius: 5px;"
                                        onclick="resetForm()">
                                    <input type="button" value="Clear" name="B3"
                                        style="background-color: red; padding: 10px 20px; border-radius: 5px;"
                                        onclick="clearForm()">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <?php
            }
        }
        mysqli_close($conn);
        ?>
        <p></p>
        <footer>
            <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
        </footer>
        <script>
            //for responsive sandwich menu
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
            //reset form after modification to a php echo to fields
            function resetForm() {
                document.getElementById("myForm").reset();
            }
            //this clear form to empty the form for new data
            function clearForm() {
                var form = document.getElementById("myForm");
                if (form) {
                    var inputs = form.getElementsByTagName("input");
                    var textareas = form.getElementsByTagName("textarea");
                    //clear select
                    form.getElementsByTagName("select")[0].selectedIndex = 0;
                    //clear all inputs
                    for (var i = 0; i < inputs.length; i++) {
                        if (inputs[i].type !== "button" && inputs[i].type !== "submit" && inputs[i].type !== "reset") {
                            inputs[i].value = "";
                        }
                    }
                    //clear all textareas
                    for (var i = 0; i < textareas.length; i++) {
                        textareas[i].value = "";
                    }
                } else {
                    console.error("Form not found");
                }
            }
        </script>
</body>

</html>