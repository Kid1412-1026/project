<?php
include("config.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Study KPI</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header">
        <h1>Booking Edit</h1>
    </div>
    <?php echo '<nav class="topNav" id="topNav">';
    include("include/navMenu.php");
    echo ' </nav>';
    $payment_Date = "";
    $payment_Time = "";
    $payment_Total = "";
    $payment_Amount = "";

    if (isset($_GET["payment_ID"]) && $_GET["payment_ID"] != "") {
        $sql = "SELECT * FROM payment WHERE payment_ID=" . $_GET["payment_ID"];
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $payment_ID = $row["payment_ID"];
            $payment_Date = $row["payment_Date"];
            $payment_Time = $row["payment_Time"];
            $payment_Total = $row["payment_Total"];
            $payment_Amount = $row["payment_Amount"];
        }
    }
    mysqli_close($conn);
    ?>
    <div style="padding:0 10px;" id="challengeDiv">
        <h3 align="center">Booking</h3>
        <form method="POST" action="paymenteditaction.php" id="myForm" enctype="multipart/form-data">
            <!--hidden value: id to be submitted to action page-->
            <input type="text" id="payment_ID" name="payment_ID" value="<?= $_GET['payment_ID'] ?>" hidden>
            <table border="1" id="myTable">
            <tr>
                    <td>Booking ID</td>
                    <td><input type="text" name="booking_ID" size="20"></td>
                </tr>
                 <tr>
                    <td>Customer ID</td>
                    <td><input type="text" name="cust_ID" size="20"></td>
                </tr>
                <tr>
                    <td>Payment Date:</td>
                    <td><input type="date" name="payment_Date" value="<?php echo $payment_Date; ?>" size="20"></td>
                </tr>
                <tr>
                    <td>Payment Date:</td>
                    <td><input type="time" name="payment_Time" value="<?php echo $payment_Time; ?>" size="20"></td>
                </tr>
                <tr>
                    <td>Payment Total:</td>
                    <td><input type="text" name="payment_Total" value="<?php echo $payment_Total; ?>" size="20"></td>
                </tr>
                <tr>
                    <td>Payment Amount:</td>
                    <td><input type="text" name="payment_Amount" value="<?php echo $payment_Amount; ?>" size="20"></td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <input type="submit" value="Submit" name="B1"
                            style="background-color: #00ff00; padding: 10px 20px;border-radius: 5px;">
                        <input type="reset" value="Reset" name="B2"
                            style="background-color: red; padding: 10px 20px; border-radius: 5px;"
                            onclick="resetForm()">
                        <input type="button" value="Clear" name="B3"
                            style="background-color: red; padding: 10px 20px; border-radius: 5px;"
                            onclick="clearForm()">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <p></p>
    <footer>
        <p>Copyright (c) 2023</p>
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
        //reset form after modification to a php echo to fields
        function resetForm() {
            document.getElementById("myForm").reset();
        }
        //this clear form to empty the form for new data
        function clearForm() {
            var form = document.getElementById("myForm");
            if (form) {
                var inputs = form.getElementsByTagName("input");
                var textareas = form.getElementsByTagName("textarea");
                //clear select
                form.getElementsByTagName("select")[0].selectedIndex = 0;
                //clear all inputs
                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].type !== "button" && inputs[i].type !== "submit" && inputs[i].type !== "reset") {
                        inputs[i].value = "";
                    }
                }
                //clear all textareas
                for (var i = 0; i < textareas.length; i++) {
                    textareas[i].value = "";
                }
            } else {
                console.error("Form not found");
            }
        }
    </script>
</body>

</html>