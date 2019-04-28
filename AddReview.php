<?php
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
 $sql="INSERT INTO Reviews (ITEM_UPC, CUSTOMER_ID, REVIEW_TYPED, REVIEW_OUT_OF_TEN)
 VALUES
 ('$_POST[ITEM_UPC]','$_POST[CUSTOMER_ID]','$_POST[REVIEW_TYPED]','$_POST[REVIEW_OUT_OF_TEN]')";

 if (!mysqli_query($con,$sql))
 {
 die('Error: ' . mysqli_error($con));
 }
 echo "1 record added"; // Output to user
 mysqli_close($con);
?>
