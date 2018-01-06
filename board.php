<?php 
    session_start();
    require_once('config/database.php');
    if(isset($_GET['id'])) {
        if($_GET['id'] != '') {
            $boardId = $_GET['id'];
            //// QUERY CONTENT OF BOARD.
            $sqlBoard = "SELECT * FROM table_board Where board_id=$boardId";
            $queryBoard = $dbh->query($sqlBoard);
            $resultBoard = $queryBoard->fetch(PDO::FETCH_ASSOC);

            //// QUERY COMMENT
            // $sqlQueryComment = "SELECT * FROM table_comment WHERE comment_board_id=$boardId";
            $sqlQueryComment = "SELECT * FROM table_comment INNER JOIN table_member ON table_comment.comment_member_id=table_member.member_id WHERE table_comment.comment_board_id=$boardId ORDER BY table_comment.comment_date DESC";
            $queryComment = $dbh->query($sqlQueryComment);
            $resultsComment = $queryComment->fetchAll(PDO::FETCH_ASSOC);

        } else {
            header('Location: index.php');
            exit();
        }
    } else {
        header('Location: index.php');
        exit();
    }

    if(isset($_GET['action'])) {
        if($_GET['action']=='comment') {
            $comment = $_POST['comment'];
            $comment = addslashes($comment);
            $userId = $_SESSION['userId'];
            $sqlInsertComment = "INSERT INTO table_comment (comment_content, comment_board_id, comment_member_id) VALUES ('$comment', '$boardId', '$userId')";
            $insertComment = $dbh->exec($sqlInsertComment);
            if($insertComment) {
                echo "Success.";
                echo "<meta http-equiv='refresh' content='1;url=board.php?id=$boardId'>";
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
    <h1>Board</h1>
    <h2><?php echo $resultBoard["board_topic"] ?></h2>
    <p>
        <?php echo $resultBoard["board_content"]; ?>
    </p>

    <hr>
    <h2>Comment.</h2>
    <?php foreach($resultsComment as $key => $comment): ?>
        <h3><?php echo $comment["member_username"]; ?></h3>
        <i><?php echo $comment["comment_date"]; ?></i>
        <p><?php echo $comment["comment_content"]; ?></p>
        <hr>
    <?php endforeach; ?>
    <hr>
    <?php if(isset($_SESSION['username'])): ?>
    <form action="board.php?id=<?php echo $boardId; ?>&action=comment" method="post">
        <textarea name="comment" id="comment" cols="30" rows="10"></textarea><br/>
        <input type="submit" value="Comment">
    </form>
    <?php else: ?>
        Please, <a href="login.php">Login</a>
    <?php endif; ?>
</body>
</html>