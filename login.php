<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "Task1";
$connection = mysqli_connect($host, $user, $password, $dbname);

if (isset($_POST['login'])) {
    $name = $_POST['userName'];
    $pass = $_POST['userPass'];
    $login = "SELECT * FROM amins WHERE userName = '$name' and `password` = '$pass'";
    $l = mysqli_query($connection, $login);
    $count = mysqli_num_rows($l);
    if ($count == 1) {
        $_SESSION['admin'] = $name;
        echo "<p style='color: lightBLUE;'>" . "HELLO $name!" . "</p>";
    } else {
        echo "<p style='color:red;'>" . "Try Again $name!" . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>

<body style="background-color: black ;">
    <div class="container col-6">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group"> <label>user name</label> <input type="text" name="userName">
                    </div>
                    <div class="form-group"> <label>password</label> <input type="password" name="userPass">
                    </div>
                    <div class="form-group"> <input class="btn btn-primary" type="submit" name="login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>