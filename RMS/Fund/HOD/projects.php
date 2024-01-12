<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $project_id = $_POST['project_id'];
    $ratings = $_POST['ratings'];

    // Assuming you have a database connection established
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "researchdb";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Update the 'projects' table with the selected ratings
    $sql = "UPDATE projects SET ratings = '$ratings' WHERE project_id = $project_id";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        echo "Rating submitted successfully.";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

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

    .form-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .view-button {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .view-button:hover {
        background-color: #45a049;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 600px; /* Adjust the width as needed */
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr; /* Two columns */
        gap: 16px; /* Adjust the gap between columns as needed */
    }

    .modal-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .modal-form input, .modal-form select {
        width: 100%;
        padding: 8px;
        margin-bottom: 16px;
        box-sizing: border-box;
    }

    .modal-form button {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .modal-form button:hover {
        background-color: #45a049;
    }
</style>
    <title>Projects for HOD</title>
</head>
<body>
    <div class="form-container">
        <h2>Projects for HOD</h2>

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

        // Check if 'department' is set in the $_GET array
        if (isset($_GET["department"])) {
            $department = $_GET["department"];

            // Fetch projects from the 'form' table for the specified department
            $sql = "SELECT * FROM form WHERE department = '$department'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>
                        <th>Project ID</th>
                        <th>Research Title</th>
                        <th>Starting Date</th>
                        <th>Num Installments</th>
                        <th>Progress Report</th>
                        <th>Progress Report Date</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>";
                
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['project_id']}</td>";
                    echo "<td>{$row['research_title']}</td>";
                    echo "<td>{$row['starting_date']}</td>";
                    echo "<td>{$row['num_installments']}</td>";
                    echo "<td>";
                    
                   // Check if progress report PDF exists
             $progressReportPath = "path_to_progress_reports_directory/{$row['progress_report']}";
             if (file_exists($progressReportPath)) {
           // Display link to view PDF
           echo "<a href=\"$progressReportPath\" target=\"_blank\">View</a> | ";
    
            // Display link to download PDF
            echo "<a href=\"$progressReportPath\" download>Download</a>";
             } else {
             echo "Not available";
            }

                
                    echo "</td>";
                    echo "<td>{$row['progress_report_date']}</td>";
                    echo "<td>{$row['total_amount']}</td>";
                    echo "<td>
                            <button class=\"view-button\" onclick=\"openModal('projectModal{$row['id']}')\">View</button>
                            <button class=\"accept-button\" onclick=\"acceptProject('{$row['id']}')\">Accept</button>
                          </td>";
                    echo "</tr>";
                    ?>

<div class="modal" id="projectModal<?php echo $row['id']; ?>">
    <div class="modal-content">
        <span onclick="closeModal('projectModal<?php echo $row['id']; ?>')" style="cursor: pointer; float: right;">&times;</span>
        <h3>Project Details</h3>
        <form class="modal-form" method="post" action="">

            <div class="form-row">
                <label for="projectId">Project ID:</label>
                <input type="hidden" id="project_id" name="project_id" value="<?php echo $row['project_id']; ?>">
           </div>

            <div class="form-row">
                <label for="researchTitle">Research Title:</label>
                <input type="text" id="researchTitle" name="researchTitle" value="<?php echo $row['research_title']; ?>" readonly>
            </div>

            <div class="form-row">
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" value="<?php echo $row['department']; ?>" readonly>
            </div>

            <div class="form-row">
                <label for="startingDate">Starting Date:</label>
                <input type="text" id="startingDate" name="startingDate" value="<?php echo $row['starting_date']; ?>" readonly>
            </div>

            <div class="form-row">
                <label for="numInstallments">Num Installments:</label>
                <input type="text" id="numInstallments" name="numInstallments" value="<?php echo $row['num_installments']; ?>" readonly>
            </div>

            <div class="form-row">
                <label for="accountNumber">Account Number:</label>
                <input type="text" id="accountNumber" name="accountNumber" value="<?php echo $row['account_number']; ?>" readonly>
            </div>

            <div class="form-row">
                <label for="ifscCode">IFSC Code:</label>
                <input type="text" id="ifscCode" name="ifscCode" value="<?php echo $row['ifsc_code']; ?>" readonly>
            </div>

            <div class="form-row">
                <label for="micrCode">MICR Code:</label>
                <input type="text" id="micrCode" name="micrCode" value="<?php echo $row['micr_code']; ?>" readonly>
            </div>

            <div class="form-row">
                <label for="progressReport">Progress Report:</label>
                <input type="text" id="progressReport" name="progressReport" value="<?php echo $row['progress_report']; ?>" readonly>
            </div>

            <div class="form-row">
                <label for="progressReportDate">Progress Report Date:</label>
                <input type="text" id="progressReportDate" name="progressReportDate" value="<?php echo $row['progress_report_date']; ?>" readonly>
            </div>

            <div class="form-row">
                <label for="totalAmount">Total Amount:</label>
                <input type="text" id="totalAmount" name="totalAmount" value="<?php echo $row['total_amount']; ?>" readonly>
            </div>

            <div class="form-row">
                <label for="remainingBalance">Remaining Balance:</label>
                <input type="text" id="remainingBalance" name="remainingBalance" value="<?php echo $row['remaining_balance']; ?>" readonly>
            </div>

            <div class="form-row">
                <label for="totalSpentAmount">Total Spent Amount:</label>
                <input type="text" id="totalSpentAmount" name="totalSpentAmount" value="<?php echo $row['total_spent_amount']; ?>" readonly>
            </div>

            <div class="form-row">
                <label for="ratings">Ratings:</label>
                    <select id="ratings" name="ratings">
                        <option value="Good">Good</option>
                        <option value="Average">Average</option>
                        <option value="Bad">Bad</option>
                     </select>
                                </div>
            <div class="form-row">
                <button type="submit">Submit Rating</button>
            </div>

        </form>
    </div>
</div>
<?php
                }

                echo "</table>";
            } else {
                echo "No projects found for the specified department.";
            }
        } else {
            echo "Department not specified.";
        }

        mysqli_close($conn);
        ?>

<script>
    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "flex";
    }

    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "none";
    }

    function acceptProject(projectId) {
        // Create a form element
        var form = document.createElement('form');
        form.style.display = 'none';
        form.method = 'post';
        form.action = 'process_accept.php';

        // Get all input fields from the modal form
        var inputs = document.querySelectorAll('#projectModal' + projectId + ' .modal-form input');

        // Loop through the inputs and add them to the form
        inputs.forEach(function (input) {
            var clone = input.cloneNode(true);
            clone.name = input.name; // Ensure the name attribute is preserved
            form.appendChild(clone);
        });

        // Append projectId and rating to the form
        var projectIdInput = document.createElement('input');
        projectIdInput.type = 'hidden';
        projectIdInput.name = 'project_id';
        projectIdInput.value = projectId;
        form.appendChild(projectIdInput);

        var ratingInput = document.createElement('input');
        ratingInput.type = 'hidden';
        ratingInput.name = 'ratings';
        ratingInput.value = document.querySelector('#projectModal' + projectId + ' #ratings').value;
        form.appendChild(ratingInput);

        // Append the form to the body and submit it
        document.body.appendChild(form);
        form.submit();

        // Clean up - remove the form from the DOM
        document.body.removeChild(form);

        // Optionally, you can close the modal here
        closeModal('projectModal' + projectId);
    }
</script>

    </div>
</body>
</html>
