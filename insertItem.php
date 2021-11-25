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
        
            $name = $_GET["name"];
            $department = $_GET["department"];
            $price = $_GET["price"];
            $plu = $_GET["item_plu"];
            $vendor = $_GET["vendor_id"];
        
            if (!isset($name) || !isset($department) || !isset($price) || !isset($plu) || !isset($vendor) || trim($name) == '' || trim($department) == '' || trim($price) == '' || trim($plu) == '' || trim($vendor) == '') {
                echo "<h1 class='bodyText'>Required field(s) missing. Please go back and try again.</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Go Back</a></p>";
            }
            else {
                if (preg_match("/^[0-9]+(.)[0-9][0-9]$/", $price) !== 1) {
                    echo "<h1 class='bodyText'>Price field is formatted incorrectly. Please go back and try again.</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Go Back</a></p>";
                }
                
                elseif (preg_match("/^[0-9]{12}$/", $plu) !== 1) {
                    echo "<h1 class='bodyText'>Item PLU field is formatted incorrectly. Please go back and try again.</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Go Back</a></p>";
                }
                
                elseif (preg_match("/^[0-9]+$/", $vendor) !== 1) {
                    echo "<h1 class='bodyText'>Vendor ID field is formatted incorrectly. Please go back and try again.</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Go Back</a></p>";
                }
                //all input is valid
                else {        
                    $check_vendor = "SELECT s.Vendor_ID FROM Supplier as s WHERE s.Vendor_ID=".(int)$vendor.";";
                    $check_vendor_result = $mysqli_conn->query($check_vendor);

                    $check_department = "SELECT d.DName FROM department AS d WHERE UPPER(d.DName) LIKE UPPER(\"".$department."\");";
                    $check_department_result = $mysqli_conn->query($check_department);
                    
                    if ($check_vendor_result === false || $check_vendor_result->num_rows == 0) {
                        echo "<h1 class='bodyText'>Supplier does not exist, consider creating a new supplier or entering an existing vendor id.</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Go Back</a></p>";
                    }

                    elseif ($check_department_result === false || $check_department_result->num_rows == 0) {
                        echo "<h1 class='bodyText'>Department does not exist. Please go back and try again. The current departments are: Appliances, Silverware, Tableware, Cookware, Delivery, Headquarters;</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Go Back</a></p>";
                    }
                    
                    else {
                        $dno_query = "SELECT d.DNumber FROM Department as d WHERE UPPER(d.DName) LIKE UPPER(\"".$department."\")";
                        $dno_result = $mysqli_conn->query($dno_query);
                        while($dno_row = $dno_result->fetch_assoc()) {
                            $dno = $dno_row["DNumber"];
                            $insert_query = "INSERT INTO ITEM(Item_PLU, Name, Dno, Vendor_ID, Price) VALUES (\"".$plu."\", \"".$name."\", ".(int)$dno.", ".(int)$vendor.", ".(double)$price.")";
                            if ($mysqli_conn->query($insert_query) == true) {
                                echo "<h1 class='bodyText'>Item inserted succesfully</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Insert More</a></p>";
                                break;
                            }
                        }
                    } 
                }
            }
        ?>
    </body>
</html>