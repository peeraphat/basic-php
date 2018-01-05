<?php 
    session_start();
?>
<!-- <script src="libs/bt4/js/bootstrap.min.js"></script>
<script src="libs/js/jquery-3.2.1.min.js"></script>
<script src="libs/js/popper.js"></script> -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<?php
    require_once('config/database.php');
    if(isset($_SESSION['username'])){
        header('Location: dashboard.php');
    }
    if(isset($_GET['method'])) {
        if($_GET['method'] =="login") {
            $username = $_POST['username'];
            $password = $_POST['pwd'];
            $password = md5($password);
            $sql = "SELECT * FROM table_member Where member_username='$username'";
            $query = $dbh->query($sql);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if(!empty($result)) {
                if($password === $result["member_password"]) {
                    echo "pass";
                    $_SESSION['userId'] = $result["member_id"];
                    $_SESSION['username'] = $result["member_username"];
                    $_SESSION['role'] = $results["member_role"];
                    header('Location: dashboard.php');
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Something wrong!</div>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>Something wrong!</div>";
            }
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>
    <!-- Bootstrap core CSS -->
    <link href="libs/bt4/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="libs/style/login.css" rel="stylesheet">
  </head>
  <body>

    <div class="container">
      <form class="form-signin" method="post" action="login.php?method=login">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="pwd" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div> <!-- /container -->
  </body>
</html>
