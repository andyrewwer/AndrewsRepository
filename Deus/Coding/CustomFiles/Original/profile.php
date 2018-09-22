<?php include 'preHeaderFrontroom.php';include 'header.php';?>

		<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd'><?php 
		if (isset($_GET['message'])) {
	    $message = $_GET['message'];
	    if ($message === "complete") {
			echo "<script> var alert = new telegramAlert(); alert.render('Success', 'Response submitted to backroom!'); makeTelegramGreen(); </script>";
	    }if ($message === "error") {
			echo "<script> var alert = new telegramAlert(); alert.render('Failure', 'Sorry there was a problem submitting your response! Please try again in a few moments and it should work!'); </script>";
	    }if ($message === "noWords") {
			echo "<script> var alert = new telegramAlert(); alert.render('Sorry', 'We did not find a response text. Please try again filling in more detais!'); </script>";
	    }if ($message === "oops") {
			echo "<script> var alert = new telegramAlert(); alert.render('Sorry', 'You reached that page by accident!'); </script>";
	    }

	} ?></h4>


	<h3 style='color:black'><b> <?php 
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
		$result = $con->query("SELECT * FROM Cabinets");
	    while($row = $result->fetch_assoc()) {
	    	if ($row['ID'] === $_COOKIE['committee']){
	    		$cabinet = $row['CabinetName'];
	    		break; 
	    	}
	    }		echo "You are: " . $_COOKIE['name'] . " <br>In: " . $cabinet ."'s cabinet.";
	    ?> </b></h3>
	<h3 id="appendMe" > 
<?php include 'newsProfile.php';?>
	</h3>


	<h3 id="appendMe" > 
	<div class="col-xs-3 col-sm-3 sidebarJS" id="profileRHS" style='float:right;'>
	<div class="list-group" id="listgroupJSItem">
<?php 
	echo "	<h4>" . $_COOKIE['name'] . " Directive Response</h4> <br>";
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
		$result = $con->query("SELECT * FROM Responses");
		if ($result->num_rows > 0) {
			$myArray = array();
			$newsCount = 0;
			$messageValue = 0;
			if (isset($_GET['privatemessage'])) {
		     	$messageValue = $_GET['privatemessage'];		
		     }
	
		     while($row = $result->fetch_assoc()) {
		     	if (strpos($row['Recipient'], $_COOKIE['user']) !== false) {
		     		$arrayElement = "<a href='profile.php?privatemessage="  . $row["responseID"] . "' class = 'list-group-item ";
		     		if ($messageValue === $row['responseID']) {
				     	$arrayElement = $arrayElement . "active "; 
		     		}else if ($row['ResponseAllowed'] === 't'){
		     			$arrayElement = $arrayElement . "response ";
		     		}else if ($row['readByDelegate'] !== "f"){
		     			$arrayElement = $arrayElement . "read ";
		     		}
		     		$arrayElement = $arrayElement . "'>" . ++$newsCount . ": " . $row["Response"] . "</a> ";
			     	$myArray[] = $arrayElement;		     		
		     	}
//		     	echo 
		     }
		     $myArray = array_reverse($myArray);
		     foreach ($myArray as $element) {
		     	echo $element;
		     }
		}
	?>
		</div>
		</div>
	</h3>	
		<br>

		<?php 
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
			echo "<div class='jumbotron col-xs-5 col-sm-5' id='jumbotron'>";
			if(is_numeric(($_GET['message']))) {
				$result = $con->query("SELECT * FROM News");
				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {
				    	if ($_GET['message'] === $row["NewsNumber"]) {
							echo "<p><b>" . $row["NewsNumber"] . ": " . $row["NewsTitle"] . "</b></p> <br>" . $row["NewsDescription"];
							if ($row['NewsImage'] !== 'NULL') {
				    				echo "<br> <br><img style='width:100%; height:100%' src='".$row['NewsImage']."' align='middle'/>";
							}
		    			}
					}
				}
			}else if (isset($_GET['privatemessage'])) {
				$result = $con->query("SELECT * FROM Responses");
				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {
	    				if ($_GET['privatemessage'] === $row["responseID"]) {
		     				if (strpos($row['Recipient'], $_COOKIE['user']) !== false) {		     					// $row['Recipient'] === $_COOKIE['user']) {
		     					if ($row['Directive'] === 'NULL') {
									echo "<p style='font-style: oblique; font-size:80%;'> Response: </p><p style='font-weight:bold;''>" . $row["Response"] . "</p> " . $row["responseDescription"] . "";				
		     					}else {
									echo "<p style='font-style: oblique; font-size:80%;'> Response: </p><p style='font-weight:bold;''>" . $row["Response"] . "</p> " . $row["responseDescription"] . "<br><br><br> <p style='font-style: oblique; font-size:80%;'> Original Directive: </p><p>" . $row['Directive'];

		     					}
								if ($row['readByDelegate'] === 'f') { 
								     echo "		
		     <form method='POST' action='connectivity.php' role='form' class='form-horizontal'>
     		<input type='hidden' name='directiveNumber' value=" . $row['responseID'] . ">";
						$query = "UPDATE  `dbilh9sp_{{CONFERENCE_NAME}}`.`Responses` SET  `readByDelegate` =  't' WHERE  `Responses`.`responseID` =". $_GET['privatemessage'];
						 		$result2 = mysqli_query($con, $query);
	 					echo "<script> reduceProfileNumber(); </script>";

								}else {
								     echo "		
		     <form method='POST' action='connectivity.php' role='form' class='form-horizontal'>
     		<input type='hidden' name='directiveNumber' value=" . $row['responseID'] . ">";

								}
								echo"</form>";
								if ($row['ResponseAllowed'] === 't') {
									$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());

									echo "<br><br><form method='POST' action='privateResponse.php' role='form' class='form-horizontal'><button type='submit' id='singlebutton' name='respond' class='btn btn-danger'  ><b>Respond to Backroom </b></button>     		
									<input type='hidden' name='directiveNumber' value=" . $row['DirectiveNumber'] . ">
									<input type='hidden' name='responseNumber' value=" . $row['responseID'] . ">
</form>";			
								}
							}else {
								echo "Sorry you have tried to select a directive response which wasn't yours. :(";
							}

						}
					}
				}
			}else {
				echo "Please select a public news on the left; or a personal response on the right for more details.";
			}
			echo "</div>";
			?> 



		<!-- 
	<p id="test1">Username: <?php echo $_COOKIE['name'];?></p>
			<button class="btn" onclick="">Read Message</button>
			<br/>
			<button class="btn"  onclick="">Send Message</button>
			<p id="test2">Bodyguards: </p>
			<p id="profileTitle">Spies: </p>
		</div>
	</div> -->
</body>
</html>
