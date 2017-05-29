<?php
error_reporting(0);
session_start();

//var_dump($_SESSION);
//if($_SESSION['user_type'] =='' || $_SESSION['user_type']=='employers')
//    header('Location: login.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Jobs</title>
		<link rel="stylesheet" href="resources/default.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="resources/script.js"></script>
	</head>
	<body bgcolor="#DEB887">
        <?php include "includes/header.php";?>

<?php
include "includes/functions.php";
 $conn = connect();
$sql_fetch_jobs = "SELECT * FROM `job_postings` where status='active'";


        
$results = mysqli_query($conn, $sql_fetch_jobs);
$user_id = $_SESSION['id'];
        
while($row = mysqli_fetch_assoc($results))
{
    $sql_fetch_companyName = "select companyName from employers where id = '" . $row['employer_id'] . "'";
    
    $sql_verify_if_user_applied = "select * from applied_jobs where user_id = '" . $_SESSION['id'] . "' and job_id='" . $row['id'] . "'";
    //die($sql_verify_if_user_applied);
    $num_rows = mysqli_num_rows(mysqli_query($conn, $sql_verify_if_user_applied));
    $disabled = "";
    if($num_rows)
        $disabled = "disabled";
    echo "<div id='requirement'>";
        echo "<div id='info'>";
            echo "<b>" . mysqli_fetch_assoc(mysqli_query($conn,$sql_fetch_companyName))['companyName'] . "</b><br>";
            echo "Position: " . $row['position'] . "<br>";
            echo "Requirement: " . $row['requirements'] . "<br>";
            echo "Experience: " . $row['experience'] . "<br>";
            echo "Salary: " . $row['salary'] . "<br>";
            echo "Location: " . $row['location'] . "<br>";
        echo "</div>";
        
        //echo "<input type='hidden' name='job_id' value='" . $row['id'] . "'>";
        //echo "<input type='hidden' name='user_id' value='" . $_SESSION['id'] . "'>";
        echo "<div id='apply_div'>";
            echo "<div>";
                echo "<input type='submit' onclick=\"applyJob(this,'" . $row['id'] . "','" . $_SESSION['id'] . "');\" $disabled value='Apply' id='apply' name='apply'>";
            echo "</div>";
        echo "</div>";
    echo "</div>";
}
?>
    