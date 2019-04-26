<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("select * from Employee where last_name like ?") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchLastName'] . '%';
                $stmt->bind_param(s, $searchString);
                $stmt->execute();
                $stmt->bind_result($employee_id, $first_name, $last_name);
                echo "<table border=1><th>Customer ID</th><th>First Name</th><th>Last Name</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$employee_id</td><td>$first_name</td><td>$last_name</td></tr>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();


?>
