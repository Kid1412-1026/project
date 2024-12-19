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

        .row {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */ 
        }

        .col-left {
            text-align: center;
            padding: 15px;
            flex: 3; /* Adjust the flex property to allocate more width */
        }

        .col-right {
            flex: 2;
            padding: 15px;
        }

        .row {
            display: flex;
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

        .form-container {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            
        }

        th, td {
            padding: 10px; /* Decreased padding for labels and inputs */
            text-align: left;
            border: 1px solid rgba(0, 0, 0, 0.1); /* Thin line border with reduced opacity */
            border-radius: 8px; /* Curved corners */
        }

        th {
            width: 30%; /* Adjusted width for labels */
            background-color: #fff;
            color: black;
            
        }

        td {
            width: 70%; /* Adjusted width for inputs */
            background-color: #fff;
            
        }

        .saveButton {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .saveButton:hover {
            background-color: #45a049;
        }

        input {
        width: 100%;
        padding: 8px;
        border: none;
        border-radius: 8px;
        box-sizing: border-box;
        outline: none; /* Remove outline on focus */
        }

        textarea {
        width: 100%;
        height: 100px; /* Adjust the height as needed */
        padding: 8px;
        border: none;
        border-radius: 8px;
        box-sizing: border-box;
        outline: none;
        resize: none; /* Disable textarea resizing */
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
        <h1 style='text-align: center'>Report Form</h>
    </div>
    <div class="row"> 
        <div class="col-left"> 
            <form method="POST" action="report_action.php" id="reportform" class="form-container">
                <table>
                    <tr>
                        <th>Name</th>
                        <td><input name="reportname" type="text"></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Email</th>
                        <td><input name="reportemail" type="email"></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>Message</th>
                        <td><textarea name="reportmsg"></textarea></td>
                    </tr>
                </table>
                <button class="saveButton" type="submit">Submit Report</button>
                
            </form>
        </div> 
        <div class="col-right"> 
            <h2 style="text-align: center; margin-top: -10px;">Contact Us</h2>
            <br>
            <i class="fa fa-envelope"> meetingroom@iluv.ums.edu.my</i>
            <br><br>
            <i class="fa fa-phone"> 012-3456789</i>
            <br><br>
            <i class="fa fa-map-marker"> UMS</i>
            <br><br>
        </div> 
    </div>



    <br><br><br>

    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
    </footer>

    <script>
    // Function to show an alert popup
    function alertPopup(message, type) {
        if (type === 'success') {
            alert(message);
        } else {
            alert(message);
        }
    }

    // Call the alertPopup function with PHP variables
    alertPopup("<?php echo $_SESSION['popupMessage']; ?>", "<?php echo $_SESSION['popupType']; ?>");

    // Clear the session variables after displaying the alert
    <?php unset($_SESSION['popupMessage']); unset($_SESSION['popupType']); ?>
</script>
</body>

</html>
