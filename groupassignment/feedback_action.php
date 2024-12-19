<?php
include('config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST["feedback_rating"];
    $feedbackContent = $_POST["message"];
    $userid = $_SESSION["UID"];

    $query = "SELECT cust_ID FROM customer WHERE userid=" . $_SESSION["UID"];
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $cust_ID = $row["cust_ID"];
    }

    $sql = "INSERT INTO feedback (cust_ID, feedback_Date, feedback_Content, userid, feedback_Rating) 
            VALUES ($cust_ID, CURDATE(), '$feedbackContent', '$userid','$rating')";
    
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<h3 align=center>Feedback submitted successfully!</h3><br>";
        echo '<div style="text-align: center;">';
        echo '<a href="index.php" style="display: inline-block; padding: 10px 20px; text-align: center; text-decoration: none; background-color: #00ff00; border-radius: 5px; margin-right: 10px;">Home</a>';
        echo '</div>';
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}

mysqli_close($conn);
?>
