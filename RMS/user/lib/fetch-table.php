

<!DOCTYPE html>
<html>
<head>
    <title>View Details</title>
</head>
<body>
    <h1>Details from Database</h1>
    <table border="1">
        <tr>
            <th>Project ID</th>
            <th>Starting Date</th>
            <th>Proposed Date</th>
            <th>Account Number</th>
            <th>IFSC Code</th>
            <th>MICR Code</th>
            <th>Number of Installments</th>
            <th>Progress Report</th>
            <th>Progress Report Date</th>
            <th>Remaining Balance</th>
            <th>Total Spent Amount</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['project_id'] . "</td>";
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
        ?>
    </table>
</body>
</html>
