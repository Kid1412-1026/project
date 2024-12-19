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

    <div style="padding:0 10px;">
        <div style="text-align: right; padding:10px;">
            <form action="calendarsearch.php" method="post">
                <input type="text" name="search">
                <input type="submit" value="Search">
            </form>
        </div>
        <p align="center">Search Room Availability</p>
        <table border="1" id="adjustable">
            <tr>
                <th>No</th>
                <th>Room ID</th>
                <th>Room Type</th>
                <th>Room Capacity</th>
                <th>Price Per Hour</th>
                <th>Room Availability Status</th>
            </tr>
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