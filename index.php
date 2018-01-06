<?php 
    session_start();
    require_once('config/database.php');
    $sqlGetTopic = "SELECT * From table_board INNER JOIN table_member On table_board.board_member_id=table_member.member_id ORDER BY table_board.board_date DESC";
    $queryGetTopic = $dbh->query($sqlGetTopic);
    $resultsGetTopic = $queryGetTopic->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>Home page</h1>
    <h3>welcome to my site</h3>
    <p>
        <?php if(isset($_SESSION['username'])): ?>
            <a href="dashBoard.php">Dashboard</a> |
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a> | <a href="register.php">Register</a>
        <?php endif; ?>
    </p>
    <table border='1'>
        <tr>
            <th>#</th>
            <th>Topic</th>
            <th>Date</th>
            <th>author</th>
        </tr>
        <?php foreach($resultsGetTopic as $key => $value) { ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><a href="board.php?id=<?php echo $value["board_id"]; ?>"><?php echo $value["board_topic"]; ?></a></td>
            <td><?php echo $value["board_date"]; ?></td>
            <td><?php echo $value["member_name"]; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>