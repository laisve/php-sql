<?php
session_start();
require_once('connection.php');

if(isset($_POST['submit'])) {
    $user = $_POST['name'];
    $quote = $_POST['quote'];


    if(empty($user) || empty($quote)) {
        $_SESSION['error'] = "Please fill the fields";
        header("Location: index.php"); 
    }
    else {
        $sql = "INSERT INTO comments (user, quote, created_at)
        VALUES ('$user', '$quote', NOW());";
        ;
        if(run_mysql_query($sql)) {
            $_SESSION['message'] = "New quote added";
        }
        else {
            $_SESSION['message'] = "Failed to add quote";
        }
        header('Location: main.php');
}
}
if(isset($_POST['skip'])) {
    header("Location: main.php");
}

?>