<?php
include('config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST["rating"];
    $feedback = $_POST["feedback"];

    $sql = "INSERT INTO feedback (rating, feedback) VALUES ('$rating', '$feedback')";
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
