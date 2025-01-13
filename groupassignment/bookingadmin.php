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
    <title>Booking List</title>
</head>

<body>
    <div class="header">
        <h1>Booking</h1>
    </div>
    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
    </nav>
    <div class="pageTitle">
        <h1>Booking List</h1>
    </div>
    <table border="1" id="adjustable">
        <thead>
            <tr>
                <th>No</th>
                <th>Booking ID</th>
                <th>Booking Date</th>
                <th>Booking Time Start</th>
                <th>Booking Time End</th>
                <th>Booking Duration</th>
                <th>Booking Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM booking";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $numrow = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $numrow . "</td>";
                    echo "<td>" . htmlspecialchars($row["booking_ID"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["booking_Date"]) . "</td>";
                    echo "<td>" . htmlspecialchars(substr($row["booking_Time_Start"], 0, 5)) . "</td>";
                    echo "<td>" . htmlspecialchars(substr($row["booking_Time_End"], 0, 5)) . "</td>";
                    echo "<td>" . htmlspecialchars($row["booking_Duration"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["booking_Status"]) . "</td>";
                    echo '<td>\n';
                    echo '<a href="bookingedit.php?booking_ID=' . urlencode($row["booking_ID"]) . '" style="background-color: #00ff00; padding: 5px 10px; text-decoration: none; border-radius: 5px; border: 1px solid #000000; color: black;">Edit</a>&nbsp;&nbsp;';
                    echo '<a href="bookingdelete.php?booking_ID=' . urlencode($row["booking_ID"]) . '" style="background-color: #ff0000; padding: 5px 10px; text-decoration: none; border-radius: 5px; border: 1px solid #000000; color: black;" onClick="return confirm(\'Delete?\');">Delete</a>';
                    echo "</td>\n</tr>";
                    $numrow++;
                }
            } else {
                echo '<tr><td colspan="8" style="text-align:center;">No bookings found</td></tr>';
            }
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
    <div style="text-align: center; margin-top: 20px;">
        <a href="bookingadd.php" style="display: inline-block; padding: 10px 20px; text-decoration: none; background-color: #00ff00; border-radius: 5px; color: black;">Add Booking</a>
    </div>
    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>
</body>

</html>
