<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vice Chancellor Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Vice Chancellor Login</h2>
        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Define fixed user IDs and hashed passwords
            $fixedUserCredentials = [
                "finance1" => password_hash("finadmin", PASSWORD_DEFAULT),
                "vice1" => password_hash("tumkur1", PASSWORD_DEFAULT)
            ];

            // Get user input
            $userInputUserId = $_POST["user_id"];
            $userInputPassword = $_POST["password"];

            // Check if the user ID exists
            if (array_key_exists($userInputUserId, $fixedUserCredentials)) {
                // Check if the password is correct
                if (password_verify($userInputPassword, $fixedUserCredentials[$userInputUserId])) {
                    // Redirect to dashboard.php with user ID as a query parameter
                    header("Location: vc_dashboard.php");
                    exit(); // Ensure that no further code is executed after the redirect
                } else {
                    echo "Incorrect password!";
                }
            } else {
                echo "User not found!";
            }
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <br>
         <a href="../../../index.html">Back to home</a>
    </div>
</body>
</html>
