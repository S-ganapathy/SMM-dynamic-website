<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    try {
        $query = "SELECT * from users_table";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("query failed" . $e->getMessage());
    }
    $inc = 0;
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
        <div id="users_table_div">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">S.NO</th>
                        <th scope="col">Name</th>
                        <th scope="col">Desingation</th>
                        <th scope="col">#</th>
                        <th scope="col"><input type="button" value="CLOSE" class="btn btn-warning" onclick="hiderecord()" /></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result2 as $row) {
                        $inc = $inc + 1;
                    ?>

                        <tr>
                            <td><?php echo $inc; ?></td>
                            <td><?php echo $row['user_name']; ?></td>
                            <td><?php echo $row['designation']; ?></td>
                            <td><input type="button" value='update' class="btn btn-success" id="<?php echo $row['user_name']; ?>" onclick="get_col(this)" />
                            <td><input type="button" value='delete' class="btn btn-danger" id="<?php echo $row['user_name']; ?>" onclick="delete_user(this)" />
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
        <script src="../other pages/admin.js"></script>
        <script src="../other pages/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php
}
?>