<?php include 'header.php';?> 		
	<h3> Delegate Feedback </h3>
	<h3 id="appendMe" style='float:left'> 
	<div class="col-xs-12 col-sm-12 sidebarJS " id="alreadyAThing">
	<div>
	<div class="list-group" id="listgroupJSItem">
	<h4 style="	text-align: center;"> Feedback: </h4>
	<?php 
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test") or die(mysql_error());
		$result = $con->query("SELECT * FROM Feedback ORDER BY ID ASC");
		echo "<br>";
		if ($result->num_rows > 0) {
			$current = 0;
			$myArray = array();
			while($row = $result->fetch_assoc()) {
				$element = "<tr> <td>" . $row["ID"]. "</td><td>" . $row["Username"]. "</td><td>" . $row["Q1"] . "</td><td>" . $row["Q2"] . "</td><td >" . $row['Q3'] . "</td><td >". $row['Q4'] ."</td><td>" . $row["Q5"] . "</td><td>" . $row["Q6"] . "</td><td>" . $row["Q7"] . "</td><td>" . $row["Q8"] . "</td></tr>"; // Add directiveFROM
				$myArray[] = $element;
			}
			$myArray = array_reverse($myArray);
	

			 if ($current !== 0) {
				//  echo "<form method='POST' action='backroomReserve.php' role='form' class='form-horizontal'>
			 // 		<input type='hidden' name='directiveNumber' value=" . $current . ">
							// <button type='submit' id='singlebutton' name='submit' class='btn btn-primary' >Reserve Directive Number " . $current . "</button> </form> <br>";		     	
			 }
			echo "<table > <thead><tr> <th >ID</th><th>Email     </th><th>Did you find the system easy and intuitive to use?     </th><th>If you have used any previous Crisis systems, which one did you use and what did you prefer about them?     </th><th>What did you prefer about muncrisis.com?     </th> <th>Please name your favorite thing about this website:</th> <th>Please name your least favorite thing:     </th><th>Please list any bugs / difficulties you may have experienced (other than slow responses to directives):</th><th>Would you recommend that other conferences use muncrisis.com?     </th><th>Do you want to discuss using muncrisis.com at your conference with the muncrisis.com team? (If so please enter the best means to contact you; ideally an email address) </th></tr></thead><tbody>";		

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
