<?php
// Include settings.php to get database credentials
require_once("settings.php");

// Establish the database connection
$conn = mysqli_connect($host, $username, $password, $database);
?>

<?php
session_start(); // Start session to track login

// Restrict access to logged-in managers
if (!isset($_SESSION["manager"])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keyword" content="HR Management, Expressions of Interest, job applications, hiring process, EOI management">
    <meta name="description" content="Manage and review job applications (EOIs), change statuses, delete EOIs, and search applicants efficiently.">
    <meta name="author" content="Dylan Swain">
    <link rel="icon" href="../images/logo.png" type="image/icon">
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Manage EOIs</title>
</head>
<body>

<header>
    <?php include 'nav.inc';?> <!-- Include the navigation bar -->
</header>

<main class="manage-container">
    <h2 class="black-dark">Manage Expressions of Interest (EOIs)</h2>
    <p class="black-dark">Use the options below to search, update, or delete EOI records.</p>

    <!-- Search EOIs Form -->
    <section class="manage_content">
        <h3>Search EOIs</h3>
        <form method="GET">
            <label>Job Reference Number:</label>
            <input type="text" name="job_ref">

            <label>Applicant First Name:</label>
            <input type="text" name="first_name">

            <label>Applicant Last Name:</label>
            <input type="text" name="last_name">

            <input type="submit" name="search_eoi" value="Search EOIs">
        </form>
    </section>

    <!-- Update EOI Status Form -->
    <section class="manage_content">
        <h3>Update EOI Status</h3>
        <form method="GET">
            <label>EOI Number:</label>
            <input type="text" name="eoi_number">

            <label>New Status:</label>
            <select name="new_status">
                <option value="New">New</option>
                <option value="Current">Current</option>
                <option value="Final">Final</option>
            </select>

            <input type="submit" name="update_status" value="Update Status">
        </form>
    </section>

    <!-- Delete EOIs Form -->
    <section class="manage_content">
        <h3>Delete EOIs</h3>
        <form method="GET">
            <label>Job Reference Number:</label>
            <input type="text" name="delete_job_ref">
            <input type="submit" name="delete_eoi" value="Delete EOIs">
        </form>
    </section>

    <!-- Display EOI Records -->
    <section class="manage_content">
    <?php 
        // Run SQL query to retrieve all EOI records
        $sql = "SELECT * FROM eoi";
        $result = mysqli_query($conn, $sql);

        // If EOIs exist, display them in a table
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<h3>EOI Records</h3>";
            echo "<table border='1'>";
            echo "<tr><th>EOI Number</th><th>Job Ref</th><th>Name</th><th>Email</th><th>Status</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['EOInumber']) . "</td>";
                echo "<td>" . htmlspecialchars($row['job_ref']) . "</td>";
                echo "<td>" . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No EOIs found.</p>"; // Display message if no EOIs exist
        }

        // Close the database connection
        mysqli_close($conn);
    ?>
    </section>
</main>

<footer>
    <?php include 'footer.inc';?> <!-- Include the footer -->
</footer>

</body>
</html>