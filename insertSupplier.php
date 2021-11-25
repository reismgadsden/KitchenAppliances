<html>
    <head>
        <link rel="stylesheet" href="landingstyle.css">
        <title>Kitchen Appliances</title>
    </head>
    <body>
        <img src="kaLogo.svg" width="10%" height="10%" class="center">
        <br/>
        <p class="top_links"><a href="index.html" class="topLink">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Product Search</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Order Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Employee Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin.html" class="topLink">Admin</a></p>
        <?php
            include("./connection.php");
        
            $name = $_GET["name"];
            $vendor = $_GET["vendor_id"];
        
            if (!isset($name) || !isset($vendor) || trim($name) == '' || trim($vendor) == '') {
                echo "<h1 class='bodyText'>Required field(s) missing. Please go back and try again.</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Go Back</a></p>";
            }
            else {
                $check_vendor = null;
                $check_vendor_result = null;
                
                if (preg_match("/^[0-9]+$/", $vendor) !== 1) {
                    echo "<h1 class='bodyText'>Vendor ID field is formatted incorrectly. Please go back and try again.</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Go Back</a></p>";
                }
                
                //all input is valid
                else {        
                    $check_vendor = "SELECT s.Vendor_ID FROM Supplier as s WHERE s.Vendor_ID=".(int)$vendor.";";
                    $check_vendor_result = $mysqli_conn->query($check_vendor);

                    if ($check_vendor_result === true || $check_vendor_result->num_rows > 0) {
                        echo "<h1 class='bodyText'>Supplier already exists.</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Go Back</a></p>";
                    }
                    
                    else {
                        $insert_query = "INSERT INTO Supplier VALUES(\"".$name."\", ".$vendor.");";
                        if ($mysqli_conn->query($insert_query) == true) {
                            echo "<h1 class='bodyText'>Supplier inserted succesfully</h1><br/><p class='top_links'><a href='insertItem.html' class='topLink'>Insert More</a></p>";
                        }
                    } 
                }
            }
        ?>
    </body>
</html>