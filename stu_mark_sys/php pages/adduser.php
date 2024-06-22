<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $username=$_POST["username"];
    $type=$_POST["type"];
    $psswd=$_POST["psswd"];
    $hs_pwd=hash('sha512',$psswd);
    echo $hs_pwd;

    // database connection
    $dsn="mysql:host=localhost;dbname=temp";
    $dbusername="root";
    $dbpsswd="";

    // connect to database
    try{
        $pdo=new PDO($dsn,$dbusername,$dbpsswd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        die("connection failed".$e->getMessage());
    }

    try{
        $query="INSERT INTO users_table VALUES (?, ?, ?)";
        $stmt=$pdo->prepare($query);
        $stmt->execute([$username,$hs_pwd,$type]);
        header("Location: admin.php");
    }catch(Exception $e){
        die("query failed".$e->getMessage());
    }


}else{
    header("Location: admin.php");
}
?>
