<?php
// Start the session
session_start();
if ($_SESSION['role'] == "EMPLOYEE"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/logout.php");}
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
                <img src="http://www.cs.virginia.edu/~jme3tp/db_project/flower.jpg" width="35" height="35" style="border-radius: 4px;" alt="Home">
            </a>
            <div class="dropdown-menu" align="right">
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/customer_home.php">Home</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/customer_view_stores.php">Store Hours</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/customer_stock.php">Stock Information</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/customer_view_reviews.php">Bouquet Reviews</a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/ReviewForm.php">Review a Bouquet </a>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/ViewTransactions.php">Transaction History</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="http://www.cs.virginia.edu/~jme3tp/db_project/logout.php">Logout</a>
    </nav>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10">
        <h3> Our Current Stock</h3>
        <br>
<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("select * from Stock_Items ORDER BY STORE_ID") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchDes'] . '%';
                $stmt->bind_param(s, $searchString);
                $stmt->execute();
                $stmt->bind_result($STORE_ID, $ITEM_UPC, $DESCRIPTION, $CURRENT_STOCK);
                echo "<table border=1><th>Store</th><th>Item UPC</th><th>Description</th><th>Stock</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$STORE_ID</td><td>$ITEM_UPC</td><td>$DESCRIPTION</td><td>$CURRENT_STOCK</td></tr>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();


?>

</div> </div>
    </div>
</body>
</html>