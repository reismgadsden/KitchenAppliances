<html>
    <head>
        <link rel="stylesheet" href="landingstyle.css">
        <title>Kitchen Appliances</title>
    </head>
    <body>
        <img src="kaLogo.svg" width="10%" height="10%" class="center">
        <br/>
        <p class="top_links"><a href="index.html" class="topLink">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="productSearch.html" class="topLink">Product Search</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="order.html" class="topLink">Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="orderLookup.html" class="topLink">Order Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin.html" class="topLink">Admin</a></p>
        <?php
            include("./connection.php");
        
            $ssn = $_GET["ssn"];
        
            if (!isset($ssn) || trim($ssn) == '') {
                echo "<h1 class='bodyText'>Required field missing. Please go back and try again.</h1><br/><p class='top_links'><a href='employeeLookup.html' class='topLink'>Go Back</a></p>";
            }
            else {
                
                if (preg_match("/^[0-9]{9}$/", $ssn) !== 1) {
                    echo "<h1 class='bodyText'>SSN field is formatted incorrectly. Please go back and try again.</h1><br/><p class='top_links'><a href='employeeLookup.html' class='topLink'>Go Back</a></p>";
                }
                
                //all input is valid
                else {        
                    $search_query = "SELECT e.Name, e.Sex, e.DOB, e.Address, e.Salary, d.DName FROM Employee as e, Department as d WHERE e.SSN=".$ssn." AND e.Dno=d.DNumber;";
                    $search_result = $mysqli_conn->query($search_query);
                    if ($search_result === false || $search_result->num_rows == 0) {
                        echo "<h1 class='bodyText'>No employee with corresponding social security number. Please go back and try again.</h1><br/><p class='top_links'><a href='employeeLookup.html' class='topLink'>Go Back</a></p>";
                    }
                    else {
                        while($employee_row = $search_result->fetch_assoc()) {
                            echo "<h1 class='bodyText'>Employee SSN: #".$ssn."</h1>";
                            echo "<p>Name: ".$employee_row["Name"]."</p>";
                            echo "<p>Sex: ".$employee_row["Sex"]."</p>";
                            echo "<p>Date of Birth: ".$employee_row["DOB"]."</p>";
                            echo "<p>Address: ".$employee_row["Address"]."</p>";
                            echo "<p>Salary: $".$employee_row["Salary"]."</p>";
                            echo "<p>Department: ".$employee_row["DName"]."</p>";
                            break;
                        }
                        echo "<p class='top_links'><a href='employeeLookup.html' class='topLink'>Go Back</a></p>";
                    }
                }
            }
        ?>
    </body>
</html>