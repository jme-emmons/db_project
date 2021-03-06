<?php
// Start the session
session_start();
if ($_SESSION['role'] == "CUSTOMER"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/logout.php");}
if ($_SESSION['role'] == "EMPLOYEE"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/logout.php");}

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
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/owner_home.php">Home</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/owner_view_stores.php">Store Hours</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/owner_view_stock.php">Stock Information</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/owner_view_reviews.php">Item Reviews</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/owner_view_shifts.php"> My Shifts</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/owner_make_transactions.php">Make a Transaction</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/owner_make_shipments.php"> Complete a Shipment</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/owner_change_set_shifts.php">Assign Shifts</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/owner_input_edit_stock.php"> Fix Stock</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/logout.php">Logout</a>
            </div>
    </nav>
    <div class="container">
        <h1> Edit/add Shift Hours </h1>
        <h2> Current shifts </h2>
        <?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();
        $user = $_SESSION['e_id'];
        if($stmt->prepare("SELECT * FROM Shift_Hours") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchDes'] . '%';
                $stmt->bind_param(s, $searchString);
                $stmt->execute();
                $stmt->bind_result($SHIFT_ID, $STORE_ID, $EMPLOYEE_ID, $DAY, $TIME);
                echo "<table border=1><th>Shift ID</th><th>Store ID</th><th>Employee ID</th><th>Day</th><th>Time</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$SHIFT_ID</td><td>$STORE_ID</td><td>$EMPLOYEE_ID</td><td>$DAY</td><td>$TIME</td></tr>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();
        ?>
        <h2> Add new shift </h2>
        <form action="" method="post">
            Store ID
            <input type="number" name="store_id" class="form-control">
            Employee ID
            <input type="number" name="employee_id" class="form-control">
            Day
            <input type="text" name="day" class="form-control">
            Time
            <input type="text" name="time" class="form-control">
            <br>
	    <input type="submit" class="btn btn-primary btn-block" name="submit_add">
        </form>
        <h2> Delete shift </h2>
        <form action="" method="post">
            Shift ID
            <input type="number" name="shift_id" class="form-control">
            <br>
	    <input type="submit" class="btn btn-primary btn-block" name="submit_delete">
        </form>
    </div>
</body>
</html>

<?php
    include_once("./library.php");
    $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
    if (mysqli_connect_errno())
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

    if (isset($_POST['submit_add'])) {
    $sql = "INSERT INTO Shift_Hours (STORE_ID, EMPLOYEE_ID, DAY, TIME_PERIOD) VALUES ('$_POST[store_id]','$_POST[employee_id]','$_POST[day]','$_POST[time]')"; 

    if (!mysqli_query($con,$sql))
      {
      die('Error: ' . mysqli_error($con));
      }
    echo "1 record added";
    mysqli_close($con);
    header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/owner_change_set_shifts.php");
  }
?>

<?php
    include_once("./library.php");
    $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
    if (mysqli_connect_errno())
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

    if (isset($_POST['submit_delete'])){
    $sql = "DELETE FROM Shift_Hours WHERE SHIFT_ID = $_POST[shift_id]";
    echo '$sql';
    if (!mysqli_query($con,$sql))
      {
      die('Error: ' . mysqli_error($con));
      }
    echo "1 record deleted";
    mysqli_close($con);
    header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/owner_change_set_shifts.php");
  }
?>










