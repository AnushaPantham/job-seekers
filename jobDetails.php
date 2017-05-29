<?php
error_reporting(0);
session_start();

//var_dump($_SESSION);
if($_SESSION['user_type'] =='' || $_SESSION['user_type']=='employers')
    header('Location: login.php');
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
	<body id="jobDetails" bgcolor="#DEB887">
        <?php include "includes/header.php";?>

<?php
include "includes/functions.php";
 $conn = connect();
$sql_fetch_jobs = "SELECT * FROM applied_jobs where user_id='" . $_SESSION['id'] . "'";

$results = mysqli_query($conn, $sql_fetch_jobs);
$user_id = $_SESSION['id'];
        
while($row = mysqli_fetch_assoc($results))
{
    $sql_fetch_employer_id = "select * from job_postings where id ='".$row[job_id]."'";
    $row1 = mysqli_fetch_assoc(mysqli_query($conn,$sql_fetch_employer_id));
    $sql_fetch_companyName = "select companyName from employers where id = '" . $row1['employer_id'] . "'";
    
    echo "<div id='requirement'>";
        echo "<div id='info'>";
            echo "<b>" . mysqli_fetch_assoc(mysqli_query($conn,$sql_fetch_companyName))['companyName'] . "</b><br>";
            echo "Position: " . $row1['position'] . "<br>";
            echo "Requirement: " . $row1['requirements'] . "<br>";
            echo "Experience: " . $row1['experience'] . "<br>";
            echo "Salary: " . $row1['salary'] . "<br>";
            echo "Location: " . $row1['location'] . "<br>";
        echo "</div>";
        
        //echo "<input type='hidden' name='job_id' value='" . $row['id'] . "'>";
        //echo "<input type='hidden' name='user_id' value='" . $_SESSION['id'] . "'>";
        echo "<div id='apply_div'>";
            echo "<div>";
                echo "<b>Status</b><br>";
                if($row['status']=='')
                    echo "Pending";
                else
                    echo $row['status'];
            echo "</div>";
        echo "</div>";
    echo "</div>";
}
?>
    