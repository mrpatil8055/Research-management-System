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

// Process accepting or rejecting a project when the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action_project"])) {
    $projectId = mysqli_real_escape_string($conn, $_POST["project_id"]);
    $actionType = mysqli_real_escape_string($conn, $_POST["action_type"]);

    // Check if the project has already been accepted or rejected
    $checkStatusSQL = "SELECT * FROM fd_accepted WHERE project_id = '$projectId'";
    $statusResult = mysqli_query($conn, $checkStatusSQL);

    if ($statusResult && mysqli_num_rows($statusResult) > 0) {
        echo "<p class='status-message accepted-message'>This project has already been accepted.</p>";
    } else {
        // Fetch details for the selected project
        $fetchProjectDetailsSQL = "SELECT * FROM Projects WHERE project_id = '$projectId'";
        $projectDetailsResult = mysqli_query($conn, $fetchProjectDetailsSQL);

        if ($projectDetailsResult && mysqli_num_rows($projectDetailsResult) > 0) {
            $projectDetails = mysqli_fetch_assoc($projectDetailsResult);

            if ($actionType === "accept") {
                // Insert details into 'fd_accepted' table (using INSERT IGNORE)
                $insertAcceptedProjectSQL = "INSERT IGNORE INTO fd_accepted 
                    (project_id, rating, research_title, department, starting_date, num_installments, 
                    account_number, ifsc_code, micr_code, progress_report, progress_report_date, 
                    total_amount, remaining_balance, total_spent_amount)
                    VALUES (
                        '{$projectDetails['project_id']}', '{$projectDetails['ratings']}', 
                        '{$projectDetails['research_title']}', '{$projectDetails['department']}', 
                        '{$projectDetails['starting_date']}', '{$projectDetails['num_installments']}', 
                        '{$projectDetails['account_number']}', '{$projectDetails['ifsc_code']}', 
                        '{$projectDetails['micr_code']}', '{$projectDetails['progress_report']}', 
                        '{$projectDetails['progress_report_date']}', '{$projectDetails['total_amount']}', 
                        '{$projectDetails['remaining_balance']}', '{$projectDetails['total_spent_amount']}'
                    )";

                if (mysqli_query($conn, $insertAcceptedProjectSQL)) {
                    echo "<p class='status-message accepted-message'>Project accepted successfully .</p>";
                } else {
                    echo "<p class='status-message rejected-message'>Error accepting project: " . mysqli_error($conn) . "</p>";
                }
            } elseif ($actionType === "reject") {
                echo "<p class='status-message rejected-message'>Project rejected.</p>";
            }
        } else {
            echo "<p class='status-message rejected-message'>Error fetching project details: " . mysqli_error($conn) . "</p>";
        }
    }
}

// Fetch data from 'Projects' table
$fetchProjectsSQL = "SELECT * FROM Projects";
$result = mysqli_query($conn, $fetchProjectsSQL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        h2, h3 {
            color: #343a40;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        tr:hover {
            background-color: #e2e6ea;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .accept-button, .reject-button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
        }

        .reject-button {
            background-color: #dc3545;
        }

        .status-message {
            font-weight: bold;
            margin-top: 10px;
            padding: 10px;
            border-radius: 4px;
        }

        .accepted-message {
            color: green;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .rejected-message {
            color: red;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
    <title>Finance Dashboard</title>
</head>
<body>

<?php
if ($result && mysqli_num_rows($result) > 0) {
    echo "<h2 style='margin-bottom: 20px;'>Welcome, Finance Department!</h2>";
    echo "<a href="../../../index.html">Back to home</a>";
    echo "<h3>Projects Overview:</h3>";
    echo "<table border='1'>
            <tr>
                <th>Project ID</th>
                <th>Rating</th>
                <th>Research Title</th>
                <th>Department</th>
                <th>Starting Date</th>
                <th>Num Installments</th>
                <th>Account Number</th>
                <th>IFSC Code</th>
                <th>MICR Code</th>
                <th>Progress Report</th>
                <th>Progress Report Date</th>
                <th>Total Amount</th>
                <th>Remaining Balance</th>
                <th>Total Spent Amount</th>
                <th>Action</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        $projectId = $row['project_id'];
        $checkAcceptedSQL = "SELECT * FROM fd_accepted WHERE project_id = '$projectId'";
        $checkResult = mysqli_query($conn, $checkAcceptedSQL);

        echo "<tr>
                <td>{$row['project_id']}</td>
                <td>{$row['ratings']}</td>
                <td>{$row['research_title']}</td>
                <td>{$row['department']}</td>
                <td>{$row['starting_date']}</td>
                <td>{$row['num_installments']}</td>
                <td>{$row['account_number']}</td>
                <td>{$row['ifsc_code']}</td>
                <td>{$row['micr_code']}</td>
                <td>{$row['progress_report']}</td>
                <td>{$row['progress_report_date']}</td>
                <td>{$row['total_amount']}</td>
                <td>{$row['remaining_balance']}</td>
                <td>{$row['total_spent_amount']}</td>
                <td class='action-buttons'>";

        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            echo "<span class='status-message accepted-message'>Already Accepted</span>";
        } else {
            echo "<form action='{$_SERVER["PHP_SELF"]}' method='post'>
                    <input type='hidden' name='project_id' value='$projectId'>
                    <input type='hidden' name='action_type' value='accept'>
                    <button class='accept-button' name='action_project'>Accept</button>
                  </form>";
        }

        echo "<form action='{$_SERVER["PHP_SELF"]}' method='post'>
                <input type='hidden' name='project_id' value='$projectId'>
                <input type='hidden' name='action_type' value='reject'>
                <button class='reject-button' name='action_project'>Reject</button>
              </form>
            </td>
          </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No projects found.</p>";
}

mysqli_close($conn);
?>

</body>
</html>
