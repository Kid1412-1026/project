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
            const roomTableBody = document.querySelector('#adjustable tbody');
            roomTableBody.innerHTML = '';
        }
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
        <a href="javascript:void(0);" class="icon" onclick="regulateNavMenu"><i class="fa fa-bars"></i></a>
    </nav>

    <main>
        <div class="pageTitle">
            <h1>Room List</h1>
        </div>
        <div class="roomList">
            <div class="option">
                <form method="POST" id="roomFilter">
                    <label for="roomType">Room Type: &nbsp;</label>
                    <select class="room_type_select" id="roomType" name="roomType" onchange="this.form.submit()">
                        <?php
                        $roomTypes = [
                            "All" => "All Room",
                            "Board Room" => "Board Room",
                            "Breakout Room" => "Breakout Room",
                            "Conference Room" => "Conference Room",
                            "Huddle Room" => "Huddle Room",
                            "Seminar Room" => "Seminar Room",
                            "Video Conference Room" => "Video Conference Room"
                        ];
                        $selectedRoomType = $_POST['roomType'] ?? "All";

                        foreach ($roomTypes as $key => $label) {
                            $selected = ($selectedRoomType === $key) ? "selected" : "";
                            echo "<option value=\"$key\" $selected>$label</option>";
                        }
                        ?>
                    </select>
                </form>

                &nbsp;
                <form method="GET" action="room_add.php" id="roomAdd">
                    <input type="submit" id="add_button" value="Add New Room">
                </form>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $roomTypeCondition = $selectedRoomType !== "All" ? "WHERE room_Type = '" . mysqli_real_escape_string($conn, $selectedRoomType) . "'" : "";
                    $sql = "SELECT * FROM room $roomTypeCondition";

                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        $numrow = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $roomID = htmlspecialchars($row['room_ID']);
                            $roomType = htmlspecialchars($row['room_Type']);
                            $roomCapacity = htmlspecialchars($row['room_Capacity']);
                            $roomPrice = htmlspecialchars($row['room_Price_Per_Hour']);
                            $roomStatus = htmlspecialchars($row['room_Availability_Status']);

                            echo "<tr>";
                            echo "<td>$numrow</td>";
                            echo "<td>$roomID</td>";
                            echo "<td>$roomType</td>";
                            echo "<td>$roomCapacity</td>";
                            echo "<td>RM$roomPrice</td>";
                            echo "<td>$roomStatus</td>";
                            echo "<td>
                                <a href=\"room_edit.php?id=$roomID\" class=\"btn-edit\">Edit</a>
                                <a href=\"room_delete.php?id=$roomID\" class=\"btn-delete\" onclick=\"return confirm('Delete?')\">Delete</a>
                                </td>";
                            echo "</tr>";
                            $numrow++;
                        }
                    } else {
                        echo "<tr><td colspan='7'>No results found</td></tr>";
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
        <br><br><br><br><br>
    </main>

    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>
</body>

</html>
