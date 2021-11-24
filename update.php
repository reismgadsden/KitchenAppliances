<html>
<body>

<form action="update.php" method="get">
Name: <input type="text" name="student_name">
<input type="Submit" value="Search">
</form>

<?php 
      	include("connection.php");
      
	$searchkey = $_GET["student_name"];

	$sql = "SELECT * FROM Grades where student_name='".$searchkey."'";
	$result = $mysqli_conn->query($sql);

	if ($result->num_rows > 0) {
	    
	    $row = $result->fetch_assoc();
	   
	    $stu_name = $row["student_name"];
	    $stu_grade = $row["grade"];
	}
	
	$mysqli_conn->close();
?> 

<form action="update_action.php" method="get">
Name: <input type="text" name="student_name" value="<?php echo $stu_name ?>"><br>
Grade: <input type="text" name="grade" value="<?php echo $stu_grade ?>">
<input type="Submit" value="Update">
</form>


</body>
</html>
