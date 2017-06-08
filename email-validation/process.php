<?php
//require_once('connection.php');

$conn = mysqli_connect("localhost", "root", "", "quotes");

if(isset($_POST['submit'])) {
   $user = $_POST['name'];
   $email = $_POST['email']; 
   
   if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       $message = "<div class='box error'>Invalid email</div>";
   } else {      
       $message = "<div class='box success'>Success! You entered ".$email." email</div>";
        $sql = "INSERT INTO email (email, created_at, updated_at)
        VALUES('$email', NOW(), NOW())";
        if(run_mysql_query($sql)) {
            $_SESSION['message'] = "New email added";
        }
        else {
            $_SESSION['message'] = "Failed to add email";
        }
   }
}

        
?>
<html>
<head>
    <title>Email validation</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<div class="container">
    <h2>Email addresses entered:</h2>
       <?php 
        echo $message;
        
        $query = "SELECT email, created_at FROM email";
        $results = fetch_all($query);
        foreach($results as $row) {
?>
        <p><?= $row['email'] ?> <?= $row['created_at'] ?></p>
        <?php } ?>
</div>
