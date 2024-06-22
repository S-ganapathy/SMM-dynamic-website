<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location: ../index.php");
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['std']) && isset($_GET['yr'])) {
        $s1 = $_GET['std'];
        $s2 = $_GET['yr'];
        // echo "hello".$s1,$s2 ;


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
        // query to fetch data 
        try {
            $query = "SELECT reg_no, roll_no, name, (sub1+sub2+sub3+sub4+sub5) as total, Round(((sub1+sub2+sub3+sub4+sub5)/5),2) as percentage,CASE WHEN sub1 and sub2 and sub3 and sub4 and sub5 >=35 THEN 'PASS' ELSE 'FAIL' END as result from students_marks where batch= ? and std= ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$s2, $s1]);
            $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("query failed" . $e->getMessage());
        }

        // query to fetch data for class dropdown 
        try {
            $query = "SELECT DISTINCT(std) as std from students_marks ORDER by std ASC";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("query failed" . $e->getMessage());
        }

        // query to fetch data for batch dropdown 
        try {
            $query = "SELECT DISTINCT(batch) as batch from students_marks ORDER by batch ASC";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("query failed" . $e->getMessage());
        }

        // query 4 counts of number of students in the school // result4
        try {
            $query = "SELECT count(*) as count from students_marks where batch= ? and std= ? ";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$s2, $s1]);
            $result4 = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("query failed" . $e->getMessage());
        }

        // query 5 counts of number of students in the school // result5
        try {
            $query = "SELECT count(*) as count from students_marks where batch= ? and std= ? and gender='male'";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$s2, $s1]);
            $result5 = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("query failed" . $e->getMessage());
        }

         // query 6 counts of number of students in the school // result 6
         try {
            $query = "SELECT count(*) as count from students_marks where batch= ? and std= ? and gender='female'";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$s2, $s1]);
            $result6 = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("query failed" . $e->getMessage());
        }

         // query 7 counts of number of students in the school // result 7
         try {
            $query = "SELECT Round((passcount/count)*100 ,2) as passpercent  from (SELECT COUNT(*) as count, COUNT(CASE WHEN sub1 and sub2 and sub3 and sub4 and sub5 >=35 THEN 'PASS' END) as passcount from students_marks where batch= ? and std= ? ) as cast";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$s2, $s1]);
            $result7 = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("query failed" . $e->getMessage());
        }

        $inc = 0;

        // display the record fetched

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
            <div id="darkbg">
                <div class="container min-vh-100">
                    <div class="row  mt-5">
                        <div class="col-md-8">
                            <h1><?php echo $s1 . " STD " . $s2; ?></h1>
                        </div>
                        <div class="col-sm-4 d-flex justify-content-end align-items-center gap-4">
                            <div class="text-success"><?php echo $_SESSION["username"]; ?></div>
                            <button class="btn" onclick="logout()">log out</button>
                            <button class="btn" onclick="window.history.back()">Back</button>
                        </div>
                    </div>

                    <div class="row mt-5" id="dash_div">
                        <div class="col-md-3">
                            <div class="border border-dark rounded d-flex justify-content-center align-items-center">No.student : <?php echo $result4['count']; ?></div>
                        </div>
                        <div class="col-md-3">
                            <div class="border border-dark rounded d-flex justify-content-center align-items-center">No.boys : <?php echo $result5['count']; ?></div>
                        </div>
                        <div class="col-md-3">
                            <div class="border border-dark rounded d-flex justify-content-center align-items-center">No.girls : <?php echo $result6['count']; ?></div>
                        </div>
                        <div class="col-md-3">
                            <div class="border border-dark rounded d-flex justify-content-center align-items-center">pass percentage : <?php echo $result7['passpercent']; ?>%</div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center align-items-center gap-3 mt-5">
                        <div class="col-md-3 col-xs-2 d-flex justify-content-center align-items-center">
                            <label for="class">class: </label>
                            <select id="class" class="form-control">
                                <?php
                                foreach ($result2 as $row) {
                                ?>
                                    <option value="<?php echo $row['std']; ?>"><?php echo $row['std']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 col-xs-2 d-flex justify-content-center align-items-center">
                            <label for="batch">Year: </label>
                            <select id="batch" class="form-control">
                                <?php
                                foreach ($result3 as $row) {
                                ?>
                                    <option value="<?php echo $row['batch']; ?>"><?php echo $row['batch']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 col-xs-2 d-flex justify-content-start align-items-center">
                            <input type="button" value="choose" onclick="filter_value()" class="btn btn-success" />
                        </div>
                    </div>

                    <div class="row justify-content-center mt-5">
                        <div class="col-md-10">
                            <div id="record_table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Reg No</th>
                                            <th>Roll No</th>
                                            <th>Name</th>
                                            <th>Total</th>
                                            <th>Percentage</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($result1 as $row) {
                                            $inc = $inc + 1;
                                        ?>
                                            <tr>
                                                <td><?php echo $inc; ?></td>
                                                <td><?php echo $row['reg_no']; ?></td>
                                                <td><?php echo $row['roll_no']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['total']; ?></td>
                                                <td><?php echo $row['percentage'] . "%"; ?></td>
                                                <td><?php echo $row['result']; ?></td>
                                                <td><input type="button" value="update" id=<?php echo $row['reg_no']; ?> onclick="update_rec(this)" class="btn btn-success" /></td>
                                                <td><input type="button" value="Delete" id=<?php echo $row['reg_no']; ?> onclick="delete_rec(this)" class="btn btn-danger" /></td>
                                            </tr>

                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="update_col_div"></div>

            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="../other pages/page_1.js"></script>
            <script src="../other pages/bootstrap.bundle.min.js"></script>
            <script src="../other pages/sweetalert.min.js"></script>
        </body>

        </html>

<?php
    }
}

?>