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
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </nav>

    <?php
    $search = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["search"])) {
        $search = htmlspecialchars($_POST["search"]);
    }
    ?>

    <h2 align="center">Search Result: <?= htmlspecialchars($search) ?></h2>

    <div style="padding: 0 10px;">
        <div style="text-align: right; padding: 10px;">
            <form action="calendarsearch.php" method="post" style="display: inline-block;">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>">
                <input type="submit" value="Search">
            </form>
            <a href="calendar.php" class="btn btn-green">Back</a>
        </div>

        <p align="center">Rooms Availability</p>
        <table border="1" id="adjustable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Room ID</th>
                    <th>Room Type</th>
                    <th>Room Capacity</th>
                    <th>Price Per Hour</th>
                    <th>Room Availability Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($search)) {
                    $keywords = explode(" ", $search);
                    $conditions = array_map(fn($keyword) => "room_Type LIKE '%" . mysqli_real_escape_string($conn, $keyword) . "%'", $keywords);

                    $sql = "SELECT * FROM room WHERE room_Availability_Status = 'Not Booked' AND (" . implode(" OR ", $conditions) . ")";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $numrow = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$numrow}</td>";
                            echo "<td>{$row['room_ID']}</td>";
                            echo "<td>{$row['room_Type']}</td>";
                            echo "<td>{$row['room_Capacity']}</td>";
                            echo "<td>RM{$row['room_Price_Per_Hour']}</td>";
                            echo "<td>{$row['room_Availability_Status']}</td>";
                            echo "</tr>";
                            $numrow++;
                        }
                    } else {
                        echo '<tr><td colspan="6">No results found</td></tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">Search query is empty</td></tr>';
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>

    <script>
        function myFunction() {
            const x = document.getElementById("topNav");
            x.classList.toggle("responsive");
        }

        function show_AddEntry() {
            const challengeDiv = document.getElementById("challengeDiv");
            if (challengeDiv) {
                challengeDiv.style.display = 'block';
                document.getElementById('sem').focus();
            }
        }
    </script>
</body>

</html>
