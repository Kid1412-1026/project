<?php
include('config.php');
session_start();

if (isset($_GET["booking_ID"]) && !empty($_GET["booking_ID"])) {
    $booking_ID = intval($_GET["booking_ID"]); // Use intval to prevent SQL injection

    $sql = "DELETE FROM booking WHERE booking_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $booking_ID);
        if (mysqli_stmt_execute($stmt)) {
            echo "<h3 style='text-align: center;'>Record deleted successfully!</h3><br>";
            echo '<div style="text-align: center;">';
            echo '<a href="booking.php" style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px; color: black;">View</a>';
            echo '</div>';
        } else {
            echo "<h3 style='text-align: center;'>Error deleting record: " . htmlspecialchars(mysqli_error($conn)) . "</h3><br>";
            echo '<div style="text-align: center;">';
            echo '<a href="javascript:history.back()" style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #ff0000; border-radius: 5px; color: black;">Back</a>';
            echo '</div>';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<h3 style='text-align: center;'>Failed to prepare the SQL statement.</h3><br>";
        echo '<div style="text-align: center;">';
        echo '<a href="javascript:history.back()" style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #ff0000; border-radius: 5px; color: black;">Back</a>';
        echo '</div>';
    }
} else {
    echo "<h3 style='text-align: center;'>Invalid booking ID.</h3><br>";
    echo '<div style="text-align: center;">';
    echo '<a href="javascript:history.back()" style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #ff0000; border-radius: 5px; color: black;">Back</a>';
    echo '</div>';
}

mysqli_close($conn);
?>
