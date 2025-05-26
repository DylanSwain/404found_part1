<?php
require_once 'settings.php';  

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: apply.php'); 
        exit();
    }

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
        $tableSql = "
        CREATE TABLE IF NOT EXISTS eoi (
            EOInumber INT AUTO_INCREMENT PRIMARY KEY,
            job_ref VARCHAR(10) NOT NULL,
            first_name VARCHAR(20) NOT NULL,
            last_name VARCHAR(20) NOT NULL,
            street VARCHAR(40) NOT NULL,
            suburb VARCHAR(40) NOT NULL,
            state ENUM('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
            postcode CHAR(4) NOT NULL,
            email VARCHAR(100) NOT NULL,
            phone VARCHAR(12) NOT NULL,
            skill1 VARCHAR(20),
            skill2 VARCHAR(20),
            skill3 VARCHAR(20),
            skill4 VARCHAR(20),
            other_skills TEXT,
            status ENUM('New', 'Current', 'Final') NOT NULL DEFAULT 'New'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
        $pdo->exec($tableSql);
    } catch (PDOException $e) {
        die("DB Connection failed: " . $e->getMessage());
    }

    
    function clean_input($data) {
        return trim(htmlspecialchars($data));
    }

    // Validate inputs
    $errors = [];

    $job_ref = $_POST['job_ref'] ?? '';
    $first_name = clean_input($_POST['first_name'] ?? '');
    $last_name = clean_input($_POST['last_name'] ?? '');
    $dob = $_POST['dob'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $street = clean_input($_POST['street'] ?? '');
    $suburb = clean_input($_POST['suburb'] ?? '');
    $state = $_POST['state'] ?? '';
    $postcode = $_POST['postcode'] ?? '';
    $email = clean_input($_POST['email'] ?? '');
    $phone = clean_input($_POST['phone'] ?? '');
    $skills = $_POST['skills'] ?? [];
    $other_skills = clean_input($_POST['other_skills'] ?? '');

    

    // Job ref 
    $allowed_job_refs = ['REF001', 'REF002'];
    if (!in_array($job_ref, $allowed_job_refs)) {
        $errors[] = "Invalid job reference number.";
    }

    // First name  
    if (!preg_match("/^[a-zA-Z]{1,20}$/", $first_name)) {
        $errors[] = "First name must be up to 20 alphabetic characters.";
    }
    //  last name
    if (!preg_match("/^[a-zA-Z]{1,20}$/", $last_name)) {
        $errors[] = "Last name must be up to 20 alphabetic characters.";
    }

    // Dob
    if (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $dob)) {
        $errors[] = "Date of birth must be in dd/mm/yyyy format.";
    } else {
        
        list($day, $month, $year) = explode('/', $dob);
        if (!checkdate((int)$month, (int)$day, (int)$year)) {
            $errors[] = "Date of birth is not a valid date.";
        }
    }

    // Gender 
    if (!in_array($gender, ['male', 'female', 'other'])) {
        $errors[] = "Please select a valid gender.";
    }

    // Street 
    if (strlen($street) > 40 || strlen($street) === 0) {
        $errors[] = "Street address must be up to 40 characters.";
    }
    // suburb
    if (strlen($suburb) > 40 || strlen($suburb) === 0) {
        $errors[] = "Suburb/town must be up to 40 characters.";
    }

    // State 
    $allowed_states = ['VIC','NSW','QLD','NT','WA','SA','TAS','ACT'];
    if (!in_array($state, $allowed_states)) {
        $errors[] = "Please select a valid state.";
    }

    // Postcode
    if (!preg_match("/^\d{4}$/", $postcode)) {
        $errors[] = "Postcode must be exactly 4 digits.";
    } else {
        
        $postcode_start = $postcode[0];
        $state_postcode_rules = [
            'VIC' => ['3','8'],
            'NSW' => ['1','2'],
            'QLD' => ['4','9'],
            'NT'  => ['0'],
            'WA'  => ['6'],
            'SA'  => ['5'],
            'TAS' => ['7'],
            'ACT' => ['0']
        ];
        if (!in_array($postcode_start, $state_postcode_rules[$state])) {
            $errors[] = "Postcode does not match the selected state.";
        }
    }

    // Email 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    // Phone 
    if (!preg_match("/^[0-9 ]{8,12}$/", $phone)) {
        $errors[] = "Phone number must be 8 to 12 digits or spaces.";
    }

    // Skills 
    if (!is_array($skills) || count($skills) == 0) {
        $errors[] = "Please select at least one technical skill.";
    }

    // Other skills

    if (count($errors) > 0) {
        
        echo "<h2>Errors found:</h2><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul><a href='apply.php'>Go back to the form</a>";
        exit();
    }

    
    $skill1 = $skills[0] ?? null;
    $skill2 = $skills[1] ?? null;
    $skill3 = $skills[2] ?? null;
    $skill4 = $skills[3] ?? null;

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO eoi (job_ref, first_name, last_name, street, suburb, state, postcode, email, phone, skill1, skill2, skill3, skill4, other_skills, status) 
        VALUES (:job_ref, :first_name, :last_name, :street, :suburb, :state, :postcode, :email, :phone, :skill1, :skill2, :skill3, :skill4, :other_skills, 'New')");

    $stmt->execute([
        ':job_ref' => $job_ref,
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':street' => $street,
        ':suburb' => $suburb,
        ':state' => $state,
        ':postcode' => $postcode,
        ':email' => $email,
        ':phone' => $phone,
        ':skill1' => $skill1,
        ':skill2' => $skill2,
        ':skill3' => $skill3,
        ':skill4' => $skill4,
        ':other_skills' => $other_skills
    ]);

    // Get EOInumber
    $eoi_number = $pdo->lastInsertId();

    // confirmation message
    echo "<h2>Thank you for your interest.</h2>";
    echo "<p>Your EOI number is: <strong>" . htmlspecialchars($eoi_number) . "</strong></p>";
    echo "<a href='index.php'>Return to Home Page</a>";
?>
