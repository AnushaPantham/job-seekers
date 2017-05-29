<?php
session_start();
?>
 <div id="header">
     <h1>Job Seekers</h1>
</div>
 <div id="nav">
    <h3> 
        <a href=<?php if(isset($_SESSION['user']) && $_SESSION['user_type']!="users") { echo "employer_mainpage.php";} else echo "mainPage.php";?> >Home</a>
        <?php if(isset($_SESSION['user']) && $_SESSION['user_type']!="users") { ?><a href="job_posting.php">Post Jobs</a>
        <?php } ?>
        <a class="jobDetails" href= <?php if($_SESSION['user']!="" && $_SESSION['user_type']!="" && $_SESSION['user_type'] = "employee") { echo "jobDetails.php>JobDetails"; }else echo "Home.php>JobDetails"; ?></a>
        
       <!-- <a class="jobDetails" href="Home.php">JobDetails</a>-->
        <a href="contactUs.php">ContactUs</a>
        <a href= <?php if($_SESSION['user']!="" && $_SESSION['user_type']!="") { echo "logout.php>Logout"; }else echo "login.php>Login"; ?></a>
       

    </h3>
</div>