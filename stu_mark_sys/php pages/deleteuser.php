<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['user'])) {
        $uname = $_GET['user'];

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
        // query 1 counts of number of staffs in the school // result1
        try {
            $query = "DELETE FROM users_table WHERE user_name= ? ";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$uname]);
            
        } catch (Exception $e) {
            die("query failed" . $e->getMessage());
        }
    }
}else{
    echo 'not sucessful';
}
