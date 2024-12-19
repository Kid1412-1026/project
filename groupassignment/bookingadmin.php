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
</head>

<body>
    <div class="header">
            <h1>Booking</h1>
        </div>
    <?php echo '<nav class="topNav" id="topNav">';
    include("include/navMenu.php");
    echo '</nav>';
    ?>
    <div class="pageTitle">
            <h1>Booking List</h1>
        </div>
    <table border="1" id="adjustable">
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
        <?php
        $sql = "SELECT * FROM booking";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $numrow = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $numrow . "</td><td>" . $row["booking_ID"] . "</td>
                <td>" . $row["booking_Date"] . "</td><td>" . substr($row["booking_Time_Start"], 0, 5) .
                    "</td><td>" . substr($row["booking_Time_End"], 0, 5) . "</td><td>" . $row["booking_Duration"] . "</td><td>" . $row["booking_Status"] . "</td>";
                echo '<td>';
                echo '<a href="bookingedit.php?booking_ID=' . $row["booking_ID"] . '" style="background-color: #00ff00; padding: 5px 10px; text-decoration: none; border-radius: 5px; border: 1px solid #000000; color: black;">Edit</a>&nbsp;&nbsp;';
                echo '<a href="bookingdelete.php?booking_ID =' . $row["booking_ID"] . '" style="background-color: #ff0000; padding: 5px 10px; text-decoration: none; border-radius: 5px; border: 1px solid #000000; color: black;" onClick="return confirm(\'Delete?\');">Delete</a>';
                echo "</tr>" . "\n\t\t";
                $numrow++;
            }
        }
        mysqli_close($conn);
        ?>
    </table>
    <p></p>
    <div style="text-align: center;">
        <a href="bookingadd.php"
            style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px; margin-right: 10px;">Add
            Booking</a>
    </div>
    <p></p>
    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
    </footer>
</body>

</html>