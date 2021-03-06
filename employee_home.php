<?php
// Start the session
session_start();
if ($_SESSION['role'] == "CUSTOMER"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/logout.php");}
if ($_SESSION['role'] == "OWNER"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/logout.php");}

include_once("./library.php"); // To connect to the database
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection
if (mysqli_connect_errno())
 {
echo "Failed to connect to MySQL: " .
mysqli_connect_error();
 }
$user = $_SESSION['a_id'];
$sql = "SELECT * FROM Employees WHERE ACCOUNT_ID = '$user'";
if (!mysqli_query($con,$sql))
 {
 die('Error: ' . mysqli_error($con));
 }
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);
if ($count == 1){
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['e_id'] = $row["EMPLOYEE_ID"];
    }
}
else{
echo "An issue occured in the sign in process.";
echo "<br>";
echo "<a href='http://www.cs.virginia.edu/~jme3tp/db_project/sign_in.html'>Try Again</a>";
}
//mysqli_free_result($result);
?>

<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-dark bg-primary d-flex justify-content-between">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="http://www.cs.virginia.edu/~jme3tp/db_project/flower.jpg" width="30" height="30" style="border-radius: 4px;" alt="Home">
            </a>
            <div class="dropdown-menu" align="right">
               <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/employee_home.php">Home</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/employee_view_stores.php">Store Hours</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/employee_view_stock.php">Stock Information</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/employee_view_reviews.php">Item Reviews</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/employee_view_shifts.php"> My Shifts</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/employee_make_transactions.php">Make a Transaction</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/logout.php">Logout</a>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-sm-10">
        <h1 align="center"> Hi &nbsp; <?php echo $_SESSION['username']; ?></h1>
        <a class="btn btn-block btn-primary" href="http://www.cs.virginia.edu/~jme3tp/db_project/employee_view_shifts.php"> My Shifts </a>
        <a class="btn btn-block btn-primary" href="http://www.cs.virginia.edu/~jme3tp/db_project/employee_make_transactions.php"> Make a Transaction </a>
    </div>
    </div>
</body>
</html>