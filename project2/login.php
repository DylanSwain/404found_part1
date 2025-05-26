<?php
session_start();
require_once("settings.php"); // Load database connection

$conn = mysqli_connect($host, $username, $password, $database);
$error_message = "";

// Ensure the `managers` table exists
$query = "CREATE TABLE IF NOT EXISTS managers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(50) NOT NULL -- Stores password in plaintext (UNSAFE)
)";
mysqli_query($conn, $query);

$username = "bob123";
$plain_password = "bob123";

// Check if `bob123` already exists
$query = "SELECT * FROM managers WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!mysqli_fetch_assoc($result)) {
    // Insert plaintext password (NOT recommended)
    $query = "INSERT INTO managers (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $plain_password);
    mysqli_stmt_execute($stmt);
}

// If login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Fetch user from the database
    $query = "SELECT * FROM managers WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($password === $row['password']) {
            $_SESSION["manager"] = $username;
            
            // Redirect to manage.php after successful login
            header("Location: manage.php");
            exit();
        } else {
            $error_message = "Incorrect username or password.";
        }
    } else {
        $error_message = "Incorrect username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Login</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

<header>
    <?php include 'nav.inc';?>
</header>

<main class="login-container">
    <section class="login-form">
        <h2 class="black-dark">Manager Login</h2>
        <p class="black-light">Enter your credentials to access the management system.</p>

        <?php if (!empty($error_message)) echo "<p class='error-message'>$error_message</p>"; ?>

        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <input type="submit" value="Login">
        </form>
    </section>
</main>

<footer>
    <?php include 'footer.inc';?>
</footer>

</body>
</html>