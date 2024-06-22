<?php


if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    session_start();
    // if the user properly redirected to this page
    $username=$_POST["username"];
    $psswd=$_POST["psswd"];
    $hs_pwd=hash('sha512',$psswd);

    // data base connection
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

    // retrive from mysql databasse

    try{
        $query="SELECT CASE WHEN EXISTS (SELECT 1 FROM users_table WHERE user_name = ? AND password = ?) THEN 1 ELSE 0 END AS result";
        $stmt=$pdo->prepare($query);
        $stmt->execute([$username,$hs_pwd]);

        $user=$stmt->fetch(PDO::FETCH_ASSOC);
        if($user){
            if ($user['result']==1){
                $_SESSION["username"]=$username;
                //check the user is admin or staff
                $query="SELECT designation FROM users_table WHERE user_name = ? AND password = ?";
                $stmt=$pdo->prepare($query);
                $stmt->execute([$username,$hs_pwd]);
                $user=$stmt->fetch(PDO::FETCH_ASSOC);

                if($user){
                    if($user["designation"]=='admin'){
                        header("Location: ../php pages/admin.php");
                    }elseif($user["designation"]=='staff'){
                        header("Location: ../php pages/page_1.php");
                    }
                }
   
            }else{
                header("Location: ../index.php?msg=failed");
            }
        }else{
            echo "something wrong";
        }

    }catch(Exception $e){
        die("query failed".$e->getMessage());
    }


    
}else{
    // if the user acess the page without submit
    header("Location: ../index.php");
}
?>