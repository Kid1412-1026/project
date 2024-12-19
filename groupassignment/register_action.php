<?php
include("config.php");
?>
<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<body>
    <?php

    //STEP 1: Form data handling using mysqli_real_escape_string function to escape special characters for use in an SQL query,
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userrole = mysqli_real_escape_string($conn, $_POST['userrole']);
        $userEmail = mysqli_real_escape_string($conn, $_POST['userEmail']);
        $userPwd = mysqli_real_escape_string($conn, $_POST['userPwd']);
        $confirmPwd = mysqli_real_escape_string($conn, $_POST['confirmPwd']);

        //Validate pwd and confrimPwd
        if ($userPwd !== $confirmPwd) {
            die("Password and confirm password do not match.");
        }

        // User does not exist, insert new user record, hash the password       
        $pwdHash = trim(password_hash($_POST['userPwd'], PASSWORD_DEFAULT));
        //echo $pwdHash;
        $sql = "INSERT INTO user (userrole, useremail, userPwd ) VALUES ('$userrole', '$userEmail', '$pwdHash')";
        $insertOK = 0;

        if (mysqli_query($conn, $sql)) {
            echo "<h3 align=center>New user record created successfully.</h3><br>";
            echo '<a href="index.php"
            style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px; margin-right: 10px;">Login</a>';
        } else {
            echo "<h3 align=center>Error: " . $sql . "<br>" . mysqli_error($conn) . "</h3><br>";
        }
    }

    mysqli_close($conn);

    ?>
</body>

</html>