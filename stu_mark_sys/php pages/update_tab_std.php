<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['col']) && isset($_GET['val']) && isset($_GET['reg'])) {
        $reg_no = $_GET['reg'];
        $column=$_GET['col'];
        $newval=$_GET['val'];
        
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
            $query = "update students_marks set ".$column."= ? where reg_no = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$newval,$reg_no]);
           
        } catch (Exception $e) {
            die("query failed" . $e->getMessage());
        }
    }
}
?>