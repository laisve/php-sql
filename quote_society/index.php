<?php 
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Quote Society</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <h2>Welcome to the Quoting Society!</h2>
        </div>
        <div class="row">
            <div class="col-sm-10">
                <form class="form-horizontal" method="post" action="process.php">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Your Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quote" class="col-sm-2 control-label">Your Quote:</label>
                        <div class="col-sm-10">
                            <textarea name="quote" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-default">Add quote</button>
                        <button class="btn btn-default" name="skip">Skip to quotes</button>
                    </div>
                </form>
                <?php
                date_default_timezone_set('Europe/Vilnius');
                if(isset($_SESSION['error'])) {
                    echo "<div class='row error' style='color: red;'>". $_SESSION['error']."</div>";
                unset($_SESSION['error']);
                }
                ?>
            </div>
           <?php if(isset($_POST['skip'])) {
    header("Location: main.php");
}
?>
        </div>
    </div>
</body>
</html>


