<html>
    <head>
        <link rel="stylesheet" href="landingstyle.css">
        <title>Order</title>
    </head>
    <body>
    <img src="kaLogo.svg" width="10%" height="10%" class="center">
    <br/>
    <p class="top_links"><a href="index.html" class="topLink">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Product Search</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Order Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Employee Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin.html" class="topLink">Admin</a></p>
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
                $check_item_query = "SELECT * FROM ITEM WHERE Item_PLU=\"".$plu."\";";
                $check_item_result = $mysqli_conn->query($check_item_query);
                
                if ($check_item_result === false || $check_item_result->num_rows == 0){
                    echo "<h1 class='bodyText'>Item was not found in system, was PLU entered correctly?</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Go Back</a></p>";
                }
                
                else {
                    $purchase_key = "";
                    $seed = str_split("abcdefghijklmnopqrstuwxyz");
                    
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
                    echo "<br/><p><a href='index.html' class='topLink'>Home</a></p>";
                }
            }
        ?>
    </body>
</html>