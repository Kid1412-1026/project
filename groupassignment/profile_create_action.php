<?php
include('include/config.php');
session_start();

// Variables
$cust_Name = "";
$cust_Phone_No = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cust_Name = $_POST["custName"];
    $cust_Phone_No = $_POST["custPhoneNo"];

$select = "SELECT userid FROM user WHERE userid=".$_SESSION["UID"];


    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userid = $row["userid"];
    }

    $sql = "INSERT INTO customer (cust_Name, cust_Phone_No, userid)
        VALUES ('" . $cust_Name . "', '" . $cust_Phone_No . "', '" . $userid . "')";

    $status = insertTo_DBTable($conn, $sql);

    if ($status) {
        echo "Form data saved successfully! <br>";
        echo '<a href="profile.php">Back</a>';
    } else {
        echo '<a href="profile.php">Back</a>';
    }
}
mysqli_close($conn);

// Function to insert database table
function insertTo_DBTable($conn, $sql)
{
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . ":" . mysqli_error($conn) . "<br>";
        return false;
    }
}
?>