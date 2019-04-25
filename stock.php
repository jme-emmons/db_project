<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("select * from Stock_Items where DESCRIPTION like ?") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchDes'] . '%';
                $stmt->bind_param(s, $searchString);
                $stmt->execute();
                $stmt->bind_result($Store_ID, $Item_upc, $Des, $stock);
                echo "<table border=1><th>Store</th><th>Item UPC</th><th>Description</th><th>Stock</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$Store_ID</td><td>$Item_upc</td><td>$Des</td><td>$stock</td></tr>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();


?>