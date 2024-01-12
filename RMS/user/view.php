<?php
include('lib/DataSource.php');
$database = new \Phppot\DataSource();
$conn = $database->getConnection();

$query = "SELECT * FROM form";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Form Data</title>
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #0074D9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #0074D9;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ccc;
        }
        a {
            text-decoration: none;
            color: #0074D9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Research Management System - View Data</h1>

        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Project ID</th>
                    <th>Research Title</th>
                    <th>Department</th>
                    <th>Starting Date</th>
                    <th>Proposed Date</th>
                    <th>Account Number</th>
                    <th>IFSC Code</th>
                    <th>MICR Code</th>
                    <th>Num Installments</th>
                    <th>Progress Report</th>
                    <th>Progress Report Date</th>
                    <th>Remaining Balance</th>
                    <th>Total Spent Amount</th>
                </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['project_id'] . "</td>";
                echo "<td>" . $row['research_title'] . "</td>";
                echo "<td>" . $row['department'] . "</td>";
                echo "<td>" . $row['starting_date'] . "</td>";
                echo "<td>" . $row['proposed_date'] . "</td>";
                echo "<td>" . $row['account_number'] . "</td>";
                echo "<td>" . $row['ifsc_code'] . "</td>";
                echo "<td>" . $row['micr_code'] . "</td>";
                echo "<td>" . $row['num_installments'] . "</td>";
                echo "<td>" . $row['progress_report'] . "</td>";
                echo "<td>" . $row['progress_report_date'] . "</td>";
                echo "<td>" . $row['remaining_balance'] . "</td>";
                echo "<td>" . $row['total_spent_amount'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No records found in the database.";
        }
        ?>

        <a href="home.php">Go back to the form</a>
    </div>
</body>
</html>
