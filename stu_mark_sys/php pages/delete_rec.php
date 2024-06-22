<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['reg'])) {
        $reg = $_GET['reg'];

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
            $query = "DELETE FROM students_marks WHERE reg_no= ? ";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$reg]);
            
        } catch (Exception $e) {
            die("query failed" . $e->getMessage());
        }
    }
}else{
    echo 'not sucessful';
}
