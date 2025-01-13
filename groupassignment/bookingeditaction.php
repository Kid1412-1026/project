<?php
include('config.php');
session_start();

$booking_Date = "";
$booking_Time_Start = "";
$booking_Time_End = "";
$roomID = "";
$booking_Status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("SELECT userrole FROM user WHERE userid = ?");
    $stmt->bind_param("i", $_SESSION["UID"]);
    $stmt->execute();
    $stmt->bind_result($userrole);
    $stmt->fetch();
    $stmt->close();

    $booking_ID = $_POST["booking_ID"];
    $booking_Date = $_POST["booking_Date"];
    $booking_Time_Start = $_POST["booking_Time_Start"];
    $booking_Time_End = $_POST["booking_Time_End"];
    $roomID = $_POST["roomID"];

    $booking_Status = $userrole == 1 ? $_POST["booking_Status"] : 'Pending';

    $sql = "UPDATE booking SET booking_Date = ?, booking_Time_Start = ?, booking_Time_End = ?, booking_Duration = TIME_FORMAT(TIMEDIFF(?, ?), '%H hours %i minutes'), room_ID = ?, booking_Status = ? WHERE booking_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $booking_Date, $booking_Time_Start, $booking_Time_End, $booking_Time_End, $booking_Time_Start, $roomID, $booking_Status, $booking_ID);

    if ($stmt->execute()) {
        echo "<h3 align='center'>Form data saved successfully!</h3><br>";
        echo '<div style="text-align: center;">';
        echo '<a href="' . ($userrole == 1 ? 'bookingadmin.php' : 'booking.php') . '" style="display: inline-block; padding: 10px 20px; text-decoration: none; background-color: #00ff00; border-radius: 5px;">View</a>';
        echo '</div>';
    } else {
        echo "<h3 align='center'>Failed to update</h3><br>";
        echo '<div style="text-align: center;">';
        echo '<a href="javascript:history.back()" style="display: inline-block; padding: 10px 20px; text-decoration: none; background-color: red; border-radius: 5px;">Back</a>';
        echo '</div>';
    }

    $stmt->close();
}

$conn->close();
?>
