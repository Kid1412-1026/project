<?php
session_start();
include('include/config.php');

// Initialize variables for pop-up message
$popupMessage = '';
$popupType = ''; // 'success' or 'error'

// This block is called when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reportname = mysqli_real_escape_string($conn, $_POST["reportname"]);
    $reportemail = mysqli_real_escape_string($conn, $_POST["reportemail"]);
    $reportmsg = mysqli_real_escape_string($conn, $_POST["reportmsg"]);

    $sql = "INSERT INTO report (reportname, reportemail, reportmsg)
    VALUES ('$reportname', '$reportemail', '$reportmsg')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['popupMessage'] = 'Report sent successfully!';
        $_SESSION['popupType'] = 'success';
    } else {
        $_SESSION['popupMessage'] = 'Error: ' . mysqli_error($conn);
        $_SESSION['popupType'] = 'error';
    }
}

mysqli_close($conn);

header("Location: report.php");
exit();
?>