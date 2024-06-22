<?php
session_start();
if (!isset($_SESSION["username"])) {
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

// query 1 counts of number of students in the school // result1
try {
    $query = "SELECT count(*) as count from students_marks";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result1 = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("query failed" . $e->getMessage());
}

// query 2 counts of number of male students in the school // result2
try {
    $query = "SELECT count(*) as count from students_marks where gender='male'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("query failed" . $e->getMessage());
}

// query 3 counts of number of male students in the school // result3
try {
    $query = "SELECT count(*) as count from students_marks where gender='female'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result3 = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("query failed" . $e->getMessage());
}

// query 4 students pass percentage in the school // result4
try {
    $query = "SELECT Round((passcount/count)*100 ,2) as passpercent  from (SELECT COUNT(*) as count, COUNT(CASE WHEN sub1 and sub2 and sub3 and sub4 and sub5 >=35 THEN 'PASS' END) as passcount from students_marks) as cast";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result4 = $stmt->fetch(PDO::FETCH_ASSOC);
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
            <div class="row mt-5">
                <div class="col-md-8">
                    <h1>welcome page</h1>
                </div>
                <div class="col-sm-4 d-flex justify-content-end align-items-center gap-4">
                    <div class="text-success"><?php echo $_SESSION["username"]; ?></div>
                    <button class="btn" onclick="logout()">log out</button>
                    <button class="btn" onclick="window.history.back()">Back</button>
                </div>
            </div>

            <div class="row mt-5 d-flex justify-content-center align-items-center" id="dash_div">
                <div class="col-md-3 col-xs-2">
                    <div class="border border-dark rounded d-flex justify-content-center align-items-center">No.student : <?php echo $result1['count']; ?></div>
                </div>
                <div class="col-md-3 col-xs-2">
                    <div class="border border-dark rounded d-flex justify-content-center align-items-center">No.boys : <?php echo $result2['count']; ?></div>
                </div>
                <div class="col-md-3 col-xs-2">
                    <div class="border border-dark rounded d-flex justify-content-center align-items-center">No.girls : <?php echo $result3['count']; ?></div>
                </div>
                <div class="col-md-3 col-xs-2">
                    <div class="border border-dark rounded d-flex justify-content-center align-items-center">pass percentage : <?php echo $result4['passpercent']; ?>%</div>
                </div>
            </div>
            <div class="row  justify-content-center mt-5">
                <div class="col-md-12" id="class_table">
                    <table class="table" id="table_class">
                        <tbody>
                            <tr>
                                <td class="text-center">X</td>
                                <td class="text-center"> <input type="button" value="view marks" id='10' onclick="show_batch(this)" /></td>
                                <td class="text-center"><input type="button" value="add_record" id='10' onclick="add_record(this)" /></td>
                                <td class="text-center"> <input type="button" value="update addentence" /></td>
                            </tr>


                            <tr>
                                <td class="text-center">XI</td>
                                <td class="text-center"> <input type="button" value="view marks" id='11' onclick="show_batch(this)" /></td>
                                <td class="text-center"><input type="button" value="add_record" id='11' onclick="add_record(this)" /></td>
                                <td class="text-center"><input type="button" value="update addentence" /></td>
                            </tr>

                            <tr>
                                <td class="text-center">XII</td>
                                <td class="text-center"> <input type="button" value="view marks" id='12' onclick="show_batch(this)" /></td>
                                <td class="text-center"> <input type="button" value="add_record" id='12' onclick="add_record(this)" /></td>
                                <td class="text-center"> <input type="button" value="update addentence" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


    <div id="show_batch">
    </div>

    <div class="container" id="addrecform">
        <form id="add_rec_form" name="addstdrec" action="add_rec.php" method="post">
            <div class="row justify-content-center mt-4">
                <div class="col-md-8 text-center">
                    <h3>Enter Student Mark</h3>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-md-6">
                    <input type='number' placeholder="Reg NO" name="reg_no" class="form-control" />
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-md-6">
                    <input type='number' placeholder="Roll NO" name="roll_no" class="form-control" />
                </div>
            </div>
            <div class=" row justify-content-center mt-2">
                <div class="col-md-6">
                    <input type='text' placeholder="Name" name="name" class="form-control" />
                </div>
            </div>
            <div class=" row justify-content-center mt-2">
                <div class="col-md-6">
                    <input type="number" placeholder="class" name='std' id='std' class="form-control" />
                </div>
            </div>
            <div class=" row justify-content-center mt-2">
                <div class="col-md-6">
                    <input type='number' placeholder="sub" name="sub1" class="form-control" />
                </div>
            </div>
            <div class=" row justify-content-center mt-2">
                <div class="col-md-6">
                    <input type='number' placeholder="sub" name="sub2" class="form-control" />
                </div>
            </div>
            <div class=" row justify-content-center mt-2">
                <div class="col-md-6">
                    <input type='number' placeholder="sub" name="sub3" class="form-control" />
                </div>
            </div>
            <div class=" row justify-content-center mt-2">
                <div class="col-md-6">
                    <input type='number' placeholder="sub" name="sub4" class="form-control" />
                </div>
            </div>
            <div class=" row justify-content-center mt-2">
                <div class="col-md-6">
                    <input type='number' placeholder="sub" name="sub5" class="form-control" />
                </div>
            </div>
            <div class=" row justify-content-center mt-2">
                <div class="col-md-6">
                    <input type='text' placeholder="gender" name="gen" class="form-control" />
                </div>
            </div>

            <div class=" row justify-content-center mt-2" id="page_btns">
                <div class="col-md-2 col-xs-1 text-center">
                    <input type="button" value="clear" onclick="emptyform()" class="btn btn-secondary" />
                </div>
                <div class="col-md-2 col-xs-1 text-center">
                    <input type="button" value="submit" class="btn btn-success" onclick="insert()" />
                </div>
                <div class="col-md-2 col-xs-1 text-center">
                    <input type="button" value="close" onclick="closeform()" class="btn btn-warning" />
                </div>

        </form>
    </div>
    <script>
        function check(value) {
            if (value == "") {
                return false;
            } else {
                return true;
            }
        }

        function insert() {
            let reg = document.forms["addstdrec"]["reg_no"].value;
            let roll = document.forms["addstdrec"]["roll_no"].value;
            let nam = document.forms["addstdrec"]["name"].value;
            let clas = document.forms["addstdrec"]["std"].value;
            let s1 = document.forms["addstdrec"]["sub1"].value;
            let s2 = document.forms["addstdrec"]["sub2"].value;
            let s3 = document.forms["addstdrec"]["sub3"].value;
            let s4 = document.forms["addstdrec"]["sub4"].value;
            let s5 = document.forms["addstdrec"]["sub5"].value;
            let valid = false;


            valid = check(reg) && check(roll) && check(nam) && check(clas) && check(s1) && check(s2) && check(s3) && check(s4) && check(s5);

            if (valid) {
                swal({
                        title: "Are you sure?",
                        text: " To Add a new record!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            document.forms["addstdrec"].submit();
                            swal("Poof! Record Added", {
                                icon: "success",
                            });
                        } else {
                            swal("Something Went worng Please Check!");
                        }
                    });

                // alert("fine");
            } else {
                alert("Fields missing");
            }

        }
    </script>

    <script src="../other pages/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../other pages/page_1.js"></script>
    <script src="../other pages/sweetalert.min.js"></script>


</body>

</html>