<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
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
        .form-container {
            text-align: center;
            margin: 20px auto;
            max-width: 400px; /* Adjust the maximum width as needed */
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        .form-container h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Style form labels and inputs */
        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="tel"],
        .form-container input[type="password"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Style radio buttons and labels */
        .form-container input[type="radio"] {
            margin-right: 5px;
        }

        /* Style the submit button */
        .form-container input[type="submit"] {
            background-color: #007acc;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
        }

        .form-container input[type="submit"]:hover {
            background-color: #005b9f;
        }
    </style>
</head>

<body>
    <header>
        <img src="Tumkur_University_logo1.jpg" alt="Tumkur University Logo">
        <h1>Sign Up</h1>
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
        <div class="form-container">
            <h3>Signup Form</h3>
            <form action="signup_process.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email ID:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>

                <label>Gender:</label>
                <input type="radio" id="male" name="gender" value="Male">
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="Female">
                <label for="female">Female</label>

                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" value="Sign Up">
            </form>
        </div>
    </main>
</body>

</html>