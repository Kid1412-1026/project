<?php
include('config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <style>
        body {
            margin: 0;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: sans-serif;
        }

        h1, p {
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }

        .app {
            width: 90%;
            max-width: 500px;
            margin: 0 auto;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .item {
            width: 90px;
            height: 90px;
            display: flex;
            justify-content: center;
            align-items: center;
            user-select: none;
        }

        .radio {
            display: none;
        }

        .radio ~ span {
            font-size: 3rem;
            filter: grayscale(100);
            cursor: pointer;
            transition: 0.3s;
        }

        .radio:checked ~ span {
            filter: grayscale(0);
            font-size: 4rem;
        }

        #message {
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            box-sizing: border-box;
        }

        #submitBtn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            background-color: #3366ff;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="app">
        <h1>Was this website helpful?</h1>
        <p>Let us know how we did</p>

        <form method="POST" action="feedback_action.php" enctype="multipart/form-data" id="myForm">
        <div class="container">
            <div class="item">
                <label for="0">
                    <input class="radio" type="radio" name="feedback_rating" id="0" value="0" required>
                    <span>🤬</span>
                </label>
            </div>

            <div class="item">
                <label for="1">
                    <input class="radio" type="radio" name="feedback_rating" id="1" value="1" required>
                    <span>🙁</span>
                </label>
            </div>

            <div class="item">
                <label for="2">
                    <input class="radio" type="radio" name="feedback_rating" id="2" value="2" required>
                    <span>😶</span>
                </label>
            </div>

            <div class="item">
                <label for="3">
                    <input class="radio" type="radio" name="feedback_rating" id="3" value="3" required>
                    <span>😁</span>
                </label>
            </div>

            <div class="item">
                <label for="4">
                    <input class="radio" type="radio" name="feedback_rating" id="4" value="4" required>
                    <span>😍</span>
                </label>
            </div>
        </div>

        <textarea id="message" name="message" placeholder="Optional: Leave a message"></textarea>
        <input type="submit" value="Submit" id="submitBtn">

        </form>

    </div>
</body>
</html>
