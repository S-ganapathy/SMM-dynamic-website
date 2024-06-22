<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['s'])) {
        $std = $_POST['s'];
        //    echo "inside the get record"."std:  ".$std;
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
            echo "no connectivity";
        }

        // retrive data

        try {
            $query = "SELECT DISTINCT(batch) as years from students_marks where std= ? ORDER BY batch ASC";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$std]);
            $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // echo "result".$result1['years'];
        } catch (Exception $e) {
            die("query failed" . $e->getMessage());
            echo "no query";
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
    <div id="batch_div">
        <div id="title_close">
            <h4>Batch</h4>
            <input type="button" class="btn btn-warning" value="CLOSE" onclick="batch_close()"/>
        </div>
    <?php
    if ($result1) {
        foreach ($result1 as $row) {
    ?>
            <div class="batch_year" id=<?php echo $row['years']; ?> onclick="view_record(this,<?php echo $std; ?>)"> <?php echo $row['years']; ?></div>
    <?php
        }
    } else {
        echo "no data";
    }
    ?>
    </div>
    <script src="../other pages/page_1.js"></script>
    <script src="../other pages/bootstrap.bundle.min.js"></script>
</body>

</html>