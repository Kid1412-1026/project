<?php
include('config.php');

if (isset($_GET["payment_ID"]) && $_GET["payment_ID"] != "") {
    $booking_ID = $_GET["payment_ID"];

    $sql = "DELETE FROM payment WHERE payment_ID=" . $payment_ID;
    if (mysqli_query($conn, $sql)) {
        echo "<h3 align=center>Record deleted successfully!</h3><br>";
        echo '<div style="text-align: center;">';
        echo '<a href="payment.php" style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px; margin-right: 10px;">View</a>';
        echo '</div>';
    } else {
        echo "<h3 align=center>Error deleting record: " . mysqli_error($conn) . "</h3><br>";
        echo '<div style="text-align: center;">';
        echo '<a href="javascript:history.back() style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px; margin-right: 10px;">Back</a>';
        echo '</div>';
    }
}

mysqli_close($conn);
?>