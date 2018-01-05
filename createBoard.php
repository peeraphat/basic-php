<?php session_start(); ?>
<?php
    if(empty($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }
?>
<?php 
    require_once('config/database.php');
    if(isset($_GET['action'])) {
        if($_GET['action'] == 'create') {
            $topic = $_POST['topic'];
            $content = $_POST['content'];
            $userId = $_SESSION['userId'];

            $sql = "INSERT INTO table_board (board_topic, board_content, board_member_id ) VALUES ('$topic', '$content', '$userId')";
            $result = $dbh->exec($sql);
            if($result) {
                echo 'Created success.';
                // echo '<meta http-equiv="refresh" content="2;url=dashboard.php">';
                echo '<a href="javascript:location.href=\'dashboard.php\'">Home</a>';
                exit();
            } else {
                echo 'Sorry, Something error.';
                echo '<br />';
                echo '<a href="javascript:history.back()">back</a>';
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
    <title>Document</title>
</head>
<body>
    <h1>Create Board.</h1>
    <form action="createBoard.php?action=create" method="post">
        Topic: <input type="text" name="topic" id="topic"> <br />
        Content: <textarea name="content" id="content" cols="30" rows="10"></textarea><br />
        <input type="submit" value="Submit">
    </form>
</body>
</html>