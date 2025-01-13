<?php
include("include/config.php");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$roomID = "";
$roomType = "";
$roomCapacity = "";
$roomPrice = "";
$roomStatus = "";

// Fetch room details if ID is provided
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    $sql = "SELECT * FROM room WHERE room_ID = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $roomID = $row["room_ID"];
        $roomType = $row["room_Type"];
        $roomCapacity = $row["room_Capacity"];
        $roomPrice = $row["room_Price_Per_Hour"];
        $roomStatus = $row["room_Availability_Status"];
    } else {
        echo "No room found with the given ID.<br>";
        echo '<a href="room.php">Back</a>';
        exit;
    }
} else {
    echo "Invalid request. No room ID provided.<br>";
    echo '<a href="room.php">Back</a>';
    exit;
}

mysqli_close($conn);

// Function to populate dropdown options
function generateDropdownOptions($options, $selectedValue) {
    $html = '';
    foreach ($options as $value) {
        $isSelected = ($value === $selectedValue) ? 'selected' : '';
        $html .= "<option value='$value' $isSelected>$value</option>";
    }
    return $html;
}

// Predefined dropdown values
$roomTypes = ["Board Room", "Breakout Room", "Conference Room", "Huddle Room", "Seminar Room", "Video Conference Room"];
$roomStatuses = ["Not Booked", "Booked", "Occupied"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Room</title>
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
        <a href="javascript:void(0);" class="icon" onClick="regulateNavMenu"><i class="fa fa-bars"></i></a>
    </nav>

    <main>
        <div class="pageTitle">
            <h1>Update Room</h1>
        </div>
        <br>
        <div class="updateRoom">
            <form method="POST" action="room_edit_action.php" id="updateForm" enctype="multipart/form-data">
                <table border="1" id="roomForm">
                    <tr>
                        <td><b>Room ID</b></td>
                        <td><input type="text" name="roomID" value="<?= htmlspecialchars($roomID) ?>" readonly></td>
                    </tr>
                    <tr>
                        <td><b>Room Type</b></td>
                        <td>
                            <select name="roomType" required>
                                <?= generateDropdownOptions($roomTypes, $roomType) ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Room Capacity</b></td>
                        <td><input type="number" name="roomCapacity" value="<?= htmlspecialchars($roomCapacity) ?>" required min="1"></td>
                    </tr>
                    <tr>
                        <td><b>Room Price (Per Hour)</b></td>
                        <td><input type="number" name="roomPrice" value="<?= htmlspecialchars($roomPrice) ?>" required step="0.01" min="0"></td>
                    </tr>
                    <tr>
                        <td><b>Room Status</b></td>
                        <td>
                            <select name="roomStatus" required>
                                <?= generateDropdownOptions($roomStatuses, $roomStatus) ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
                <div class="formButton">
                    <input type="submit" value="Submit" name="Submit">
                    <input type="reset" value="Reset">
                    <button type="button" onclick="clearForm()">Clear</button>
                </div>
            </form>
        </div>
    </main>

    <footer style="position: fixed; bottom: 0;">
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>

    <script>
        function clearForm() {
            document.getElementById("updateForm").reset();
        }
    </script>
</body>
</html>
