<?php
session_start();
include('lib/DataSource.php');
if(isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    session_write_close();
} else {
    
    session_unset();
    session_write_close();
    $url = "./index.php";
    header("Location: $url");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="assets/css/phppot-style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/user-registration.css" type="text/css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .header {
            background-color: #cdac6a;
            color:  #0c0003;
            text-align: center;
            padding : 10px 0;
            
        }

        .page-content {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .login-signup a {
            color: #fff;
            text-decoration: none;
            
        }

        .button-container {
            display: flex;
            justify-content: left;
            margin-top: 20px;
        }

        .btn {
            background-color: #ccc;
            color: #fff;
            padding: 5px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome <?php echo $username; ?></h1>
        <div class="login-signup"><a href="logout.php" class="btn">Logout</a></div>
    </div>
    <div class="page-content">
        
        <div class="button-container">
            <button class="btn"><a href="investigator_form.php">Investigator Form</a></button>
            <button class="btn"><a href="view.php">View Investigator Details</a></button>
            <button class="btn"><a href="add_hod.php">Add HOD</a></button>
            <button class="btn"><a href="view_hod.php">View HOD</a></button>
        </div>
    </div>
</body>
</html>
