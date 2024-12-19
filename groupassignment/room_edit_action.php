<?PHP
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

        $sql = "UPDATE room SET room_Type='$Type', 
        room_Capacity='$Capacity', room_Price_Per_Hour='$Price', 
        room_Availability_Status='$Status' WHERE room_ID = '$ID'";

        $status = update_DBTable($conn, $sql);
            
        if ($status) {
            echo "Form data updated successfully!<br>";
            echo '<a href="room.php">Back</a>'; 
        } else {
            echo '<a href="room.php">Back</a>';
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