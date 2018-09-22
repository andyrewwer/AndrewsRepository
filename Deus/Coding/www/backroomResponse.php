<?php 
$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
		$result = $con->query("SELECT * FROM Directives ");
			$tempFix = "UPDATE `Directives` SET `Status`='Available' WHERE Status = ''";
				$resultTempFix = mysqli_query($con, $tempFix);


		

			while($row = $result->fetch_assoc()) {
				if ($row['Status'] === "Completed" && $_GET['directive'] === $row['DirectiveNumber']) {
							$location = 'Location: sentMessages.php?directive=' . $_GET['directive'];	//only in backroom ROoms
						header($location);
				}else if (($row['Status'] === "Available" || $row['Status'] === $_COOKIE['user']) && $_GET['directive'] === $row['DirectiveNumber']){
						$location = 'Location: backroomReserve.php?directiveNumber=' . $_GET['directive'];
						header($location);	
				}
			}
include 'preHeaderBackroom.php';
include 'header.php';?>
	<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd;'>
<?php 
		if (isset($_GET['message'])) {
		$message = $_GET['message'];
			if ($message === "failure") {
			echo "<script> var alert = new telegramAlert(); alert.render('Sorry you do not have a directive reserved', 'Select one here; or choose to send a message to a delegate below!'); </script>";
			}else if ($message === "failure2") {
				echo "<script> var alert = new telegramAlert(); alert.render('You did not complete the form', 'Please finish filling it out!'); </script>";
			}else if ($message === "sent") {
				echo "<script> var alert = new telegramAlert(); alert.render('Successfully sent', 'Keep going!'); makeTelegramGreen(); </script>";
			}else if ($message === "admin") {
				echo "<script> var alert = new telegramAlert(); alert.render('You are not admin', 'Sorry you do not have permission to be there.'); </script>";
			}else if ($message === "unreserve") {
				echo "<script> var alert = new telegramAlert(); alert.render('Success', 'Directive successfully unreserved.'); makeTelegramGreen(); </script>";
			}else if ($message === "oops") {
				echo "<script> var alert = new telegramAlert(); alert.render('Oops', 'You reached that page by accident.'); </script>";
			}else if ($message === "error") {
				echo "<script> var alert = new telegramAlert(); alert.render('Sorry', 'There was an error with your request! Please wait a few moments and try again.'); </script>";
			}
		}
		 ?></h4>

	<h3 id=''> Respond to Delegates </h3>
	<!-- <h3 id="appendMe" style='float:left'>  -->
	<div class="col-xs-11 col-sm-11 col-md-11 sidebarJS" id="">
	<div class="list-group" id="appendMe">

	<h4 style="	text-align: center;"> Delegate Directives: </h4>
	<?php 
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
		$queryTitle =  "SELECT * FROM Directives";
		$started = 0; 

		if (isset($_GET['sortBy']) && is_numeric($_GET['sortBy'])) {
			$queryTitle = $queryTitle . " WHERE `DirectiveCommittee` = ".$_GET['sortBy']; 
			$started = 1;
		}else if (is_numeric($_COOKIE['sortBy'])) { 
			$queryTitle = $queryTitle . " WHERE `DirectiveCommittee` = ".$_COOKIE['sortBy']; 
			$started = 1;
			// $result = $con->query("SELECT * FROM Directives WHERE DirectiveCommittee = ".$_COOKIE['sortBy'] ." ORDER BY DirectiveNumber");
		}
		if ($_GET['showAll'] === 'N') {
			if ($started === 1)  { 
				$queryTitle = $queryTitle . " AND Status != 'Completed'"; 
			}else {
				$started = 1;
				$queryTitle = $queryTitle . " WHERE Status != 'Completed'"; 
			}
		}else if ($_COOKIE['showAll'] === 'N') {
			if ($started === 1)  { 
				$queryTitle = $queryTitle . " AND Status != 'Completed'"; 
			}else {
				$started = 1;
				$queryTitle = $queryTitle . " WHERE Status != 'Completed'"; 
			}
		}

		if ($started === 1)  { 
			$queryTitle = $queryTitle . " AND Status != 'Frozen' AND Status != 'Rejected'"; 
		}else {
			$started = 1;
			$queryTitle = $queryTitle . " WHERE Status != 'Frozen' AND Status != 'Rejected'"; 
		}
		$queryTitle = $queryTitle . " ORDER BY DirectiveNumber";

		$result = $con->query($queryTitle);


		$cabinetResult = $con->query("SELECT * FROM Cabinets");
		$cabinetArray;

