<?php
error_reporting(0);
session_start();
include "includes/functions.php";
if(isset($_POST) && isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $enc_password = md5($password);
    $conn = connect();
    $sql_insert_employer = "INSERT INTO `employers`(`companyName`, `email`, `password`) VALUES ('$name','$email','$enc_password')";
    if(mysqli_query($conn, $sql_insert_employer))
        header("Location: login.php");
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
            <div class="clearfix"><div class="leftElement">CompanyName: </div><div class="rightElement"><input type = "text" name = "name"></div></div>
            <div class="clearfix"><div class="leftElement">EmailId: </div><div class="rightElement"><input type = "email" name = "email" placeholder="Enter valid email address"></div></div>
            <div class="clearfix"><div class="leftElement">Create Password: </div><div class="rightElement"><input type = "password" name = "password" value = ""></div></div>
             <div id="submit_div">
            <input type="submit" value="Submit" name="submit"><input type="reset"value="clear">
            </div>
        </form>
	</body>
</html>      