<?php
include('lib/DataSource.php');

$database = new \Phppot\DataSource();
$conn = $database->getConnection();

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $hodName = $_POST['hodName'];
    $username = $_POST['username'];
    $rawPassword = $_POST['password']; // Unhashed password
    $department = $_POST['department'];

    // Check if HOD already exists for the department
    $checkHODQuery = "SELECT COUNT(*) AS hodCount FROM HOD WHERE department = '$department'";
    $result = $conn->query($checkHODQuery);

    if ($result) {
        $row = $result->fetch_assoc();
        $hodCount = $row['hodCount'];

        if ($hodCount > 0) {
            $error = "Error: HOD already exists for the selected department";
        } else {
            // Hash the password
            $hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

            // Insert data into HOD table
            $sql = "INSERT INTO HOD (HOD_Name, Username, Password, department) VALUES ('$hodName', '$username', '$hashedPassword', '$department')";

            if ($conn->query($sql) === TRUE) {
                $message = "HOD added successfully";
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        $error = "Error checking existing HOD: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add HOD Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            text-align: left;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            color: green;
            font-weight: bold;
        }

        p.error {
            color: red;
            font-weight: bold;
        }
    </style>
    <script>
        function validateForm() {
            var password = document.forms["hodForm"]["password"].value;
            var confirmPassword = document.forms["hodForm"]["confirmPassword"].value;

            if (password !== confirmPassword) {
                alert("Passwords do not match");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <form name="hodForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
        <h2>Add HOD</h2>

        <?php
        // Display success or error message
        if (isset($message)) {
            echo "<p>$message</p>";
        } elseif (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>

        <label for="hodName">HOD Name:</label>
        <input type="text" name="hodName" required>

        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" name="confirmPassword" required>

        <label for="department">Department:</label>
        <select name="department" required>
            <?php
                // Fetch departments from researchinfo table
                $result = $conn->query("SELECT department FROM researchinfo");

                // Populate the dropdown with department options
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['department'] . "'>" . $row['department'] . "</option>";
                }
            ?>
        </select>

        <input type="submit" value="Add HOD">
    </form>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
