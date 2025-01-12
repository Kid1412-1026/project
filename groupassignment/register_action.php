<?php
include("config.php");

// Define variables and initialize with empty values
$userrole = $userEmail = $userPwd = $confirmPwd = "";
$error_message = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input values
    $userrole = mysqli_real_escape_string($conn, $_POST['userrole']);
    $userEmail = mysqli_real_escape_string($conn, $_POST['userEmail']);
    $userPwd = mysqli_real_escape_string($conn, $_POST['userPwd']);
    $confirmPwd = mysqli_real_escape_string($conn, $_POST['confirmPwd']);

    // Validate password and confirm password match
    if ($userPwd !== $confirmPwd) {
        $error_message = "Password and confirm password do not match.";
    } elseif (empty($userrole) || empty($userEmail) || empty($userPwd)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } else {
        // Hash the password
        $pwdHash = password_hash($userPwd, PASSWORD_DEFAULT);

        // Check if the email already exists in the database
        $email_check_sql = "SELECT * FROM user WHERE useremail = '$userEmail'";
        $result = mysqli_query($conn, $email_check_sql);
        
        if (mysqli_num_rows($result) > 0) {
            $error_message = "This email is already registered.";
        } else {
            // Insert new user record
            $sql = "INSERT INTO user (userrole, useremail, userPwd) VALUES ('$userrole', '$userEmail', '$pwdHash')";

            if (mysqli_query($conn, $sql)) {
                echo "<h3 align='center'>New user record created successfully.</h3><br>";
                echo '<a href="index.php" style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px; margin-right: 10px;">Login</a>';
            } else {
                $error_message = "Error: " . mysqli_error($conn);
            }
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <title>Registration</title>
</head>

<body>
    <div class="container">
        <h2>Register</h2>

        <?php
        if (!empty($error_message)) {
            echo "<div class='error-message' style='color: red; text-align: center;'>$error_message</div>";
        }
        ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="userrole">User Role</label>
                <input type="text" id="userrole" name="userrole" value="<?php echo htmlspecialchars($userrole); ?>" required>
            </div>
            <div class="form-group">
                <label for="userEmail">Email</label>
                <input type="email" id="userEmail" name="userEmail" value="<?php echo htmlspecialchars($userEmail); ?>" required>
            </div>
            <div class="form-group">
                <label for="userPwd">Password</label>
                <input type="password" id="userPwd" name="userPwd" required>
            </div>
            <div class="form-group">
                <label for="confirmPwd">Confirm Password</label>
                <input type="password" id="confirmPwd" name="confirmPwd" required>
            </div>
            <div class="form-button">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</body>

</html>
