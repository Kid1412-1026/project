<?php
include("config.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Booking</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header">
        <h1>Edit Booking</h1>
    </div>
    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
    </nav>

    <?php
    $booking_Date = "";
    $booking_Time_Start = "";
    $booking_Time_End = "";
    $roomID = "";
    $booking_Status = "";

    if (isset($_GET["booking_ID"]) && $_GET["booking_ID"] != "") {
        $stmt = $conn->prepare("SELECT * FROM booking WHERE booking_ID = ?");
        $stmt->bind_param("i", $_GET["booking_ID"]);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $roomID = $row["room_ID"];
            $booking_ID = $row["booking_ID"];
            $booking_Date = $row["booking_Date"];
            $booking_Time_Start = $row["booking_Time_Start"];
            $booking_Time_End = $row["booking_Time_End"];
            $booking_Status = $row["booking_Status"];
        }
        $stmt->close();
    }

    $stmt = $conn->prepare("SELECT * FROM user WHERE userid = ?");
    $stmt->bind_param("i", $_SESSION["UID"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userrole = $row["userrole"];

        echo '<div style="padding:0 10px;" id="challengeDiv">';
        echo '<h3 align="center">Booking</h3>';
        echo '<form method="POST" action="bookingeditaction.php" id="myForm" enctype="multipart/form-data">';
        echo '<input type="hidden" id="booking_ID" name="booking_ID" value="' . htmlspecialchars($_GET["booking_ID"]) . '">';
        echo '<table border="1" id="myTable">';
        echo '<tr><td>Room ID:</td><td><input type="text" name="roomID" value="' . htmlspecialchars($roomID) . '" size="20"></td></tr>';
        echo '<tr><td>Booking Date:</td><td><input type="date" name="booking_Date" value="' . htmlspecialchars($booking_Date) . '" size="20"></td></tr>';
        echo '<tr><td>Booking Time Start:</td><td><input type="time" name="booking_Time_Start" value="' . htmlspecialchars($booking_Time_Start) . '" size="20"></td></tr>';
        echo '<tr><td>Booking Time End:</td><td><input type="time" name="booking_Time_End" value="' . htmlspecialchars($booking_Time_End) . '" size="20"></td></tr>';

        if ($userrole == 1) {
            echo '<tr><td>Booking Status:</td><td><select id="booking_Status" name="booking_Status">';
            echo '<option value="Approved"' . ($booking_Status == "Approved" ? ' selected' : '') . '>Approved</option>';
            echo '<option value="Rejected"' . ($booking_Status == "Rejected" ? ' selected' : '') . '>Rejected</option>';
            echo '</select></td></tr>';
        }

        echo '<tr><td colspan="3" align="right">';
        echo '<input type="submit" value="Submit" name="B1" style="background-color: #00ff00; padding: 10px 20px; border-radius: 5px;">';
        echo '<input type="reset" value="Reset" name="B2" style="background-color: red; padding: 10px 20px; border-radius: 5px;" onclick="resetForm()">';
        echo '<input type="button" value="Clear" name="B3" style="background-color: red; padding: 10px 20px; border-radius: 5px;" onclick="clearForm()">';
        echo '</td></tr></table></form></div>';
    }
    $stmt->close();
    $conn->close();
    ?>

    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>

    <script>
        function resetForm() {
            document.getElementById("myForm").reset();
        }

        function clearForm() {
            const form = document.getElementById("myForm");
            if (form) {
                Array.from(form.elements).forEach(el => {
                    if (el.type !== "button" && el.type !== "submit" && el.type !== "reset") {
                        el.value = "";
                    }
                });
                const select = form.querySelector("select");
                if (select) select.selectedIndex = 0;
            }
        }
    </script>
</body>

</html>
