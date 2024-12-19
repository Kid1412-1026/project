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
    <script>
        function updateRoomList() {
            var roomTypeSelect = document.getElementById('roomType');
            var roomTableBody = document.querySelector('#adjustable tbody');
            var selectedRoomType = roomTypeSelect.value;

            // Clear existing rows
            roomTableBody.innerHTML = '';
        }

        // Initial room list update
        updateRoomList();
    </script>
</head>

<body>
    <header>
        <div class="header">
            <h1>Meeting Room Booking System</h1>
        </div>
    </header>

    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
        <a href="javascript:void(0);" class="icon" onClick="regulateNavMenu"><i class="fa fa-bars"></i></a>
    </nav>

    <main>
        <div class="pageTitle">
            <h1>Room List</h1>
        </div>
        <div class="roomList">
            <div class="option">
                <form method="POST" id="roomFilter">
                    <label for="">Room Type: &nbsp;</label>
                    <select class="room_type_select" id="roomType" name="roomType" value=""
                        onchange="this.form.submit()">
                        <?php
                        $roomType = $_POST['roomType'];
                        if ($roomType == null) {
                            echo '<option value="All">All Room</option>';
                            echo '<option value="Board Room">Board Room</option>';
                            echo '<option value="Breakout Room">Breakout Room</option>';
                            echo '<option value="Conference Room">Conference Room</option>';
                            echo '<option value="Huddle Room">Huddle Room</option>';
                            echo '<option value="Seminar Room">Seminar Room</option>';
                            echo '<option value="Video Conference Room">Video Conference Room</option>';
                        }

                        if (isset($_POST['roomType'])) {
                            $roomType = $_POST['roomType'];
                            if ($roomType == "All") {
                                echo '<option value="All" selected>All Room</option>';

                            } else {
                                echo '<option value="All">All Room</option>';
                            }

                            if ($roomType == "Board Room") {
                                echo '<option value="Board Room" selected>Board Room</option>';

                            } else {
                                echo '<option value="Board Room">Board Room</option>';
                            }

                            if ($roomType == "Breakout Room") {
                                echo '<option value="Breakout Room" selected>Breakout Room</option>';
                            } else {
                                echo '<option value="Breakout Room">Breakout Room</option>';
                            }

                            if ($roomType == "Conference Room") {
                                echo '<option value="Conference Room" selected>Conference Room</option>';
                            } else {
                                echo '<option value="Conference Room">Conference Room</option>';
                            }

                            if ($roomType == "Huddle Room") {
                                echo '<option value="Huddle Room" selected>Huddle Room</option>';
                            } else {
                                echo '<option value="Huddle Room">Huddle Room</option>';
                            }

                            if ($roomType == "Seminar Room") {
                                echo '<option value="Seminar Room" selected>Seminar Room</option>';
                            } else {
                                echo '<option value="Seminar Room">Seminar Room</option>';
                            }

                            if ($roomType == "Video Conference Room") {
                                echo '<option value="Video Conference Room" selected>Video Conference Room</option>';
                            } else {
                                echo '<option value="Video Conference Room">Video Conference Room</option>';
                            }
                        }
                        ?>
                    </select>
                </form>

                &nbsp;
            </div>

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
                    if (isset($_POST['roomType'])) {
                        $roomType = $_POST['roomType'];

                        // Fetch data based on selected room type
                        if ($roomType == 'All') {
                            $sql = "SELECT * FROM room";
                        } else {
                            $sql = "SELECT * FROM room WHERE room_type = '$roomType'";
                        }

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $numrow = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $numrow . "</td>";
                                echo "<td>" . $row['room_ID'] . "</td>";
                                echo "<td>" . $row['room_Type'] . "</td>";
                                echo "<td>" . $row['room_Capacity'] . "</td>";
                                echo "<td>RM" . $row['room_Price_Per_Hour'] . "</td>";
                                echo "<td>" . $row['room_Availability_Status'] . "</td>";
                                $numrow++;
                            }
                        } else {
                            echo "<tr><td colspan='7'>No results found</td></tr>";
                        }
                        mysqli_close($conn);

                    } else {
                        $sql = "SELECT * FROM room";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $numrow = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $numrow . "</td>";
                                echo "<td>" . $row['room_ID'] . "</td>";
                                echo "<td>" . $row['room_Type'] . "</td>";
                                echo "<td>" . $row['room_Capacity'] . "</td>";
                                echo "<td>RM" . $row['room_Price_Per_Hour'] . "</td>";
                                echo "<td>" . $row['room_Availability_Status'] . "</td>";
                                $numrow++;
                            }
                        } else {
                            echo "<tr><td colspan='7'>No results found</td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br><br><br><br><br>
    </main>

    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
    </footer>
</body>

</html>