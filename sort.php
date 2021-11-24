<html>
<body>

<?php 
      	include("connection.php");
      
	$sort = $_GET["sort"];
    echo $sort;
	$sql = "SELECT * FROM StudentGrade order by ".$sort;
	$result = $mysqli_conn->query($sql);
	if ($result !== false && $result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo "Name: " . $row["name"]. " grade: " . $row["grade"]."<br>";
	    }
	}
	
	$mysqli_conn->close();
?> 

Sort by: <a href="sort.php?sort=name">Names</a> OR <a href="sort.php?sort=grade">Grades</a>

<br>
    
<a href = "insertForm.html">Insert More Values</a>
    
</body>
</html>
