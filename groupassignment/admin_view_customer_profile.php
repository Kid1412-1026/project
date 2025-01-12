<?php 
    include "include/config.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer List</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">   
</head>

<body>
    <header>
        <div class="header">
            <h1>Meeting Room Booking System</h1>  
        </div>
    </header>

    <nav class="topNav" id="topNav">
        <?php include "include/navMenu.php"; ?>
        <a href="javascript:void(0);" class="icon" onClick="regulateNavMenu"><i class="fa fa-bars"></i></a>
    </nav>

    <main>
        <div class="pageTitle">
            <h1>Customer List</h1>
        </div>

        <?php 
            // Fetch customer data from the database
            $sql = "SELECT cust_ID, cust_Name, cust_Phone_No FROM customer";
            $result = mysqli_query($conn, $sql);
        ?>

        <table border="1" id="adjustable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Customer Contact Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        $numRow = 1;

                        // Loop through the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $numRow . "</td>";
                            echo "<td>" . htmlspecialchars($row["cust_ID"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["cust_Name"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["cust_Phone_No"]) . "</td>";
                            echo "<td>";
                            echo '<a href="admin_delete_customer_profile.php?id=' . htmlspecialchars($row["cust_ID"]) . 
                                '" onClick="return confirm(\'Are you sure you want to delete this record?\')">Delete</a>';
                            echo "</td>";
                            echo "</tr>";

                            $numRow++;
                        }
                    } else {
                        // Display a message if no records are found
                        echo '<tr><td colspan="5">No customers found.</td></tr>';
                    }

                    // Free the result set and close the connection
                    mysqli_free_result($result);
                    mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </main>

    <footer>
        <h3>&copy; KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>
</body>

</html>
