<html>
    <head>
        <link rel="stylesheet" href="landingstyle.css">
        <title>Admin</title>
    </head>
    <body>
    <img src="kaLogo.svg" width="10%" height="10%" class="center">
    <br/>
    <p class="top_links"><a href="index.html" class="topLink">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="productSearch.html" class="topLink">Product Search</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="order.html" class="topLink">Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="orderLookup.html" class="topLink">Order Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin.html" class="topLink">Admin</a></p>
        
<?php
    echo "<h1 class='heading'>Logged in as: ".$_GET["username"]."</h1>";
?>
    <p class="top_links"><a href="insertItem.html" class="topLink">Insert New Item</a></p>
    <p class="top_links"><a href="insertEmployee.html" class="topLink">Insert New Employee</a></p>
    <p class="top_links"><a href="insertSupplier.html" class="topLink">Insert New Supplier</a></p>
    <p class="top_links"><a href="employeeLookup.html" class="topLink">Lookup Employee</a></p>
    <p class="top_links"><a href="customerLookup.html" class="topLink">Lookup Customer</a></p>
    <p class="top_links"><a href="departmentLookup.html" class="topLink">Lookup Department</a></p>
    <p class="top_links"><a href="updateItem.html" class="topLink">Update Item</a></p>
    <p class="top_links"><a href="updateEmployee.html" class="topLink">Update Employee</a></p>
    </body>
</html>