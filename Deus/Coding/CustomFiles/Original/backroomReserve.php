<?php include 'preHeaderBackroom.php';?>
<?php
$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
		$result = $con->query("SELECT * FROM Directives");
		if ($result->num_rows > 0) {
			$hasADirective = "true";
		    while($row = $result->fetch_assoc()) {
		    	if (isset($_GET['directiveNumber'])) {
			    	if ($row['DirectiveNumber'] === $_GET['directiveNumber']) {
			    		if ( ($row['Status'] === $_COOKIE['user'] || $row['Status'] === "Available")) {
							$hasADirective = "false";
				    		global $directiveRow;
				    		$directiveRow = $row;
				    		break;
			    		}
			    	}		    		
		    	}else if ($row['Status'] === $_COOKIE['user']) {
					$hasADirective = "false";
		    		global $directiveRow;
		    		$directiveRow = $row;
		    		break;
	
		    	}
			}					
		}
		if ($hasADirective === "true") {
	    	header('Location: backroomResponse.php?message=failure');
	    	return;
		}
	// $con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
	// $result = $con->query("SELECT * FROM  `Directives` WHERE  `Status` = '".$_COOKIE['user']."'");
	// while($row = $result->fetch_assoc()) {
	// 	echo $row['DirectiveNumber'];
	// }

include 'header.php';?>	
	<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd;'>
	<?php 
		if (isset($_GET['message'])) {
	    $message = $_GET['message'];
	    if ($message === "failure") {
			echo "<script> var alert = new telegramAlert(); alert.render('You did not complete the form!', 'Please finish filling it out!'); </script>";
	    }if ($message === "sent") {
				echo "<script> var alert = new telegramAlert(); alert.render('Success', 'Keep going!'); makeTelegramGreen(); </script>";
	    }

	} ?></h4>

		<h3> Respond to Delegate Directive</h3>

	<div class="col-xs-12 col-sm-12 sidebarJS" id="alreadyAThing">
	<div class="list-group" id="listgroupJSItem">
	<h4 style="	text-align: center;"> Your Reserved Directive. </h4>
