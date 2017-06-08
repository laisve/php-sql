<?php
    require_once('connection.php');
?>
<html>
<head>
    <title>Quote Society</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <a href="index.php"><button class="btn btn-default" style="margin-top: 25px;">Back to form</button></a>
            <h2>Here are some awesome quotes:</h2>
        </div>
        <div class="row">
            <div class="col-sm-10">
                <p><?php
                $sql = "SELECT quote, user FROM comments;";
                $res = mysqli_query($connection, $sql);
                      
                if($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc() ) {
                      echo '<p>"'.$row["quote"].'"</p>';
                      echo "<p>".$row["user"]."</p><hr>";
                      }
                }
                     ?></p>
            </div>
        </div>
    </div>
</body>
</html>