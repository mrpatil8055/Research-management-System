<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection established
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "researchdb";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $project_id = $_POST['project_id'];
    $ratings = $_POST['ratings'];

    // Update the database with the selected ratings
    $sql = "UPDATE form SET ratings = '$ratings' WHERE project_id = $project_id";

    if (mysqli_query($conn, $sql)) {
        echo "Rating submitted successfully.";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
