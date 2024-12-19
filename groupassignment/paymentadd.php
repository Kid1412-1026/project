<?PHP
include('config.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
</head>

<body>
    <div class="header">
        <h1>Booking</h1>
    </div>
    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
    </nav>
    <div style="padding:0 10px;" id="kpiDiv">
        <form method="POST" action="paymentaddaction.php" enctype="multipart/form-data" id="myForm">
            <table border="1" id="myTable">
            <tr>
                    <td>Booking ID</td>
                    <td><input type="text" name="booking_ID" size="20"></td>
                </tr>
                 <tr>
                    <td>Customer ID</td>
                    <td><input type="text" name="cust_ID" size="20"></td>
                </tr>
                <tr>
                    <td>Payment Date:</td>
                    <td><input type="date" name="payment_Date" size="20"></td>
                </tr>
                <tr>
                    <td>Payment Time:</td>
                    <td><input type="time" name="payment_Time" size="20"></td>
                </tr>
                <tr>
                    <td>Payment Total:</td>
                    <td><input type="text" name="payment_Total" size="20"></td>
                </tr>
                <tr>
                    <td>Payment Amount:</td>
                    <td><input type="text" name="payment_Amount" size="20"></td>
                </tr>
                <div class="col-right">
                    <td colspan="10" align="middle">
                        <input type="submit" value="Submit" style="background-color: #00FF00" name="B1">
                        <input type="reset" value="Reset" style="background-color: #FF0000" name="B2">
                    </td>
                    </tr>
                </div>
        </form>
        </table>
        <p></p>

        <footer>
            <span><i>Copyright &copy; 2023 FCI </i></span>
        </footer>
</body>

</html>