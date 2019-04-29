<?php
// Start the session
session_start();
if ($_SESSION['role'] == "CUSTOMER"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/logout.php");}
if ($_SESSION['role'] == "OWNER"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/logout.php");}

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
        <h1> New Transaction</h1>
        <form action="" method="post">
            Store Number 
            <select class="form-control form-control-lg" name="store_number">
                <option> 1 </option>
                <option> 2 </option>
            </select>
            Customer ID
            <input type="number" name="customer_id" class="form-control">
            Item
            <input type="number" name="item_upc" class="form-control">
            Amount
            <input type="number" name="amount" class="form-control">
            <br>
            <input type="submit" class="btn btn-primary btn-block" name="submit_transaction">
        </form>
    </div>
</body>
</html>

<?php
  if (isset($_POST['submit_transaction'])) {
    include_once("./library.php");
    $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
    if (mysqli_connect_errno()) 
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
    $user = $_SESSION['e_id'];
    $sql = "INSERT INTO Transactions (STORE_ID, CUSTOMER_ID, EMPLOYEE_ID, ITEM_UPC, AMOUNT) VALUES ('$_POST[store_number]','$_POST[customer_id]', '$user','$_POST[item_upc]','$_POST[amount]')";

    if (!mysqli_query($con,$sql))
      {
      die('Error: ' . mysqli_error($con));
      }
    echo "1 record added";
    mysqli_close($con);
  }
?>












