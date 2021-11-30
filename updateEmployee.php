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
        
            $ssn = $_GET["ssn"];
            $addy = $_GET["addy"];
            $salary = $_GET["salary"];
            $dept = $_GET["dept"];
            $mgmt = $_GET["mgmt"];
        
            if (!isset($ssn) || trim($ssn) == "") {
                echo "<h1 class='bodyText'>SSN is needed for update. Please go back and try again.</h1><br/><p class='top_links'><a href='updateEmployee.html' class='topLink'>Go Back</a></p>";
            }
            elseif((!isset($addy) || trim($addy) == "") && (!isset($salary) || trim($salary) == "") && (!isset($dept) || trim($dept) == "") && (!isset($mgmt) || trim($dept) == "") && !isset($mgmt)){
                echo "<h1 class='bodyText'>At least on field is needed for update. Please go back and try again.</h1><br/><p class='top_links'><a href='updateEmployee.html' class='topLink'>Go Back</a></p>";
            }
            else {
                $emp_check_query = "SELECT * FROM Employee WHERE SSN=\"".$ssn."\";";
                $emp_check = $mysqli_conn->query($emp_check_query);
                
                if ($emp_check === false || $emp_check->num_rows == 0) {
                    echo "<h1 class='bodyText'>Employee with SSN \"".$ssn."\" does not exist.</h1><br/><p class='top_links'><a href='updateEmployee.html' class='topLink'>Go Back</a></p>";
                }
                else {
                    $check_department = "SELECT d.DName FROM Department AS d WHERE UPPER(d.DName) LIKE UPPER(\"".$dept."\");";
                    $check_department_result = $mysqli_conn->query($check_department);

                    if (isset($dept) && trim($dept) != "" && ($check_department_result === false || $check_department_result->num_rows == 0)) {
                        echo "<h1 class='bodyText'>Department does not exist. Please go back and try again. The current departments are: Appliances, Silverware, Tableware, Cookware, Delivery, Sales, Headquarters;</h1><br/><p class='top_links'><a href='updateEmployee.html' class='topLink'>Go Back</a></p>";
                    }
                    elseif (preg_match("/^[0-9]+(.)[0-9][0-9]$/", $salary) !== 1 && (isset($salary) && trim($salary) != "")) {
                        echo "<h1 class='bodyText'>Salary field is formatted incorrectly. Please go back and try again.</h1><br/><p class='top_links'><a href='updateEmployee.html' class='topLink'>Go Back</a></p>";
                    }
                    else {
                        echo "<h1 class='bodyText'>Succesfully updated employee \"".$ssn."\".</h1><br/>";
                        if(isset($addy) && trim($addy) != "") {
                            $addy_sql_query = "SELECT e.Address FROM Employee as e WHERE e.SSN=\"".$ssn."\";";
                            $addy_sql = $mysqli_conn->query($addy_sql_query);
                            $old_addy = "";
                            while($old_addy_row = $addy_sql->fetch_assoc()){
                                $old_addy = $old_addy_row["Address"];
                                break;
                            }
                            echo "<p>UPDATED ADDRESS: ".$old_addy." -> ".$addy."</p>";

                            $update_query = "UPDATE Employee SET Address=\"".$addy."\" WHERE SSN=\"".$ssn."\";";
                            $mysqli_conn->query($update_query);
                        }
                        if(isset($salary) && trim($salary) != "") {
                            $salary_sql_query = "SELECT e.Salary FROM Employee as e WHERE e.SSN=\"".$ssn."\";";
                            $salary_sql = $mysqli_conn->query($salary_sql_query);
                            $old_salary = "";
                            while($old_salary_row = $salary_sql->fetch_assoc()){
                                $old_salary = $old_salary_row["Salary"];
                                break;
                            }
                            echo "<p>UPDATED SALARY: $".$old_salary." -> $".$salary."</p>";

                            $update_query = "UPDATE Employee SET Salary=".(double)$salary." WHERE SSN=\"".$ssn."\";";
                            $mysqli_conn->query($update_query);
                        }
                        if(isset($dept) && trim($dept) != "") {
                            $dno_query = "SELECT d.DNumber FROM Department as d WHERE UPPER(d.DName) LIKE UPPER(\"".$dept."\")";
                            $dno_result = $mysqli_conn->query($dno_query);
                            $dno = null;
                            while($dno_row = $dno_result->fetch_assoc()) {
                                $dno = $dno_row["DNumber"];
                                break;
                            }
                            
                            $dept_sql_query = "SELECT d.DName FROM Employee as e, Department as d WHERE e.SSN=\"".$ssn."\" AND e.dno=d.DNumber;";
                            $dept_sql = $mysqli_conn->query($dept_sql_query);
                            $old_dept = "";
                            while($old_dept_row = $dept_sql->fetch_assoc()){
                                $old_dept = $old_dept_row["DName"];
                                break;
                            }
                            echo "<p>UPDATED DEPARTMENT: ".$old_dept." -> ".$dept."</p>";

                            $update_query = "UPDATE Employee SET Dno=".(int)$dno." WHERE SSN=\"".$ssn."\";";
                            $mysqli_conn->query($update_query);
                        }
                        if ($mgmt === "t") {
                            $dno_query = "SELECT e.Dno FROM Employee as e WHERE e.ssn=\"".$ssn."\";";
                            $dno_result = $mysqli_conn->query($dno_query);
                            $dno = null;
                            while($dno_row = $dno_result->fetch_assoc()) {
                                $dno = $dno_row["Dno"];
                                break;
                            }
                            
                            echo "<p>UPDATED POSITION: MANAGER</p>";
                            
                            $update_query = "UPDATE Department SET Manager_SSN=\"".$ssn."\" WHERE DNumber=".(int)$dno.";";
                            $mysqli_conn->query($update_query);
                        }
                        echo "<p class='top_links'><a href='updateEmployee.html' class='topLink'>Go Back</a></p>";
                    }
                }
            }
        ?>
    </body>
</html>