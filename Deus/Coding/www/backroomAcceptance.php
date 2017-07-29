<?php include 'preHeaderBackroom.php';?>
<?php 
if (isset($_POST['unreserve'])){
	$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testMUN") or die(mysql_error());
	$query = "UPDATE `d5g9x9d8_testMUN`.`Directives` SET `Status` = 'Available', `StatusName` = 'Available', `DirectiveColour` = '' WHERE `Directives`.`DirectiveNumber` = " . $_POST["directiveNumber"] . " ";
	$result = mysqli_query($con, $query);
	if (!$result) {
		header("Location: backroomResponse.php?message=error");
		}else {
		header('Location: backroomResponse.php?message=unreserve');
		}		
	}
	if (!isset($_POST['title']) || !isset($_POST['description']) || $_POST['title'] === "" || $_POST['description'] === "") {
		if (isset($_POST['directMessage']) ||isset($_POST['publicMessage']) ) {
			header('Location: backroomResponse.php?message=failure2');	
		}if (isset($_POST['unreserve'])){
			$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testMUN") or die(mysql_error());
			$query = "UPDATE `d5g9x9d8_testMUN`.`Directives` SET `Status` = 'Available', `StatusName` = 'Available', `DirectiveColour` = '' WHERE `Directives`.`DirectiveNumber` = " . $_POST["directiveNumber"] . " ";
			$result = mysqli_query($con, $query);
			if (!$result) {
				header("Location: backroomResponse.php?message=error");
	   		}else {
				header('Location: backroomResponse.php?message=unreserve');
	   		}		
	   	}else{
				header('Location: backroomReserve.php?message=failure');	
			}
		$cookie_name = "responseTitle";
		$cookie_value = $_POST['title'];
		$cookie_value = str_replace("'", '', $cookie_value);
		$cookie_value = str_replace("\\", '', $cookie_value);
		setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
		$cookie_name = "responseText";
		$cookie_value = $_POST['description'];
		$cookie_value = str_replace("'", '', $cookie_value);
		$cookie_value = str_replace("\\", '', $cookie_value);
		setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
		$cookie_name = "responseImage";
		$cookie_value = $_POST['image'];
		$cookie_value = str_replace("'", '', $cookie_value);
		
		$cookie_value = str_replace("\\", '', $cookie_value);
		setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
	


	}
	include 'header.php';?> 
