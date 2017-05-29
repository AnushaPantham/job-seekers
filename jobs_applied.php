<?php
include "includes/functions.php";
$conn = connect();
$job_id = $_POST['job_id'];
$user_id = $_POST['user_id'];

// Need to verify if the user has already applied for this job.

$sql_applied_job = "INSERT INTO `applied_jobs`(`job_id`, `user_id`) VALUES ('" . $job_id . "','" . $user_id . "')";
if(mysqli_query($conn, $sql_applied_job))
    echo "success";
else
    echo "error";

?>