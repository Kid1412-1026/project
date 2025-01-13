<?php
include("include/config.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Room List</title>
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
    </nav>

    <main>
        <div class="pageTitle">
            <h1>Room List</h1>
        </div>

        <div class="roomList">
            <div class="filterOption">
                <form method="POST" id="roomFilter">
                    <label for="roomType">Room Type:</label>
                    <select id="roomType" name="roomType" onchange="this.form.submit()">
                        <option value="All" <?= isset($_POST['roomType']) && $_POST['roomType'] === 'All' ? 'selected' : '' ?>>All Rooms</option>
                        <option value="Board Room" <?= isset($_POST['roomType']) && $_POST['roomType'] === 'Board Room' ? 'selected' : '' ?>>Board Room</option>
                        <option value="Breakout Room" <?= isset($_POST['roomType']) && $_POST['roomType'] === 'Breakout Room' ? 'selected' : '' ?>>Breakout Room</option>
                        <option value="Conference Room" <?= isset($_POST['roomType']) && $_POST['roomType'] === 'Conference Room' ? 'selected' : '' ?>>Conference Room</option>
                        <option value="Huddle Room" <?= isset($_POST['roomType']) && $_POST['roomType'] === 'Huddle Room' ? 'selected' : '' ?>>Huddle Room</option>
                        <option value="Seminar Room" <?= isset($_POST['roomType']) && $_POST['roomType'] === 'Seminar Room' ? 'selected' : '' ?>>Seminar Room</option>
                        <option value="Video Conference Room" <?= isset($_POST['roomType']) && $_POST['roomType'] === 'Video Conference Room' ? 'selected' : '' ?>>Video Conference Room</option>
                    </select>
                </form>
            </div>

            <table border="1" id="roomTable">
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
                    $roomType = isset($_POST['roomType']) ? $_POST['roomType'] : 'All';

                    $sql = $roomType === 'All' ? "SELECT * FROM room" : "SELECT * FROM room WHERE room_Type = '" . mysqli_real_escape_string($conn, $roomType) . "'";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $counter = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$counter}</td>";
                            echo "<td>{$row['room_ID']}</td>";
                            echo "<td>{$row['room_Type']}</td>";
                            echo "<td>{$row['room_Capacity']}</td>";
                            echo "<td>RM {$row['room_Price_Per_Hour']}</td>";
                            echo "<td>{$row['room_Availability_Status']}</td>";
                            echo "</tr>";
                            $counter++;
                        }
                    } else {
                        echo "<tr><td colspan='6'>No rooms found.</td></tr>";
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
