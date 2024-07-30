<?php
session_start();
if(!isset($_SESSION["register"])){
    header("Location: login.php");
   
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>user dashboard</title>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style3.css">
</head>
<body>
    <div class="container">
        <h1>welcome</h1>
        <p>you can see the details of reported animals here</p>
        <!--<div class="form-btn">
            <input type="submit"class="btn btn-primary" value="See details" name="submit">-->
           <div class="button-container">
				<button class="button" onclick="window.location.href='details.php'">see details</button>
			</div>
        <!--</div>--> 
        <p>want to logout</p>
        <a href="logout.php" class="btn btn warning">Logout</a>
    </div>
</body>
</html>