<?php include 'preHeaderFrontroom.php';include 'header.php';?>
<?php 	
	echo "<h3>Please write your response</h3>";
	echo "<div class='jumbotron col-xs-12 col-sm-12' id='jumbotron'>";
	
	$result = $con->query("SELECT * FROM Responses WHERE `responseID` = " . $_POST['responseNumber']);
	if ($result->num_rows > 0) {	
	     while($row = $result->fetch_assoc()) {
	     	echo "<br><i>" . $row['Directive'];
	     	echo "</i><br><br>";
	     	echo "<p>" . $row['Response'] . ": </p><b>" . $row['responseDescription'] . "</b>";
	     }
	 }
?>
<br><br><br>
<label class=" control-label" for="description"><i>Response:</i></label>
<div style="padding-left: 30px">
	<p> Make sure to specify as much detail as possible to ensure succesful completion of your intended action.</p>   
			<form method="POST" action="telegramAcceptance.php" role="form" `class="form-horizontal">						<!-- Form Name --> 
		<textarea class="form-control" id="description" name="description" style="height: 250px;"><?php   echo $_COOKIE["respond"]; ?></textarea>
			<input type='hidden' name='responseNumber' value='<?php echo $_POST['responseNumber'];?>'>
			<input type='hidden' name='directiveNumber' value='<?php echo $_POST['directiveNumber'];?>'>
			<div class="wrapper"></br>
			<button type="submit" id="singlebutton" name="superResonspe" class="btn btn-primary ">Submit</button></div>
					</div>
	</form>
</div>
</body>


