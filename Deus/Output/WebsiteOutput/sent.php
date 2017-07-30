<?php include 'preHeaderBackroom.php';include 'header.php';?>

	<h3> Private Responses</h3>
	<h3 id="appendMe" style='float:left'> 
	<div class="col-xs-12 col-sm-12 sidebarJS " id="alreadyAThing">
	<div class="list-group" id="listgroupJSItem">
	<h4 style="	text-align: center;"> Responses to Delegates </h4>
	<?php 
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testDB") or die(mysql_error());
		$result = $con->query("SELECT * FROM Responses WHERE MassMessage = 'f' ORDER BY DirectiveNumber ASC");
		if ($result->num_rows > 0) {
			$current = 0;
			$myArray = array();
			while($row = $result->fetch_assoc()) {
				$element = "<tr";
				$DirectiveNumber = $row['DirectiveNumber'];
				if ($row['DirectiveNumber'] === '0') {
					$DirectiveNumber = 'PM';
				}
				$Directive = $row['Directive'];
				if ($row['Directive'] === 'NULL') { 
					$Directive = 'Direct Message. ';
				}
				$element = $element . "><td width='100px'>" . $row["Timestamp"]. "</td> <td width='95px'>" . $DirectiveNumber. "</td><td width='130px'>". $row["RecipientName"] ."</td><td width='165px'>" . $row["Response"] . "</td><td width='330px'>" . $row["responseDescription"] ."</td><td width='180px'>" . $Directive. "</td></tr>"; // Add directiveFROM
				$myArray[] = $element;
			}
			$myArray = array_reverse($myArray);
	

			 if ($current !== 0) {
				//  echo "<form method='POST' action='backroomReserve.php' role='form' class='form-horizontal'>
			 // 		<input type='hidden' name='directiveNumber' value=" . $current . ">
							// <button type='submit' id='singlebutton' name='submit' class='btn btn-primary' >Reserve Directive Number " . $current . "</button> </form> <br>";		     	
			 }
			echo "<table id='directives' class='responseTable'> <thead id='directives'><tr id='head'> <th width='100px'>Timestamp</th> <th width='95px'>Directive #</th><th width='130px'>Character Name</th><th width='165px'>ResponseTitle</th> <th width='330px'>ResponseText</th><th width='180px'>Original Directive</th></tr></thead><tbody id='directives' class='responseTable'>";		

			 foreach ($myArray as $element) {
				echo $element;
			 }
			 echo "</tbody>";
			 echo "</table>";
		}
	?>	
		</div>
		</div>
</h3>
	<!-- <div class='jumbotron col-xs-offset-1 col-sm-offset-1 col-xs-5 col-sm-6' id='jumbotron'> TESTWRTSD </div>
	 --></div>
			

</div>


	</body>



	
</html>
