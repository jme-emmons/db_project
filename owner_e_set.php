<?php
// Start the session
session_start();
if ($_SESSION['role'] == "CUSTOMER"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/logout.php");}
if ($_SESSION['role'] == "EMPLOYEE"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/logout.php");}
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
 header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/owner_home.php");
?>