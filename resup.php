
<!DOCTYPE html>
<html>
<head>
	<title>rescue form</title>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 2rem auto;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #343a40;
        }
        form label {
            display: block;
            margin-bottom: 0.5rem;
            color: #343a40;
        }
        form input[type="text"],
        form input[type="file"]
        {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }
        form input[type="submit"] {
			width: 20%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class ="container">
	<?php
	require_once "database.php";
	if (isset($_POST["submit"])) {
		// Get the animal type and image data from the form
		$rescue_id = mysqli_real_escape_string($conn, $_POST['rescue_id']);
		$animal_type = mysqli_real_escape_string($conn, $_POST['animal-type']);
		$image_data = addslashes(file_get_contents($_FILES['animal-photo']['tmp_name']));
		//$folder = "uploads/".$image_data;
		$location_data = mysqli_real_escape_string($conn, $_POST['location_data']);
	   // var_dump($_POST['location_data']);
		// Insert the data into the database
		$sql = "INSERT INTO rescue_animal (rescue_id, animal_type, image_data, location_data) VALUES ('$rescue_id','$animal_type', '$image_data', '$location_data')";
		if (mysqli_query($conn, $sql)) {
			/*echo "rescue animal details are uploaded  successfully.";*/

		session_start();
        $_SESSION["register"] = "yes";
        header("Location: sent.php");
        die();
		}
	}
    ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

          <label for="animal-id">Animal id:</label>
          <input type="text" id="animal-id" name="rescue_id" required>
          <label for="animal-type">Animal Type:</label>

        <input type="text" id="animal-type" name="animal-type" required>

        <label for="animal-photo">Animal Photo:</label>
        <input type="file" id="animal-photo" name="animal-photo" required>

        <label for="animal-location">Animal Location:</label>
        <input type="text" id="location_data" name="location_data" required>
       <br><br>
        <input type="submit" name="submit" value="Submit">
       </form>
    </div>    
</body>
</html>