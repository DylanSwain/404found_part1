<?php
// Start session to track login **before any output**
session_start();

// Include settings.php to get database credentials
require_once("settings.php");

// Establish the database connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection is successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Restrict access to logged-in managers
if (!isset($_SESSION["manager"])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

// Initialize variables
$search_results = [];
$message = "";
$default_results = [];

// **SEARCH EOIs**
if (isset($_GET['search_eoi'])) {
    $job_ref = $_GET['job_ref'];
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];

    $sql = "SELECT * FROM eoi WHERE 1=1"; // Base query

    if (!empty($job_ref)) {
        $sql .= " AND job_ref = '".mysqli_real_escape_string($conn, $job_ref)."'";
    }
    if (!empty($first_name)) {
        $sql .= " AND first_name LIKE '%".mysqli_real_escape_string($conn, $first_name)."%'";
    }
    if (!empty($last_name)) {
        $sql .= " AND last_name LIKE '%".mysqli_real_escape_string($conn, $last_name)."%'";
    }

    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $search_results[] = $row;
        }
    } else {
        $message = "No matching EOIs found.";
    }
} else {
    // **Fetch All EOIs when no search is performed**
    $sql = "SELECT * FROM eoi";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $default_results[] = $row;
        }
    }
}

// **UPDATE EOI STATUS**
if (isset($_POST['update_status'])) {
    $eoi_number = $_POST['eoi_number'];
    $new_status = $_POST['new_status'];

    if (!empty($eoi_number) && !empty($new_status)) {
        $update_sql = "UPDATE eoi SET status = '".mysqli_real_escape_string($conn, $new_status)."' WHERE EOInumber = '".mysqli_real_escape_string($conn, $eoi_number)."'";
        if (!mysqli_query($conn, $update_sql)) {
            $message = "Failed to update EOI status.";
        }
    }
}

// **DELETE EOIs**
if (isset($_POST['delete_eoi'])) {
    $delete_job_ref = $_POST['delete_job_ref'];

    if (!empty($delete_job_ref)) {
        $delete_sql = "DELETE FROM eoi WHERE job_ref = '".mysqli_real_escape_string($conn, $delete_job_ref)."'";
        if (mysqli_query($conn, $delete_sql)) {
            $message = "EOIs with job reference '$delete_job_ref' deleted successfully.";
        } else {
            $message = "Failed to delete EOIs.";
        }
    } else {
        $message = "Please provide a Job Reference Number.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage EOIs</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

<header>
    <link rel="icon" href="../images/logo.png" type="image/icon">
    <?php include 'nav.inc'; ?> <!-- Include the navigation bar -->
</header>

<main class="manage-container">
    <h2 class="black-dark">Manage Expressions of Interest (EOIs)</h2>
    <p class="black-dark">Use the options below to search, update, or delete EOI records.</p>

    <?php if (!empty($message)) echo "<p class='notification'>$message</p>"; ?>

    <!-- Search EOIs Form -->
    <section class="manage_content">
        <h3>Search EOIs</h3>
        <form method="GET">
            <label>Job Reference Number:</label>
            <input type="text" name="job_ref" required>

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
        <form method="POST">
            <label>EOI Number:</label>
            <input type="text" name="eoi_number" required>

            <label>New Status:</label>
            <select name="new_status" required>
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
        <form method="POST">
            <label>Job Reference Number:</label>
            <input type="text" name="delete_job_ref" required>
            <input type="submit" name="delete_eoi" value="Delete EOIs">
        </form>
    </section>

    <!-- Display Search Results or Default All EOIs -->
    <section class="manage_content">
        <h3>EOI Records</h3>
        <table border='1'>
            <tr><th>EOI Number</th><th>Job Ref</th><th>Name</th><th>Email</th><th>Status</th></tr>
            <?php 
            $results_to_display = !empty($search_results) ? $search_results : $default_results;
            if (!empty($results_to_display)):
                foreach ($results_to_display as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['EOInumber']) ?></td>
                        <td><?= htmlspecialchars($row['job_ref']) ?></td>
                        <td><?= htmlspecialchars($row['first_name']) ?> <?= htmlspecialchars($row['last_name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                    </tr>
                <?php endforeach;
            else: ?>
                <tr><td colspan="5">No EOIs found.</td></tr>
            <?php endif; ?>
        </table>
    </section>
</main>

<footer>
    <?php include 'footer.inc'; ?> <!-- Include the footer -->
</footer>

</body>
</html>