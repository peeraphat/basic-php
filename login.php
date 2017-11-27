<?php 
    session_start();
    require_once('config/database.php');
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
                    $_SESSION['username'] = $result["member_username"];
                    $_SESSION['role'] = $results["member_role"];
                    header('Location: home.php');
                } else {
                    echo "wrong!";
                }
            } else {
                echo 'false';
            }
        }
    }
?>
<h1>Login page.</h1>
<form method="post" action="login.php?method=login">
    <input type="text" name="username" id="username">
    <input type="password" name="pwd" id="pwd">
    <input type="submit" value="Login">
</form>