<?php 
    $user = "root";
    $password = "";

    try{
        $dbh = new PDO('mysql:host=localhost;dbname=my_app', $user, $password,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
                    );
        // foreach($dbh->query('SELECT * From table_member') as $row) {
        //     print_r($row);
        // }
    } catch (PDOException $e) {
        echo "Error!; ". $e->getMessage() . "<br />";
        die();
    }
    
?>