/// HERE WE ARE MAKING THE BUTTONS FOR SORT BY  
		if ((!isset($_COOKIE['sortBy']) || $_GET['sortBy'] === 'all' || $_COOKIE['sortBy'] === 'all') && (!is_numeric($_GET['sortBy']))){
			echo "<br><form method='POST' action='backroomConfirmation.php' role='form' class='form-horizontal' >
			<button type='submit' id='singlebutton' name='sortBy' value='all' class='btn btn-info active' >Show all</button>      ";
			echo "<script> setCookie('sortBy', 'all'); </script>";
		}else {
			echo "<br><form method='POST' action='backroomConfirmation.php' role='form' class='form-horizontal' >
			<button type='submit' id='singlebutton' name='sortBy' value='all' class='btn btn-info' >Show all</button>      ";

		}
		if (isset($_GET['sortBy'])) {
			while($row = $cabinetResult->fetch_assoc()) {
				$true = 1;
				$cabinetArray[$row['ID']] = $row['CabinetName'];
				if (isset($_GET['sortBy'])) {
					if ($_GET['sortBy'] === $row['ID']){
						$true = 0;
						echo "<button type='submit' id='singlebutton' name='sortBy' value='".$row['ID']."' class='btn btn-default active' >".$row['CabinetName']."</button>      ";				
						echo "<script> setCookie('sortBy', '".$_GET['sortBy']."'); </script>";

					}
				}
				if ($true === 1) {
					echo "<button type='submit' id='singlebutton' name='sortBy' value='".$row['ID']."' class='btn btn-default' >".$row['CabinetName']."</button>      ";				
				}
			}		
		}else if (isset($_COOKIE['sortBy'])) {
			while($row = $cabinetResult->fetch_assoc()) {
				$true = 1;
				$cabinetArray[$row['ID']] = $row['CabinetName'];
				if (isset($_COOKIE['sortBy'])) {
					if ($_COOKIE['sortBy'] === $row['ID']){
						$true = 0;
						echo "<button type='submit' id='singlebutton' name='sortBy' value='".$row['ID']."' class='btn btn-default active' >".$row['CabinetName']."</button>      ";				
						echo "<script> setCookie('sortBy', '".$_COOKIE['sortBy']."'); </script>";

					}
				}
				if ($true === 1) {
					echo "<button type='submit' id='singlebutton' name='sortBy' value='".$row['ID']."' class='btn btn-default' >".$row['CabinetName']."</button>      ";				
				}
			}
		}else { 
			while($row = $cabinetResult->fetch_assoc()) {
				$cabinetArray[$row['ID']] = $row['CabinetName'];
					echo "<button type='submit' id='singlebutton' name='sortBy' value='".$row['ID']."' class='btn btn-default' >".$row['CabinetName']."</button>      ";				
			}
		}
		
		echo "</form>";
		echo "<br>";
