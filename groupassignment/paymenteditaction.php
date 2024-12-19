<?PHP
include('config.php');
//variables
$payment_ID = "";
$payment_Date = "";
$payment_Time = "";
$payment_Total = "";
$payment_Amount = "";

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $payment_ID = $_POST["payment_ID"];
    $payment_Date = $_POST["payment_Date"];
    $payment_Time = $_POST["payment_Time"];
    $payment_Total = $_POST["payment_Total"];
    $payment_Amount = $_POST["payment_Amount"];
    $booking_ID = $_POST["booking_ID"];
    $cust_ID = $_POST["cust_ID"];

    $sql = "UPDATE payment SET payment_Date = '$payment_Date', payment_Time = '$payment_Time', booking_ID = '$booking_ID',cust_ID = '$cust_ID',
            payment_Total = '$payment_Total',payment_Amount = '$payment_Amount',
            payment_Balance= '$payment_Amount'- '$payment_Total' WHERE payment_ID = $payment_ID";
    $status = update_DBTable($conn, $sql);
    if ($status) {
        echo "<h3 align=center>Form data saved successfully!</h3><br>";
        echo '<div style="text-align: center;">';
        echo '<a href="payment.php" style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px; margin-right: 10px;">View</a>';
        echo '</div>';
    } else {
        echo "<h3 align=center></h3>Failed to update<br>";
        echo '<div style="text-align: center;">';
        echo '<a href="javascript:history.back() style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px; margin-right: 10px;">Back</a>';
        echo '</div>';
    }
}

//close db connection
mysqli_close($conn);
//Function to insert data to database table
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