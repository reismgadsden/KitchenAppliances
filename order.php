<html>
    <head>
        <link rel="stylesheet" href="landingstyle.css">
        <title>Order</title>
    </head>
    <body>
    <img src="kaLogo.svg" width="10%" height="10%" class="center">
    <br/>
    <p class="top_links"><a href="index.html" class="topLink">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="productSearch.html" class="topLink">Product Search</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="order.html" class="topLink">Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="orderLookup.html" class="topLink">Order Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="employeeLookup.html" class="topLink">Employee Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin.html" class="topLink">Admin</a></p>
        <?php
            include("./connection.php");
        
            $plu = $_GET["order_plu"];
            $addy = $_GET["addy"];
            $method = $_GET["method"];
        
            if(!isset($plu) || !isset($method) || !isset($addy) || trim($plu) == "" || trim($method) == "" || trim($addy)=="") {
                echo "<h1 class='top_link'>Required field(s) left blank, please try again.</h1><p><a href='order.html' class='topLink'></a></p>";
            }
            
            elseif (preg_match("/^[0-9]{12}$/", $plu) !== 1) {
                echo "<h1 class='bodyText'>Item PLU field is formatted incorrectly. Please go back and try again.</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Go Back</a></p>";
            }
            
            else {
                $check_item_query = "SELECT Name, Item_PLU FROM ITEM WHERE Item_PLU=\"".$plu."\";";
                $check_item_result = $mysqli_conn->query($check_item_query);
                
                if ($check_item_result === false || $check_item_result->num_rows == 0){
                    echo "<h1 class='bodyText'>Item was not found in system, was PLU entered correctly?</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Go Back</a></p>";
                }
                
                else {
                    $item_name = "";
                    
                    while ($item_row = $check_item_result->fetch_assoc()) {
                        $item_name .= $item_row["Name"];
                        break;
                    }
                    
                    $purchase_key = "";
                    $seed = str_split("abcdefghijklmnopqrstuvwxyz");
                    
                    $counter = 0;
                    while ($counter < 16) {
                        if(rand() % 2 == 0){
                            $purchase_key .= $seed[rand(0, 25)];
                        }
                        else {
                            $purchase_key .= strval(rand(0, 9));
                        }
                        
                        $counter += 1;
                        
                        if (rand() % 8 == 0) {
                            break;
                        }
                    }
                    
                    $rand_employee_query = "SELECT e.name, e.ssn FROM Employee as e WHERE e.dno=4;";
                    $rand_employee_result = $mysqli_conn->query($rand_employee_query);
                    
                    $delivery_employee_name ="";
                    $delivery_employee_ssn="";
                    
                    while($rand_employee_row = $rand_employee_result->fetch_assoc()) {
                        $delivery_employee_name = $rand_employee_row["name"];
                        $delivery_employee_ssn = $rand_employee_row["ssn"];
                        
                        if (rand() % 5 == 0) {
                            break;
                        }
                    }
                    
                    $insert_customer_query = "INSERT INTO Customer Values(\"".$addy."\", \"".$purchase_key."\", \"".$method."\", \"".$plu."\", \"".$delivery_employee_ssn."\");";
                    $mysqli_conn->query($insert_customer_query);
                    echo "<h1 class='bodyText'>Order #".$purchase_key." recieved succesfully!</h1>";
                    echo "<p>Make sure to record your order number!</p>";
                    echo "<br/><h1 class='bodyText'Your Order Details</h1>";
                    echo "<p>Your order no.: #".$purchase_key."</p>";
                    echo "<p>Item / Item PLU Ordered: ".$item_name." / ".$plu."</p>";
                    echo "<p>Destination: ".$addy."</p>";
                    echo "<p>Delivery Agent: ".$delivery_employee_name."</p>";
                    echo "<br/><p><a href='index.html' class='topLink'>Home</a></p>";
                }
            }
        ?>
    </body>
</html>