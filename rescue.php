<!DOCTYPE html>
<html>
<head>
    <title>Rescue Details</title>
    <meta charset="UTF-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style4.css">
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
    <div class="rescue-container">
<?php

// SELECT statement to retrieve rescued animal details
require_once "database.php";
$sql = "SELECT * from rescue_animal";

// Execute the SELECT statement and store the results in a variable
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Loop through the rows and display the details on the web page
    while($row = $result->fetch_assoc()) {
        echo "<div class='rescue-item'>";
        echo "<h2>Rescued Animal #" . $row["rescue_id"] . "</h2>";
        echo "<p>Animal Type: " . $row["animal_type"] . "</p>";
        $image_data = $row["image_data"];
        $image_info = base64_encode($image_data);
        echo "<div class='image-container'>";
        echo "<img src='data:image/png;base64," . $image_info . "' alt='" . $row["animal_type"] . "'>";
        echo "</div>";
        echo "<p>Location: " . $row["location_data"] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No rescued animals found.</p>";
}
$conn->close();
?>
    </div>
</body>
</html>
