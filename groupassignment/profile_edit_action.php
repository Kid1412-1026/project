<?php
    include('include/config.php');

    // Variables
    $cust_ID = "";
    $cust_Name = "";
    $cust_Phone_No = "";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cust_ID = $_POST["custID"];
        $cust_Name = $_POST["custName"];
        $cust_Phone_No = $_POST["custPhoneNo"];


        $sql = "UPDATE customer SET cust_Name='$cust_Name', 
        cust_Phone_No='$cust_Phone_No' WHERE cust_ID = '$cust_ID'";

        $status = update_DBTable($conn, $sql);
            
        if ($status) {
            echo "Form data updated successfully!<br>";
            echo '<a href="profile.php">Back</a>'; 
        } else {
            echo '<a href="profile.php">Back</a>';
        } 
    }
mysqli_close($conn);

    function update_DBTable($conn, $sql){
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
            return false;
        }
    }
?>