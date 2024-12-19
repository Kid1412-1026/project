<?php
include("include/config.php");
// Display of the navigation menu depending on whether or not a session is active
if (isset($_SESSION["UID"])) {
    $sql = "SELECT * FROM user WHERE userid=" . $_SESSION["UID"];
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userrole = $row["userrole"];
        if ($userrole == 1) {
            echo "
            <a href='admin_view_customer_profile.php'class='tabs'>Manage Profile</a>
            <a href='room.php' class='tabs'>Manage Room</a>
            <a href='bookingadmin.php'class='tabs'>Manage Booking</a>
            <a href='payment.php'class='tabs'>Manage Payment</a>
            <a href='analytics.php'class='tabs'>View Report</a>
            <!--login&logout section-->
            <a href='logout.php'class='tabs'>Logout</a>";
        } else {
            echo "
            <a href='profile_create.php'class='tabs'>My Profile</a>
            <a href='roomcust.php' class='tabs'>Room List</a>
            <a href='booking.php'class='tabs'>Booking</a>
            <a href='paymentcust.php'class='tabs'>View Payment Details</a>
            <a href='calendar.php'class='tabs'>Available Rooms</a>
            <a href='feedback.php'class='tabs'>Leave Feedback</a>
            <!--login&logout section-->
            <a href='logout.php'class='tabs'>Logout</a>";
        }
    }
} else {
    echo "<a href='index.php' class='tabs'>Home</a>
    <a href='landingpage.php' class='login'>Login</a> ";
}
?>