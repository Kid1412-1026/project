<?php 
    include("include/config.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Profile</title>
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
        <?php include("include/navMenu.php"); ?>
        <a href="javascript:void(0);" class="icon" onClick="regulateNavMenu"><i class="fa fa-bars"></i></a>
    </nav>

    <main>
        <?php 
            // Initialize variables
            $cust_ID = $cust_Name = $cust_Phone_No = "";

            if (isset($_GET["id"]) && !empty($_GET["id"])) {
                // Sanitize the id to prevent SQL Injection
                $id = mysqli_real_escape_string($conn, $_GET['id']);
                $sql = "SELECT * FROM customer WHERE cust_ID = '$id'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $cust_ID = $row["cust_ID"];
                    $cust_Name = $row["cust_Name"];
                    $cust_Phone_No = $row["cust_Phone_No"];
                } else {
                    echo "Customer not found.";
                    exit();
                }
            } else {
                echo "Invalid request.";
                exit();
            }

            // Close the database connection
            mysqli_close($conn);
        ?>

        <div class="pageTitle">
            <h1>Update Profile</h1>
        </div>

        <div class="updateRoom">
            <form method="POST" action="profile_edit_action.php" id="updateForm" enctype="multipart/form-data">
                <table border="1" id="roomForm">
                    <tr>
                        <td><b>Customer ID</b></td>
                        <td><input type="text" name="custID" value="<?= htmlspecialchars($cust_ID) ?>" readonly></td>
                    </tr>
                    <tr>
                        <td><b>Customer Name</b></td>
                        <td><input type="text" name="custName" value="<?= htmlspecialchars($cust_Name) ?>" required></td>
                    </tr>
                    <tr>
                        <td><b>Customer Contact No</b></td>
                        <td><input type="text" name="custPhoneNo" value="<?= htmlspecialchars($cust_Phone_No) ?>" required pattern="\d{10,15}"></td>
                    </tr>
                </table>

                <div class="formButton">
                    <input type="submit" value="Submit" name="Submit"> 
                    <input type="reset" value="Reset" name="Reset"> 
                    <input type="button" value="Clear" name="Clear" onclick="clearForm()">
                </div>
            </form>
        </div>
    </main>

    <footer style="position: fixed; bottom: 0;">
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
    </footer>

    <script>
        // Reset form function
        function resetForm() {
            document.getElementById("updateForm").reset();
        }

        // Clear form function with enhanced behavior
        function clearForm() {
            var form = document.getElementById("updateForm");
            if (form) {
                var inputs = form.querySelectorAll("input[type='text'], input[type='number']"); 
                inputs.forEach(input => input.value = "");  // Clears text input fields
            } else {
                console.error("Form not found");
            }
        }
    </script>
</body>

</html>
