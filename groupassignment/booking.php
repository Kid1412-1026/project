<?php
include('config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking</title>
</head>

<body>
    <header class="header">
        <h1>Booking</h1>
    </header>

    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
    </nav>

    <main>
        <section class="pageTitle">
            <h1>Book Room</h1>
        </section>

        <section>
            <table border="1" id="adjustable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Room ID</th>
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
                    $sql = "SELECT * FROM booking WHERE userid=" . $_SESSION["UID"];
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $numrow = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$numrow}</td>";
                            echo "<td>{$row['room_ID']}</td>";
                            echo "<td>{$row['booking_Date']}</td>";
                            echo "<td>" . substr($row['booking_Time_Start'], 0, 5) . "</td>";
                            echo "<td>" . substr($row['booking_Time_End'], 0, 5) . "</td>";
                            echo "<td>{$row['booking_Duration']}</td>";
                            echo "<td>{$row['booking_Status']}</td>";
                            echo "<td>";
                            echo "<a href='bookingedit.php?booking_ID={$row['booking_ID']}' class='btn btn-edit'>Edit</a>";
                            echo "<a href='bookingdelete.php?booking_ID={$row['booking_ID']}' class='btn btn-delete' onClick='return confirm(\"Delete?\");'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                            $numrow++;
                        }
                    } else {
                        echo "<tr><td colspan='8' style='text-align:center;'>No bookings found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <div style="text-align: center; margin: 20px 0;">
            <a href="bookingadd.php" class="btn btn-add">Add Booking</a>
        </div>
    </main>

    <?php mysqli_close($conn); ?>

    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>
</body>

<style>
    .btn {
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        color: black;
        font-size: 14px;
        text-align: center;
    }

    .btn-edit {
        background-color: #00ff00;
        border: 1px solid #000;
        margin-right: 10px;
    }

    .btn-delete {
        background-color: #ff0000;
        border: 1px solid #000;
    }

    .btn-add {
        background-color: #00ff00;
        border: 1px solid #000;
    }
</style>

</html>