// /// HERE WE ARE MAKING THE BUTTONS FOR SHOW ALL OR ONLY SHOW COMPLETED 
		if ((!isset($_COOKIE['showAll']) || $_GET['showAll'] === 'Y' || $_COOKIE['showAll'] === 'Y') && ($_GET['showAll'] !== 'N')){
			echo "<br><form method='POST' action='backroomConfirmation.php' role='form' class='form-horizontal'>
			<button type='submit' id='singlebutton' name='showAll' value='all' class='btn btn-info active' >Show all</button>      ";
			echo "<script> setCookie('showAll', 'Y'); </script>";
		}else {
			echo "<br><form method='POST' action='backroomConfirmation.php' role='form' class='form-horizontal'>
			<button type='submit' id='singlebutton' name='showAll' value='all' class='btn btn-info' >Show all</button>      ";

		}
		if (($_GET['showAll'] === 'N' || $_COOKIE['showAll'] === 'N') && $_GET['showAll'] !== 'Y'){
			echo "<button type='submit' id='singlebutton' name='showAll' value='N' class='btn btn-default active' > Only Show Uncompleted</button>      ";	


			echo $_COOKIE['showAll'];			
			echo "<script> setCookie('showAll', 'N'); </script>";
			echo $_COOKIE['showAll'];			
		}else {
			echo "<button type='submit' id='singlebutton' name='showAll' value='N' class='btn btn-default' > Only Show Uncompleted</button>      ";					
		}


		echo "</form>";
		echo "<br>";


		if ($result->num_rows > 0) {
			$current = 0;
			$myArray = array();
			while($row = $result->fetch_assoc()) {
				$element = "<tr onclick='clickTableRow(" .$row["DirectiveNumber"] . ")' ";
				$rowIsAvailable = "FALSE";
				if ($_GET['directive'] === $row['DirectiveNumber'] ) {
					if ($row['Status'] === "Available") {
						$current = $_GET['directive'];
						$rowIsAvailable = "TRUE";
						$element = $element . "style='color:#ffffff; background-color:#337ab7;'";
						 echo "<br><form method='POST' action='backroomReserve.php' role='form' class='form-horizontal'>
					<input type='hidden' name='directiveNumber' value=" . $current . ">
							<button type='submit' id='singlebutton' name='submit' class='btn btn-primary' >Reserve Directive Number " . $current . "</button> </form> <br>";		     	
					}else if ($row['Status'] === $_COOKIE['user']){
						$current = $_GET['directive'];
						$rowIsAvailable = "TRUE";
						$element = $element . "style='color:#ffffff; background-color:#337ab7;'";
						 echo "<br><form method='POST' action='backroomReserve.php' role='form' class='form-horizontal'>
					<input type='hidden' name='directiveNumber2' value=" . $current . ">";
							// <button type='submit' id='singlebutton' name='unreserve' class='btn btn-warning' >Unreserve Directive Number " . $current . "</button> </form> <br>";	
					}else if ($row['Status'] === "Completed") {
						echo "<br><p style='color:#ddd'>This Directive has already been completed.</p><br>";  
					}else {
						echo "<br> <h6>Sorry! <b>" . $row['StatusName'] . "</b> has reserved this directive.</h6><br> ";
						if ($_COOKIE['isBackroom'] === 'a') {
							$current = $_GET['directive'];
							$rowIsAvailable = "TRUE";
							$element = $element . "style='color:#ffffff; background-color:#337ab7;'";
							 echo "<br><form method='POST' action='backroomAcceptance.php' role='form' class='form-horizontal'>
						<input type='hidden' name='directiveNumber' value=" . $current . ">
								<button type='submit' id='singlebutton' name='unreserve' class='btn btn-danger' >ADMIN: Unreserve Directive Number " . $current . ". From: ". $row['StatusName']."</button> </form> <br>";		    					
						}
					}
					echo "<br>";

				}if ($rowIsAvailable === "FALSE"){
					if ($row['Status'] === "Available") {
						if (strpos($row['DirectiveType'], 'RESPONSE') !== false){
							$element = $element . "style='color:#ffffff; background-color:#7F00FF;'";
						}else {
							$element = $element . "style=' background-color:". $row["DirectiveColour"].";'";	
						}	    			
					}else { 
						$element = $element . "style='color:#ffffff; background-color:". $row["DirectiveColour"].";'";
					}
				}
				$directiveText = $row['DirectiveText'];
				if (strlen($directiveText) > 280 && $_GET['directive'] !== $row['DirectiveNumber']) {
					$directiveText = substr($directiveText, 0, 280) . "<i> ... [Reserve to read end of directive]</i>";
				}
				$element = $element . "> <td width='3.5%'>" . $row["DirectiveNumber"]. "</td><td width='8%'>" . $row["Timestamp"]. "</td><td width='12%'>". $row["DirectiveSenderName"] ."</td><td width='9.5%'>" . $cabinetArray[$row["DirectiveCommittee"]] . "</td><td width='8%'>" . $row["DirectiveType"] . "</td><td width =10%>" . $row["DirectiveFrom"] . "</td><td width='30%'>" . $directiveText . "</td><td width='13%'>". $row['StatusName'] ."</td></tr>"; // Add directiveFROM
				$myArray[] = $element;
			}
			$myArray = array_reverse($myArray);
	

			 if ($current !== 0) {
				//  echo "<form method='POST' action='backroomReserve.php' role='form' class='form-horizontal'>
			 // 		<input type='hidden' name='directiveNumber' value=" . $current . ">
							// <button type='submit' id='singlebutton' name='submit' class='btn btn-primary' >Reserve Directive Number " . $current . "</button> </form> <br>";		     	
			 }
			echo "<table id='directives' class='responseTable'> <thead><tr> <th width='3.5%'>#</th> <th width='8%'>Timestamp</th><th width='16%'>Character Name</th> <th width='9.5%'>Cabinet</th><th width='10%'>Request Type</th><th width='10%'>From </th><th width='35%'>Description</th> <th width='13%'>Status</th></tr></thead><tbody id='directives' class='responseTable'>";		

			 foreach ($myArray as $element) {
				echo $element;
			 }
			 echo "</tbody>";
			 echo "</table>";
		}
	?>	
		</div>
		</div>
	<!-- <div class='jumbotron col-xs-offset-1 col-sm-offset-1 col-xs-5 col-sm-6' id='jumbotron'> TESTWRTSD </div>
	 --></div>
			

