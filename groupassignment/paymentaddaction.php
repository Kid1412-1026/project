<?PHP
include('config.php');
session_start();
//variables
$payment_Date = "";
$payment_Time = "";
$payment_Total = "";
$payment_Amount = "";
$booking_ID = "";
$cust_ID = "";

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $select = "SELECT userid FROM user WHERE userid=" . $_SESSION["UID"];
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userid = $row["userid"];
    }

    //values for add or edit
    $payment_Date = $_POST["payment_Date"];
    $payment_Time = $_POST["payment_Time"];
    $payment_Total = $_POST["payment_Total"];
    $payment_Amount = $_POST["payment_Amount"];
    $booking_ID = $_POST["booking_ID"];
    $cust_ID =$_POST["cust_ID"];

    $sql = "INSERT INTO payment (payment_Date, payment_Time, payment_Total, payment_Amount, payment_Balance, userid, cust_ID,booking_ID)
    VALUES ('" . $payment_Date . "','" . $payment_Time . "','" . $payment_Total . "','" . $payment_Amount . "',
        '" . ($payment_Total - $payment_Amount) . "', '" . $userid . "', '" . $cust_ID . "', '" . $booking_ID . "' )";

    $status = insertTo_DBTable($conn, $sql);
    if ($status) {
        echo "<h3 align=center>Form data saved successfully!</h3><br>";
        echo '<div style="text-align: center;">';
        echo '<a href="payment.php" style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px; margin-right: 10px;">View</a>';
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