<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
        exit();
    }
?>
<h1>Home page</h1>
<h2>Hello, <?php echo $_SESSION['username']; ?></h2>
<p><a href="logout.php">logout</a></p>