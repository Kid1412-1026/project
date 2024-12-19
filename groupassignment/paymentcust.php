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
    <?php echo '<nav class="topNav" id="topNav">';
    include("include/navMenu.php");
    echo '</nav>'; ?>
    <div class="pageTitle">
            <h1>Payments Made</h1>
        </div>
    <table border="1" id="adjustable">
        <thead>
            <tr>
                <th>No</th>
                <th>Payment Date</th>
                <th>Payment Time</th>
                <th>Total Payment</th>
                <th>Payment Amount</th>
                <th>Payment Balance</th>
            </tr>
        </thead>
        <?php

        ////// booking id needed here
        $sql = "SELECT * FROM payment WHERE userid=" . $_SESSION["UID"];
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $numrow = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $numrow . "</td>
                <td>" . $row["payment_Date"] . "</td>
                <td>" . substr($row["payment_Time"], 0, 5) . "</td>
                    <td>RM" . $row["payment_Total"] . "</td>
                    <td>RM" . $row["payment_Amount"] . "</td>
                    <td>RM" . $row["payment_Balance"] . "</td>";
                $numrow++;
            }
        }
        mysqli_close($conn);
        ?>
    </table>
    <p></p>
    <footer style="position: fixed; bottom: 0;">
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
    </footer>
</body>

</html>