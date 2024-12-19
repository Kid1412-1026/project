<?php 
    include('include/config.php');

    // Variables
    $ID = "";
    $Type = "";
    $Capacity = "";
    $Price = "";
    $Status = "";
 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ID = $_POST["roomID"];
        $Type = $_POST["roomType"];
        $Capacity = $_POST["roomCapacity"];
        $Price = $_POST["roomPrice"];
        $Status = $_POST["roomStatus"];

        $sql = "INSERT INTO room (room_ID, room_Type, room_Capacity, room_Price_Per_Hour, room_Availability_Status)
        VALUES ( '" . $ID . "' , '" . $Type . "', '" . $Capacity ."', '" . $Price . "', '" . $Status . "')";

        $status = insertTo_DBTable($conn, $sql);

        if ($status) {
            echo "Form data saved successfully! <br>";
            echo '<a href="room.php">Back</a>';
        } else {
            echo '<a href="room.php">Back</a>';
        }
    }
    mysqli_close($conn);
    
    // Function to insert database table
    function insertTo_DBTable($conn, $sql){
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            echo "Error: " . $sql . ":" . mysqli_error($conn) . "<br>";
            return false; 
        }
    }
?>