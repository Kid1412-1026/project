<?php
include('include/config.php');
session_start();

// Variables
$changepwd = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $changepwd = $_POST["chgpassword"];
    $pwdHash = trim(password_hash($changepwd, PASSWORD_DEFAULT));

    $sql = "UPDATE user SET userpwd='$pwdHash'WHERE userid=" . $_SESSION["UID"];

    $status = update_DBTable($conn, $sql);

    if ($status) {
        echo "Form data updated successfully!<br>";
        echo '<a href="profile.php">Back</a>';
    } else {
        echo '<a href="profile.php">Back</a>';
    }
}
mysqli_close($conn);

function update_DBTable($conn, $sql)
{
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        return false;
    }
}
?>