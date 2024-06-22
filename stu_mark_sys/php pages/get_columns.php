<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['user'])) {
        $uname = $_POST['user'];

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
            $query = "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = 'users_table' LIMIT 1,3;";
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
</head>

<body>
    <?php
    if ($result1) {
        foreach ($result1 as $row) {
    ?>
            <span><input type="button" class="btn btn-primary" id=<?php echo $uname; ?> value=<?php echo $row['column_name']; ?> onclick="update_qry(this)" /></span>
    <?php
        }
    }
    ?>
    <input type="button" value="CANCEL" class="btn btn-warning" onclick="hide_up_q()"/>
    <script src="../other pages/admin.js"></script>
</body>

</html>