</div>
			<div class='jumbotron col-xs-11 col-sm-11 privateEmail'>
			<h3 style='color:#555'>Send Message: (Select a character or cabinet)</h3><br>
			<div class= 'col-xs-6 col-sm-3 list-group' id='listgroupJSItem'>
			<?php 
			if (isset($_GET['cabinet']) || isset($_GET['email']) || isset($_GET['public'])) {
				if ($_GET['cabinet'] === 'p') {
					$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
					$result = $con->query("SELECT * FROM Cabinets ORDER BY CabinetName");
					if ($result->num_rows > 0) {
						 echo "<a class='list-group-item titleUnderline' href='backroomResponse.php'>Back</a>";
					
						while($row = $result->fetch_assoc()) 
						{	
							if ($row['ID'] === $_GET['public']) {
								$arrayElement = "<a class='list-group-item active' href='backroomResponse.php?public="  . $row["ID"] . "'> " . $row["CabinetName"] . " </a> ";

							 }else {
								$arrayElement = "<a class='list-group-item' href='backroomResponse.php?public="  . $row["ID"] . "'> " . $row["CabinetName"] . " </a> ";
							}
							  echo $arrayElement;
						}
							$arrayElement = "<a class='list-group-item' href='backroomResponse.php?public=p' style='background-color:#00ff00;'> Publish News </a> ";
							  echo $arrayElement;
					}//send Public Announcement! 
				}else if (isset($_GET['public'])) {
					$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
					$result = $con->query("SELECT * FROM Cabinets ORDER BY CabinetName");
					$theVariable = 'p';
					if ($result->num_rows > 0) {
						 echo "<a class='list-group-item titleUnderline' href='backroomResponse.php'> <b>Back</b></a>";
					$responseTitle = "";
					$responseText  = "";
					$responseImage  = "";
					if (isset($_COOKIE['responseTitle'])) {
						$responseTitle = $_COOKIE['responseTitle'];
					}if (isset($_COOKIE['responseText'])) {
						$responseText = $_COOKIE['responseText']; 
					}
					if (isset($_COOKIE['responseText'])) {
						$responseImage = $_COOKIE['responseImage']; 
					}
					while($row = $result->fetch_assoc()) 
					{	
						if ($row['ID'] === $_GET['public']) {
							$arrayElement = "<a class='list-group-item active' href='backroomResponse.php?public="  . $row["ID"] . "'> " . $row["CabinetName"] . " </a> ";
							$theVariable = $row['ID'];
						}else {
							$arrayElement = "<a class='list-group-item' href='backroomResponse.php?public="  . $row["ID"] . "'> " . $row["CabinetName"] . " </a> ";
						}
						  echo $arrayElement;
						}
						if ($theVariable === 'p') {
							$arrayElement = "<a class='list-group-item active' href='backroomResponse.php?public=p'> Publish News </a> ";
							  echo $arrayElement;
							  echo "</div>
					<div class= 'col-xs-6 col-sm-9'> 
					<p><b>Public</b> Response Title:</p>    
					<form method='POST' action='backroomAcceptance.php' role='form' `class='form-horizontal'>	 
						<input type='hidden' name='recipientCabinet' value=" . $theVariable . ">";
					echo "<textarea class='form-control' id='description' name='title' style='height: 50px;' placeholder='The subject/title of the personal response should go here.'>". $responseTitle."</textarea>
					<br><p><b>Public</b> Response Text</p>     
					<textarea class='form-control' id='description' name='description' style='height: 250px;' placeholder='The main text of the directive goes here.'>". $responseText ."</textarea>
					<br><p>News image (Optional)</p>     
		<textarea class='form-control' id='description' name='image' style='height: 50px;' placeholder='If you want an image please add the link here (any link ending in .png or .jpg).'>". $responseImage . "</textarea>
		 <br><br>					<br>
					<button style='float: left; margin-left:25px;' type='submit' id='singlebutton' name='publicMessage' class='btn btn-primary'>Publish </button>

					</form>";


						}else {
							$arrayElement = "<a class='list-group-item' href='backroomResponse.php?public=p' style='background-color:#00ff00;'> Publish News </a> ";
							  echo $arrayElement;

							  echo "</div>
					<div class= 'col-xs-6 col-sm-9'> 
					<p><b>Public</b> Response Title:</p>    
					<form method='POST' action='backroomAcceptance.php' role='form' `class='form-horizontal'>	 
						<input type='hidden' name='recipientCabinet' value=" . $theVariable . ">";
					echo "<textarea class='form-control' id='description' name='title' style='height: 50px;' placeholder='The subject/title of the personal response should go here.'>". $responseTitle."</textarea>
					<br><p><b>Public</b> Response Text</p>     
					<textarea class='form-control' id='description' name='description' style='height: 250px;' placeholder='The main text of the directive goes here.'>". $responseText ."</textarea>
					<br>
					<button style='float: left; margin-left:25px;' type='submit' id='singlebutton' name='publicMessage' class='btn btn-primary'>Publish </button>

					</form>";
						}
					}
								
						
				
					
				}else {
					$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
					$result = $con->query("SELECT * FROM Users ORDER BY CharacterName");
					$theVariable;
					$theVariableName;
					if ($result->num_rows > 0) {
						 echo "<a class='list-group-item titleUnderline' href='backroomResponse.php'> Back</a>";
						
						while($row = $result->fetch_assoc()) 
						{	
							if (isset($_GET['email'])) {
								$message = $_GET['email'];
								if ($message === $row["id"]) {
									$arrayElement = "<a class='list-group-item active' href='backroomResponse.php?email="  . $row["id"] . "&cabinet=" . $_GET['cabinet'] ."'>" . $row["CharacterName"] . " </a> ";
									$theVariable = $row['UserNameID'];
									$theVariableName = $row['CharacterName'];
								  echo $arrayElement;
								}
							}

							if ($row['isBackroom'] !== "f"||$row['Committee'] !== $_GET['cabinet'] || $row['id'] === $_GET['email']) {
								continue;
							}

									$arrayElement = "<a class='list-group-item' href='backroomResponse.php?email="  . $row["id"] . "&cabinet=" . $_GET['cabinet'] ."'>" . $row["CharacterName"] . " </a> ";
							
							//$arrayElement = "<a class='list-group-item' href='index.php?message="  . $row["NewsNumber"] . "'>" . $row["NewsNumber"] . ": " . $row["NewsTitle"] . "</a> ";
							  echo $arrayElement;
						}
							$arrayElement = "<a class='list-group-item' href='backroomResponse.php?public=".$_GET['cabinet']."'> Everyone in selected Cabinet</a> ";
							  echo $arrayElement;
					}
				if (isset($_GET['email'])){
					$responseTitle = "";
					$responseText  = "";
					if (isset($_COOKIE['responseTitle'])) {
						$responseTitle = $_COOKIE['responseTitle'];
					}if (isset($_COOKIE['responseText'])) {
						$responseText = $_COOKIE['responseText']; 
					}			
						
		
			echo "</div>
			<div class= 'col-xs-6 col-sm-9'> 
			<p>Response Title:</p>    
			<form method='POST' action='backroomAcceptance.php' role='form' `class='form-horizontal'>	 
				<input type='hidden' name='directiveSender' value=" . $theVariable . ">
				<input type='hidden' name='getValue' value=" . $_GET['email'] . ">
				<textarea style='display:none;' name='directiveSenderName'>" . $theVariableName . "</textarea>";					

			echo "<textarea class='form-control' id='description' name='title' style='height: 50px;' placeholder='The subject/title of the personal response should go here.'>". $responseTitle."</textarea>
			<br><p> Response Text</p>     
			<textarea class='form-control' id='description' name='description' style='height: 250px;' placeholder='The main text of the directive goes here.'>". $responseText ."</textarea>
			<br>
			<button style='float: left; margin-left:25px;' type='submit' id='singlebutton' name='directMessage' class='btn btn-primary'>Send </button>

			</form>";					}
				}
			}else {
				$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
				$result = $con->query("SELECT * FROM Cabinets ORDER BY CabinetName");
				if ($result->num_rows > 0) {
					 echo "<a class='list-group-item titleUnderline'> Cabinet:</a>";
					
					while($row = $result->fetch_assoc()) 
					{	
						$arrayElement = "<a class='list-group-item' href='backroomResponse.php?cabinet="  . $row["ID"] . "'>" . $row["CabinetName"] . " </a> ";
						  echo $arrayElement;
					}
					echo "<a class='list-group-item' href='backroomResponse.php?public=p' style='background-color:#00ff00;'> <i>Publish News </i></a> ";
				}
			}
			?>
			</div>

			</div>
<?php 
			if (isset($_GET['cabinet']) || isset($_GET['email']) || isset($_GET['public'])) {
				echo "<script>
			function scrollWin() {
			    window.scrollTo(0, 1000);
			    window.scrollBy(0,300);
				console.log('test');
			}
			scrollWin();
		</script>";
}
		?>


	</body>



	
</html>
