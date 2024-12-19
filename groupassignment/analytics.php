<?php
include("include/config.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Report Analytics</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <header>
        <div class="header">
            <h1>Report Analytics</h1>
        </div>
    </header>

    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
    </nav>

    <main>
        <div class="pageTitle">
            <h1>View Reports</h1>
        </div>
        <div class="reportSelector">
            <form method="POST">
                <label for="reportType">Select Report:</label>
                <select id="reportType" name="reportType" onchange="this.form.submit()">
                <option value="userReport" <?php echo (isset($_POST['reportType']) && $_POST['reportType'] == 'userReport') ? 'selected' : ''; ?>>User Report</option>
                    <option value="adminReport" <?php echo (isset($_POST['reportType']) && $_POST['reportType'] == 'adminReport') ? 'selected' : ''; ?>>Admin Report</option>
                    <option value="paymentReport" <?php echo (isset($_POST['reportType']) && $_POST['reportType'] == 'paymentReport') ? 'selected' : ''; ?>>Payment Report</option>
                    <option value="roomReport" <?php echo (isset($_POST['reportType']) && $_POST['reportType'] == 'roomReport') ? 'selected' : ''; ?>>Room Report</option>
                    <option value="feedbackReport" <?php echo (isset($_POST['reportType']) && $_POST['reportType'] == 'feedbackReport') ? 'selected' : ''; ?>>Feedback Report</option>
                </select>
            </form>
        </div>

        <br>

        <table border="1" id="adjustable">
            <tbody>
                <?php
                if (isset($_POST['reportType'])) {
                    $reportType = $_POST['reportType'];

                    switch ($reportType) {
                        case 'userReport':
                            $sql = "SELECT * FROM user WHERE userrole=2";
                            printUserReport($conn, $sql);
                            break;

                        case 'adminReport':
                            $sql = "SELECT * FROM user WHERE userrole=1";
                            printAdminReport($conn, $sql);
                            break;

                        case 'paymentReport':
                            $sql = "SELECT * FROM payment";
                            printPaymentReport($conn, $sql);
                            break;

                        case 'roomReport':
                            $sql = "SELECT * FROM room";
                            printRoomReport($conn, $sql);
                            break;

                        case 'feedbackReport':
                            $sql = "SELECT * FROM feedback";
                            printFeedbackReport($conn, $sql);
                            break;

                        default:
                            $sql = ""; // Handle other cases if needed
                            break;
                    }
                }
                ?>
            </tbody>
        </table>

    </main>

    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
    </footer>
</body>

</html>

<?php
function printUserReport($conn, $sql)
{
    printReportHeader(["No", "User ID", "User Email", "User Role", "Registration Date"]);

    if (!empty($sql)) {
        $result = mysqli_query($conn, $sql);
        printReportRows($result, ["userid", "useremail", "userrole", "regdate"]);
    }

    mysqli_close($conn);
}

function printAdminReport($conn, $sql)
{
    printReportHeader(["No", "User ID", "User Email", "User Role", "Registration Date"]);

    if (!empty($sql)) {
        $result = mysqli_query($conn, $sql);
        printReportRows($result, ["userid", "useremail", "userrole", "regdate"]);
    }

    mysqli_close($conn);
}

function printPaymentReport($conn, $sql)
{
    printReportHeader(["No", "Payment ID", "Customer ID", "Booking ID", "Payment Date", "Payment Time", "Payment Total", "Payment Amount", "Payment Balance", "User ID"]);

    if (!empty($sql)) {
        $result = mysqli_query($conn, $sql);
        printReportRows($result, ["payment_ID", "cust_ID", "booking_ID", "payment_Date", "payment_Time", "payment_Total", "payment_Amount", "payment_Balance", "userid"]);
    }

    mysqli_close($conn);
}

function printRoomReport($conn, $sql)
{
    printReportHeader(["No", "Room ID", "Room Type", "Room Capacity", "Room Price Per Hour", "Room Availability Status"]);

    if (!empty($sql)) {
        $result = mysqli_query($conn, $sql);
        printReportRows($result, ["room_ID", "room_Type", "room_Capacity", "room_Price_Per_Hour", "room_Availability_Status"]);
    }

    mysqli_close($conn);
}

function printFeedbackReport($conn, $sql)
{
    printReportHeader(["No", "Feedback ID", "Customer ID", "Feedback Date", "Feedback Rating", "Feedback Content", "User ID"]);

    if (!empty($sql)) {
        $result = mysqli_query($conn, $sql);
        printReportRows($result, ["feedback_ID", "cust_ID", "feedback_Date", "feedback_Rating", "feedback_Content", "userid"]);
    }

    mysqli_close($conn);
}

function printReportHeader($columns)
{
    echo "<thead>";
    echo "<tr>";
    foreach ($columns as $column) {
        echo "<th>$column</th>";
    }
    echo "</tr>";
    echo "</thead>";
}

function printReportRows($result, $columns)
{
    if (mysqli_num_rows($result) > 0) {
        $numrow = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>$numrow</td>";
            foreach ($columns as $column) {
                echo "<td>" . $row[$column] . "</td>";
            }
            echo "</tr>";
            $numrow++;
        }
    } else {
        echo "<tr><td colspan='" . count($columns) . "'>No results found</td></tr>";
    }
}
?>
