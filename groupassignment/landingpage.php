<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Room Booking System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Header Section -->
    <header class="header">
        <h1>Meeting Room Booking System</h1>
    </header>

    <!-- Main Content -->
    <main class="row">
        <section class="col-login">
            <?php if (isset($_SESSION["UID"])): ?>
                <div class="imgcontainer">
                    <img src="img/photo.jpg" alt="Avatar" class="avatar">
                </div>
                <p class="welcome-text">Welcome: <?php echo htmlspecialchars($_SESSION["useremail"]); ?></p>
            <?php else: ?>
                <!-- Login Form -->
                <form action="login_action.php" method="post" id="login">
                    <div class="imgcontainer">
                        <img src="img/photo.jpg" alt="Avatar" class="avatar" width="150" height="150">
                    </div>
                    <div class="container">
                        <label for="useremail"><b>User Email</b></label>
                        <input type="text" placeholder="Enter your email" name="useremail" required>
                        
                        <label for="userpwd"><b>Password</b></label>
                        <input type="password" placeholder="Enter your password" name="userpwd" required>
                        
                        <button type="submit" class="btn btn-green">Login</button>
                        
                        <label>
                            <input type="checkbox" name="remember" checked> Remember me
                        </label>
                    </div>
                    <div class="container footer-container">
                        <span class="register-link" onclick="showRegister()">Register</span>
                    </div>
                </form>
            <?php endif; ?>
        </section>

        <!-- Registration Form -->
        <section id="registerDiv" class="hidden">
            <h2>User Registration</h2>
            <form action="register_action.php" method="post">
                <label for="userrole">Role</label>
                <select name="userrole" required>
                    <option value="">Select Role</option>
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                </select>
                
                <label for="userEmail">Email</label>
                <input type="email" id="userEmail" name="userEmail" required>
                
                <label for="userPwd">Password</label>
                <input type="password" id="userPwd" name="userPwd" required maxlength="8">
                
                <label for="confirmPwd">Confirm Password</label>
                <input type="password" id="confirmPwd" name="confirmPwd" required>
                
                <div class="form-buttons">
                    <button type="submit" class="btn btn-green">Register</button>
                    <button type="reset" class="btn btn-red">Reset</button>
                    <button type="button" class="btn btn-red" onclick="cancelRegister()">Cancel</button>
                </div>
            </form>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2023 Meeting Room Booking System</p>
    </footer>

    <!-- Scripts -->
    <script>
        // Toggle Registration Form
        function showRegister() {
            document.getElementById("registerDiv").style.display = 'block';
        }

        // Cancel Registration
        function cancelRegister() {
            document.getElementById("registerDiv").style.display = 'none';
        }
    </script>

    <!-- Inline Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            padding: 20px;
        }
        .row {
            display: flex;
            width: 100%;
        }
        .col-login {
            flex: 1;
            max-width: 400px;
            margin: auto;
        }
        .imgcontainer img {
            border-radius: 50%;
            object-fit: cover;
        }
        .container {
            margin-top: 10px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-green {
            background-color: green;
            color: white;
        }
        .btn-red {
            background-color: red;
            color: white;
        }
        .hidden {
            display: none;
        }
        .footer-container {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #f4f4f4;
        }
    </style>
</body>

</html>
