<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" href="../images/logo.png" type="image/icon">
    <link rel="php" href="https://mercury.swin.edu.au/it000000/formtest.php">
</head>
<body>
  <header>
    <?php include 'nav.inc';?>
</header> 
    <h2 id="application_header" class="black-dark" >Register Interest in Job Position</h2>

    <main class="application black-dark">
        <div class="form-container">



        <!-- form -->
        <form action="process_eoi.php" method="post" novalidate="novalidate">



          <!-- reference number -->
            
            <label for="job_ref">Job Reference Number:</label>
        <select id="job_ref" class="input-size" name="job_ref" required>
          <option value="" disabled selected>Select</option>
          <option value="REF001">REF001</option>
          <option value="REF002">REF002</option>
        </select><br><br>
        

        <!-- first name -->
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" class="input-size" name="first_name" placeholder="Enter First Name" required><br><br>

        <!-- last name -->
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" class="input-size" name="last_name" placeholder="Enter Last Name" required><br><br>
        
        <!-- birth date -->
        <label for="dob">Date of Birth:</label>
        <input type="text" id="dob" class="input-size" name="dob" pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy" required><br><br>

        <!-- <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" class="input-size" name="dob"  placeholder="dd/mm/yyyy" required><br><br> -->
    
        <!-- gender -->
        <fieldset>
          <legend>Gender</legend>
          <input type="radio" id="male" name="gender" value="male" required>
          <label for="male">Male</label>
          <input type="radio" id="female" name="gender" value="female" required>
          <label for="female">Female</label>
          <input type="radio" id="other" name="gender" value="other" required>
          <label for="other">Other</label>
        </fieldset><br>


        <!-- address -->
        <fieldset><label for="street">Street Address:</label>
            <input type="text" id="street" class="input-size" name="street" maxlength="40" required><br><br>
        
            <label for="suburb">Suburb/Town:</label>
            <input type="text" id="suburb" class="input-size" name="suburb" maxlength="40" required><br><br>
        
            <label for="state">State:</label>
            <select id="state"  class="input-size" name="state" required>
              <option value="" disabled selected>Select state</option>
              <option value="VIC">VIC</option>
              <option value="NSW">NSW</option>
              <option value="QLD">QLD</option>
              <option value="NT">NT</option>
              <option value="WA">WA</option>
              <option value="SA">SA</option>
              <option value="TAS">TAS</option>
              <option value="ACT">ACT</option>
            </select><br><br>
        
            <label for="postcode">Postcode:</label>
            <input type="text" id="postcode" class="input-size" name="postcode" pattern="\d{4}" required><br><br>
        </fieldset><br>
        <!-- https://www.w3schools.com/tags/att_input_pattern.asp -->


        <!-- email -->
        <label for="email">Email:</label>
        <input type="email" id="email" class="input-size" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br><br>
        
        <!-- number -->
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" class="input-size" name="phone" pattern="[0-9]{8,12}" required><br><br>
    


        <!-- skills -->
        <fieldset >
          <legend>Technical Skills (select at least one)</legend>
          <input type="checkbox" id="html" name="skills[]" value="HTML" required>
          <label for="html">HTML</label>
          <input type="checkbox" id="css" name="skills[]" value="CSS">
          <label for="css">CSS</label>
          <input type="checkbox" id="js" name="skills[]" value="JavaScript">
          <label for="js">JavaScript</label>
          <input type="checkbox" id="python" name="skills[]" value="Python">
          <label for="python">Python</label>
        </fieldset><br>
    
        <label for="other_skills">Other Skills:</label><br>
        <textarea id="other_skills" name="other_skills" placeholder="Optional..."></textarea><br><br>
    
        <input class="submit-btn" type="submit" value="Submit">
    </form>
   
    </div>
    <img id="apply_image" src="../styles/Images/apply_side.jpg" alt="group working">
</main>
    
</body>
</html>