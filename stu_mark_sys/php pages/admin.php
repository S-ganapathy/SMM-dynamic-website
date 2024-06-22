<?php
session_start();
if(!isset($_SESSION["username"])){
    header("location: ../index.php");
    die();
}
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
    $query = "SELECT count(*) as count from users_table";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result1 = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("query failed" . $e->getMessage());
}

// query 2 number of staff in the school //result2
try {
    $query = "SELECT * from users_table";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("query failed" . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S M M</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">
    <link rel="stylesheet" href="../other pages/bootstrap.min.css">
    <link rel="stylesheet" href="../other pages/all.css">
    <link rel="stylesheet" href="/other pages/custom.css">
</head>

<body>
    <div id=bgdark>
        <div class="container min-vh-100">
            <div class="row mt-4">
                <div class="col-sm-8  col-xs-12 ">
                    <h1> welcome Administator</h1>
                </div>
                <div class="col-sm-4 d-flex justify-content-center align-items-center gap-4">
                    <div class="text-success"><?php echo $_SESSION["username"]; ?></div>
                    <button class="btn" onclick="logout()">log out</button>
                </div>
            </div>
            <div class="row mt-5 d-flex justify-content-center align-items-center gap-4">
                <div class="col-md-3">
                    <div onclick="recordvisible()" class="border border-dark rounded d-flex justify-content-center align-items-center"> <?php echo "USERS : " . $result1['count']; ?> </div>
                </div>

                <div class="col-md-3">
                    <div onclick="makevisible()" class="border border-dark rounded d-flex justify-content-center align-items-center"> ADD USERS </div>
                </div>
                <div class="col-md-3">
                    <div onclick="location.href='page_1.php';" class="border border-dark rounded d-flex justify-content-center align-items-center"> STUDENTS PROGRESS </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container  rounded" id="adduserformid">

        <form method="post" name="adduser" action="adduser.php" id="adduserform">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-12 col-xs-12 text-center text-">
                    <h2>Enter The Details To Add New User</h2>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-4">
                <div class="col-md-6 col-xs-12 ">
                    <input type="text" placeholder="user name" name="username" class="form-control" /><span class="text-danger" id="error1"></span>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-2">
                <div class="col-md-6 col-xs-12 ">
                    <input type="email" placeholder="email" name="email" class="form-control" /><span class="text-danger" id="error2"></span>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-2">
                <div class="col-md-6 col-xs-12 ">
                    <input type="text" placeholder="admin/staff" name="type" class="form-control" /><span class="text-danger" id="error3"></span>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-2">
                <div class="col-md-6 col-xs-12 ">
                    <input type="password" placeholder="new password" name="psswd1" class="form-control" />
                </div>
            </div>
            <div class="row justify-content-center align-items-center mt-2">
                <div class="col-md-6 col-xs-12 ">
                    <input type="password" placeholder="Renter the password" name="psswd" class="form-control" /><span class="text-danger" id="error4"></span>
                </div>
            </div>
            <div class="row  d-flex justify-content-center align-items-center mt-4 gap-3">
                <div class="col-md-2 col-xs-2 text-center">
                    <input type="button" value="ADD" onclick="validate_submit()" class="btn btn-success" style="width: 83px;" />
                </div>
                <div class="col-md-2 col-xs-2 text-center">
                    <input type="button" value="CANCEL" onclick="notvisible()" class="btn btn-warning" />
                </div>
            </div>
        </form>

    </div>

    <div id="user_records">

    </div>
    <!-- to show the which column we should update -->
    <div id="update_question">
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../other pages/admin.js"></script>
    <script src="../other pages/bootstrap.bundle.min.js"></script>
    <script src="../other pages/sweetalert.min.js"></script>
</body>

</html>