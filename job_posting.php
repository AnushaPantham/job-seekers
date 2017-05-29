<?php
error_reporting(0);
session_start();
include "includes/functions.php";

if(isset($_POST['submit']))
{
    $id = $_SESSION['id'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $location = $_POST['location'];
    $requirements = $_POST['requirements'];
    $experience = $_POST['experience'];
    
    $conn = connect();
    $sql_insert_job ="INSERT INTO `job_postings`(`employer_id`, `position`, `salary`, `requirements`, `location`, `experience`,`status`) VALUES ('$id','$position','$salary','$requirements','$location','$experience','active')";
    if(mysqli_query($conn,$sql_insert_job))
        header("Location: employer_mainpage.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Register</title>
		<link rel="stylesheet" href="resources/default.css">
	</head>
	<body bgcolor="#DEB887">
        <?php include "includes/header.php";?>
        <form action = "#" method="POST" enctype="multipart/form-data">
            <h1><font color = "black">POST YOUR JOB</font></h1>
<!--            <div class="clearfix"><div class="leftElement">CompanyName: </div><div class="rightElement"><input type = "text" name = "companyName"></div></div>-->
            <div class="clearfix"><div class="leftElement">Position </div><div class="rightElement"><input type = "text" name = "position" ></div></div>
            <div class="clearfix"><div class="leftElement">Salary </div><div class="rightElement"><input type = "text" name = "salary" value = ""></div></div>
            <div class="clearfix"><div class="leftElement">Requirements </div><div class="rightElement"><textarea name = "requirements" value = ""></textarea></div></div>
            <div class="clearfix"><div class="leftElement">Location </div><div class="rightElement"><input type = "text" name = "location" value = ""></div></div> 
            <div class="leftElement">Experience </div><div class="rightElement"><select name="experience" id="type" required>
                    <option value="">--select--</option>
                    <option value="fresher">fresher</option>
                    <option value="1 year">1 year</option>
                    <option value="2 years">2 years</option>
                    <option value="3 years">3 years</option>
                    <option value="4 years">4 years</option>
               </select></div></div>
        
             <div id="submit_div">
            <input type="submit" value="Submit" name="submit"><input type="reset"value="clear">
            </div>
        </form>
	</body>
</html>