<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "pandu@6183";
$dbName= "msrd";
$conn = mysqli_connect($hostName,$dbUser,$dbPassword,$dbName);
if(!$conn){
    die("oops,something went wrong");
}
echo "connection was successful";
$sql = "select * from user";
$result = mysqli_query($conn,$sql);
echo $result;
?>