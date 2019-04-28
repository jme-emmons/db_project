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
$sql="SELECT * FROM Reviews ORDER BY ITEM_UPC";
$result = mysqli_query($con,$sql);
// Print the data from the table row by row
while($row = mysqli_fetch_array($result)) {
echo $row['ITEM_UPC'];
echo " " . $row['CUSTOMER_ID'];
echo " " . $row['REVIEW_ID'];
echo " " . $row['REVIEW_TYPED'];
echo " " . $row['REVIEW_OUT_OF_TEN'];
echo "<br>";
}
mysqli_close($con);
?>
