<?php
session_start();
include('include/config.php');

// Initialize variables for pop-up messages
$popupMessage = '';
$popupType = ''; // 'success' or 'error'

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize user input
    $reportname = trim(mysqli_real_escape_string($conn, $_POST["reportname"]));
    $reportemail = trim(mysqli_real_escape_string($conn, $_POST["reportemail"]));
    $reportmsg = trim(mysqli_real_escape_string($conn, $_POST["reportmsg"]));

    // Validate required fields
    if (!empty($reportname) && !empty($reportemail) && !empty($reportmsg)) {
        // Prepare SQL statement
        $sql = "INSERT INTO report (reportname, reportemail, reportmsg) 
                VALUES ('$reportname', '$reportemail', '$reportmsg')";

        // Execute query and handle the result
        if (mysqli_query($conn, $sql)) {
            $_SESSION['popupMessage'] = 'Report sent successfully!';
            $_SESSION['popupType'] = 'success';
        } else {
            $_SESSION['popupMessage'] = 'Error while submitting the report: ' . mysqli_error($conn);
            $_SESSION['popupType'] = 'error';
        }
    } else {
        $_SESSION['popupMessage'] = 'All fields are required. Please fill in the form completely.';
        $_SESSION['popupType'] = 'error';
    }
}

// Close database connection
mysqli_close($conn);

// Redirect to the report page
header("Location: report.php");
exit();
?>
