<?php
    session_start();
    require_once('config/database.php');
    if(isset($_GET['method'])) {
        if($_GET['method'] == "register") {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password = md5($password);

            $sql = "INSERT INTO table_member (member_username, member_password) Values ('$username', '$password')";
            $result = $dbh->exec($sql);
            if($result) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = '1';
                header('Location: home.php');
            } else {
                echo "some thing error";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <h1>Register page.</h1>
    <form action="register.php?method=register" method="post">
        <input type="text" name="username" id="username">
        <input type="password" name="password" id="password">
        <input type="submit" value="Submit">
    </form>
</body>
</html>