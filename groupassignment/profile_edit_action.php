<?php
include('include/config.php');

// Initialize variables
$cust_ID = $cust_Name = $cust_Phone_No = "";

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input values to prevent SQL Injection
    $cust_ID = mysqli_real_escape_string($conn, $_POST["custID"]);
    $cust_Name = mysqli_real_escape_string($conn, $_POST["custName"]);
    $cust_Phone_No = mysqli_real_escape_string($conn, $_POST["custPhoneNo"]);

    // Update SQL query
    $sql = "UPDATE customer SET cust_Name='$cust_Name', cust_Phone_No='$cust_Phone_No' WHERE cust_ID='$cust_ID'";

    // Attempt to update the record in the database
    $status = update_DBTable($conn, $sql);

    // Handle the result of the update
    if ($status) {
        echo "Form data updated successfully!<br>";
        echo '<a href="profile.php">Back</a>';
    } else {
        echo "Error updating data. <br>";
        echo '<a href="profile.php">Back</a>';
    }
}

// Close the database connection
mysqli_close($conn);

// Function to update the database
function update_DBTable($conn, $sql) {
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        // Log the error for debugging (you might want to remove this in production)
        error_log("Error updating database: " . mysqli_error($conn));
        return false;
    }
}
?>
