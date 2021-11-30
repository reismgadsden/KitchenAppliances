<html>
    <head>
        <link rel="stylesheet" href="landingstyle.css">
        <title>Kitchen Appliances</title>
    </head>
    <body>
        <a href="index.html"><img src="kaLogo.svg" width="10%" height="10%" class="center"></a>
        <br/>
        <p class="top_links"><a href="index.html" class="topLink">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="productSearch.html" class="topLink">Product Search</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="order.html" class="topLink">Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="orderLookup.html" class="topLink">Order Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin.html" class="topLink">Admin</a></p>
        <?php
            include("./connection.php");
        
            $plu = $_GET["plu"];
            $name = $_GET["name"];
            $price = $_GET["price"];
        
            if (!isset($plu) || trim($plu) == "") {
                echo "<h1 class='bodyText'>PLU is needed for update. Please go back and try again.</h1><br/><p class='top_links'><a href='updateItem.html' class='topLink'>Go Back</a></p>";
            }
            elseif((!isset($name) || trim($name) == "") && (!isset($price) || trim($price) == "")){
                echo "<h1 class='bodyText'>At least one field is needed for update. Please go back and try again.</h1><br/><p class='top_links'><a href='updateItem.html' class='topLink'>Go Back</a></p>";
            }
            else {
                $item_check_query = "SELECT * FROM ITEM WHERE Item_PLU=\"".$plu."\";";
                $item_check = $mysqli_conn->query($item_check_query);
                
                if ($item_check === false || $item_check->num_rows == 0) {
                    echo "<h1 class='bodyText'>Item with plu \"".$plu."\" does not exist.</h1><br/><p class='top_links'><a href='updateItem.html' class='topLink'>Go Back</a></p>";
                }
                else {
                    echo "<h1 class='bodyText'>Succesfully updated item \"".$plu."\".</h1><br/>";
                    if(!isset($name) || trim($name) == "") {
                        $price_sql_query = "SELECT i.Price FROM ITEM as i WHERE i.Item_PLU=\"".$plu."\";";
                        $price_sql = $mysqli_conn->query($price_sql_query);
                        $old_price = "";
                        while($old_price_row = $price_sql->fetch_assoc()){
                            $old_price = $old_price_row["Price"];
                            break;
                        }
                        echo "<p>UPDATED PRICE: $".$old_price." -> $".$price."</p>";
                        
                        $update_query = "UPDATE ITEM SET Price=".(double)$price." WHERE Item_PLU=\"".$plu."\";";
                        $mysqli_conn->query($update_query);
                    }
                    if(!isset($price) || trim($price) == "") {
                        $name_sql_query = "SELECT i.Name FROM ITEM as i WHERE i.Item_PLU=\"".$plu."\";";
                        $name_sql = $mysqli_conn->query($name_sql_query);
                        $old_name = "";
                        while($old_name_row = $name_sql->fetch_assoc()){
                            $old_name = $old_name_row["Name"];
                            break;
                        }
                        echo "<p>UPDATED NAME: ".$old_name." -> ".$name."</p>";
                        
                        $update_query = "UPDATE ITEM SET Name=\"".$name."\" WHERE Item_PLU=\"".$plu."\";";
                        $mysqli_conn->query($update_query);
                    }
                    echo "<p class='top_links'><a href='updateItem.html' class='topLink'>Go Back</a></p>";
                }
            }
        ?>
    </body>
</html>