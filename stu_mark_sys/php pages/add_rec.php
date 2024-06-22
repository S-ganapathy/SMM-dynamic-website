<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reg = $_POST['reg_no'];
    $roll = $_POST['roll_no'];
    $name = $_POST['name'];
    $yr=date("Y");
    echo $yr;
    $std = $_POST['std'];
    $sub1 = $_POST['sub1'];
    $sub2 = $_POST['sub2'];
    $sub3 = $_POST['sub3'];
    $sub4 = $_POST['sub4'];
    $sub5 = $_POST['sub5'];
    $gender=$_POST['gen'];


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


    // insert in to the database
    
    try {
        $query = "insert into students_marks values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$reg,$roll,$name,$yr,$std,$sub1,$sub2,$sub3,$sub4,$sub5,$gender]);
        $result1 = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result1){

            header("location: ../php pages/page_1.php?msg=sucess");
        }
        else{
            header("location: ../php pages/page_1.php?msg=failed");
        }
    } catch (Exception $e) {
        die("query failed" . $e->getMessage());
    }
} else {
    header('location: ../php pages/page_1.php');
}
