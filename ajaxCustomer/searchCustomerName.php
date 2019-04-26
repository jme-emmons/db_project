<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("select * from Customer where last_name like ?") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchLastName'] . '%';
                $stmt->bind_param(s, $searchString);
                $stmt->execute();
                $stmt->bind_result($customer_id, $location, $gender, $age, $first_name, $last_name);
                echo "<table border=1><th>Customer ID</th><th>Location</th><th>Gender</th><th>Age</th><th>First Name</th><th>Last Name</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$customer_id</td><td>$location</td><td>$gender</td><td>$age</td><td>$first_name</td><td>$last_name</td></tr>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();


?>
