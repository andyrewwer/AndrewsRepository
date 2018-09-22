<?php include 'preHeaderBackroom.php';include 'header.php';

	$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
	$result = $con->query("SELECT * FROM `GlobalVariables` WHERE `VariableName` = 'GoogleDoc'");
	while($row = $result->fetch_assoc()) {
		echo "<iframe width='100%' height='1000px' src=".$row['VariableValue']."></iframe>";
	}
?>


</body>
