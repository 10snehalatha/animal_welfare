<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="practice.php" method="GET">
          <label>name</label>
          <input type="text" name="username">
          <label>password</label>
          <input type="password" name="password">
          <input type="submit" value="Submit">

    </form>
</body>
</html>
<?php

    $n=$_GET["username"];
    $p=$_GET["password"];
    echo "{$n}";
    echo "{$p}";
?>