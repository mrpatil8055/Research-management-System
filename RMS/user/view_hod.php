<?php
include('lib/DataSource.php');

$database = new \Phppot\DataSource();
$conn = $database->getConnection();

// Retrieve HOD data
$sql = "SELECT * FROM HOD";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View HODs</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }
    </style>
</head>
<body>
    <h2>View HODs</h2>

    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>HOD Name</th><th>Username</th><th>Department</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>" . $row['HOD_Name'] . "</td>";
            echo "<td>" . $row['Username'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No HODs found";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
