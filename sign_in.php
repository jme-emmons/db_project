<?php  //Start the Session
session_start();
include_once("./library.php"); // To connect to the database
 $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " .
mysqli_connect_error();
 }

$user = $_POST[USERNAME];
$sql = "SELECT * FROM Accounts WHERE USERNAME = '$user' and PASSWORD = ('$_POST[PASSWORD]')";

if (!mysqli_query($con,$sql))
 {
 die('Error: ' . mysqli_error($con));
 }

$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);
if ($count == 1){
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['username'] = $row["USERNAME"];
        $_SESSION['a_id'] = $row["ACCOUNT_ID"];
        $_SESSION['role'] = $row["ROLE_TYPE"];
    }
    if ($_SESSION['role'] == "CUSTOMER"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/customer_home.php");}
    if ($_SESSION['role'] == "EMPLOYEE"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/employee_home.html");}
    if ($_SESSION['role'] == "OWNER"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/owner_home.html");}
}
else{
echo "Invalid Login Credentials.";
echo "<a href='http://www.cs.virginia.edu/~jme3tp/db_project/sign_in.html'>Try Again</a>";
}
//mysqli_free_result($result);
?>

