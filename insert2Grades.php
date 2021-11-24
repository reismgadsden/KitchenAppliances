<html>
<body>

<?php 
    include("./connection.php");
      
	$name = $_GET["name"];
	$grade = $_GET["grade"];

	$sql = "INSERT INTO StudentGrade values ('".$name."',".$grade.")";

	if ($mysqli_conn->query($sql) === TRUE) {
    		echo "New record created successfully";
            echo $name;
	} else if ($name || $grade) {
	    echo "Error: " . $sql . "<br>" . $mysqli_conn->error;
	}
	
	$mysqli_conn->close();
?> 

<br>
Sort by: <a href="sort.php?sort=name">Names</a> OR <a href="sort.php?sort=grade">Grades</a>

</body>
</html>

