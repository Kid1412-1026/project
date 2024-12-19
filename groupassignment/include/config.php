<?php
    $databaseHost = "localhost";
    $databaseUsername = "root";
    $databasePassword = "";
    $databaseName = "meeting_room_booking_system";

    // Create connection
    $conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
?>