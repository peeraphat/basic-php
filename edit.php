<?php 
    require_once('config/database.php');
    $boardId = $_GET['id'];
    if(isset($_GET['action'])) {
        if($_GET['action'] == 'edit') {
            //// GET BOARD.
            $sqlQueryBoard = "SELECT * FROM table_board WHERE board_id=$boardId";
            $queryBoard = $dbh->query($sqlQueryBoard);
            $resultBoard = $queryBoard->fetch(PDO::FETCH_ASSOC);
        }
        if($_GET['action'] == 'update') {
            $topic = $_POST['topic'];
            $content = $_POST['content'];
            $topic = addslashes($topic);
            $content = addslashes($content);

            $sqlUpdateBoard = "UPDATE table_board SET board_topic='$topic', board_content='$content' WHERE board_id=$boardId";
            $execUpdateBoard = $dbh->exec($sqlUpdateBoard);
            if($sqlUpdateBoard) {
                echo "updated.";
                echo "<meta http-equiv='refresh' content='1;url=dashboard.php'>";
                exit();
            } else {
                echo "Sorry, Something error.";
                echo "<br />";
                echo "<a href='javascript:history.back()'>back</a>";
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
    <h1>Edit Board.</h1>
    <form action="edit.php?action=update&id=<?php echo $boardId; ?>" method="post">
        Topic: <input type="text" name="topic" id="topic" value="<?php echo $resultBoard['board_topic']; ?>"> <br />
        Content: <textarea name="content" id="content" cols="30" rows="10"><?php echo $resultBoard['board_content']; ?></textarea><br />
        <input type="submit" value="Submit">
    </form>
</body>
</html>