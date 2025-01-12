<?php
include("include/config.php");
session_start();

// Fetch customer information
function getCustomerInfo($conn, $userId)
{
    $stmt = $conn->prepare("SELECT cust_ID, cust_Name, cust_Phone_No FROM customer WHERE userid = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

if (!isset($_SESSION["UID"])) {
    header("Location: login.php");
    exit;
}

$customer = getCustomerInfo($conn, $_SESSION["UID"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="header">
            <h1>Meeting Room Booking System</h1>
        </div>
    </header>

    <nav class="topNav" id="topNav">
        <?php include("include/navMenu.php"); ?>
        <a href="javascript:void(0);" class="icon" onclick="regulateNavMenu()">
            <i class="fa fa-bars"></i>
        </a>
    </nav>

    <main>
        <div class="pageTitle">
            <h1>My Profile</h1>
        </div>

        <?php if ($customer): ?>
            <table border="1" id="profileTable">
                <colgroup>
                    <col>
                    <col style="background-color: #FFFFFF">
                </colgroup>
                <tr>
                    <td><b>Customer ID</b></td>
                    <td><?= htmlspecialchars($customer['cust_ID']); ?></td>
                </tr>
                <tr>
                    <td><b>Customer Name</b></td>
                    <td><?= htmlspecialchars($customer['cust_Name']); ?></td>
                </tr>
                <tr>
                    <td><b>Customer Contact No</b></td>
                    <td><?= htmlspecialchars($customer['cust_Phone_No']); ?></td>
                </tr>
            </table>

            <div class="profileUpdateButton">
                <form action="profile_edit.php" method="get">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($customer['cust_ID']); ?>">
                    <button type="submit">Update Profile</button>
                </form>
            </div>

            <h2>Change Password</h2>
            <form method="POST" action="profile_change_password_action.php" id="insertForm">
                <table>
                    <tr>
                        <td><label for="chgpassword"><b>New Password:</b></label></td>
                        <td><input type="password" name="chgpassword" id="chgpassword" required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" name="Submit">Change Password</button>
                        </td>
                    </tr>
                </table>
            </form>
        <?php else: ?>
            <p style="color: red;">Unable to fetch customer information. Please contact support.</p>
        <?php endif; ?>
    </main>

    <footer>
        <h3>@ KK34703 Web Engineering Group Assignment (Group 14)</h3>
    </footer>
</body>

</html>
