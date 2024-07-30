<?php
			require_once "database.php";
			
			// Check if the form has been submitted
			if (isset($_POST['submit'])) {
				
				// Get the animal type and image data from the form
				$animal_type = mysqli_real_escape_string($conn, $_POST['animal-type']);
				$image_data = addslashes(file_get_contents($_FILES['animal-photo']['tmp_name']));
				
				// Insert the data into the database
				$sql = "INSERT INTO animal_info (animal_type, image_data) VALUES ('$animal_type', '$image_data')";
				if (mysqli_query($conn, $sql)) {
					echo "Animal report submitted successfully.";
				if(isset($sneha['volunteer_id']) && !is_null($sneha['volunteer_id'])){
						
				session_start();
                $volunteer_id = $_SESSION['volunteer_id'];
                ini_set("SMTP","smtp.gmail.com");
                ini_set("smtp_port","587");

               // Get volunteer email from database
                $sql = "SELECT email FROM register WHERE id = '$volunteer_id'";
                $result = mysqli_query($conn, $sql);
                $email = mysqli_fetch_assoc($result)['email'];
				}
        // Send email notification to volunteer
                $to = $email;
                $subject = "New animal report uploaded";
                $message = "A new animal report has been uploaded. Please check the website for more details.";
                $headers = "From: Animal Welfare Website <noreply@animalwelfare.com>";
                mail($to, $subject, $message, $headers);
                } else{
			      echo "Error: " . mysqli_error($conn);
		        }


		    }
			
			// Get all the images from the database
			$sql = "SELECT * FROM animal_info";
			$result = mysqli_query($conn, $sql);

			mysqli_close($conn);

			?>
           if (isset($_POST['submit'])) {
				
				// Get the animal type and image data from the form
				$animal_type = mysqli_real_escape_string($conn, $_POST['animal-type']);
				$image_data = addslashes(file_get_contents($_FILES['animal-photo']['tmp_name']));
				
				// Insert the data into the database
				$sql = "INSERT INTO animal_info (animal_type, image_data) VALUES ('$animal_type', '$image_data')";
				if (mysqli_query($conn, $sql)) {
					echo "Animal report submitted successfully.";
				/*if(isset($sneha['volunteer_id']) && !is_null($sneha['volunteer_id'])){
						
				session_start();
                $volunteer_id = $_SESSION['volunteer_id'];
                ini_set("SMTP","smtp.gmail.com");
                ini_set("smtp_port","587");

               // Get volunteer email from database
                $sql = "SELECT email FROM register WHERE id = '$volunteer_id'";
                $result = mysqli_query($conn, $sql);
                $email = mysqli_fetch_assoc($result)['email'];
				}*/
				ini_set("SMTP","smtp.gmail.com");
                ini_set("smtp_port","587");
				  $sql = "SELECT email FROM register WHERE role = 'volunteer'";
			      $result = mysqli_query($conn, $sql);
			      while ($row = mysqli_fetch_assoc($result)) {
				  $email = $row['email'];
        // Send email notification to volunteer
                $to = $email;
                $subject = "New animal report uploaded";
                $message = "A new animal report has been uploaded. Please check the website for more details.";
                $headers = "From: Animal Welfare Website <noreply@animalwelfare.com>";
                mail($to, $subject, $message, $headers);
				  }
                } else{
			      echo "Error: " . mysqli_error($conn);
		        }


		    }
			
			// Get all the images from the database
			$sql = "SELECT * FROM animal_info";
			$result = mysqli_query($conn, $sql);

			mysqli_close($conn);

			?>
		</div>
		use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["submit"])){
    $mail= new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->Username='snehalathar008@gmail.com';
    $mail->Password='ymjhnzdzvbooxqqg';
    $mail->SMTPSecure='ssl';
    $mail->Port=465;
    $mail->setFrom('snehalathar008@gmail.com');
    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);
    $mail->Subject=$_POST["subject"];
    $mail->Body=$_POST["message"];
    $mail->send();
    echo
    "
    <script>
    alert('sent successfully');
    document.location.href = 'upload.php';
    </script>
    ";
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

    <?php
            // Connect to the database
           /* require_once "database.php";*/
            $conn = mysqli_connect("localhost", "root", "pandu@6183", "miniproject");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            // Retrieve the rescued animal data from the database
            $sql = "SELECT * FROM rescued_animal";
            $result = mysqli_query($conn, $sql);
            
            // Check if there are any rescued animals in the database
            if (mysqli_num_rows($result) > 0) {
                // Loop through all the rescued animals and display their details
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="rescued-animal">';
                    echo '<img src="' . $row['image_path'] . '" alt="' . $row['name'] . '">';
                    echo '<h2>' . $row['name'] . '</h2>';
                    echo '<p><strong>Animal Type:</strong> ' . $row['animal_type'] . '</p>';
                    echo '<p><strong>Location:</strong> ' . $row['location'] . '</p>';
                    echo '<p><strong>Rescued By:</strong> ' . $row['rescued_by'] . '</p>';
                    echo '</div>';
                }
            } else {
                echo "<p>No rescued animals found.</p>";
            }
            
            // Close the database connection
            mysqli_close($conn);
        ?>
    </main>
    <br><br><br><br><br><br><br><br><br><br><br>
    <footer>
        <p>Copyright © 2023 Animal Welfare Website.</p>
    </footer>
</body>
</html>
<body>
    <div class="container">
        <h1>welcome</h1>
        <p>you can see the details of reported animals here</p>
        <div class="form-btn">
            <input type="submit"class="btn btn-primary" value="See details" name="submit">
        </div>
        <a href="logout.php" class="btn btn warning">Logout</a>
    </div>
</body>
</html>