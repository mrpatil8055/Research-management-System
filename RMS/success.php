<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printable Research Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align:center
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ddd; /* Add a border to the table */
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .print-button {
            display: block;
            width: 100px;
            margin: 20px auto;
            text-align: center;
        }

        /* CSS for print */
        @media print {
            /* Exclude system-generated header and footer */
            thead, tfoot {
                display: none !important;
            }

            /* Change to landscape mode */
            @page {
                size: landscape;
            }
        }
    </style>
</head>
<body>
    <h1>Research Information added Successfully</h1> <!-- Add a heading -->

    <?php
    // Database credentials
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "researchdb";
    $tableName = "researchinfo";

    // Create a database connection
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the last inserted record from the database
    $sql = "SELECT * FROM $tableName ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        
        // Create an array to store table rows
        $tableRows = array();

        while ($row = $result->fetch_assoc()) {
            // Push table rows into the array
            $tableRows[] = $row;
        }

        // Transpose the table
        $transposedTable = array();
        foreach ($tableRows as $row) {
            foreach ($row as $key => $value) {
                $transposedTable[$key][] = $value;
            }
        }

        // Print the transposed table
        foreach ($transposedTable as $header => $values) {
            echo '<tr>';
            echo '<th>' . $header . '</th>';
            foreach ($values as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No records found.';
    }

    // Close the database connection
    $conn->close();
    ?>

    <div class="print-button">
        <button onclick="printPage()">Print</button>
    </div>

    <script>
        function printPage() {
            // Hide the print button and other non-printable elements
            var elementsToHide = document.querySelectorAll('.print-button');
            elementsToHide.forEach(function(element) {
                element.style.display = 'none';
            });

            // Trigger the print operation
            window.print();

            // Restore the hidden elements
            elementsToHide.forEach(function(element) {
                element.style.display = 'block';
            });
        }
    </script>
</body>
</html>
