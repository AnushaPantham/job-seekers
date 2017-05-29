<?php
error_reporting(0);
session_start();
include "includes/functions.php";

if(isset($_POST))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $enc_password = md5($password);
    $phone = $_POST['phonenumber'];
    $experience = $_POST['experience'];
    //var_dump($_FILES['resume']);
    $conn = connect();
    $sql_insert_user = "INSERT INTO `users`(`name`, `email`, `password`, `phone`, `experience`, `role`) VALUES ('$name','$email','$enc_password',$phone,'$experience','employee')";
    //echo $sql_insert_user;
    if(mysqli_query($conn,$sql_insert_user))
    {
        $id = mysqli_insert_id($conn);
        $filename = "Resume_" . $id . ".pdf";
        
        if(move_uploaded_file($_FILES['resume']['tmp_name'],"resumes/".$filename))
        {
            $sql_update_resume = "UPDATE `users` SET `resume`='$filename' WHERE `id`='$id'";
            mysqli_query($conn, $sql_update_resume);
            header("Location: login.php");
        }
    }
    else
       echo mysqli_connect_error();
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
            <h1><font color = "black">REGISTRATION FORM</font></h1>
            <div class="leftElement">Name: </div><div class="rightElement"><input type = "text" name = "name"></div>
            <div class="leftElement">EmailId: </div><div class="rightElement"><input type = "email" name = "email" placeholder="Enter valid email address"></div>
            <div class="leftElement">Create Password: </div><div class="rightElement"><input type = "password" name = "password" value = ""></div>
            <div class="leftElement">Phone Number: </div><div class="rightElement"><input type="text" name="phonenumber" pattern="[0-9]{10}" placeholder="Enter Employee Phone Number" required></div>
            <div class="leftElement">Experience:</div>
                <div class = "rightElement"><select name="experience" id="type" required>
                    <option value="">--select--</option>
                    <option value="0">null</option>
                    <option value="1">1 year</option>
                    <option value="2">2 years</option>
                    <option value="3">3 years</option>
                    <option value="4">4 years</option>
               </select></div>
            <div class="leftElement">Upload Resume:</div><div class = "rightElement"> <input type ="file" accept="application/pdf" name="resume"></div>
           <div id="submit_div">
            <input type="submit" value="Submit" name="submit"><input type="reset"value="clear">
            </div>
        </form>
	</body>
</html>