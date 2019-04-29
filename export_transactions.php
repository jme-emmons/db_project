
<?php
session_start();
if ($_SESSION['role'] == "EMPLOYEE"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/logout.php");}
if ($_SESSION['role'] == "OWNER"){ header("Location: http://www.cs.virginia.edu/~jme3tp/db_project/logout.php");}

include_once("./library.php");

$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
if (!$con) {
    echo "Unable to connect to DB: " . mysqli_error();
    exit;
}

$user = $_SESSION['c_id'];
$result = mysqli_query($con, "SELECT * FROM Transactions");

if (!$result) {
    // This is where its going wrong right now when I test it
    // It's connecting to the DB but $result is not being created because the query isnt running
    echo "\nCould not successfully run query ($sql) from DB: " . mysqli_error();
    exit;
}

while($data = mysqli_fetch_assoc($result)) {
  foreach($data as $key => $value) {
    echo "$value";
    echo ", ";
  }
  echo "\n";
}

//  Return the contents of the output buffer
$htmlStr = ob_get_contents();
// Clean (erase) the output buffer and turn off output buffering
//ob_end_clean();
// Write final striing to file

$fileName = "test.csv";
file_put_contents($fileName, $htmlStr);

ob_end_clean();

?>
    <a href="http://www.cs.virginia.edu/~jme3tp/db_project/test.csv" class="btn btn-primary btn-block">Get the File</a>

