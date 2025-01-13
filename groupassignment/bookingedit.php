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
        <?php include("include/navMenu.php"); ?>
    </nav>

    <?php
    $booking_Date = "";
    $booking_Time_Start = "";
    $booking_Time_End = "";
    $roomID = "";
    $booking_Status = "";

    if (!empty($_GET["booking_ID"])) {
        $sql = "SELECT * FROM booking WHERE booking_ID=" . intval($_GET["booking_ID"]);
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $roomID = $row["room_ID"];
            $booking_Date = $row["booking_Date"];
            $booking_Time_Start = $row["booking_Time_Start"];
            $booking_Time_End = $row["booking_Time_End"];
            $booking_Status = $row["booking_Status"];
        }
    }

    $sql = "SELECT userrole FROM user WHERE userid=" . intval($_SESSION["UID"]);
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $userrole = mysqli_fetch_assoc($result)["userrole"];
        ?>

        <div style="padding: 0 10px;" id="challengeDiv">
            <h3 align="center">Booking</h3>
            <form method="POST" action="bookingeditaction.php" id="myForm" enctype="multipart/form-data">
                <input type="hidden" id="booking_ID" name="booking_ID" value="<?= htmlspecialchars($_GET['booking_ID']) ?>">
                <table border="1" id="myTable">
                    <tr>
                        <td>Room ID:</td>
                        <td><input type="text" name="roomID" value="<?= htmlspecialchars($roomID) ?>" size="20"></td>
                    </tr>
                    <tr>
                        <td>Booking Date:</td>
                        <td><input type="date" name="booking_Date" value="<?= htmlspecialchars($booking_Date) ?>" size="20"></td>
                    </tr>
                    <tr>
                        <td>Booking Time Start:</td>
                        <td><input type="time" name="booking_Time_Start" value="<?= htmlspecialchars($booking_Time_Start) ?>" size="20"></td>
                    </tr>
                    <tr>
                        <td>Booking Time End:</td>
                        <td><input type="time" name="booking_Time_End" value="<?= htmlspecialchars($booking_Time_End) ?>" size="20"></td>
                    </tr>
                    <?php if ($userrole == 1) { ?>
                        <tr>
                            <td>Booking Status:</td>
                            <td>
                                <select id="booking_Status" name="booking_Status">
                                    <option value="Approved" <?= $booking_Status === "Approved" ? 'selected' : '' ?>>Approved</option>
                                    <option value="Rejected" <?= $booking_Status === "Rejected" ? 'selected' : '' ?>>Rejected</option>
                                </select>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3" align="right">
                            <input type="submit" value="Submit" name="B1" class="btn btn-green">
                            <input type="reset" value="Reset" name="B2" class="btn btn-red" onclick="resetForm()">
                            <input type="button" value="Clear" name="B3" class="btn btn-red" onclick="clearForm()">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
    }
    mysqli_close($conn);
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
                form.querySelectorAll("input:not([type=hidden]), textarea").forEach(input => input.value = "");
                form.querySelector("select").selectedIndex = 0;
            } else {
                console.error("Form not found");
            }
        }
    </script>
</body>

</html>
