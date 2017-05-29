<?php
error_reporting(0);
session_start();
$error_message = "";
include "includes/functions.php";
$conn = connect();
if(isset($_POST['submit']))
{
    $userid = $_POST['userid'];
    $password = $_POST['password'];
    $enc_password = md5($password);
    $user_type = $_POST['usertype'];

    $sql_verify_user = "select id from " . $user_type . " where email='" . $userid . "' and password='" . $enc_password . "'";
    $result = mysqli_query($conn, $sql_verify_user);
    if(mysqli_num_rows($result)>0)
    {
        $_SESSION['id'] = mysqli_fetch_assoc($result)['id'];
        $_SESSION['user'] = $userid;
        $_SESSION['user_type'] = $user_type;
        if($user_type=="users")
            header("Location: Home.php");
        else
            header("Location: employer_mainpage.php");
    }
    else
        $error_message = "Not a valid user";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Sign In</title>
        <link rel="stylesheet" href="resources/default.css">
    </head>
    <body bgcolor="#DEB887">
        <?php include "includes/header.php";?>
        <form action = "#" method = "post">
            <h1><font color = "black">LOGIN</font></h1>
            <div class="leftElement"> Email: </div>
            <div class = "rightElement"><input type = "text" name = "userid" id = "userid"></div>
            <div class="leftElement">Password: </div>
            <div class = "rightElement"> <input type = "password" name = "password" ></div>
            <div class="leftElement">User type: </div>
            <div class = "rightElement"> 
                <select name = "usertype">
                    <option value="users">Employee</option>
                    <option value="employers">Employer</option>
                </select>
            </div>
            <div id = "submit_div"><input type = "submit" value="Login" name = "submit"><?php echo $error_message;?>
            </div>
            <tr>  <td>If not signed in <a href="RegistrationForm.php" target="_blank">click here</a></td></tr>
        </form>
    </body>
</html>