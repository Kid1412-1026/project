<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!-- Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        .header {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .topNav {
            background-color: #333;
            overflow: hidden;
            padding: 10px;
        }
        .topNav .icon {
            float: right;
        }
        .greeting, .info {
            text-align: center;
            padding: 20px;
        }
        .info {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .briefInfo {
            width: 250px;
            margin: 10px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            text-align: left;
        }
        .info-link {
            text-decoration: none;
            color: inherit;
        }
        footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header>
        <div class="header">
            <h1>Meeting Room Booking System</h1>
        </div>
    </header>

    <!-- Navigation Bar -->
    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
        <a href="javascript:void(0);" class="icon" onClick="regulateNavMenu()"><i class="fa fa-bars"></i></a>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Greeting Section -->
        <div class="greeting">
            <?php if (isset($_SESSION["UID"])): ?>
                <h1 style="text-align: center">Welcome Back</h1>
            <?php else: ?>
                <h1 style="text-align: center">Welcome to Meeting Room Booking System</h1>
            <?php endif; ?>
        </div>

        <!-- Information Section -->
        <div class="info">
            <div class="briefInfo">
                <a href="landingpage.php" class="info-link">
                    <p><b>Login</b><br>Login to your profile.</p>
                </a>
            </div>
            <div class="briefInfo">
                <p><b>My Profile</b><br>View and manage your information in a personalized portfolio.</p>
            </div>
            <div class="briefInfo">
                <p><b>Bookings</b><br>Manage your meeting room bookings efficiently.</p>
            </div>
            <div class="briefInfo">
                <p><b>Contact Us</b><br>Reach out to our support team for assistance.</p>
            </div>
        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        <h3>&copy; KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>

</body>

</html>
