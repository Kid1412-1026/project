<?php 
include("include/config.php");
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
        <?php 
        // Initialize variables
        $roomID = $roomType = $roomCapacity = $roomPrice = $roomStatus = "";

        // Fetch room details if ID is provided
        if (isset($_GET["id"]) && $_GET["id"] !== "") {
            $id = $_GET['id'];
            $sql = "SELECT * FROM room WHERE room_ID= '$id'";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $roomID = $row["room_ID"];
                $roomType = $row["room_Type"];
                $roomCapacity = $row["room_Capacity"];
                $roomPrice = $row["room_Price_Per_Hour"];
                $roomStatus = $row["room_Availability_Status"];
            }
        }
        mysqli_close($conn);
        ?>

        <div class="pageTitle">
            <h1>Update Room</h1>
        </div>
        <br>
        <div class="updateRoom">
            <form method="POST" action="room_edit_action.php" id="updateForm" enctype="multipart/form-data">
                <table border="1" id="roomForm">
                    <tr>
                        <td><b>Room ID</b></td>
                        <td><input type="text" name="roomID" value="<?= htmlspecialchars($roomID) ?>"></td>
                    </tr>
                    <tr>
                        <td><b>Room Type</b></td>
                        <td>
                            <select name="roomType">
                                <?php
                                $roomTypes = [
                                    "Board Room",
                                    "Breakout Room",
                                    "Conference Room",
                                    "Huddle Room",
                                    "Seminar Room",
                                    "Video Conference Room"
                                ];
                                foreach ($roomTypes as $type) {
                                    $selected = ($type === $roomType) ? "selected" : "";
                                    echo "<option value='$type' $selected>$type</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Room Capacity</b></td>
                        <td><input type="number" name="roomCapacity" value="<?= htmlspecialchars($roomCapacity) ?>"></td>
                    </tr>
                    <tr>
                        <td><b>Room Price (Per Hour)</b></td>
                        <td><input type="text" name="roomPrice" value="<?= htmlspecialchars($roomPrice) ?>"></td>
                    </tr>
                    <tr>
                        <td><b>Room Status</b></td>
                        <td>
                            <select name="roomStatus">
                                <?php
                                $statuses = ["Not Booked", "Booked", "Occupied"];
                                foreach ($statuses as $status) {
                                    $selected = ($status === $roomStatus) ? "selected" : "";
                                    echo "<option value='$status' $selected>$status</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <br> 
                <div class="formButton">
                    <input type="submit" value="Submit" name="Submit"> &nbsp;
                    <input type="reset" value="Reset" name="Reset"> &nbsp;
                    <input type="button" value="Clear" name="Clear" onclick="clearForm()">
                </div>
            </form>
        </div>
    </main>

    <footer style="position: fixed; bottom: 0;">
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>

    <script>
        function clearForm() {
            const form = document.getElementById("updateForm");
            if (form) {
                form.reset();
                form.querySelectorAll("input[type=text], input[type=number]").forEach(input => input.value = "");
                form.querySelectorAll("select").forEach(select => select.selectedIndex = 0);
            } else {
                console.error("Form not found");
            }
        }
    </script>
</body>

</html>
