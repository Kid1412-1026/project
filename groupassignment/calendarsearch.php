<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Calendar</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header">
        <h1>Calendar</h1>
    </div>

    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
            <a href="javascript:void(0);" class="icon" onClick="regulateNavMenu"></a>
    </nav>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search = $_POST["search"];
    }
    ?>

    <h2 align="center">Search Result:&nbsp;
        <?= $search ?>
    </h2>

    <div style="padding:0 10px;">
        <div style="text-align: right; padding:10px;">
            <form action="calendarsearch.php" method="post" style="display: inline-block;">
                <input type="text" name="search">
                <input type="submit" value="Search">
            </form>
            <a href="calendar.php"
                style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px; margin-right: 10px;">Back</a>
        </div>

        <p align="center">Rooms Availability</p>
        <table border="1" id="adjustable">
            <tr>
                <th>No</th>
                <th>Room ID</th>
                <th>Room Type</th>
                <th>Room Capacity</th>
                <th>Price Per Hour</th>
                <th>Room Availability Status</th>
            </tr>

            <?php
            if ($search != "") {
                $search = $_POST["search"];

                $keywords = explode(" ", $search);

                $sql = "SELECT * FROM room WHERE room_Availability_Status = 'Not Booked' AND (";

                // Build the conditions dynamically for single keyword
                $conditions = [];
                foreach ($keywords as $index => $keyword) {
                    $conditions[] = "room_Type LIKE '%$keyword%'";
                }

                // Combine
                $sql .= implode(" OR ", $conditions);

                // Select only with this userID
                $sql .= " OR room_Type LIKE '%$search%')";

                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    // output data of each row
                    $numrow = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $numrow . "</td>
                        <td>" . $row["room_ID"] . "</td>
                        <td>" . $row["room_Type"] . "</td>                          
                        <td>" . $row["room_Capacity"] . "</td>
                        <td>RM" . $row["room_Price_Per_Hour"] . "</td>
                        <td>" . $row["room_Availability_Status"] . "</td>";
                        echo "</tr>" . "\n\t\t";
                        $numrow++;
                    }
                } else {
                    echo '<tr><td colspan="7">0 results</td></tr>';
                }

                mysqli_close($conn);
            } else {
                echo "Search query is empty<br>";
            }
            ?>
        </table>
    </div>

    <p></p>
    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
    </footer>

    <script>
        //for responsive sandwich menu
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }

        function show_AddEntry() {
            var x = document.getElementById("challengeDiv");
            x.style.display = 'block';
            var firstField = document.getElementById('sem');
            firstField.focus();
        }
    </script>
</body>

</html>