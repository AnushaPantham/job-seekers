<?php
error_reporting(0);
session_start();
$user_id = $_SESSION['id'];
include "includes/functions.php";
$conn = connect();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Register</title>
		<link rel="stylesheet" href="resources/default.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="resources/script.js"></script>
        <style>
            table, tr, td, th{
                border: 1px solid black;
                border-collapse: collapse;
            }
            td, th{
                padding: 10px;
            }
            body > a[href='job_posting.php']{
                display: block;
                margin: 20px 0px 20px 20px;
            }
            table{
                margin-left: 20px;
            }
            button:last-child{
                margin-left: 10px;
            }
            
        </style>
	</head>
	<body bgcolor="#DEB887">
        <?php include "includes/header.php";?>
        <a href="job_posting.php">Click here to post a requirement.</a>
        
        <div>
            <table>
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Job Details</th>
                        <th>Employee Details</th>
                        <th>Resume</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql_fetch_job_details = "SELECT aj.job_id, aj.user_id, jp.position, jp.salary, jp.location, jp.experience, jp.requirements, u.name, u.email, u.resume,aj.status FROM `applied_jobs` aj, `job_postings` jp, `users` u WHERE aj.job_id = jp.id and jp.employer_id = '$user_id' and aj.user_id = u.id";
                        $result = mysqli_query($conn, $sql_fetch_job_details);
                        
                        $i = 0;
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $disabled = '';
                            if($row['status'] != '')
                                $disabled = 'disabled';
                            
                            echo "<tr>";
                                echo "<td>" . (++$i) ."</td>";
                                echo "<td>" . $row['position'] . "<br>"
                                            . $row['requirements'] . "<br>"
                                            . $row['salary'] . "<br>" 
                                            . $row['location'] . "<br>"
                                            . $row['experience'] . "</td>";
                                echo "<td>" . $row['name'] . "<br><a href='mailto:" . $row['email'] . "'>"
                                            . $row['email'] . "</a></td>";
                                echo "<td><a href='resumes/" . $row['resume'] . "' target='_blank'>" . $row['resume'] . "</td>";
                                echo "<td><button $disabled onclick=\"changeJobAppliedStatus(this,'" . $row['job_id'] . "','" . $row['user_id'] . "','" . "accepted" . "')\">Accept</button>";
                                echo "<button $disabled onclick=\"changeJobAppliedStatus(this,'" . $row['job_id'] . "','" . $row['user_id'] . "','" . "rejected" . "')\">Reject</button></td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>