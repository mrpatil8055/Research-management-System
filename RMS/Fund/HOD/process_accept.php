<?php
// process_accept.php

// Assuming you have a database connection established
$host = "localhost";
$username = "root";
$password = "";
$database = "researchdb";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $projectId = mysqli_real_escape_string($conn, $_POST["projectId"]);
    $rating = mysqli_real_escape_string($conn, $_POST["ratings"]);

    // Check if a record with the same project_id already exists
    $checkDuplicateSQL = "SELECT project_id FROM Projects WHERE project_id = '$projectId'";
    $checkResult = mysqli_query($conn, $checkDuplicateSQL);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        // Display error message if project_id already exists
        echo "Error: Project with the same project_id already exists.";
    } else {
        // Fetch other details from 'form' table
        $fetchDetailsSQL = "SELECT * FROM form WHERE id = '$projectId'";
        $result = mysqli_query($conn, $fetchDetailsSQL);

        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the first row, assuming project ID is unique
            $row = mysqli_fetch_assoc($result);

            // Extract other details
            $researchTitle = mysqli_real_escape_string($conn, $row['project_id']);
            $researchTitle = mysqli_real_escape_string($conn, $row['research_title']);
            $department = mysqli_real_escape_string($conn, $row['department']);
            $startingDate = mysqli_real_escape_string($conn, $row['starting_date']);
            $numInstallments = mysqli_real_escape_string($conn, $row['num_installments']);
            $accountNumber = mysqli_real_escape_string($conn, $row['account_number']);
            $ifscCode = mysqli_real_escape_string($conn, $row['ifsc_code']);
            $micrCode = mysqli_real_escape_string($conn, $row['micr_code']);
            $progressReport = mysqli_real_escape_string($conn, $row['progress_report']);
            $progressReportDate = mysqli_real_escape_string($conn, $row['progress_report_date']);
            $totalAmount = mysqli_real_escape_string($conn, $row['total_amount']);
            $remainingBalance = mysqli_real_escape_string($conn, $row['remaining_balance']);
            $totalSpentAmount = mysqli_real_escape_string($conn, $row['total_spent_amount']);

            // Insert data into 'Projects' table
            $insertProjectSQL = "INSERT INTO Projects (project_id, ratings, research_title, department, starting_date, num_installments, 
                account_number, ifsc_code, micr_code, progress_report, progress_report_date, total_amount, remaining_balance, total_spent_amount)
                VALUES ('$projectId', '$rating', '$researchTitle', '$department', '$startingDate', '$numInstallments',
                '$accountNumber', '$ifscCode', '$micrCode', '$progressReport', '$progressReportDate', '$totalAmount',
                '$remainingBalance', '$totalSpentAmount')";

            if (mysqli_query($conn, $insertProjectSQL)) {
                // Project accepted and all details submitted successfully
                echo "Project accepted and all details submitted successfully";
            } else {
                // Error in project acceptance or details submission
                echo "Error inserting into Projects table: " . mysqli_error($conn);
            }
        } else {
            // Error in fetching details or project not found
            echo "Error fetching details: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
