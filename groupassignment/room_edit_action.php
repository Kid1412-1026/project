<?php
include('include/config.php');

// Variables
$ID = "";
$Type = "";
$Capacity = "";
$Price = "";
$Status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $ID = mysqli_real_escape_string($conn, $_POST["roomID"]);
    $Type = mysqli_real_escape_string($conn, $_POST["roomType"]);
    $Capacity = mysqli_real_escape_string($conn, $_POST["roomCapacity"]);
    $Price = mysqli_real_escape_string($conn, $_POST["roomPrice"]);
    $Status = mysqli_real_escape_string($conn, $_POST["roomStatus"]);

    // Prepare the SQL update query
    $sql = "UPDATE room SET 
            room_Type = '$Type', 
            room_Capacity = '$Capacity', 
            room_Price_Per_Hour = '$Price', 
            room_Availability_Status = '$Status' 
            WHERE room_ID = '$ID'";

    // Execute the query
    $status = update_DBTable($conn, $sql);

    if ($status) {
        echo "Form data updated successfully!<br>";
    } else {
        echo "Error updating data. Please try again.<br>";
    }

    echo '<a href="room.php">Back</a>';
}

// Close the database connection
mysqli_close($conn);

/**
 * Updates the database table with the given SQL query.
 *
 * @param mysqli $conn Database connection
 * @param string $sql SQL query
 * @return bool True if successful, false otherwise
 */
function update_DBTable($conn, $sql) {
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn) . "<br>";
        return false;
    }
}
?>
