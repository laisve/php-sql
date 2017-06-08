<?php 
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Facebook</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style type="text/css">
        .login-title {
            text-align: center;
            color: darkslateblue;
        }
        button {
            float: right;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>  
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="login-title">
                    <h3>Register</h3>
                </div>
                <form class="form-horizontal" action="process.php" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="surname">Surname</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="surname" placeholder="Surname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="email">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div><br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="password">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary">Register</button>
                </form>
                <?php if(isset($_SESSION['reg_error'])) {
                    echo "<div class='row error'>". $_SESSION['reg_error']."</div>";
                unset($_SESSION['reg_error']);
                }?>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="login-title">
                    <h3>Login</h3>
                </div>
                <form class="form-horizontal" action="process.php" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="email">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Surname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="password">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Log In</button>
                </form>
                <?php if(isset($_SESSION['loginerror'])) {
                    echo "<div class='row error'>". $_SESSION['loginerror']."</div>";
                unset($_SESSION['loginerror']);
                } ?>
            </div>
        </div>
    </div>
</body>
</html>


