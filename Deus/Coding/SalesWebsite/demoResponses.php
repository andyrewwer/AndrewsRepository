<?php include 'header.php';?> 		
	<h3> Sales Form </h3>
	<h3 id="appendMe" style='float:left'> 
	<div class="col-xs-12 col-sm-12 sidebarJS " id="alreadyAThing">
	<div>
	<div class="list-group" id="listgroupJSItem">
	<h4 style="	text-align: center;"> DEMO INTEREST STUFF: </h4>
	<?php 
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_test") or die(mysql_error());
		$result = $con->query("SELECT * FROM DemoInterest");
		echo "<br>";
		if ($result->num_rows > 0) {
			$current = 0;
			$myArray = array();
			while($row = $result->fetch_assoc()) {
				$element = "<tr> <td  width='5%'>" . $row["ID"]. "</td><td width='20%'>" . $row["Q1"] . "</td><td width='15%'>" . $row["Q2"] . "</td><td width='20%'>" . $row['Q3'] . "</td><td width='20%' >". $row['Slot'] ."</td><td width='20%'>" . $row["Q4"] . "</td width='20%'></tr>"; // Add directiveFROM
				$myArray[] = $element;
			}
			$myArray = array_reverse($myArray);
	

			 if ($current !== 0) {
				//  echo "<form method='POST' action='backroomReserve.php' role='form' class='form-horizontal'>
			 // 		<input type='hidden' name='directiveNumber' value=" . $current . ">
							// <button type='submit' id='singlebutton' name='submit' class='btn btn-primary' >Reserve Directive Number " . $current . "</button> </form> <br>";		     	
			 }
			echo "<table > <thead><tr> <th width='5%'> ID</th><th width='20%'>Name     </th><th width='15%'>Email    </th><th width='20%'>Society, Conference, or UNA </th><th width='20%'>Which slot?     </th> <th width='20%'>Other comments</th> </tr></thead><tbody>";		

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
