<html>
    <head>
        <link rel="stylesheet" href="landingstyle.css">
        <title>Department Lookup Results</title>
    </head>
    <body>
        <img src="kaLogo.svg" width="10%" height="10%" class="center">
        <br/>
        <p class="top_links"><a href="index.html" class="topLink">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="productSearch.html" class="topLink">Product Search</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="order.html" class="topLink">Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="orderLookup.html" class="topLink">Order Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin.html" class="topLink">Admin</a></p>
        <?php
            include("./connection.php");
        
            $dept = $_GET["dept"];
        
            if (!isset($dept) || trim($dept) == "") {
                echo "<h1 class='bodyText'>Please enter a department name.</h1><br/><p class='top_links'><a href='departmentLookup.html' class='topLink'>Go Back</a></p>";
            }
            else {
                $check_department = "SELECT d.DName FROM Department AS d WHERE UPPER(d.DName) LIKE UPPER(\"".$dept."\");";
                    $check_department_result = $mysqli_conn->query($check_department);

                    if ($check_department_result === false || $check_department_result->num_rows == 0) {
                        echo "<h1 class='bodyText'>Department does not exist. Please go back and try again. The current departments are: Appliances, Silverware, Tableware, Cookware, Delivery, Sales, Headquarters;</h1><br/><p class='top_links'><a href='departmentLookup.html' class='topLink'>Go Back</a></p>";
                    }
                    else {
                        $dno_query = "SELECT d.DNumber FROM Department as d WHERE UPPER(d.DName) LIKE UPPER(\"".$dept."\")";
                        $dno_result = $mysqli_conn->query($dno_query);
                        $dno = null;
                        while($dno_row = $dno_result->fetch_assoc()) {
                            $dno = $dno_row["DNumber"];
                            break;
                        }
                        
                        $employee_search_query = "SELECT e.Name, e.Sex, e.DOB, e.Address, e.Salary FROM Employee as e WHERE e.Dno=".$dno." ORDER BY e.Name;";
                        $employee_search = $mysqli_conn->query($employee_search_query);
                        
                        echo "<h1 class='bodyText'>Employees and Items in department \"".$dept."\":</h1><br/><br/>";
                        echo "<h1 class='bodyText'>Employees</h1><br/>";
                        echo "<table class='tableCenter'><tr><th>Name</th><th>Sex</th><th>Date of Birth</th><th>Address</th><th>Salary</th></tr><tr></tr>";
                        while($employee_row = $employee_search->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$employee_row["Name"]."</td>";
                            echo "<td>".$employee_row["Sex"]."</td>";
                            echo "<td>".$employee_row["DOB"]."</td>";
                            echo "<td>".$employee_row["Address"]."</td>";
                            echo "<td>$".$employee_row["Salary"]."</td>";
                            echo "</tr>";
                        }
                        
                        echo "</table><br/><br/><br/><br/><br/><br/>";
                        
                        $item_search_query = "SELECT i.Name, i.Item_PLU, s.Name as suppName, i.Price FROM ITEM as i, Supplier as s WHERE i.Dno=".$dno." AND s.Vendor_ID=i.Vendor_ID ORDER BY i.Name;";
                        $item_search = $mysqli_conn->query($item_search_query);
                        echo "<h1 class='bodyText'>Items</h1><br/>";
                        if ($item_search === false || $item_search->num_rows == 0) {
                            echo "<h1 class='bodyText'>There are no items for this department.</h1><br/>";
                        }
                        else {
                            echo "<table class='tableCenter'><tr><th>Name</th><th>PLU</th><th>Supplier</th><th>Price</th></tr><tr></tr>";
                            while($item_row = $item_search->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$item_row["Name"]."</td>";
                                echo "<td>".$item_row["Item_PLU"]."</td>";
                                echo "<td>".$item_row["suppName"]."</td>";
                                echo "<td>$".$item_row["Price"]."</td>";
                                echo "</tr>";
                            }

                            echo "</table><br/>";
                            echo "<p class='top_links'><a href='departmentLookup.html' class='topLink'>Go Back</a></p>";
                        }
                        echo "<p class='top_links'><a href='departmentLookup.html' class='topLink'>Go Back</a></p>";
                    }
            }
        ?>
    </body>
</html>