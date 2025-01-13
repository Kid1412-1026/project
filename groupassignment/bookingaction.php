<?php
include('config.php');
session_start();

// Variables
$booking_Date = "";
$booking_Time_Start = "";
$booking_Time_End = "";
$roomID = "";

// Function to insert data into the database table
function insertToDBTable($conn, $sql)
{
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: $sql : " . mysqli_error($conn) . "<br>";
        return false;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userIdQuery = "SELECT userid FROM user WHERE userid=" . $_SESSION["UID"];
    $userResult = mysqli_query($conn, $userIdQuery);

    if ($userResult && mysqli_num_rows($userResult) > 0) {
        $userRow = mysqli_fetch_assoc($userResult);
        $userid = $userRow["userid"];
    }

    $customerQuery = "SELECT cust_ID FROM customer WHERE userid=" . $_SESSION["UID"];
    $customerResult = mysqli_query($conn, $customerQuery);

    if ($customerResult && mysqli_num_rows($customerResult) > 0) {
        $customerRow = mysqli_fetch_assoc($customerResult);
        $cust_ID = $customerRow["cust_ID"];
    }

    // Get form values
    $booking_Date = $_POST["booking_Date"];
    $booking_Time_Start = $_POST["booking_Time_Start"];
    $booking_Time_End = $_POST["booking_Time_End"];
    $roomID = $_POST["roomID"];

    // Prepare SQL statement
    $sql = "INSERT INTO booking (booking_Date, booking_Time_Start, booking_Time_End, booking_Duration, userid, cust_ID, room_ID, booking_Status) " .
           "VALUES (?, ?, ?, TIME_FORMAT(TIMEDIFF(?, ?), '%H hours %i minutes'), ?, ?, ?, 'Pending')";

    // Prepare and bind statement
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssssss', $booking_Date, $booking_Time_Start, $booking_Time_End, $booking_Time_End, $booking_Time_Start, $userid, $cust_ID, $roomID);

        if (mysqli_stmt_execute($stmt)) {
            echo "<h3 align='center'>Form data saved successfully!</h3><br>";
            echo '<div style="text-align: center;">';
            echo '<a href="booking.php" style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px;">View</a><br><br>';
            echo '<a href="feedback.php" style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #3366ff; border-radius: 5px; color: #fff; margin-right: 10px;">Leave us a feedback :)<br>(Optional)</a>';
            echo '</div>';
        } else {
            echo "<div style='text-align: center;'>Error: Could not execute query.</div>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>
