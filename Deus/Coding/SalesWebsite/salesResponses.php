<?php include 'header.php';?> 		
	<h3> Sales Form </h3>
	<h3 id="appendMe" style='float:left'> 
	<div class="col-xs-12 col-sm-12 sidebarJS " id="alreadyAThing">
	<div>
	<div class="list-group" id="listgroupJSItem">
	<h4 style="	text-align: center;"> SALES: </h4>
	<?php 
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_test") or die(mysql_error());
		$result = $con->query("SELECT * FROM Sales");
		echo "<br>";
		if ($result->num_rows > 0) {
			$current = 0;
			$myArray = array();
			while($row = $result->fetch_assoc()) {
				$element = "<tr> <td>" . $row["ID"]. "</td><td>" . $row["Q1"] . "</td><td>" . $row["Q2"] . "</td><td >" . $row['Q3'] . "</td><td >". $row['Q4'] ."</td><td>" . $row["Q5"] . "</td><td>" . $row["Q6"] . "</td><td>" . $row["Q7"] . "</td><td>" . $row["Q8"] . "</td></tr>"; // Add directiveFROM
				$myArray[] = $element;
			}
			$myArray = array_reverse($myArray);
	

			 if ($current !== 0) {
				//  echo "<form method='POST' action='backroomReserve.php' role='form' class='form-horizontal'>
			 // 		<input type='hidden' name='directiveNumber' value=" . $current . ">
							// <button type='submit' id='singlebutton' name='submit' class='btn btn-primary' >Reserve Directive Number " . $current . "</button> </form> <br>";		     	
			 }
			echo "<table > <thead><tr> <th> ID</th><th>Name     </th><th>Email    </th><th>Conference name and dates     </th><th>How many total dels     </th> <th>How many crisis users (delegates + staff)</th> <th>What is your registration fee?</th><th>How did you hear about Deus?</th><th>Any other commens or qeustion  </th></tr></thead><tbody>";		

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
