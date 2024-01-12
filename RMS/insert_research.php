<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "researchdb";
    $tableName = "researchinfo"; // Name of your research information table

    // Retrieve form data
    $researchTitle = $_POST["research_title"];
    $project_id = $_POST["project_id"];
    $sponsorAgency = $_POST["sponser_agency"];
    $principalInvestigator = $_POST["principal_investigator"];
    $sanctionedAmount = $_POST["sanctioned_amount"];
    $department = $_POST["department"];
    $coInvestigator = $_POST["co_investigator"];
    $thrustArea = $_POST["thrust_area"];
    $address = $_POST["address"];

    // Create a database connection
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to insert data
    $sql = "INSERT INTO $tableName (research_title, project_id, sponsor_agency, principal_investigator, sanctioned_amount, department, co_investigator, thrust_area, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisdsssss", $researchTitle, $project_id, $sponsorAgency, $principalInvestigator, $sanctionedAmount, $department, $coInvestigator, $thrustArea, $address);

    if ($stmt->execute()) {
        // Redirect to the success page
        header("Location: success.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // If someone accesses this page directly without submitting the form, you can redirect them to the research_form.php page
    header("Location: research_form.php");
    exit;
}
?>
