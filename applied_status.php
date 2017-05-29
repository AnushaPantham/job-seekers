<?php
include "includes/functions.php";
$conn = connect();
$job_id = $_POST['job_id'];
$user_id = $_POST['user_id'];
$status = $_POST['status'];

$sql_update_job_status = "UPDATE `applied_jobs` SET `status`='$status' WHERE job_id='$job_id' and user_id='$user_id'";

if(mysqli_query($conn,$sql_update_job_status))
    echo "success";
else
    echo "Error: " . mysqli_error($conn);