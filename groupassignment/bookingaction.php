<?PHP
include('config.php');
session_start();
//variables

$booking_Date = "";
$booking_Time_Start = "";
$booking_Time_End = "";
$roomID= "";

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $select = "SELECT userid FROM user WHERE userid=" . $_SESSION["UID"];
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userid = $row["userid"];
    }

    $query = "SELECT cust_ID FROM customer WHERE userid=" . $_SESSION["UID"];
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $cust_ID = $row["cust_ID"];
    }

    //values for add or edit

    $booking_Date = $_POST["booking_Date"];
    $booking_Time_Start = $_POST["booking_Time_Start"];
    $booking_Time_End = $_POST["booking_Time_End"];
    $roomID=$_POST["roomID"];

    $sql = "INSERT INTO booking (booking_Date, booking_Time_Start, booking_Time_End, booking_Duration, userid,cust_ID,room_ID, booking_Status)
    VALUES ('" . $booking_Date . "','" . $booking_Time_Start . "','" . $booking_Time_End . "',
        TIME_FORMAT(TIMEDIFF('" . $booking_Time_End . "', '" . $booking_Time_Start . "'), '%H hours %i minutes'),
        '" . $userid . "', '" . $cust_ID . "','" . $roomID . "' ,'Pending')";
    $status = insertTo_DBTable($conn, $sql);
    if ($status) {
        echo "<h3 align=center>Form data saved successfully!</h3><br>";
        echo '<div style="text-align: center;">';
        echo '<a href="booking.php" style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px;">View</a>';
        echo '<br><br>';
        echo '<a href="feedback.php" style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #3366ff; border-radius: 5px; color: #fff; margin-right: 10px;">Leave us a feedback :)<br>(Optional)</a>';
        echo '</div>';
    } else {
        echo '<div style="text-align: center;">';
        echo '<a href="javascript:history.back() style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px; margin-right: 10px;">Back</a>';
        echo '</div>';
    }
}

//close db connection
mysqli_close($conn);
//Function to insert data to database table
function insertTo_DBTable($conn, $sql)
{
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        return false;
    }
}
?>