<?php include 'preHeaderFrontroom.php';include 'header.php';?>	 	
	<h3> Sent Directives</h3>
	<h3 id="appendMe" style='float:left'> 
	<div class="col-xs-12 col-sm-12 sidebarJS " id="alreadyAThing">
	<div class="list-group" id="listgroupJSItem">
	<h4 style="	text-align: center;"> Your sent directives </h4>
	<?php 
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
		$result = $con->query("SELECT * FROM Directives WHERE DirectiveSender like '%".$_COOKIE['user']."%'"); 
		if ($result->num_rows > 0) {
			$current = 0;
			$myArray = array();
			while($row = $result->fetch_assoc()) {
				$current++;
				$element = "<tr><td width='100px'>" . $row["Timestamp"]. "</td> <td width='95px'>" . $current. "</td><td width='130px'>". $row["DirectiveFrom"] ."</td><td width='165px'>" . $row["DirectiveType"] . "</td><td width='510px'>" . $row["DirectiveText"] ."</td></tr>"; // Add directiveFROM
				if ($row['Status'] === 'Rejected') {
					$element = "<tr style='color:#ffffff; background-color:#ff0000;'><td width='100px'>" . $row["Timestamp"]. "</td> <td width='95px'>" . $current. "</td><td width='130px'>". $row["DirectiveFrom"] ."</td><td width='165px'>" . $row["DirectiveType"] . "</td><td width='510px'>" . $row["DirectiveText"] ."</td></tr>"; // Add directiveFROM					
				}
				$myArray[] = $element;
			}
				$myArray = array_reverse($myArray);


			 if ($current !== 0) {
				//  echo "<form method='POST' action='backroomReserve.php' role='form' class='form-horizontal'>
			 // 		<input type='hidden' name='directiveNumber' value=" . $current . ">
							// <button type='submit' id='singlebutton' name='submit' class='btn btn-primary' >Reserve Directive Number " . $current . "</button> </form> <br>";		     	
			 }
			echo "<table id='directives' class='directiveTable'> <thead id='directives'><tr id='head'> <th width='100px'>Timestamp</th> <th width='95px'>Directive #</th><th width='130px'>Directive Sender</th><th width='165px'>Directive Type</th> <th width='510px'>Directive Text</th></tr></thead><tbody id='directives' class='directiveTable'>";		

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