<?php 	
	echo "<h3>Please confirm your message</h3>";
	echo "<div class='jumbotron col-xs-12 col-sm-12' id='jumbotron'>";
	if (isset($_POST['complete'])) {
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testMUN") or die(mysql_error());
		$query = "UPDATE `d5g9x9d8_testMUN`.`Directives` SET `Status` = 'Completed', `StatusName` = 'Completed', `DirectiveColour` = '#76EE00' WHERE `Directives`.`DirectiveNumber` = " . $_POST["directiveNumber"] . " ";
		$result = mysqli_query($con, $query);
		if (!$result) {
			header("Location: backroomResponse.php?message=error");
   		}else {
			header('Location: backroomResponse.php'); //#000000 ERROR
   		}
		exit;
	}else if (isset($_POST['unreserve'])) {
		exit;
	}
	$publicOrPrivate = "public";
	$opposite = "private";
	if (isset($_POST['public'])) {
			echo "<form method='POST' action='backroomConfirmation.php' role='form' `class='form-horizontal'>
			<br><button style='float: left; margin-left: px; margin-top:-30px;' type='submit' id='singlebutton' name='edit' class='btn btn-warning'>Edit Directive</button> <br><br>";
		echo "<p style='font-weight: bold;'> News Announcement </p><p>". $_POST['title'] . "</p>" . nl2br($_POST['description']) . "<br>";
		echo "<input type ='hidden' name='directiveNumber' value='".$_POST["directiveNumber"]."'>";

		if ($_POST['image'] !== NULL && $_POST['image'] !== '') {
			echo "<br> <br><p> Image: </p><img style='width:60%; height:60%;' src='".$_POST['image']."' align='middle'/>";
			echo "<input type='hidden' name='image' value='" . $_POST["image"] . "'>";
		}else {
			echo "<br> <br><p> No Image </p>";
			echo "<input type='hidden' name='image' value='NULL'>";			
		}
	 	$publicOrPrivate = "private";
	 	$opposite = "public";

	}else if (isset( $_POST['private'])) {
		echo"<div >";
			echo "<form method='POST' action='backroomConfirmation.php' role='form' class='form-horizontal'>
		<button style='float: left; margin-left: 20px; ' type='submit' id='singlebutton' name='edit' class='btn btn-warning'>Edit Directive</button>		
		    <button name='response' style='float: left;' class='btn btn-info' id='delegateButton' onclick='changeValue();' value='off' type='button'>Allow Delegate Response: Off</button>
 <br><br>";
	 	echo"<textarea style='display:none;' name='directiveSenderName'>" . $_POST['directiveSenderName'] . "</textarea>";
		echo "<p style='font-weight: bold;'> Private Message To: <br>" . $_POST['directiveSenderName'] . "<p>". $_POST['title'] . "</p>" . nl2br($_POST['description']) . "<br> <br> </div>";
		echo "<input type ='hidden' id='responseValue' name='responseValue' value='off'>";
		echo "<input type ='hidden' name='directiveNumber' value='".$_POST["directiveNumber"]."'>";




	}else if (isset($_POST['directMessage'])) {
		echo"<div>";
		echo "<form method='POST' action='backroomConfirmation.php' role='form' `class='form-horizontal'>
		<button type='submit' id='singlebutton' name='editDirect' class='btn btn-warning'>Edit Directive</button> 		    
		<button name='response' class='btn btn-info' id='delegateButton' onclick='changeValue();' value='off' type='button'>Allow Delegate Response: Off</button>
<br><br>";
		echo "<p style='font-weight: bold;'> Private Message To: <br>" . $_POST['directiveSenderName'] . "<p>". $_POST['title'] . "</p>" . nl2br($_POST['description']) . "<br> <br>";		
		echo "<br><br><br>";
		echo "
	 	<input type='hidden' name='directiveNumber' value='PM'>
	 	<input type='hidden' name='directiveSender' value=" . $_POST["directiveSender"] . ">
	 	<textarea style='display:none;' name='directiveSenderName'>" . $_POST['directiveSenderName'] . "</textarea>
	 	<input type='hidden' name='directiveValue' value='NULL'>
	 	<input type='hidden' name='getValue' value=" . $_POST['getValue'] . ">
	 	<textarea style='display:none;' name='title'>" . $_POST['title'] . "</textarea>
	 	<textarea style='display:none;' name='description' >" . $_POST['description'] . "</textarea>
	 	<input type='hidden' name='publicOrPrivate' value='private'>
		<br>

		<input type ='hidden' id='responseValue' name='responseValue' value='off'>
	 	<h5>Confirm you would like to send this message to " . $_POST['directiveSenderName'] . 
	 	"!</h5>
		<button style='float: left; margin-left:50px;' type='submit' id='singlebutton' name='confirmDirect' class='btn btn-success'>Confirm </button>
		<button style='float: left; margin-left:50px;' type='submit' id='singlebutton' name='Cancel' class='btn btn-danger'>Cancel</button>
		<br>
		</form>
		</div>";
		return;
	}else if (isset($_POST['publicMessage'])){

		echo "<form method='POST' action='backroomConfirmation.php' role='form' `class='form-horizontal'>
		<button type='submit' id='singlebutton' name='editDirect' class='btn btn-warning'>Edit Directive</button> <br><br>";
		if ($_POST['recipientCabinet'] === 'p') {
			echo "<p style='font-weight: bold;'> News Announcement: <p>". $_POST['title'] . "</p>" . nl2br($_POST['description']) . "<br> <br>";

		if ($_POST['image'] !== NULL && $_POST['image'] !== '') {
			echo "<br> <br><p> Image: </p><img style='width:60%; height:60%;' src='".$_POST['image']."' align='middle'/>";
			echo "<input type='hidden' name='image' value='" . $_POST["image"] . "'>";
		}else {
			echo "<br> <br><p> No Image </p>";
			echo "<input type='hidden' name='image' value='NULL'>";			
		}

				 echo"<br><br><h5>Confirm you would like to send this public message to EVERYONE!</h5>	";
		}else { 
			$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testMUN") or die(mysql_error());
			$result = $con->query("SELECT * FROM Cabinets WHERE `ID` = " . $_POST['recipientCabinet']);	
		    while($row = $result->fetch_assoc()) {
				echo "<p style='font-weight: bold;'> Public Message to all Members of the: <i>" . $row['CabinetName'] . "</i><p>". $_POST['title'] . "</p>" . nl2br($_POST['description']) . "<br> <br>";	
				echo"	 	<h5>Confirm you would like to send this public message to all members of the " . $row['CabinetName'] . "!</h5>";
				
		    }

		}
		echo "
	 	<textarea style='display:none;' name='directiveValue'>" . $_POST['directiveValue'] . "</textarea>
	 	<input type='hidden' name='recipientCabinet' value=" . $_POST['recipientCabinet'] . ">
	 	<input type='hidden' name='publicOrPrivate' value='public'>
	 	<textarea style='display:none;' name='title'>" . $_POST['title'] . "</textarea>
	 	<textarea style='display:none;' name='description' >" . $_POST['description'] . "</textarea>
	 	<br>
		<button style='float: left; margin-left:50px;' type='submit' id='singlebutton' name='confirm' class='btn btn-success'>Confirm </button>
		<button style='float: left; margin-left:50px;' type='submit' id='singlebutton' name='Cancel' class='btn btn-danger'>Cancel</button>
		<br>
		</form>
		</div>";
		return;

	}


	echo "<br><br><br>";
	echo "<h5>Would you like to send the response and mark directive as complete - or send a " . $publicOrPrivate . " message as well?</h5>";
	echo "
	 	 	<textarea style='display:none;' name='directiveValue'>" . $_POST["directiveValue"] . "</textarea>
	 	<input type='hidden' name='directiveSender' value=" . $_POST["directiveSender"] . ">
	 	<textarea style='display:none;' name='title'>" . $_POST['title'] . "</textarea>
	 	<textarea style='display:none;' name='description' >" . $_POST['description'] . "</textarea>
	 	<input type='hidden' name='publicOrPrivate' value=" . $opposite . ">
	 	<br>
	<button style='float: left; margin-left:25px;' type='submit' id='singlebutton' name='confirmAndComplete' class='btn btn-success'>Confirm and <b>mark as Completed</b></button>
	<button style='float: left; margin-left:50px;' type='submit' id='singlebutton' name='confirmAndOpposite' class='btn btn-success'>Confirm and <b>send " . $publicOrPrivate . " message as well </b></button>
	<button style='float: left; margin-left:50px;' type='submit' id='singlebutton' name='Cancel' class='btn btn-danger'>Cancel</button><br><br>";
	// echo " 	<button style='float: left; margin-left:25px;' type='submit' id='singlebutton' name='failAndComplete' class='btn btn-danger'>Confirm and <b>mark as Failed</b></button>";
	echo "

	<br>
</form>
</div>";





// INSERT INTO `a2551823_a`.`news` (
// `NewsNumber` ,
// `NewsTitle` ,
// `NewsDescription`
// )
// VALUES (
// NULL , 'This is the title! ', 'This is the main bit thing! '
// );

?>

</body>





<!-- Send it to news OR private (include directive)
Ask if it should be marked as completed - button. 

Find a way to message delegate without a directive. 
Remove the cookie! 

-> Delegates seeing their answer (have it on server; but delegates cannot see it yet

AND backroom sending messages to delegates who haven't sent a directive (eg spy reports etc)
 -->

