<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "researchdb";
    

    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Securely hash the password

    // Perform basic validation (you should enhance this)
    if (empty($name) || empty($email) || empty($phone) || empty($gender) || empty($address) || empty($username) || empty($password)) {
        echo "All fields are required. Please go back and fill in all the fields.";
    } else {
        // Create a database connection
        $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL query to insert data
        $sql = "INSERT INTO users (name, email, phone, gender, address, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $name, $email, $phone, $gender, $address, $username, $password);

        if ($stmt->execute()) {
            echo "<h1>Registration Successful!</h1>";
            echo "<p>Name: $name</p>";
            echo "<p>Email: $email</p>";
            echo "<p>Phone Number: $phone</p>";
            echo "<p>Gender: $gender</p>";
            echo "<p>Address: $address</p>";
            echo "<p>Username: $username</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
} else {
    // If someone accesses this page directly without submitting the form, you can redirect them to the signup page
    header("Location: signup.php");
    exit;
}
?>
