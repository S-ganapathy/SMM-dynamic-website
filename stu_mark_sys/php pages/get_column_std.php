<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['reg'])) {
        $reg_no = $_POST['reg'];

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
            $query = "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = 'students_marks' LIMIT 1,10;";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("query failed" . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../other pages/bootstrap.min.css">
    <link rel="stylesheet" href="../other pages/all.css">
    <link rel="stylesheet" href="/other pages/custom.css">
</head>

<body>
    <?php
    if ($result1) {
    ?>
    <h3 class="text-center">Choose column Need to be updated</h3>
        <div id="update_col">
            <?php
            foreach ($result1 as $row) {
            ?>
                <div><input type="button" class="btn btn-primary" id=<?php echo $reg_no; ?> value=<?php echo $row['column_name']; ?> onclick="update_qry(this)" /></div>
            <?php
            }
            ?>
            <input type="button" value="CANCEL" class="btn btn-warning" onclick="hide_up_q()" />
        </div>
    <?php
    }
    ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../other pages/page_1.js"></script>
    <script src="../other pages/bootstrap.bundle.min.js"></script>
</body>

</html>