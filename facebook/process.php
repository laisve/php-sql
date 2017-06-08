<?php
session_start();
require_once('connection.php');

function login($loginemail, $loginpassword) {
        $query = "SELECT email, password FROM users WHERE '$loginemail' = email AND '$loginpassword' = password;";
        $loggeduser = fetch_record($query);
        if($loggeduser) {
            $sql = "SELECT first_name, id FROM users WHERE email = '$loginemail';";
            $row = fetch_record($sql);
            $name = $row['first_name'];
            $id = $row['id'];
            $_SESSION['first_name'] = $name;
            $_SESSION['id'] = $id;
            header("Location: main.php");
        }
        else {
            echo "Wrong email or password";
        }
    }

function redirect() { 
    $loginemail = escape_this_string($_POST['email']);
    $loginpassword = escape_this_string($_POST['password']);
    
    if(empty($loginemail)) {
        $_SESSION['loginerror'] = "Please insert email";
        header("Location: index.php"); 
    }
    else if(empty($loginpassword)) {
        $_SESSION['loginerror'] = "Please insert your password";
        header("Location: index.php"); 
    }
    else {
        login($loginemail, $loginpassword);
    }
 }  

if(isset($_POST['login'])) {
    redirect();
}

if(isset($_POST['register'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if(empty($name) && empty($surname)) {
        $_SESSION['reg_error'] = "Name and surname are required";
        header("Location: index.php"); 
    }
    else if(empty($name)) {
        $_SESSION['reg_error'] = "Name is required";
        header("Location: index.php"); 
    }
    else if(empty($surname)) {
        $_SESSION['reg_error'] = "Surname is required";
        header("Location: index.php"); 
    }
    else if(empty($email)) {
        $_SESSION['reg_error'] = "Email is required";
        header("Location: index.php"); 
    }
    else if(empty($password)) {
        $_SESSION['reg_error'] = "Password is required";
        header("Location: index.php"); 
    }
    else if (strlen($password) < 6) {
        $_SESSION['reg_error'] = "Password must be at least 6 characters long";
        header("Location: index.php"); 
    }
    else {
        $sql = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES ('$name', '$surname', '$email', '$password', NOW(), NOW());";
        
        if(run_mysql_query($sql)) {
            $_SESSION['message'] = "New user added";
            $_SESSION['first_name'] = $name;
        }
        else {
            $_SESSION['message'] = "Failed to add user";
        }
        header("Location: main.php");
    }
}

if(isset($_POST['logoff'])) {
    header("Location: index.php");
    session_destroy();
}

if(isset($_POST['post_message'])) {
    $message = $_POST['message'];
    $sql = "SELECT id FROM users WHERE id = '{$_SESSION['id']}';";
    $row = fetch_record($sql);
    $userid = $row['id'];
    $query = "INSERT INTO messages (message, created_at, updated_at, user_id) VALUES ('$message', NOW(), NOW(), '$userid');";
    if(run_mysql_query($query)) {
            $_SESSION['message'] = "New message added";
        }
        else {
            $_SESSION['message'] = "Failed to add message";
        }
        header("Location: main.php");
}
if(isset($_POST['post_comment'])) {
    $comment = $_POST['comment'];
    $mess_id = $_POST['message_id'];
    $sql_user = "SELECT id AS user_id FROM users
            WHERE id = '{$_SESSION['id']}';";
    $results = fetch_record($sql_user);
    $user_id = $results['user_id'];
    $sql_message = "SELECT id AS message_id FROM messages WHERE id = '$mess_id';";
    $res = fetch_record($sql_message);
    $mess_id = $res['message_id'];
    echo $user_id;
    echo $mess_id;
    
    $query = "INSERT INTO comments (comment, created_at, updated_at, message_id, user_id) VALUES ('$comment', NOW(), NOW(), '$mess_id', '$user_id');";
    if(run_mysql_query($query)) {
        $_SESSION['message_comm'] = "New comment added";
    }
    else {
        $_SESSION['message_comm'] = "Failed to add comment";
    }
    header("Location: main.php");
}


?>