<?php 
	//commit to Server that this one is reserved. Unreserve others. 
	//Go to user: Get user. See if they have reserved any. If so: Unreserve it 
	global $directiveRow;		
	echo "<script> updateBackroomReserve(". $directiveRow['DirectiveNumber'] . ");</script>";

	function viewDidLoad() {
		
		checkIfReserved();

	}
	function checkIfReserved() {
		global $directiveRow;
		if ($directiveRow["Status"] === "Available" || $directiveRow["Status"] === $_COOKIE["user"]) {
			printTable();
			checkIfUserHasAReservedDirective();
			reserveDirective();
		}else {
			//echo error message :P
			echo "Sorry: This directive has already been reserved by: ";
			echo $directiveRow["Status"];
			echo "<br>" . $directiveRow["Status"] . "User" . $_COOKIE["user"];
			//present error message like: Sorry pick another message. Send them back to backroomResponse.php
		}
		//if unreserved
		//reserveDirective 
		//checkIfUserHasAReservedDirective

	}
	function checkIfUserHasAReservedDirective(){
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
		$result = $con->query("SELECT * FROM Directives");
	    while($userRow = $result->fetch_assoc()) {
	    	if ($userRow['Status'] === $_COOKIE["user"]) {
				$query = "UPDATE `d5g9x9d8_{{CONFERENCE_NAME}}`.`Directives` SET  `Status` =  'Available', `StatusName` = 'Available', `DirectiveColour` =  '' WHERE  `Directives`.`DirectiveNumber` ='".$userRow["DirectiveNumber"] ."'";

		 		$update = mysqli_query($con, $query);
	    		//set new one to reserve! 
	    	}
		}//well now if one is reserved. But if a diffrent user has reserved it. Don't ALLOW THAT! D:  


		//unreserve any others! 
	}
	function reserveDirective() {
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
		global $directiveRow;

		$query = "UPDATE  `d5g9x9d8_{{CONFERENCE_NAME}}`.`Directives` SET  `Status` =  '". $_COOKIE["user"] ."', `StatusName` = '". $_COOKIE['name'] . "',`DirectiveColour` =  '". $_COOKIE["backroomColour"] ."' WHERE  `Directives`.`DirectiveNumber` =" . $directiveRow["DirectiveNumber"]  . ";";
 		$result = mysqli_query($con, $query);
	}
	function printTable() {
		global $directiveRow;
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
		$cabinetResult = $con->query("SELECT * FROM Cabinets ORDER BY CabinetName");
		$cabinetArray;
	    while($row = $cabinetResult->fetch_assoc()) {
			$cabinetArray[$row['ID']] = $row['CabinetName'];
			echo "test";
	    }
		echo "	 	<div class='wrapper'>
		<form method='POST' action='backroomAcceptance.php' role='form' `class='form-horizontal'>	
	 	<input type='hidden' name='directiveNumber' value=" . $directiveRow["DirectiveNumber"] . ">
	 	<input type='hidden' name='directiveSender' value=" . $directiveRow["DirectiveSender"] . ">
	 	<textarea style='display:none;' name='directiveSenderName'>" . $directiveRow["DirectiveSenderName"] . "</textarea>
	 	
		<button style='margin-bottom:10px;' type='submit' id='singlebutton' name='unreserve' class='btn btn-warning'>Unreserve Directive</button>




	<table class='directiveTable'> <thead><tr id='head'> <th width=5%>#</th><th width=13%>Character Name</th> <th width=7%>Cabinet</th><th width=11%>Request Type</th> <th  width=54%>Description</th> </tr></thead><tbody class='directiveTable'> <tr> <td width=5%>" . $directiveRow["DirectiveNumber"]. "</td><td width=13%>". $directiveRow["DirectiveSenderName"] ."</td><td width=7%>" . $cabinetArray[$directiveRow["DirectiveCommittee"]] . "</td><td width=11%>" . $directiveRow["DirectiveType"] . "</td><td  width=54%>" . $directiveRow["DirectiveText"] . "</td></tr> </tbody></table>";
	

echo"		</div>
		";

	}
	viewDidLoad();



	global $directiveRow;


	$responseTitle = "";
	$responseText  = "";
	$responseImage  = "";
	if (isset($_COOKIE['responseTitle'])) {
		$responseTitle = $_COOKIE['responseTitle'];
	}if (isset($_COOKIE['responseText'])) {
		$responseText = $_COOKIE['responseText']; 
	}if (isset($_COOKIE['responseImage'])) {
		$responseText = $_COOKIE['responseImage']; 
	}

	echo "
<br><br>
<div class = 'googleForm'>
<form method='POST' action='backroomAcceptance.php' role='form' `class='form-horizontal'>	
		<label style='font-size: 160%; float: left' class='col-md-4 control-label' for='description'>       Respond to the Directive:</label> <br><br>
		<p>Response Title:</p>     
		<textarea class='form-control' id='description' name='title' style='height: 50px;' >" . $responseTitle    . "</textarea>
		<br><p> Response Text</p>     
		<textarea class='form-control' id='description' name='description' style='height: 250px;'>" . $responseText . "</textarea>
		<br><p>Image (optional and Public Only) <b>Please enter imgur link enter in '.png'</b></p>     
		<textarea class='form-control' id='description' name='image' style='height: 50px;' >". $responseImage . "</textarea>
	 <br><br>
	 <p> Should the response be public (as a news release found on the home page). Or a private response only the directive can see and share as they see fit.</p> <br>
	 	 	<textarea style='display:none;' name='directiveValue'>" . $directiveRow["DirectiveText"] . "</textarea>
	 	<input type='hidden' name='directiveNumber' value=" . $directiveRow["DirectiveNumber"] . ">
	 	<input type='hidden' name='directiveSender' value=" . $directiveRow["DirectiveSender"] . ">
	<button style='margin-bottom:10px' type='submit' id='singlebutton' name='public' class='btn btn-success'>Publish News</button>
	<button style='margin-bottom:10px' type='submit' id='singlebutton' name='private' class='btn btn-primary'>Send a private response</button>";

	// if ($_COOKIE['isBackroom'] === 'a') {
		echo "<button style='' type='submit' id='singlebutton' name='complete' class='btn btn-danger'>Mark Directive As Complete [WILL NOT SUBMIT THIS RESPONSE] </button>";

	// }
	echo "
	<br>
	<br>
	<br>
</form>
</div>
	</div>
</div>
";
?>

</body>
