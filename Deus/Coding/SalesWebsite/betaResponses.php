<?php include 'header.php';?> 		
	<h3> Beta Form </h3>
	<h3 id="appendMe" style='float:left'> 
	<div class="col-xs-12 col-sm-12 sidebarJS " id="alreadyAThing">
	<div>
	<div class="list-group" id="listgroupJSItem">
	<h4 style="	text-align: center;"> BETA FORM: </h4>
	<?php 
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_data") or die(mysql_error());
		$result = $con->query("SELECT * FROM DeusMailingList");
		echo "<br>";
		if ($result->num_rows > 0) {
			$current = 0;
			$myArray = array();
			while($row = $result->fetch_assoc()) {
				$element = "<tr> 
				<td  width='10%'>" . $row["ID"]. "</td>
				<td width='30%'>" . $row["Name"] . "</td>
				<td width='60%'>" . $row["Email"] . "</td>
				</tr>"; // Add directiveFROM
				$myArray[] = $element;
			}
			$myArray = array_reverse($myArray);

			echo "<table > <thead>
			<tr> 
			<th width='10%'> ID</th>
			<th width='40%'>Name     </th>
			<th width='60%'>Email    </th>
			</tr>
			</thead><tbody>";		

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
