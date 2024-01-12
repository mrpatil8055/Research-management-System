<?php
include('lib/DataSource.php');
$database = new \Phppot\DataSource();
$conn = $database->getConnection();

// Fetch project information for dropdown
$projectQuery = "SELECT project_id, research_title, sanctioned_amount, department FROM researchinfo";
$projectResult = mysqli_query($conn, $projectQuery);

// Define the upload directory
$uploadDir = 'uploads/';

if (isset($_POST['register'])) {
    $project_id = $_POST['project_id'];
    $research_title = $_POST['research_title'];
    $department = $_POST['Department_name'];
    $total_amount = $_POST['total_amount'];
    $starting_date = $_POST['starting_date'];
    $proposed_date = $_POST['proposed_date'];
    $account_number = $_POST['account_number'];
    $ifsc_code = $_POST['ifsc_code'];
    $micr_code = $_POST['micr_code'];
    $num_installments = $_POST['num_installments'];
    $progress_report_date = $_POST['progress_report_date'];
    $remaining_balance = $_POST['remaining_balance'];
    $total_spent_amount = $_POST['total_spent_amount'];

    // File upload handling
    if (isset($_FILES['progress_report']) && !empty($_FILES['progress_report']['name'])) {
        $uploadFileName = $_FILES['progress_report']['name'];
        $uploadFilePath = $uploadDir . $uploadFileName;

        // Check file format
        $allowedFormats = ['pdf', 'jpg','jpeg','png'];
        $fileFormat = pathinfo($uploadFilePath, PATHINFO_EXTENSION);

        if (in_array(strtolower($fileFormat), $allowedFormats)) {
            // Move the file to the upload directory
            if (move_uploaded_file($_FILES['progress_report']['tmp_name'], $uploadFilePath)) {
                // File upload success, update the database
                $query = "INSERT INTO form (project_id, research_title, department, starting_date, proposed_date, account_number, ifsc_code, micr_code, num_installments, progress_report, progress_report_date, total_amount, remaining_balance, total_spent_amount) 
                          VALUES ('$project_id', '$research_title', '$department', '$starting_date', '$proposed_date', '$account_number', '$ifsc_code', '$micr_code', '$num_installments', '$uploadFilePath', '$progress_report_date','$total_amount', '$remaining_balance', '$total_spent_amount')";

                $data = mysqli_query($conn, $query);

                if ($data) {
                    header('Refresh: 5; URL=home.php');
                    echo "Data submitted successfully";
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "Invalid file format. Allowed formats: " . implode(', ', $allowedFormats);
        }
    } else {
        echo "Please select a file to upload.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Investigator Form</title>
    <style>
        <!-- Your CSS styles remain unchanged -->
    </style>
    <script>
        <!-- Your JavaScript functions remain unchanged -->
    </script>
</head>

<body>
    <div class="header">
        <h1>Research Management System</h1>
    </div>
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="container">
            <!-- Your HTML form content remains unchanged -->
        </div>
    </form>
</body>

</html>

Pl
<!-- ... (the rest of your HTML form remains unchanged) -->

<!DOCTYPE html>
<html>
<head>
    <title>Investigator Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .header {
            background-color: #cdac6a;
            color: #0c0003;
            text-align: center;
            padding: 7px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
        }

        .input-container {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 1px;
        }

        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 1px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
    function fillFields() {
        var project_id = document.getElementById('project-id').value;

        // Check if a project_id is selected
        if (project_id) {
            // Create an XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Configure it: GET-method for the URL /get_project_info.php?project_id={project_id}
            xhr.open('GET', 'get_project_info.php?project_id=' + project_id, true);

            // Send the request
            xhr.send();

            // This will be called after the response is received
            xhr.onload = function () {
                if (xhr.status == 200) {
                    // Parse the JSON response
                    var projectInfo = JSON.parse(xhr.responseText);

                    // Update the form fields
                    document.getElementById('research-title').value = projectInfo.research_title;
                    document.getElementById('total-amount').value = projectInfo.sanctioned_amount;
                    document.getElementById('Department_name').value = projectInfo.department;
                }
            };
        }
    }

    function calculateRemainingBalance() {
        var totalAmount = parseFloat(document.getElementById('total-amount').value);
        var totalSpentAmount = parseFloat(document.getElementById('total-spent-amount').value);

        if (!isNaN(totalAmount) && !isNaN(totalSpentAmount)) {
            var remainingBalance = totalAmount - totalSpentAmount;

            // Update the remaining-balance field
            document.getElementById('remaining-balance').value = remainingBalance.toFixed(2);
        }
    }
</script>
     <script>
        function fillFields() {
            var project_id = document.getElementById('project-id').value;

            // Check if a project_id is selected
            if (project_id) {
                // Create an XMLHttpRequest object
                var xhr = new XMLHttpRequest();

                // Configure it: GET-method for the URL /get_project_info.php?project_id={project_id}
                xhr.open('GET', 'get_project_info.php?project_id=' + project_id, true);

                // Send the request
                xhr.send();

                // This will be called after the response is received
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        // Parse the JSON response
                        var projectInfo = JSON.parse(xhr.responseText);

                        // Update the form fields
                        document.getElementById('research-title').value = projectInfo.research_title;
                        document.getElementById('total-amount').value = projectInfo.sanctioned_amount;
                        document.getElementById('Department_name').value = projectInfo.department;
                    }
                };
            }
        }
    </script>
</head>
<body>
    <div class="header">
        <h1>Research Management System</h1>
        </div>
        <form action="#" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="input-container">
                <label for="project-id">Project ID:</label>
                <select name="project_id" id="project-id" onchange="fillFields()" required>
                    <option value="" disabled selected>Select Project ID</option>
                    <?php 
                        // Reset the pointer to the beginning of the result set
                        mysqli_data_seek($projectResult, 0);
                        while ($row = mysqli_fetch_assoc($projectResult)) : 
                    ?>
                        <option value="<?php echo $row['project_id']; ?>"><?php echo $row['project_id']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="input-container">
                <label for="research-title">Research Title:</label>
                <input type="text" id="research-title" name="research_title" readonly>
            </div>
            <div class="input-container">
                <label for="total-amount">Total Amount:</label>
                <input type="number" id="total-amount" name="total_amount" readonly>
            </div>
            <div class="input-container">
                <label for="Department">Department:</label>
                <input type="text" id="Department_name" name="Department_name" readonly required>
            </div>
            <div class="input-container">
                <label for="starting-date">Start of Project Date:</label>
                <input type="date" name="starting_date" id="starting-date" required>
            </div>
            <div class="input-container">
                <label for="proposed-date">Proposed End Date:</label>
                <input type="date" name="proposed_date" id="proposed-date" required>
            </div>
            <h5>Bank Details:</h5>
            <div class="input-container">
                <label for="account-number">A/c Number:</label>
                <input type="text" id="account-number" name="account_number" placeholder="Enter Account Number" required>
            </div>
            <div class="input-container">
                <label for="ifsc-code">IFSC Code:</label>
                <input type="text" id="ifsc-code" name="ifsc_code" placeholder="Enter IFSC Code" required>
            </div>
            <div class="input-container">
                <label for="micr-code">MICR Code:</label>
                <input type="text" id="micr-code" name="micr_code" placeholder="Enter MICR Code" required>
            </div>
            <div class="input-container">
                <label for="num-instalments">Number of Installments for Progress Report:</label>
                <input type="number" id="num-instalments" name="num_installments" placeholder="Enter Number of Installments" required>
            </div>
            <!-- Update the name attribute of the file input field -->
            <div class="input-container">
                <label for="progress-report">Upload Progress Report:</label>
                <input type="file" name="progress_report" id="progress-report" required>
            </div>

            <div class="input-container">
                <label for="progress-report-date">Date of Progress Report Submitted:</label>
                <input type="date" name="progress_report_date" id="progress-report-date" required>
            </div>
           
            <div class="input-container">
            <label for="total-spent-amount">Total Spent Amount:</label>
            <input type="number" id="total-spent-amount" name="total_spent_amount" placeholder="Enter Total Spent Amount" required onchange="calculateRemainingBalance()">
            </div>
            <div class="input-container">
            <label for="remaining-balance">Remaining Balance:</label>
            <input type="number" id="remaining-balance" name="remaining_balance" placeholder="Remaining Balance" required readonly>
            </div>
            <div class="btn btn-primary">
                <input type="submit" name="register" value="Submit">
            </div>
        </div
