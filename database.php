<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "pandu@6183";
$dbName= "miniproject";
$conn = mysqli_connect($hostName,$dbUser,$dbPassword,$dbName);
$res =new PDO("mysql:host=$hostName;dbname=$dbName", $dbUser, $dbPassword);
if(!$conn){
    die("oops,something went wrong");
}
?>