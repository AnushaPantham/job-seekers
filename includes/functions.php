<?php
function connect(){
    $server = "localhost";
    $dbname = "job_seekers";
    $username = "root";
    $password = "";
    return mysqli_connect($server,$username,$password,$dbname);
}
?>
