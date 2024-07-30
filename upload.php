<!DOCTYPE html>
<html>
<head>
	<title>Animal Welfare Website</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">-->
	<link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
	<header>
		<nav>
			<ul>
			    <li><a href="home.php">Home</a></li>
				<li><a href="upload.php">Upload</a></li>
				<li><a href="volunteer.html">Volunteer</a></li>
				<li><a href="charity.php">Find a Charity</a></li>
				<li><a href="contacts.html">Contact Us</a></li>
			</ul>
		</nav>
	</header>

	<div class="main">
		<h1>"Behind every wound is a will to survive. Together, we can help them thrive."</h1>

        <br>
		<p1>Here you can report an injured or unhealthy animal and find a charity animal trust to help them.</p1>
	   <div class="container">
            <?php
		
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;


           require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
           require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
           require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';
			
			require_once "database.php";
			if (isset($_POST["submit"])) {
				// Get the animal type and image data from the form
				$animal_type = mysqli_real_escape_string($conn, $_POST['animal-type']);
				$image_data = addslashes(file_get_contents($_FILES['animal-photo']['tmp_name']));
                //$folder = "uploads/".$image_data;
                $location_data = mysqli_real_escape_string($conn, $_POST['location_data']);
                $animal_description = mysqli_real_escape_string($conn, $_POST['animal_description']);
			   // var_dump($_POST['location_data']);
				// Insert the data into the database
				$sql = "INSERT INTO animal_info (animal_type, image_data, location_data, animal_description) VALUES ('$animal_type', '$image_data', '$location_data', '$animal_description')";
				if (mysqli_query($conn, $sql)) {
					echo "Animal report submitted successfully.";

					$mail = new PHPMailer(true);
					try{
					$mail->isSMTP();
					$mail->Host = 'smtp.gmail.com';
					$mail->SMTPAuth = true;
					$mail->Username = 'snehalathar008@gmail.com'; // Replace with your Gmail address
                    $mail->Password =  'exqwscpnbqgwuzqb';
					/*$mail->Password = 'qwxzredjoiscgang'; */// Replace with your Gmail password
					$mail->SMTPSecure = 'ssl';
					$mail->Port = 465;
			       // $email = $_POST["email"];
					// Get all the emails of registered volunteers from the database
					//$sql = "SELECT * FROM register WHERE email = '$email'";
                    $sql="select email from register";
					$result = mysqli_query($conn, $sql);
					$emails = mysqli_fetch_all($result, MYSQLI_ASSOC);
					$volunteer_emails = array_column($emails, 'email');
					
					
					// Set the email parameters
					$mail->setFrom('snehalathar008@gmail.com', 'Animal Welfare Website');
                    $mail->Subject = 'New animal report uploaded';
					$mail->Body = 'A new animal report has been uploaded. Please check the website for more details.';
		
                    foreach ($volunteer_emails as $email) {
                        $mail->addAddress($email);
                        $mail->send();
                        $mail->ClearAddresses();
                    }

                        session_start();
                        $_SESSION["email"] = "yes";
                        header("Location: send.php");
                        die();
				   }catch(Exception $e){
						/*echo "Error sending email: " . $mail->ErrorInfo;*/
						echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					}
				}
			}
			
			?>
	   </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
               <div class="form-group">
                    <label for="animal-type">Animal Type:</label>
                    <select id="animal-type" name="animal-type" required>
                        <option value="dog">Dog</option>
                        <option value="cat">Cat</option>
                        <option value="cow">Cow</option>
                        <option value="other">Other</option>
                    </select>
              </div>
              <div class="form-group">
                    <label for="animal-photo">Animal Photo:</label>
                    <input type="file" id="animal-photo" name="animal-photo" required>
              </div>
              <div class="form-group">
                    <label for="animal-location">Animal Location:</label>
                    <input type="text" id="location_data" name="location_data" required>
                    <p>please mention the location clearly
                        (ex:near place,street/road name,town/city name)
                    </p>                 
              </div>
              <div class="form-group">
                    <label for="animal-description">Animal Description:</label>
                    <textarea id="animal-description" name="animal_description"></textarea> 
              </div>
              <div class="form-group">
                       <input type="submit" id="btn" name="submit" value="Report Animal">
              </div>

           
        </form>

        

        <div class="content">
            <h3>Things you follow<h3>
            <div class="row">
                
                 <div class="column">
                     <img src="assets/see2.jpg" alt="1" >
                     <h6>step-1:Found an animal</h6>
                 </div>
                 <div class="column">
                     <img src="assets/click.jpg (3).jpg" alt="2" >
                     <h6>step-2:Take a pic</h6>
                 </div>
                 <div class="column">
                     <img src="assets/Upload-pana.jpg" alt="3" >
                     <h6>step-3:Upload in the website</h6>
                </div>
             </div>
             <h3>Things we follow</h3>
             <div class="row">             
                 <div class="column">
                     <img src="assets/volhelp2.jpg" alt="4" >
                     <h6>step-1:We take them with us</h6>
                 </div>
                 <div class="column">
                     <img src="assets/doc3.jpg" alt="5" >
                     <h6>step-2:Provide treatment</h6>
                 </div>
                 <div class="column">
                     <img src="assets/shel2.jpg" alt="6" >
                     <h6>step-3:A happy home for them</h6>
                </div>
             </div>
        </div>
</body>
</html>
