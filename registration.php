<?php
 include_once("./library.php"); // To connect to the database
 $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " .
mysqli_connect_error();
 }
 // Form the SQL query (an INSERT query)
 $sql="INSERT INTO password_check (USERNAME, PASSWORD)
 VALUES
 ('$_POST[USERNAME]','$_POST[PASSWORD]')";

 if (!mysqli_query($con,$sql))
 {
 die('Error: ' . mysqli_error($con));
 }
 mysqli_close($con);
 header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/sign_in.html");

?>