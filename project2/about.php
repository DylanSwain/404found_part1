<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keyword" content="team members, project team">
    <meta name="description" content="About our team"> <!--need to change-->
    <meta name="author" content="Md Sabbir Ahmed">
    <link rel="icon" href="../images/logo.png" type="image/icon">
    <link rel="stylesheet" href="../styles/styles.css">
    <title>About</title>
</head>
<body>
  <header>
    <?php include 'nav.inc';?>
</header>
    

        <main class="about-main">
            <section class="pd-join-title"> <!--pd = position description-->
                <h2 class="black-dark">About Our Team</h2>
            </section>


            <!-- info start -->
            <div class="gp-info-container">
                <section class="about-group-info">
                    <h2 class="barbara-blue">Group Information</h2>
                    <ul class="black-dark">
                      <li class="about-gp-name"> <span class="about-text-bold">Group Name:</span> 404_found
                        <ul>
                          <li class="about-time"> <span class="about-text-bold">Class Time:</span> 10:30am - 12:30pm</li>
                          <li> <span class="about-text-bold">Class Day:</span> Thursday</li>
                        </ul>
                      </li>
                      <li> <span class="about-text-bold">Tutor:</span> Razeen Hashmi</li>
                    </ul>
                  </section>
    
    
                  <section class="about-student-ids">
                    <h2 class="barbara-blue">Members IDs</h2> 
                    <ul class="black-dark">
                      <li class="about-text-bold">Md Sabbir Ahmed - 105092206</li>
                      <li class="about-text-bold">Dylan Swain - 105753312</li>
                    </ul>
                  </section>
            </div>
            <!-- info start -->



            <!-- contribution start -->
             <div class="contribution-container">
                <section class="about-contributions">
                    <h2 class="barbara-blue">Contributions</h2>
                    <dl class="black-dark">
                      
              
                      <dt class="about-text-bold">Md Sabbir Ahmed</dt>
                      <dd>Created EOI table, Updated apply page to implement server-side data formate checking and store EOI record to the table, converted job description page dynamic with database.</dd>
              
                      <dt class="about-text-bold">Dylan Swain</dt>
                      <dd>Created the manage.php and login.php pages. </dd>
                    </dl>
                  </section>
                  <!-- contribution end -->

                  <!-- Group Photo -->
                <section class="group-photo">
                    <h2 class="barbara-blue">Group Photo</h2>
                    <figure>
                    <img class="group-photo-img" src="../images/group-photo.jpg" alt="Our group photo">
                    </figure>
                </section>

             </div>


             <section class="interests ">
                <h2 class="barbara-blue">Team Interests</h2>
                <table class="interest-table black-dark">
                  <caption>Our Team's Personal Interests</caption>
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Interests</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Md Sabbir Ahmed</td>
                      <td>Music, Riding Bike, Travel.</td>
                    </tr>
                    <tr>
                      <td>Dylan Swain</td>
                      <td>Technology, Music, Cooking, Reading, Travelling, Anime/Manga.</td>
                    </tr>
                  </tbody>
                </table>
              </section>

              
            

        </main>

        <footer>
          <div class="pd-footer">
              <p>&copy; 2025 NeuroByte. All rights reserved.</p>
          </div>
      </footer>
        

    </body>
    

</html>