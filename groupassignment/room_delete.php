<?php
include('include/config.php');

// Check if 'id' is set in the GET request
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Prepare the SQL query
    $sql = "DELETE FROM room WHERE room_ID = '$id'";

    // Execute the query and handle the result
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully.<br>";
    } else {
        echo "Error deleting record: " . mysqli_error($conn) . "<br>";
    }

    // Provide a link back to the room list page
    echo '<a href="room.php">Back</a>';
} else {
    // Handle the case where 'id' is not provided
    echo "Invalid request. No room ID provided.<br>";
    echo '<a href="room.php">Back</a>';
}

// Close the database connection
mysqli_close($conn);
?>
