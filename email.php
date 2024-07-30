// Get volunteer email from database
<?php
require_once "database.php";
$sql = "SELECT email FROM register WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$email = mysqli_fetch_assoc($result)['email'];

// To send email notification to volunteer
$to = $email;
$subject = "New animal report uploaded";
$message = "A new animal report has been uploaded. Please check the website for more details.";
$headers = "From: Animal Welfare Website <noreply@animalwelfare.com>";
mail($to, $subject, $message, $headers);
?>
