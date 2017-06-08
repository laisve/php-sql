<?php 
session_start();
require('connection.php');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Email validation</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Enter your email address:</h2>
        <form method="post" action="process.php">
            User: <input type="text" name="name">
            Email: <input type="text" name="email">
            <button type="submit" name="submit">Submit</button>
        </form>  
    </div>
</body>
</html>