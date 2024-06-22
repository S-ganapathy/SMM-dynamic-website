<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S M M login</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">
    <link rel="stylesheet" href="../other pages/bootstrap.min.css">
    <link rel="stylesheet" href="../other pages/all.css">
    <link rel="stylesheet" href="/other pages/custom.css">
</head>

<body>
    <div class="bg" style="background-image:url(/images/bg-school.jpg); background-size:cover; background-position: center;">
        <div class="background_div">

            <div class="container  min-vh-100 d-flex flex-column justify-content-center">
                <h2 class="text-center text-warning"> STUDENTS MARK ADMINISTRATION</h2>
                <form action="php pages/login.php" method="post" name="login">
                    <div class="row justify-content-center align-items-center mt-4">
                        <div class="col-md-4">
                            <input type="text" placeholder="username" name="username" class="form-control" /><span class="text-danger" id="error1"></span>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center mt-4">
                        <div class="col-md-4">
                            <input type="password" placeholder="password" name="psswd" class="form-control" /><span class="text-danger" id="error2"></span>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center mt-4">
                        <div class="col-md-4 d-flex justify-content-center">
                            <input type="button" class="btn btn-warning" value="login" onclick="validation()" />
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center mt-4">
                        <div class="col-md-4 d-flex justify-content-center text-danger">
                            <?php
                            if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
                                echo "wrong username and password";
                            }
                            ?>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function validation() {
            let valid = true;
            let err1 = document.getElementById('error1');
            let err2 = document.getElementById('error2');
            let x = document.forms["login"]["username"].value;
            let y = document.forms["login"]["psswd"].value.length;
            if (x == '') {
                err1.innerText = "user name is requried";
                valid = false;
            } else {
                err1.innerText = "";
            }
            if (y == "") {
                err2.innerText = "password is requried";
                valid = false;
            } else if (y < 4) {
                err2.innerText = "Minimum password length is 4";
                valid = false;
            }
            if (valid) {
                document.forms["login"].submit();
            }
        }
    </script>
    <script src="../other pages/bootstrap.bundle.min.js"></script>
</body>

<!-- 
xs (for phones - screens less than 768px wide)
sm (for tablets - screens equal to or greater than 768px wide)
md (for small laptops - screens equal to or greater than 992px wide)
lg (for laptops and desktops - screens equal to or greater than 1200px wide) -->
<!-- http://localhost:3000/php%20pages/page_1.php -->

</html>