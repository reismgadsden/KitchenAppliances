<html>
    <head>
        <link rel="stylesheet" href="landingstyle.css">
        <title>Search Results</title>
    </head>
    <body>
        <img src="kaLogo.svg" width="10%" height="10%" class="center">
        <br/>
        <p class="top_links"><a href="index.html" class="topLink">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="productSearch.html" class="topLink">Product Search</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="order.html" class="topLink">Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="orderLookup.html" class="topLink">Order Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin.html" class="topLink">Admin</a></p>
      <h1 class="bodyText">Order Look-Up</h1>
      <br/>
        <?php
            include("./connection.php");
        
            $name = $_GET["name"];
            $dept = $_GET["dept"];
        
            if ((!isset($name) && !isset($dept)) || (trim($name) == "" && trim($dept) == "")) {
                echo "<h1 class='bodyText'>Please enter at least a name or department.</h1><br/><p class='top_links'><a href='productSearch.html' class='topLink'>Go Back</a></p>";
            }
            else {
                if (!isset($name) || trim($name) == ""){
                    $check_department = "SELECT d.DName FROM Department AS d WHERE UPPER(d.DName) LIKE UPPER(\"".$dept."\");";
                    $check_department_result = $mysqli_conn->query($check_department);

                    if ($check_department_result === false || $check_department_result->num_rows == 0) {
                        echo "<h1 class='bodyText'>Department does not exist. Please go back and try again. The current departments are: Appliances, Silverware, Tableware, Cookware;</h1><br/><p class='top_links'><a href='productSearch.html' class='topLink'>Go Back</a></p>";
                    }
                    else {
                        $dno_query = "SELECT d.DNumber FROM Department as d WHERE UPPER(d.DName) LIKE UPPER(\"".$dept."\")";
                        $dno_result = $mysqli_conn->query($dno_query);
                        $dno = null;
                            while($dno_row = $dno_result->fetch_assoc()) {
                                $dno = $dno_row["DNumber"];
                                break;
                            }

                        $name_search_query = "SELECT i.Name, i.Price, i.Item_PLU FROM ITEM AS i WHERE i.Dno=".$dno." ORDER BY i.Name";
                        $name_search_results = $mysqli_conn->query($name_search_query);
                        if ($name_search_results === false || $name_search_results->num_rows == 0) {
                            echo "<h1 class='bodyText'>No results for items in \"".$dept."\".</h1><br/><p class='top_links'><a href='productSearch.html' class='topLink'>Go Back</a></p>";
                        }
                        else {
                            echo "<h1 class='bodyText'>Results for items in \"".$dept."\":</h1><br/>";
                            echo "<table class='tableCenter'><tr><th>Product Name</th><th>Price</th><th>Order Code</th></tr><tr></tr>";
                            while($name_row = $name_search_results->fetch_assoc()){
                                echo "<tr>";
                                echo "<td>".$name_row["Name"]."</td>";
                                echo "<td>".$name_row["Price"]."</td>";
                                echo "<td>".$name_row["Item_PLU"]."</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "<p class='top_links'><a href='productSearch.html' class='topLink'>Go Back</a></p>";
                        }
                    }
                }
                
                elseif(!isset($dept) || trim($dept) == ""){
                    $name_search_query = "SELECT i.Name, i.Price, i.Item_PLU FROM ITEM AS i WHERE i.Name LIKE \"%".$name."%\" ORDER BY i.Name";
                    $name_search_results = $mysqli_conn->query($name_search_query);
                    if ($name_search_results === false || $name_search_results->num_rows == 0) {
                        echo "<h1 class='bodyText'>No results for \"".$name."\".</h1><br/><p class='top_links'><a href='productSearch.html' class='topLink'>Go Back</a></p>";
                    }
                    else {
                        echo "<h1 class='bodyText'>Results for \"".$name."\":</h1><br/>";
                        echo "<table class='tableCenter'><tr><th>Product Name</th><th>Price</th><th>Order Code</th></tr><tr></tr>";
                        while($name_row = $name_search_results->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>".$name_row["Name"]."</td>";
                            echo "<td>".$name_row["Price"]."</td>";
                            echo "<td>".$name_row["Item_PLU"]."</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "<p class='top_links'><a href='productSearch.html' class='topLink'>Go Back</a></p>";
                    }
                    
                }
                
                else {
                    $check_department = "SELECT d.DName FROM Department AS d WHERE UPPER(d.DName) LIKE UPPER(\"".$dept."\");";
                    $check_department_result = $mysqli_conn->query($check_department);

                    if ($check_department_result === false || $check_department_result->num_rows == 0) {
                        echo "<h1 class='bodyText'>Department does not exist. Please go back and try again. The current departments are: Appliances, Silverware, Tableware, Cookware;</h1><br/><p class='top_links'><a href='productSearch.html' class='topLink'>Go Back</a></p>";
                    }
                    else {
                        $dno_query = "SELECT d.DNumber FROM Department as d WHERE UPPER(d.DName) LIKE UPPER(\"".$dept."\")";
                        $dno_result = $mysqli_conn->query($dno_query);
                        $dno = null;
                            while($dno_row = $dno_result->fetch_assoc()) {
                                $dno = $dno_row["DNumber"];
                                break;
                            }

                        $name_search_query = "SELECT i.Name, i.Price, i.Item_PLU FROM ITEM AS i WHERE i.Dno=".$dno." AND i.Name LIKE \"%".$name."%\" ORDER BY i.Name";
                        $name_search_results = $mysqli_conn->query($name_search_query);
                        if ($name_search_results === false || $name_search_results->num_rows == 0) {
                            echo "<h1 class='bodyText'>No results for item \"".$name."\" in \"".$dept."\".</h1><br/><p class='top_links'><a href='productSearch.html' class='topLink'>Go Back</a></p>";
                        }
                        else {
                            echo "<h1 class='bodyText'>Results for item \"".$name."\" in \"".$dept."\":</h1><br/>";
                            echo "<table class='tableCenter'><tr><th>Product Name</th><th>Price</th><th>Order Code</th></tr><tr></tr>";
                            while($name_row = $name_search_results->fetch_assoc()){
                                echo "<tr>";
                                echo "<td>".$name_row["Name"]."</td>";
                                echo "<td>$".$name_row["Price"]."</td>";
                                echo "<td>".$name_row["Item_PLU"]."</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "<p class='top_links'><a href='productSearch.html' class='topLink'>Go Back</a></p>";
                        }
                    }
                }
            }
        ?>
    </body>
</html>