<?php
$dbServername= "localhost";
$dbUsername="root";
$dbPassword="";
$dbName="sven_jela";

$connection= mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName)
    OR die('Could not connect to database'.(mysqli_connect_error()));

