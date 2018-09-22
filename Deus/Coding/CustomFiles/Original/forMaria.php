<body style="background-image:url( <?php 
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_demo") or die(mysql_error());
$result = $con->query("SELECT * FROM `GlobalVariables` WHERE `VariableName` = 'backgroundImage'");
while($row = $result->fetch_assoc()) {
echo $row['VariableValue'];
}

?>); background-repeat: repeat">