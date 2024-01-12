<?php
include('lib/DataSource.php');
$database = new \Phppot\DataSource();
$conn = $database->getConnection();

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    $query = "SELECT research_title, sanctioned_amount, department FROM researchinfo WHERE project_id = '$project_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $projectInfo = mysqli_fetch_assoc($result);
        echo json_encode($projectInfo);
    } else {
        echo json_encode(['error' => 'Failed to fetch project information']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
