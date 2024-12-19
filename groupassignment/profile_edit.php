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
        <?php
            include("include/navMenu.php");
        ?>
            <a href="javascript:void(0);" class="icon" onClick="regulateNavMenu"><i class="fa fa-bars"></i></a>
    </nav>

    <main>
        <?php 
            $cust_ID = "";
            $cust_Name = "";
            $cust_Phone_No = "";
            

            if(isset($_GET["id"]) && $_GET["id"] != ""){
                $id = $_GET['id'];
                $sql = "SELECT * FROM customer WHERE cust_ID= '$id'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $cust_ID = $row["cust_ID"];
                    $cust_Name = $row["cust_Name"];
                    $cust_Phone_No = $row["cust_Phone_No"];
                }
            }
            mysqli_close($conn);
        ?>

        <div class="pageTitle">
            <h1>Update Profile</h1>
        </div>
        <br>
        <div class="updateRoom">
            <form method="POST" action="profile_edit_action.php" id="updateForm" enctype="multipart/form-data">
                <!--<input type="text" id="cid" name="cid" value="<?=$_GET['id']?>" hidden>-->
                <table border="1" id="roomForm">
                    <colgroup>
                        <col>
                    </colgroup>
                    <tr>
                        <td><b>Customer ID</b></td>
                        <td>
                            <input type="text" name="custID" value="<?=$cust_ID?>">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Customer Name</b></td>
                        <td>
                            <input type="text" name="custName" value="<?=$cust_Name?>">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Customer Contact No</b></td>
                        <td>
                            <input type="text" name="custPhoneNo" value="<?=$cust_Phone_No?>">
                        </td>
                    </tr>
                </table>
                <br> 
                <div class="formButton">
                    <input type="submit" value="Submit" name="Submit"> &nbsp;
                    <input type="reset" value="Reset" name="Reset" onclick="resetForm()"> &nbsp
                    <input type="button" value="Clear" name="Clear" onclick="clearForm()">
                </div>
            </form>
        </div>
    </main>

    <footer style="position: fixed; bottom: 0;">
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14) </h3>
    </footer>

    <script>
        function resetForm() {
            document.getElementById("updateForm").reset();
        }

        function clearForm() {
            var form = document.getElementById("updateForm");
            if (form) {
                var inputs = form.getElementsByTagName("input");

                form.getElementsByTagName("select")[0].selectedIndex=0;

                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].type !== "button" && inputs[i].type !== "submit" && 
                    inputs[i].type !== "reset") {
                    inputs[i].value = "";
                    }
                }

            } else {
                console.error("Form not found");
            }
        }
    </script>
</body>
</html>