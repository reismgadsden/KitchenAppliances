<html>
    <head>
        <link rel="stylesheet" href="landingstyle.css">
        <title>Insert New Item</title>
    </head>
    <body>
        <p class="top_links"><a href="index.html" class="topLink">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Product Search</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Order Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="topLink">Employee Look-Up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin.html" class="topLink">Admin</a></p>

        <?php
            include("./connection.php");
        
            $name = $_GET["name"];
            $sex = $_GET["sex"];
            $dob = $_GET["dob"];
            $addy = $_GET["addy"];
            $ssn = $_GET["ssn"];
            $dname = $_GET["dname"];
            $salary = $_GET["salary"];
        
            if (!isset($name) || !isset($sex) || !isset($dob) || !isset($addy) || !isset($ssn) || !isset($dname) || !isset($salary) || trim($name) == '' || trim($sex) == '' || trim($dob) == '' || trim($addy) == '' || trim($ssn) == '' || trim($dname) == '' || trim($dname) == '') {
                echo "<h1 class='bodyText'>Required field(s) missing. Please go back and try again.</h1><br/><p class='top_links'><a href='insertEmployee.html' class='topLink'>Go Back</a></p>";
            }
            else {

                
                if (preg_match("/^[mfnMFN]{1}$/", $sex) !== 1) {
                    echo "<h1 class='bodyText'>Sex field is formatted incorrectly. Please go back and try again.</h1><br/><p class='top_links'><a href='insertEmployee.html' class='topLink'>Go Back</a></p>";
                }
                
                elseif (preg_match("/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/", $dob) !== 1) {
                    echo "<h1 class='bodyText'>Date of Birth field is formatted incorrectly. Please go back and try again.</h1><br/><p class='top_links'><a href='insertEmployee.html' class='topLink'>Go Back</a></p>";
                }
                
                elseif (preg_match("/^[0-9]{9}$/", $ssn) !== 1) {
                    echo "<h1 class='bodyText'>SSN field is formatted incorrectly. Please go back and try again.</h1><br/><p class='top_links'><a href='insertEmployee.html' class='topLink'>Go Back</a></p>";
                }
                
                elseif (preg_match("/^[0-9]+(.)[0-9][0-9]$/", $salary) !== 1) {
                    echo "<h1 class='bodyText'>Salary field is formatted incorrectly. Please go back and try again.</h1><br/><p class='top_links'><a href='insertEmployee.html' class='topLink'>Go Back</a></p>";
                }
                //all input is valid
                else {
                    $check_department = "SELECT d.DName FROM department AS d WHERE UPPER(d.DName) LIKE UPPER(\"".$dname."\");";
                    $check_department_result = $mysqli_conn->query($check_department);

                    if ($check_department_result === false || $check_department_result->num_rows == 0) {
                        echo "<h1 class='bodyText'>Department does not exist. Please go back and try again.</h1><br/><p class='top_links'><a href='insertEmployee.html' class='topLink'>Go Back</a></p>";
                    }
                    
                    else {
                        
                        $dno_query = "SELECT d.DNumber FROM Department as d WHERE UPPER(d.DName) LIKE UPPER(\"".$dname."\")";
                        $dno_result = $mysqli_conn->query($dno_query);
                        while($dno_row = $dno_result->fetch_assoc()) {
                            $dno = $dno_row["DNumber"];
                            $insert_query = "INSERT INTO Employee VALUES (\"".$sex."\", \"".$dob."\", ".(int)$ssn.", \"".$addy."\", ".(double)$salary.", ".(int)$dno.", \"".$name."\");";
                            if ($mysqli_conn->query($insert_query) == true) {
                                echo "<h1 class='bodyText'>Item inserted succesfully</h1><br/><p class='top_links'><a href='insertEmployee.html' class='topLink'>Insert More</a></p>";
                                break;
                            }
                        }
                    }
                } 
            }
        ?>
    </body>
</html>