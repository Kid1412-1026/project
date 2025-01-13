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
        <?php include("include/navMenu.php"); ?>
        <a href="javascript:void(0);" class="icon" onclick="regulateNavMenu"><i class="fa fa-bars"></i></a>
    </nav>

    <main>
        <div class="pageTitle">
            <h1>Room List</h1>
        </div>

        <div class="roomList">
            <form method="POST" id="roomFilter">
                <label for="roomType">Room Type:&nbsp;</label>
                <select id="roomType" name="roomType" onchange="this.form.submit()">
                    <?php
                    $roomType = $_POST['roomType'] ?? 'All';
                    $roomTypes = [
                        'All' => 'All Room',
                        'Board Room' => 'Board Room',
                        'Breakout Room' => 'Breakout Room',
                        'Conference Room' => 'Conference Room',
                        'Huddle Room' => 'Huddle Room',
                        'Seminar Room' => 'Seminar Room',
                        'Video Conference Room' => 'Video Conference Room'
                    ];

                    foreach ($roomTypes as $key => $value) {
                        $selected = ($key === $roomType) ? 'selected' : '';
                        echo "<option value=\"$key\" $selected>$value</option>";
                    }
                    ?>
                </select>
            </form>

            <br>

            <table border="1" id="adjustable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Room ID</th>
                        <th>Room Type</th>
                        <th>Room Capacity</th>
                        <th>Room Price (Per Hour)</th>
                        <th>Room Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = ($roomType === 'All') 
                        ? "SELECT * FROM room" 
                        : "SELECT * FROM room WHERE room_type = '$roomType'";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $numrow = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$numrow}</td>";
                            echo "<td>{$row['room_ID']}</td>";
                            echo "<td>{$row['room_Type']}</td>";
                            echo "<td>{$row['room_Capacity']}</td>";
                            echo "<td>RM{$row['room_Price_Per_Hour']}</td>";
                            echo "<td>{$row['room_Availability_Status']}</td>";
                            echo "</tr>";
                            $numrow++;
                        }
                    } else {
                        echo "<tr><td colspan='6'>No results found</td></tr>";
                    }

                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>
</body>

</html>
