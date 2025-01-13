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

        document.addEventListener('DOMContentLoaded', updateRoomList);
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
    </nav>

    <main>
        <div class="pageTitle">
            <h1>Room List</h1>
        </div>

        <div class="roomList">
            <div class="option">
                <form method="POST" id="roomFilter">
                    <label for="roomType">Room Type: </label>
                    <select id="roomType" name="roomType" onchange="this.form.submit()">
                        <?php
                        $roomTypes = ["All", "Board Room", "Breakout Room", "Conference Room", "Huddle Room", "Seminar Room", "Video Conference Room"];
                        $selectedRoomType = $_POST['roomType'] ?? "All";

                        foreach ($roomTypes as $type) {
                            $selected = $type === $selectedRoomType ? "selected" : "";
                            echo "<option value='$type' $selected>$type</option>";
                        }
                        ?>
                    </select>
                </form>

                <form method="POST" action="room_add.php" id="roomAdd">
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
                    $sql = "SELECT * FROM room";
                    if ($selectedRoomType !== "All") {
                        $stmt = $conn->prepare("SELECT * FROM room WHERE room_type = ?");
                        $stmt->bind_param("s", $selectedRoomType);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    } else {
                        $result = $conn->query($sql);
                    }

                    if ($result->num_rows > 0) {
                        $numrow = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$numrow}</td>";
                            echo "<td>{$row['room_ID']}</td>";
                            echo "<td>{$row['room_Type']}</td>";
                            echo "<td>{$row['room_Capacity']}</td>";
                            echo "<td>RM{$row['room_Price_Per_Hour']}</td>";
                            echo "<td>{$row['room_Availability_Status']}</td>";
                            echo "<td>";
                            echo "<a href='room_edit.php?id={$row['room_ID']}' class='edit-button'>Edit</a>";
                            echo "<a href='room_delete.php?id={$row['room_ID']}' class='delete-button' onclick='return confirm(\"Delete?\")'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                            $numrow++;
                        }
                    } else {
                        echo "<tr><td colspan='7'>No results found</td></tr>";
                    }

                    $result->free();
                    $conn->close();
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
