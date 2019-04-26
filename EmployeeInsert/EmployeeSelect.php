<?php
require_once('./library.php');
$con = new mysqli($SERVER, $USERNAME, $PASSWORD,
$DATABASE);
// Check connection
if (mysqli_connect_errno()) {
echo("Can't connect to MySQL Server. Error code: " .
mysqli_connect_error());
return null;
}
// Form the SQL query (a SELECT query)
$sql="SELECT * FROM Employee ORDER BY last_name";
$result = mysqli_query($con,$sql);
// Print the data from the table row by row
while($row = mysqli_fetch_array($result)) {
echo $row['first_name'];
echo " " . $row['last_name'];
echo "<br>";
}
mysqli_close($con);
?>
