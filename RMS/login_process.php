<?php
session_start(); // Start a PHP session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "researchdb";
    $tableName = "users"; // Assuming your users table is named "users"

    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Create a database connection
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to validate user credentials
    $sql = "SELECT * FROM $tableName WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Verify the password
    if ($row && password_verify($password, $row["password"])) {
        // Successful login
        $_SESSION["username"] = $username; // Store the username in the session
        header("Location: dashboard.php"); // Redirect to the dashboard or another page
        exit;
    } else {
        // Invalid credentials
        echo "Invalid username or password. Please try again.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
