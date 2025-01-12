<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: flex-start;
            margin: 20px;
        }

        .col-left, .col-right {
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            margin: 10px;
        }

        .col-left {
            flex: 3;
        }

        .col-right {
            flex: 2;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        th {
            width: 30%;
            background-color: #f9f9f9;
        }

        td {
            width: 70%;
            background-color: #fff;
        }

        .saveButton {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .saveButton:hover {
            background-color: #45a049;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            outline: none;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .contact-item {
            margin: 10px 0;
            font-size: 1.2em;
        }
    </style>
</head>

<body>
    <header>
        <div class="header">
            <h1>Meeting Room Booking System</h1>
        </div>
    </header>

    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
    </nav>

    <div class="greeting">
        <h1 style="text-align: center;">Report Form</h1>
    </div>

    <div class="row"> 
        <!-- Left Column: Form -->
        <div class="col-left"> 
            <form method="POST" action="report_action.php" id="reportform" class="form-container">
                <table>
                    <tr>
                        <th>Name</th>
                        <td><input name="reportname" type="text" required></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input name="reportemail" type="email" required></td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td><textarea name="reportmsg" required></textarea></td>
                    </tr>
                </table>
                <button class="saveButton" type="submit">Submit Report</button>
            </form>
        </div> 

        <!-- Right Column: Contact Information -->
        <div class="col-right"> 
            <h2>Contact Us</h2>
            <div class="contact-item">
                <i class="fa fa-envelope"></i> meetingroom@iluv.ums.edu.my
            </div>
            <div class="contact-item">
                <i class="fa fa-phone"></i> 012-3456789
            </div>
            <div class="contact-item">
                <i class="fa fa-map-marker"></i> UMS
            </div>
        </div> 
    </div>

    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>

    <script>
        // Display alert if session variables exist
        <?php if (isset($_SESSION['popupMessage']) && isset($_SESSION['popupType'])): ?>
            alert("<?php echo $_SESSION['popupMessage']; ?>");
            <?php unset($_SESSION['popupMessage'], $_SESSION['popupType']); ?>
        <?php endif; ?>
    </script>
</body>
</html>
