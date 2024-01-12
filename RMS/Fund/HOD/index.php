<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input, select {
            padding: 8px;
            margin-bottom: 16px;
        }

        button {
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    <title>HOD Login</title>
</head>
<body>
    <div class="login-container">
        <h2>HOD Login</h2>
        <form action="projects.php" method="get"> <!-- Use GET method to pass parameters in URL -->
            <label for="department">Department:</label>
            <select name="department" required>
                <?php
                // Assuming you have a database connection established
                $host = "localhost";
                $username = "root";
                $password = "";
                $database = "researchdb";

                $conn = mysqli_connect($host, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch departments from hod table
                $deptQuery = "SELECT DISTINCT department FROM hod";
                $deptResult = mysqli_query($conn, $deptQuery);

                while ($row = mysqli_fetch_assoc($deptResult)) {
                    echo "<option value=\"{$row['department']}\">{$row['department']}</option>";
                }

                mysqli_close($conn);
                ?>
            </select>

            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <br>
         <a href="../../../index.html">Back to home</a>
    </div>
</body>
</html>
