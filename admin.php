<html>
    <head>
        <link rel="stylesheet" href="landingstyle.css">
        <title>Admin</title>
    </head>
    <body>
    <img src="kaLogo.svg" width="10%" height="10%" class="center">
    <br/>
    <p class="top_links"><a href="index.html" class="topLink">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Product Search</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Order Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Employee Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin.html" class="topLink">Admin</a></p>
        
<?php
    echo "<h1 class='heading'>Logged in as: ".$_GET["username"]."</h1>";
?>
    <p class="top_links"><a href="insertItem.html" class="topLink">Insert New Item</a></p>
    <p class="top_links"><a href="insertEmployee.html" class="topLink">Insert New Employee</a></p>
    <p class="top_links"><a href="insertSupplier.html" class="topLink">Insert New Supplier</a></p>
    <p class="top_links"><a href="lookupCustomer.html" class="topLink">Lookup Customer</a></p>
    <p class="top_links"><a href="lookupDepartment.html" class="topLink">Lookup Department</a></p>
    </body>
</html>