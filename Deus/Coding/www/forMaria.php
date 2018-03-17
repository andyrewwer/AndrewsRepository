<body style="background-image:url( <?php 
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_demo") or die(mysql_error());
$result = $con->query("SELECT * FROM `GlobalVariables` WHERE `VariableName` = 'backgroundImage'");
while($row = $result->fetch_assoc()) {
echo $row['VariableValue'];
}

?>); background-repeat: repeat">