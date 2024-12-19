<?php
session_start();
include("config.php");
?>
<html>

<head>
    <title>Login Action</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen" />
</head>

<body>
    <h2>Login Information</h2>
    <?php
    //login values from login form
    $useremail = $_POST['useremail'];
    $userPwd = $_POST['userpwd'];

    $sql = "SELECT * FROM user WHERE useremail='$useremail' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        //check password hash
        $row = mysqli_fetch_assoc($result);
        if (password_verify($_POST['userpwd'], $row['userpwd'])) {
            $_SESSION["UID"] = $row["userid"]; //the first record set, bind to userID
            $_SESSION["useremail"] = $row["useremail"];
            //set logged in time
            $_SESSION['loggedin_time'] = time();
            header("location:index.php");
        } else {
            echo 'Login error, user email and password is incorrect.<br>'; //user email & pwd not correct    
            echo '<a href="landingpage.php?login=1"> | Login |</a> &nbsp;&nbsp;&nbsp; <br>';
        }

    } else {
        echo "Login error, user <b>$useremail</b> does not exist. <br>"; //user not exist
        echo '<a href="landingpage.php?login=1"> | Login |</a>&nbsp;&nbsp;&nbsp; <br>';
    }

    mysqli_close($conn);
    ?>
</body>

</html>