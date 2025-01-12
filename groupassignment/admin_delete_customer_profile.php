<?php
    include('include/config.php');

    // Check if the 'id' parameter exists and is not empty
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        // Sanitize the input
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        // Use a prepared statement for the delete query
        $sql = "DELETE FROM customer WHERE cust_ID = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $id); // Bind the 'id' parameter

            if (mysqli_stmt_execute($stmt)) {
                echo "Record deleted successfully<br>";
            } else {
                echo "Error deleting record: " . mysqli_error($conn) . "<br>";
            }

            mysqli_stmt_close($stmt); // Close the statement
        } else {
            echo "Failed to prepare the SQL statement: " . mysqli_error($conn) . "<br>";
        }
    } else {
        echo "Invalid or missing ID.<br>";
    }

    echo '<a href="admin_view_customer_profile.php">Back</a>';

    // Close the database connection
    mysqli_close($conn);
?>
