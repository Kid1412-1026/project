<?php
    include('include/config.php');
    //this action is called when the Delete link is clicked
    if(isset($_GET["id"]) && $_GET["id"] != ""){
        $id = $_GET["id"];
        $sql = "DELETE FROM customer WHERE cust_ID= '$id'";

        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully<br>";
            echo '<a href="admin_view_customer_profile.php">Back</a>';
        } else {
            echo "Error deleting record: " . mysqli_error($conn) . "<br>";
            echo '<a href="admin_view_customer_profile.php">Back</a>';
        }  
    }
    mysqli_close($conn);
?>