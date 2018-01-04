<?php
    session_start();
    require_once('config/database.php');
    if(isset($_GET['method'])) {
        if($_GET['method'] == "register") {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $password = md5($password);

            $sqlCheckUser = "SELECT COUNT(member_username) FROM table_member WHERE member_username='$username'";
            $resCheckUser = $dbh->query($sqlCheckUser);
            $countCheckUser = $resCheckUser->fetchColumn();
            if($countCheckUser == 0) {
                $sql = "INSERT INTO table_member (member_username, member_password, member_name, member_lastName, member_email, member_gender) Values ('$username', '$password', '$name', '$lastName', '$email', '$gender')";
                $result = $dbh->exec($sql);
                if($result) {
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = '1';
                    header('Location: dashboard.php');
                } else {
                    echo "some thing error";
                }
            } else {
                echo "Sorry!, This username is exist.";
                echo "<br />";
                echo "<a href='javascript:history.go(-1)'>Back</a>";
                exit();
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
        <input type="text" name="username" placeholder="username" id="username"> <br />
        <input type="password" name="password" placeholder="password" id="password"> <br />
        <input type="text" name="name" placeholder="name" id="name"> <br />
        <input type="text" name="lastName" placeholder="lastName" id="lastName"> <br />
        <input type="text" name="email" placeholder="email" id="email"> <br />
        <input type="radio" name="gender" placeholder="gender" id="gender" value="m"> Male
        <input type="radio" name="gender" placeholder="gender" id="gender" value="f"> Female
        <br />
        <input type="submit" value="Submit">
    </form>
</body>
</html>