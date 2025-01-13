<?php 
    include('include/config.php');

    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve and sanitize form inputs
        $roomID = mysqli_real_escape_string($conn, $_POST['roomID']);
        $roomType = mysqli_real_escape_string($conn, $_POST['roomType']);
        $roomCapacity = intval($_POST['roomCapacity']);
        $roomPrice = floatval($_POST['roomPrice']);
        $roomStatus = mysqli_real_escape_string($conn, $_POST['roomStatus']);

        // Prepare the SQL query
        $sql = "INSERT INTO room (room_ID, room_Type, room_Capacity, room_Price_Per_Hour, room_Availability_Status) 
                VALUES (?, ?, ?, ?, ?);";

        // Initialize a prepared statement
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind parameters to the statement
            mysqli_stmt_bind_param($stmt, 'ssids', $roomID, $roomType, $roomCapacity, $roomPrice, $roomStatus);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Room added successfully!<br>";
                echo '<a href="room.php">Back to Room List</a>';
            } else {
                echo "Error: Unable to execute query.<br>Error details: " . mysqli_error($conn) . "<br>";
                echo '<a href="room.php">Back to Room List</a>';
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: Unable to prepare the SQL statement.<br>Error details: " . mysqli_error($conn) . "<br>";
            echo '<a href="room.php">Back to Room List</a>';
        }
    }

    // Close the database connection
    mysqli_close($conn);
?>
