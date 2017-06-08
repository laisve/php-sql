<?php
    require_once('connection.php');
    session_start();
?>
<html>
<head>
    <title>Facebook-Timeline</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style type="text/css">
        .right {
            float: right;
            margin-top: -40px;
        }
        li {
            list-style: none;
            vertical-align: middle;
            display: inline-block;
            margin-left: 20px;
        }
        .btn-success {
            float: right;
        }
        
    </style>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="left">
                <h3>Timeline</h3>
            </div>
            <ul class="right">
                <li><h4>Welcome, <?php
                 echo $_SESSION['first_name'];
                ?></h4></li>
                <li>
                    <form method="post" action="process.php">
                        <input class="button" type="submit" name="logoff" value="Log off">
                    </form>
                </li>
            </ul>         
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <form method="post" action="process.php">
                    <div class="form-group">
                        <label for="message"><h4>Post a message</h4></label>
                        <textarea class="form-control" name="message"></textarea>
                    </div>
                    <button type="submit" name="post_message" class="btn btn-primary">Post message</button>
                </form>
                <div class="message">
                    <?php
                    $query = "SELECT users.first_name, users.last_name, messages.id AS message_id, messages.message, messages.created_at FROM messages
                    JOIN users ON users.id = messages.user_id
                    ORDER BY messages.updated_at DESC;";
                    $results = fetch_all($query);
                    foreach($results as $row) { ?>
                        <div class="row">
                            <h4 style="font-weight: bold;"><?= $row['first_name']." ".$row['last_name']." - ".$row['created_at'];?></h4>
                            <p><?= $row['message']; ?></p>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form method="post" action="process.php">
                                            <div class="form-group">
                                                <input type="hidden" name="message_id" value="<?php echo $row['message_id'];?>">
                                                <label for="comment"><h5>Post a comment</h5></label>
                                                <textarea class="form-control" name="comment"></textarea>
                                            </div>
                                            <button type="submit" name="post_comment" class="btn btn-success">Post a comment</button>
                                        </form>
                                    </div>
                                </div>
                               <div class="row">
                                    <?php
                                    $qr = "SELECT users.first_name, users.last_name, comments.comment, comments.created_at FROM comments JOIN users ON users.id = comments.user_id JOIN messages ON comments.message_id = messages.id WHERE comments.message_id = '{$row['message_id']}';";
                                    $res = mysqli_query($connection, $qr);
                                    if($res->num_rows > 0) {
                                        while ($row = $res->fetch_assoc() ) {
                                        echo '<div class="col-md-12"><p style="font-weight: bold;">'.$row["first_name"]." ".$row['last_name'].'</p>';
                                          echo "<p>".$row["comment"]."</p></div>";
                                          }
                                    }
                                                        ?>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>