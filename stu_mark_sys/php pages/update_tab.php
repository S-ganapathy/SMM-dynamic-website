<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['col']) && isset($_GET['val']) && isset($_GET['user'])) {
        $uname = $_GET['user'];
        $column=$_GET['col'];

        if($column == 'password'){
            $new=$_GET['val'];
            $newval=hash('sha512',$new);
            
        }else{
            $newval=$_GET['val'];
        }

        echo $uname,$column,$newval;


        // data base connection
        $dsn = "mysql:host=localhost;dbname=temp";
        $dbusername = "root";
        $dbpsswd = "";

        // connect to database
        try {
            $pdo = new PDO($dsn, $dbusername, $dbpsswd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("connection failed" . $e->getMessage());
        }

        // query
        try {
            $query = "update users_table set ".$column."= ? where user_name= ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$newval,$uname]);
           
        } catch (Exception $e) {
            die("query failed" . $e->getMessage());
        }
    }
}
?>