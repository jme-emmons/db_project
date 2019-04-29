<?php
session_start();
if ($_SESSION['role'] == "EMPLOYEE"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/logout.php");}
if ($_SESSION['role'] == "OWNER"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/logout.php");}

 include_once("./library.php"); // To connect to the database
 $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection
 if (mysqli_connect_errno())
 {
 echo $SERVER . $USERNAME . $PASSWORD . $DATABASE;
 echo "Failed to connect to MySQL: " .
mysqli_connect_error();
 }
 // Form the SQL query (an INSERT query)
 $user = $_SESSION['c_id'];
 $sql="INSERT INTO Reviews (ITEM_UPC, CUSTOMER_ID, REVIEW_TYPED, REVIEW_OUT_OF_TEN)
 VALUES
 ('$_POST[ITEM_UPC]','$user','$_POST[REVIEW_TYPED]','$_POST[REVIEW_OUT_OF_TEN]')";

 if (!mysqli_query($con,$sql))
 {
 die('Error: ' . mysqli_error($con));
 }
 echo "1 record added"; // Output to user
 mysqli_close($con);
 header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/customer_home.php")
?>
