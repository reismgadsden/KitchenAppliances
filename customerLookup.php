<html>
    <head>
        <link rel="stylesheet" href="landingstyle.css">
        <title>Kitchen Appliances</title>
    </head>
    <body>
        <img src="kaLogo.svg" width="10%" height="10%" class="center">
        <br/>
        <p class="top_links"><a href="index.html" class="topLink">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="productSearch.html" class="topLink">Product Search</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="order.html" class="topLink">Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="orderLookup.html" class="topLink">Order Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="employeeLookup.html" class="topLink">Employee Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin.html" class="topLink">Admin</a></p>
        <?php
            include("./connection.php");
        
            $pk = $_GET["pk"];
        
            if (!isset($pk) || trim($pk) == '') {
                echo "<h1 class='bodyText'>Required field(s) missing. Please go back and try again.</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Go Back</a></p>";
            }
            else {
                
                if (preg_match("/^[A-za-z0-9]{1,16}$/", $pk) !== 1) {
                    echo "<h1 class='bodyText'>Purchase Key is formatted incorrectly. Please go back and try again.</h1><br/><p class='top_links'><a href='customerLookup.html' class='topLink'>Go Back</a></p>";
                }
                
                //all input is valid
                else {        
                    $search_query = "SELECT c.Address, c.Item_PLU, i.Name, c.Form_Of_Payement, c.Purchase_Key, e.name FROM Customer AS C, ITEM as i, Employee as E WHERE c.Purchase_Key=\"".$pk."\" AND e.ssn=c.Delivery_Employee_SSN AND i.Item_PLU=c.Item_PLU;";
                    $search_result = $mysqli_conn->query($search_query);
                    if ($search_result === false || $search_result->num_rows == 0) {
                        echo "<h1 class='bodyText'>No customer with corresponding purchase key exits. Please go back and try again.</h1><br/><p class='top_links'><a href='customerLookup.html' class='topLink'>Go Back</a></p>";
                    }
                    else {
                        while($customer_row = $search_result->fetch_assoc()) {
                            echo "<h1 class='bodyText'>Customer Order: #".$customer_row["Purchase_Key"]."</h1>";
                            echo "<p>Delivery Address: ".$customer_row["Address"]."</p>";
                            echo "<p>Item / Item PLU Ordered: ".$customer_row["Name"]." / ".$customer_row["Item_PLU"]."</p>";
                            echo "<p>Payement Method: ".$customer_row["Form_Of_Payement"]."</p>";
                            echo "<p>Delivered By: ".$customer_row["name"]."</p>";
                            echo "<p class='top_links'><a href='customerLookup.html' class='topLink'>Look-Up Another Customer</a></p>";
                            break;
                        }
                    }
                }
            }
        ?>
    </body>
</html>