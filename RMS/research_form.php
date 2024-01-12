<!DOCTYPE html>
<html>
<head>
    <title>Research Initialization Management Form</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Link to your CSS file -->
<style>
/* Reset some default styles to ensure consistency */
body, h1, h2, h3, p, ul, li {
    margin: 0;
    padding: 0;
}

/* Set a background color for the entire page */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

/* Style the header containing the logo and headings */
header {
    background-color: #007acc;
    color: #fff;
    text-align: center;
    padding: 20px;
}

header img {
    max-width: 1000px; /* Adjust the logo size as needed */
    height: auto; /* Maintain aspect ratio */
    margin-bottom: 10px;
}

header h1 {
    font-size: 24px;
}

/* Style the navigation menu */
nav ul {
    list-style-type: none;
    text-align: center;
    background-color: #333;
    padding: 10px 0;
}

nav ul li {
    display: inline;
    margin-right: 20px;
}

nav ul li:last-child {
    margin-right: 0;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
}

nav ul li a:hover {
    text-decoration: underline;
}

/* Center the form container */
.main {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Center vertically in viewport */
}

/* Style the form section */
section {
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    width: 100%;
    max-width: 500px; /* Limit form width */
}

h3 {
    font-size: 24px;
    margin-bottom: 20px;
}

/* Style form labels and inputs */
label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
input[type="textarea"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

textarea {
    resize: vertical;
}

/* Style the submit button */
input[type="submit"] {
    background-color: #007acc;
    color: #fff;
    padding: 12px 24px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 18px;
}

input[type="submit"]:hover {
    background-color: #005b9f;
}

    /* Style the label */
    label[for="department"] {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    /* Style the select */
    select#department {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }


</style>
</head>
<body>
  
 <header>
        <img src="Tumkur_University_logo1.jpg" alt="Tumkur University Logo">
        <h1>Research Initialization Management Form</h1>
    </header>
    <nav>
        <ul>
            <li><a href="home.php">Home Page</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
        </ul>
    </nav>    
<main>
        <section>
            <h3>Research Details</h3>
            <form action="insert_research.php" method="post">
                <label for="research_title">Research Title:</label>
                <input type="text" id="research_title" name="research_title" required><br>

                <label for="Project_ID">project id:</label>
                <input type="number" id="project_id" name="project_id" required><br>

                <label for="sponser_agency">Sponsor Agency:</label>
                <input type="text" id="sponser_agency" name="sponser_agency" required><br>

                <label for="principal_investigator">Principal Investigator Name:</label>
                <input type="text" id="principal_investigator" name="principal_investigator" required><br>

                <label for="sanctioned_amount">Sanctioned Amount:</label>
                <input type="number" id="sanctioned_amount" name="sanctioned_amount" required><br>

                <label for="department">Department:</label>
			<select id="department" name="department" required>
    			<option value="Department of MCA">Department of MCA</option>
   			 <option value="Department of MBA">Department of MBA</option>
    			<option value="Department of Biochemistry">Department of Biochemistry</option>
<option value="Department of Biotechnology">Department of Biotechnology</option>
<option value="Department of general chemistry">Department of general chemistry</option>
<option value="Department of chemistry">Department of chemistry</option>
<option value="Department of organic chemistry">Department of organic chemistry</option>
<option value="Department of physics">Department of physics</option>
<option value="Department of zoology">Department of zoology</option>
<option value="Department of botany">Department of botany</option>

   			 <!-- Add more options as needed -->
		</select><br>

                <label for="co_investigator">Co-Investigator Name:</label>
                <input type="text" id="co_investigator" name="co_investigator" required><br>

                <label for="thrust_area">Thrust Area:</label>
                <input type="text" id="thrust_area" name="thrust_area" required><br>

                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea><br>

                <input type="submit" value="Submit">
            </form>
        </section>
    </main>
</body>
</html>