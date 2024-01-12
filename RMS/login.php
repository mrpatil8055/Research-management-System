<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Link to your CSS file -->
   
</head>
<body>
    <header>
        <img src="Tumkur_University_logo1.jpg" alt="Tumkur University Logo">
        <h1>Login</h1>
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
            <div class="form-container">
                <h1>Login Form</h1>
                <form action="login_process.php" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>

                    <input type="submit" value="Login">
                </form>
            </div>
        </section>
    </main>
</body>
</html>
