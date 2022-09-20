<?php
/*
    1-Connection -> DONEEEEE!
    2-Create
    3-Read
    4-Update
    5-Delete
*/

//Connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "Task1";
$connection = mysqli_connect($host, $user, $password, $dbname);

//Create
if (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
    $city = $_POST['city'];
    $department = $_POST['department'];
    $insert = "INSERT INTO employees(`name`, email, salary, city, departmentID) VALUES('$name', '$email', $salary, '$city', $department)";
    mysqli_query($connection, $insert);
    header("location: index.php?#return");
}

//Read from employees
$select = "SELECT * FROM employees";
$employees = mysqli_query($connection, $select);

//Read from departments
$select = "SELECT * FROM departments";
$departments = mysqli_query($connection, $select);

//Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = "DELETE FROM employees WHERE ID = $id";
    mysqli_query($connection, $delete);
    header("location: index.php?#return");
}


//Update
$name = "";
$email = "";
$salary = NULL;
$city = "";
$update = false;

if (isset($_GET['edit'])) {
    $update = true;
    $id = $_GET['edit'];
    $select = "SELECT * FROM employees WHERE id = $id";
    $employee = mysqli_query($connection, $select);
    $row = mysqli_fetch_assoc($employee);
    $name = $row['name'];
    $email = $row['email'];
    $salary = $row['salary'];
    $city = $row['city'];

    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $salary = $_POST['salary'];
        $city = $_POST['city'];
        $department = $_POST['department'];
        $update = "UPDATE employees SET ID = $id, `name` = '$name', email = '$email', salary = $salary, city='$city', departmentID = $department WHERE ID = $id";
        mysqli_query($connection, $update);
        header("location: index.php?#return");
    }
}

if (isset($_GET['searchName'])) {
    $searchName = $_GET['searchName'];
    $select = "SELECT * FROM employees WHERE `name` LIKE '%$searchName%'";
    $selectName = mysqli_query($connection, $select);
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
    <link rel="stylesheet" href="./style.css">
    <title>Task1</title>
</head>

<body>
    <div class="container col-6">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="<?= $name ?>" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" value="<?= $email ?>" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <input type="number" class="form-control" value="<?= $salary ?>" name="salary" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" value="<?= $city ?>" name="city" required>
                    </div>
                    <div class="form-row align-items-center">
                        <div class="col-auto my-1">
                            <label for="department">Employee's department</label>
                            <select class="custom-select mr-sm-2" name="department">
                                <option selected>Choose employee's department</option>
                                <?php foreach ($departments as $departmentData) : ?>
                                <option value="<?= $departmentData['ID']; ?>">
                                    <?= $departmentData['departmentName']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <?php if ($update) : ?>
                    <button type="submit" class="btn btn-info mt-2" name="update">Update Data</button>
                    <?php else : ?>
                    <button type="submit" name="insert" class="btn btn-primary mt-2">Insert Employee</button>
                    <?php endif; ?>
                </form>
                <a href="login.php"><button class="btn btn-info" name="loginn">Login</button></a>
            </div>
        </div>
    </div>
    <div class="container col-9 mt-5">
        <form method="GET">
            <input type="text" name="searchName">
            <input type="submit" name="search">
        </form>
        <table id="return" class="table table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Salary</th>
                    <th>City</th>
                    <th>DepartmentID</th>
                    <th colspan="2">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $data) : ?>
                <tr>
                    <td><?= $data['ID']; ?></td>
                    <td><?= $data['name']; ?></td>
                    <td><?= $data['email']; ?></td>
                    <td><?= $data['salary']; ?></td>
                    <td><?= $data['city']; ?></td>
                    <td><?= $data['departmentID']; ?></td>
                    <td>
                        <a href="index.php?edit=<?= $data['ID']; ?>"><button class="btn btn-primary">Edit</button></a>
                    </td>
                    <td>
                        <a href="index.php?delete=<?= $data['ID']; ?>"><button class="btn btn-danger"
                                name="delete">Remove</button></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
    </div>
    </table>
    <?php if (isset($_GET['searchName'])) : ?>
    <table>
        <?php foreach ($selectName as $data1) : ?>
        <tr>
            <td><?= $data1['ID']; ?></td>
            <td><?= $data1['name']; ?></td>
            <td><?= $data1['email']; ?></td>
            <td><?= $data1['salary']; ?></td>
            <td><?= $data1['city']; ?></td>
            <td><?= $data1['departmentID']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</body>

</html>