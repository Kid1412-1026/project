<?php
include('include/config.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION["UID"])) {
    echo "You must be logged in to create a profile. Please <a href='login.php'>log in</a>.";
    exit();
}

// Initialize variables
$cust_Name = $cust_Phone_No = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $cust_Name = mysqli_real_escape_string($conn, trim($_POST["custName"]));
    $cust_Phone_No = mysqli_real_escape_string($conn, trim($_POST["custPhoneNo"]));

    // Ensure valid phone number format
    if (!preg_match('/^\d{10,15}$/', $cust_Phone_No)) {
        echo "Please enter a valid phone number (10-15 digits). <br>";
        exit();
    }

    // Get user ID from session
    $userid = $_SESSION["UID"];

    // Prepare the insert query
    $stmt = $conn->prepare("INSERT INTO customer (cust_Name, cust_Phone_No, userid) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $cust_Name, $cust_Phone_No, $userid);

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "Profile created successfully! <br>";
        echo '<a href="profile.php">Go to profile</a>';
    } else {
        echo "Error: " . $stmt->error . "<br>";
        echo '<a href="profile_create.php">Try again</a>';
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
mysqli_close($conn);
?>
