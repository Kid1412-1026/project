<?php
include('config.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="header">
        <h1>Payment</h1>
    </div>
    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
    </nav>
    <div class="pageTitle">
            <h1>Payment List</h1>
        </div>
    <table border="1" id="adjustable">
        <thead>
            <tr>
                <th>No</th>
                <th>Booking ID</th>
                <th>Customer ID</th>
                <th>Payment Date</th>
                <th>Payment Time</th>
                <th>Total Payment</th>
                <th>Payment Amount</th>
                <th>Payment Balance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM payment";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $numrow = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $numrow . "</td>
                    <td>" . $row["booking_ID"] . "</td>
                    <td>" . $row["cust_ID"] . "</td>
                <td>" . $row["payment_Date"] . "</td>
                <td>" . substr($row["payment_Time"], 0, 5) .
                        "</td>
                    <td>RM" . $row["payment_Total"] . "</td>
                    <td>RM" . $row["payment_Amount"] . "</td>
                    <td>RM" . $row["payment_Balance"] . "</td>";
                    echo '<td>';
                    echo '<a href="paymentedit.php?payment_ID=' . $row["payment_ID"] . '" style="background-color: #00ff00; padding: 5px 10px; text-decoration: none; border-radius: 5px; border: 1px solid #000000; color: black;">Edit</a>&nbsp;&nbsp;';
                    echo '<a href="paymentdelete.php?payment_ID =' . $row["payment_ID"] . '" style="background-color: #ff0000; padding: 5px 10px; text-decoration: none; border-radius: 5px; border: 1px solid #000000; color: black;" onClick="return confirm(\'Delete?\');">Delete</a>';
                    echo "</tr>" . "\n\t\t";
                    $numrow++;
                }
            }
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
 <p></p>
    <div style="text-align: center;">
        <a href="paymentadd.php"
            style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px; margin-right: 10px;">Add
            Payment</a>
    </div>
    <p></p>
    <footer>
        <span><i>Copyright &copy; 2023 FCI </i></span>
    </footer>
</body>

</html>