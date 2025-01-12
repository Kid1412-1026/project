<?php
include("include/config.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/script.js"></script> <!-- External JS for form reset/clear -->
</head>

<body>
    <header>
        <div class="header">
            <h1>Meeting Room Booking System</h1>
        </div>
    </header>

    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
        <a href="javascript:void(0);" class="icon" onclick="regulateNavMenu()"><i class="fa fa-bars"></i></a>
    </nav>

    <main>
        <?php
        // Check if the user already has a profile
        if (!isset($_SESSION["UID"])) {
            echo "<p>Session expired or user not logged in. Please <a href='login.php'>log in</a>.</p>";
            exit();
        }

        $userId = $_SESSION["UID"];
        $stmt = $conn->prepare("SELECT * FROM customer WHERE userid = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Redirect if profile already exists
            header("Location: profile.php");
            exit();
        }

        // If no profile exists, show the creation form
        ?>
        <div class="pageTitle">
            <h1>Create Profile</h1>
        </div>

        <div class="profileCreate">
            <form method="POST" action="profile_create_action.php" id="insertForm" enctype="multipart/form-data">
                <table border="1" id="roomForm">
                    <tr>
                        <td><b>Customer Name</b></td>
                        <td>
                            <input type="text" name="custName" required>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Customer Contact No</b></td>
                        <td>
                            <input type="text" name="custPhoneNo" required pattern="\d{10,15}" title="Please enter a valid contact number.">
                        </td>
                    </tr>
                </table>
                <br>
                <div class="formButton">
                    <button type="submit" name="Submit">Submit</button>
                    <button type="reset" name="Reset">Reset</button>
                    <button type="button" name="Clear" onclick="clearForm()">Clear</button>
                </div>
            </form>
        </div>
    </main>

    <footer style="position: fixed; bottom: 0;">
        <h3>&copy; KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>
</body>

</html>
