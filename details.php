<?php
    session_start();
    if(!isset($_SESSION["register"]) || $_SESSION["register"] != "yes"){ // check if user is logged in
        header("Location: index.php"); // redirect to login page
        die();
    }
    require_once "database.php";
    $sql = "SELECT * FROM animal_info";
    $result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Animal Details</title>
    <meta charset="UTF-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
       
        
        .container {
            margin-top: 2rem;
        }
        h1 {
            margin-bottom: 1.5rem;
            color: #343a40;
        }
        .button-container {
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
            border-radius: 0.3rem;
            cursor: pointer;
        }
        .button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            background-color: #ffffff;
            border-radius: 0.3rem;
            overflow: hidden;
        }
        table thead th {
            background-color: #343a40;
            color: black;
            padding: 0.75rem;
            text-align: center;
        }
        table tbody td {
            padding: 0.75rem;
            text-align: center;
        }
        table tbody img {
            max-width: 100px;
            height: auto;
            border-radius: 0.3rem;
        }
    </style>
</head>
<body>
    <div class ="container">
        <h1 style="text-align: center">Details of rescued animals</h1>
        <!--<div class="container">-->
			<div class="button-container">
            <p>Upload details of rescued animals here</p>
				<button class="button" onclick="window.location.href='resup.php'">upload</button>
			</div>			  
		<!--</div>-->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Animal Type</th>
                    <th>Image</th>
                    <th>Location</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_array($result)): ?>
                <tr>
                    <td><?php echo $row['animal_type']; ?></td>
                    <td><img src="data:image/jpeg;base64,<?php echo base64_encode($row['image_data']); ?>" alt="Animal Image" /></td>
                    <td><?php echo $row['location_data']; ?></td>
                    <td><?php echo $row['animal_description']; ?></td>
                </tr>
                <?php endwhile; ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>
