
<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="style2.css">
</head>
<body>

    <div class ="container">
        <?php
        if(isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM register WHERE email = '$email'";
            $result = mysqli_query($conn,$sql);
            $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($user){
                if(password_verify($password, $user["password"])){
                    session_start();
                    $_SESSION["register"] = "yes";
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>password does not match</div>";
                 }
            }else{
                echo "<div class='alert alert-danger'>Email does not found</div>";
             }
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email"class="form-control"name="email" placeholder="Enter email-id:">
            </div>
            <div class="form-group">
                <input type="password"class="form-control"name="password" placeholder="password">
            </div>  
            <div class="form-btn">
                <input type="submit"class="btn btn-primary" value="Login" name="login">
            </div>
            <br></br>
            <div><p>Not registered yet <a href="register.php">Register Here</a></p></div>
        </form>
    </div> 
</body>
</html>