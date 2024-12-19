<?php 
    include("include/config.php");
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
        <?php
            include("include/navMenu.php");
        ?>
            <a href="javascript:void(0);" class="icon" onClick="regulateNavMenu"><i class="fa fa-bars"></i></a>
    </nav>

    <main>
        <div class="pageTitle">
            <br>
            <h1>Customer List</h1>
        </div>

        <br><br>

        <?php 
            $sql = "SELECT * FROM customer";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($result);
            $cust_ID = $row["cust_ID"];
            $cust_Name = $row["cust_Name"];
            $cust_Phone_No = $row["cust_Phone_No"];

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
                        $sql = "SELECT * FROM customer";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            //Output data of each row
                            $numrow = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $numrow . "</td><td>" . $row["cust_ID"] . "</td><td>" .
                                $row["cust_Name"] . "</td><td>" . $row["cust_Phone_No"] . "</td>";
                                echo '<td>';
                                echo '<a href="admin_delete_customer_profile.php?id=' . 
                                $row["cust_ID"] . '" onClick="return confirm(\'Delete?\')">Delete</a></td>';
                                echo "</tr>" . "\n\t\t";
                                $numrow++;
                            }
                        } else {
                            echo '<tr><td colspan="6">0 results</td></tr>';
                        }
                        mysqli_close($conn);
                    ?>
                </tbody>
            </table>

        <br><br><br><br><br>
    </main>

    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
    </footer>
</body>

</html>