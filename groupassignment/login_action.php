<?php
session_start();
include("config.php");

// Function to sanitize user input
function sanitize_input($conn, $input)
{
    return mysqli_real_escape_string($conn, trim($input));
}

// Function to display error message
function display_error($message)
{
    echo "<p style='color: red; font-weight: bold;'>$message</p>";
    echo '<a href="landingpage.php?login=1"> | Login |</a>';
    exit;
}

// Get login values from POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $useremail = sanitize_input($conn, $_POST['useremail']);
    $userPwd = sanitize_input($conn, $_POST['userpwd']);

    // Check if user exists
    $sql = "SELECT * FROM user WHERE useremail='$useremail' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // Verify password
            if (password_verify($userPwd, $row['userpwd'])) {
                $_SESSION["UID"] = $row["userid"];
                $_SESSION["useremail"] = $row["useremail"];
                $_SESSION['loggedin_time'] = time();
                header("Location: index.php");
                exit;
            } else {
                display_error("Login error: Incorrect email or password.");
            }
        } else {
            display_error("Login error: User with email <b>$useremail</b> does not exist.");
        }
    } else {
        display_error("Database error: Unable to execute the query.");
    }

    mysqli_free_result($result);
} else {
    display_error("Invalid request method.");
}

// Close the database connection
mysqli_close($conn);
?>
