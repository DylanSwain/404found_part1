<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keyword" content="software developer job, tech job, programming, software engineering, job opportunity, software career, software development position">
    <meta name="description" content="We are looking for talented and passionate software developers to join our team. Apply now for exciting opportunities in software engineering and programming."> <!--need to change-->
    <meta name="author" content="Md Sabbir Ahmed">
    <link rel="icon" href="../images/logo.png" type="image/icon">
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Career Opportunity</title>
</head>
<body>
    
    <header>
        <?php include 'nav.inc';?>
    </header> 

    <main class="jobs-container">
        <section class="pd-join-title"> <!--pd = position description-->
            <h2 class="black-dark">Join Our Team</h2>
            <p class="black-dark">We're looking for talented individuals to join our growing team. Below are our current open positions.</p>
        </section>



        <!-- --------------------------------------------------------------------- -->
         <section>
        <?php 
        require_once("settings.php");
        $conn = mysqli_connect($host, $username, $password, $database);
        if(!$conn){
            echo "<p> Database connection failed: " . mysqli_connect_error() ."</p>";
        }
        else{
            $sql = "SELECT * FROM jobs";
            $result = mysqli_query($conn, $sql);


            if($result && mysqli_num_rows($result) > 0 ){
                while($row = mysqli_fetch_assoc($result)){
                    $position_name = htmlspecialchars ($row['position_name']);
                    $location = htmlspecialchars ($row['location']);
                    $ref_id = htmlspecialchars ($row['ref_id']);
                    $job_des = htmlspecialchars ($row['job_des']);
                    $responsibility_1 = htmlspecialchars ($row['responsibility_1']);
                    $responsibility_2 = htmlspecialchars ($row['responsibility_2']);
                    $responsibility_3 = htmlspecialchars ($row['responsibility_3']);
                    $responsibility_4 = htmlspecialchars ($row['responsibility_4']);
                    $responsibility_5 = htmlspecialchars ($row['responsibility_5']);
                    $responsibility_6 = htmlspecialchars ($row['responsibility_6']);
                    $responsibility_7 = htmlspecialchars ($row['responsibility_7']);
                    $Requirement_1 = htmlspecialchars ($row['Requirement_1']);
                    $Requirement_2 = htmlspecialchars ($row['Requirement_2']);
                    $Requirement_3 = htmlspecialchars ($row['Requirement_3']);
                    $Requirement_3 = htmlspecialchars ($row['Requirement_3']);
                    $Requirement_4 = htmlspecialchars ($row['Requirement_4']);
                    $Requirement_5 = htmlspecialchars ($row['Requirement_5']);
                    $Requirement_6 = htmlspecialchars ($row['Requirement_6']);
                    $benefit_1 = htmlspecialchars ($row['benefit_1']);
                    $benefit_2 = htmlspecialchars ($row['benefit_2']);
                    $benefit_3 = htmlspecialchars ($row['benefit_3']);
                    $benefit_4 = htmlspecialchars ($row['benefit_4']);
                    $benefit_5 = htmlspecialchars ($row['benefit_5']);
                    $benefit_6 = htmlspecialchars ($row['benefit_6']);
                    $reports_to = htmlspecialchars ($row['reports_to']);
                    $salary = htmlspecialchars ($row['salary']);




                    // Employee Benefits
                    echo"<aside class='benefits black-dark'>";
                        echo"<h3>Employee Benefits</h3>";
                        echo"<ul>";
                            echo"<li>$benefit_1</li>";
                            echo"<li>$benefit_2</li>";
                            echo"<li>$benefit_3</li>";
                            echo"<li>$benefit_4</li>";
                            echo"<li>$benefit_5</li>";
                            echo"<li>$benefit_6</li>";
                        echo"</ul>";
                    echo"</aside>";



                    // <!-- Job position 1 Start -->

                    echo"<div class='job-position-1'>";
                        echo"<section class='pd-job-1'>";
                            echo"<h3 class='barbara-blue'>$position_name</h3>";
                            echo"<p class='black-light'><em>Location: $location</em></p>";
                            echo"<p class='black-dark ref'><em>Ref ID: $ref_id</em></p>";

                            // <!-- Description -->
                            echo"<h4 class='pd-description-title black-dark'>Job Description</h4>";
                            echo"<p class='black-dark'>$job_des</em></p>";
                            echo"<p class='reports-to black-dark'><em><strong>Reports to:</strong> $reports_to</em></p>";
                


                            // <!-- Responsibility -->
                            echo"<h4 class='pd-responsibility-title black-dark'>Responsibilities</h4>";
                            echo"<ul class='pd-list black-dark'>";
                                echo"<li>$responsibility_1</li>";
                                echo"<li>$responsibility_2</li>";
                                echo"<li>$responsibility_3</li>";
                                echo"<li>$responsibility_4</li>";
                                echo"<li>$responsibility_5</li>";
                                echo"<li>$responsibility_6</li>";
                                echo"<li>$responsibility_7</li>";
                            echo"</ul>";



                            // <!-- Requirements -->
                            echo"<h5 class='pd-requirements-title black-dark'>Requirements</h5>";
                            echo"<ol class='pd-list black-dark'>";
                                echo"<li >$Requirement_1</li>";
                                echo"<li>$Requirement_2</li>";
                                echo"<li>$Requirement_3</li>";
                                echo"<li>$Requirement_4</li>";
                                echo"<li>$Requirement_5</li>";
                                echo"<li>$Requirement_6</li>";
                            echo"</ol>";
                            
                            
                            
                            // <!-- Salary -->
                            echo"<h4 class='pd-responsibility-title black-dark'>Salary Range</h4>";
                            echo"<ul class='pd-list black-dark'>";
                                echo"<li>$salary per year</li>";
                            echo"</ul>";


                            // <!-- Apply Now -->
                            echo"<a href='apply.php' class='pd-apply-btn'>Apply Now</a>";
                            
                            
                
                        echo"</section>";
                    echo"</div>";
                    // <!-- Job position 1 end -->

                    // ----------------------------------------------

                    
                }
            }
            else{
                echo"<p>No jobs</p>";
            }
            mysqli_close($conn);
        }
    ?>
    </section>
        <!-- --------------------------------------------------------------------- -->


        



        




        
        


    </main>




     <?php include 'footer.inc';?>
</body>
</html>
