<?php include 'preHeaderFrontroom.php';include 'header.php';?>

	<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd;'> 

	<?php 
		if (isset($_GET['message'])) {
		    $message = $_GET['message'];
		    if ($message === "approved") {
				echo "<script> var alert = new telegramAlert(); alert.render('Directive Approved ', 'The directive has been sucessfully sent to the backroom.'); makeTelegramGreen(); </script>";
		    }else if ($message === "rejected") {
				echo "<script> var alert = new telegramAlert(); alert.render('Directive Rejected', 'The directive has been rejected. The sending delegates can find it in their sent directive tab and you can suggest edits there. The Backroom has not been notified.'); </script>";
		    }else if ($message === "oops") {
				echo "<script> var alert = new telegramAlert(); alert.render('Oops!', 'You reached that page by accident.'); </script>";
		    }else if ($message === "error"){
				echo "<script> var alert = new telegramAlert(); alert.render('Error submitting directive', 'Sorry there was an error submitting your directive! Please try again in just a few moments.'); </script>";
			}
		} 
   	?>
   	</h4>
		<h3> Respond to Delegates </h3>
	<h3 id="appendMe" style='float:left'> 
	<div class="col-xs-12 col-sm-12 sidebarJS " id="alreadyAThing">
	<div class="list-group" id="listgroupJSItem">
	<h4 style="	text-align: center;"> Delegate Directives: </h4>
	<?php 
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
		$queryTitle =  "SELECT * FROM Directives WHERE Status = 'Frozen' AND DirectiveCommittee = '".$_COOKIE['committee']."' ORDER BY DirectiveNumber";
		$result = $con->query($queryTitle);
		$cabinetResult = $con->query("SELECT * FROM Cabinets");
		$cabinetArray;
		while($row = $cabinetResult->fetch_assoc()) {
			$cabinetArray[$row['ID']] = $row['CabinetName'];
		}		
		if ($result->num_rows > 0) {
			$current = 0;
			$myArray = array();
			while($row = $result->fetch_assoc()) {
				$element = "<tr";
				$directiveText = $row['DirectiveText'];
				$element = $element . "> <td width='52px'>" . $row["DirectiveNumber"]. "</td><td width='100px'>" . $row["Timestamp"]. "</td><td width='160px'>". $row["DirectiveSenderName"] ."</td><td width='105px'>" . $cabinetArray[$row["DirectiveCommittee"]] . "</td><td width='120px'>" . $row["DirectiveType"] . "</td><td width='350px'>" . $directiveText . "</td><td width='180px'><form method='POST' action='directiveConfirmationAcceptance.php' role='form' class='form-horizontal'>
			  		<input type='hidden' name='directiveNumber' value=" . $row['DirectiveNumber'] . ">
							 <button type='submit' id='singlebutton' name='approve' class='btn btn-success' >Approve this directive</button><br><br><button type='submit' id='singlebutton' name='reject' class='btn btn-danger' >Reject this directive</button> </form></td></tr>"; // Add directiveFROM
				$myArray[] = $element;

				echo" <br>";
			}
			$myArray = array_reverse($myArray);
	


			echo "<table id='directives' class='responseTable'> <thead id='directives'><tr id='head'> <th width='52px'>#</th> <th width='100px'>Timestamp</th><th width='160px'>Character Name</th> <th width='105px'>Cabinet</th><th width='120px'>Request Type</th> <th width='350px'>Description</th> <th width='208px'>Action</th></tr></thead><tbody id='directives' class='responseTable'>";		

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



</body>
</html>
