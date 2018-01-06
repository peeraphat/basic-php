<?php
    session_start();
    require_once('config/database.php');
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
        exit();
    }
    //// QUERY OWNER BOARD
    $sqlGetBoard = "SELECT * FROM table_board WHERE board_member_id='$_SESSION[userId]'";
    $queryGetBoard = $dbh->query($sqlGetBoard);
    $resultsGetBoard = $queryGetBoard->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_GET['action'])) {
      if($_GET['action'] == 'delete'){
        $boardId = $_GET['id'];
        $sqlDeleteBoard = "DELETE FROM table_board WHERE board_id=$boardId";
        $execDeleteBoard = $dbh->exec($sqlDeleteBoard);
        if($execDeleteBoard) {
          echo 'delete success.';
          echo "<meta http-equiv='refresh' content='1;url=dashboard.php'>";
          exit();
        } else {
          echo 'Sorry, Something error';
          echo "<br/>";
          echo "<a href='javascript:history.back()'>back</a>";
          exit();
        }
      }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="libs/bt4/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="libs/style/login.css" rel="stylesheet">
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="createBoard.php">ADD</a>
            </li>
          </ul>
        </div>
      </nav>
      <section style="margin-top:20px">
      <h2>MY TOPIC.</h2>
      <table border="1">
        <tr>
          <th>#</th>
          <th>Topic</th>
          <th>Date</th>
          <th>Options</th>
        </tr>
        <?php 
          foreach ($resultsGetBoard as $key => $value) {
        ?>
          <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $value["board_topic"]; ?></td>
            <td><?php echo $value["board_date"]; ?></td>
            <td>
              <a href="edit.php?action=edit&id=<?php echo $value['board_id']; ?>">Edit</a> |
              <a href="?action=delete&id=<?php echo $value['board_id']; ?>">Delete</a>
            </td>
          </tr>
        <?php
          }
        ?>
      </table>
      </section>
    </header>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
