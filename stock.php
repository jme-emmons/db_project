<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("select * from Stock_Items where DESCRIPTION like ?") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchDes'] . '%';
                $stmt->bind_param(s, $searchString);
                $stmt->execute();
                $stmt->bind_result($STORE_ID, $ITEM_UPC, $DESCRIPTION, $CURRENT_STOCK);
                echo "<table border=1><th>Store</th><th>Item UPC</th><th>Description</th><th>Stock</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$STORE_ID</td><td>$ITEM_UPC</td><td>$DESCRIPTION</td><td>$CURRENT_STOCK</td></tr>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();


?>