<?php
 	function confirmForm() {
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());

		$responseTitle = str_replace("'", '', $_POST['title']);
		$responseTitle = str_replace("\\", '', $responseTitle);

		$responseText = str_replace("'", '', $_POST['description']);
		$responseText = str_replace("\\", '', $responseText);
		$responseText = nl2br($responseText);

		$responseImage = str_replace("'", '', $_POST['image']);
		$responseImage = str_replace("\\", '', $responseImage);
 		// echo "Title: " . $responseTitle . "<br>";
 		// echo "Description: ". $responseText . "<br>";
 		// echo "fsdf " . $_POST['responseValue'];
 		echo "NAME: " . $_POST['directiveSenderName'];
 		echo "NAME: " . $_POST['directiveValue'];
 		if ($_POST['publicOrPrivate'] === "public") {
 			echo "Public";
	 		$query2 = "INSERT INTO  `dbilh9sp_{{CONFERENCE_NAME}}`.`News` (`NewsNumber` ,`NewsTitle` ,`NewsDescription`, `NewsImage` )VALUES (NULL , '" . $responseTitle . "',  '" .  $responseText ."', '". $responseImage . "');";
	 		$result2 = mysqli_query($con, $query2);
	 		if (!$result2) {
	    			echo "ERROR" . mysqli_error($con);
		   		}else {
		   			echo "woo! <Br>";
		   		}
			echo " Hmm " . $_POST['image'];
 		}else if ($_POST['publicOrPrivate'] === "private") {
 			echo "Private";
			date_default_timezone_set('Europe/London'); // CDT
			$currentDate = getDate();
			$date = $currentDate['mday'];
			$month = $currentDate['mon'];
			$year = $currentDate['year'];
			$hour = $currentDate['hours'];
			$min = $currentDate['minutes'];
			$sec = $currentDate['seconds'];
			$currentDate = "$date/$month/$year == $hour:$min:$sec";

			if (strpos($_POST['directiveSender'], '|') !== false) {
				$first = 0;
				$array = explode('|', $_POST['directiveSender']);
				foreach($array as $selected){
					if ($first === 0) { 
			 			if ($_POST['responseValue'] === 'on') {
					 		$query2 = "INSERT INTO  `dbilh9sp_{{CONFERENCE_NAME}}`.`Responses` (`Recipient`, `RecipientName`,`Directive`,`DirectiveNumber`,`Response` ,`responseDescription` ,`responseID`, `readByDelegate`, `ResponseAllowed`, `MassMessage`, `Timestamp`)VALUES (
							'". $selected . "','".$_POST['directiveSenderName']."',  '". $_POST["directiveValue"] . "', '". $_POST['directiveNumber']."', '". $responseTitle . "',  '". $responseText . "', NULL, 'f', 't', 'f', '".$currentDate."');";
					 		$result2 = mysqli_query($con, $query2); 	
						}else { 
							$query2 = "INSERT INTO  `dbilh9sp_{{CONFERENCE_NAME}}`.`Responses` (`Recipient`, `RecipientName`,`Directive`,`DirectiveNumber`,`Response` ,`responseDescription` ,`responseID`, `readByDelegate`, `ResponseAllowed`, `MassMessage`, `Timestamp`)VALUES (
							'". $selected . "','".$_POST['directiveSenderName']."',  '". $_POST["directiveValue"] . "', '". $_POST['directiveNumber']."', '". $responseTitle . "',  '". $responseText . "', NULL, 'f', 'f', 'f', '".$currentDate."');";
					 		$result2 = mysqli_query($con, $query2); 	
						}
						$first = 1;
					}else {
						$query2 = "INSERT INTO  `dbilh9sp_{{CONFERENCE_NAME}}`.`Responses` (`Recipient`, `RecipientName`,`Directive`,`DirectiveNumber`,`Response` ,`responseDescription` ,`responseID`, `readByDelegate`, `ResponseAllowed`, `MassMessage`, `Timestamp`)VALUES (
							'". $selected . "','".$_POST['directiveSenderName']."',  '". $_POST["directiveValue"] . "', '". $_POST['directiveNumber']."', '". $responseTitle . "',  '". $responseText . "', NULL, 'f', 'f', 't', '".$currentDate."');";
				 		$result2 = mysqli_query($con, $query2); 	


					}
				}
			}else { 
				if ($_POST['responseValue'] === 'on') {
			 		$query2 = "INSERT INTO  `dbilh9sp_{{CONFERENCE_NAME}}`.`Responses` (`Recipient`, `RecipientName`,`Directive`,`DirectiveNumber`,`Response` ,`responseDescription` ,`responseID`, `readByDelegate`, `ResponseAllowed`, `MassMessage`, `Timestamp`)VALUES (
					'". $_POST["directiveSender"] . "','".$_POST['directiveSenderName']."',  '". $_POST["directiveValue"] . "', '". $_POST['directiveNumber']."', '". $responseTitle . "',  '". $responseText . "', NULL, 'f', 't', 'f', '".$currentDate."');";
			 		$result2 = mysqli_query($con, $query2); 	
				}else { 
					$query2 = "INSERT INTO  `dbilh9sp_{{CONFERENCE_NAME}}`.`Responses` (`Recipient`, `RecipientName`,`Directive`,`DirectiveNumber`,`Response` ,`responseDescription` ,`responseID`, `readByDelegate`, `ResponseAllowed`, `MassMessage`, `Timestamp`)VALUES (
					'". $_POST["directiveSender"] . "','".$_POST['directiveSenderName']."',  '". $_POST["directiveValue"] . "', '". $_POST['directiveNumber']."', '". $responseTitle . "',  '". $responseText . "', NULL, 'f', 'f', 'f', '".$currentDate."');";
			 		$result2 = mysqli_query($con, $query2); 	
				}
			}




			if (!$result2) {
	    			echo "ERROR" . mysqli_error($con);
		   		}else {
		   			echo "woo! <Br>";
		   		}
	 		
 		}
 	}

 	function sendToAllInCabinet($cabinet) {
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
		$responseTitle = str_replace("'", '', $_POST['title']);
		$responseTitle = str_replace("\\", '', $_POST['title']);

		$responseText = str_replace("'", '', $_POST['description']);
		$responseText = str_replace("\\", '', $_POST['description']);
		$responseText = nl2br($responseText);
		$responseTitle = "[TO ALL CABINET MEMBERS]  " . $responseTitle;
		$result = $con->query("SELECT * FROM  `Users` WHERE  `Committee` = '".$cabinet."'");
		$test = 1;		
		while($row = $result->fetch_assoc()) {
			date_default_timezone_set('Europe/London'); // CDT
			$currentDate = getDate();
			$date = $currentDate['mday'];
			$month = $currentDate['mon'];
			$year = $currentDate['year'];
			$hour = $currentDate['hours'];
			$min = $currentDate['minutes'];
			$sec = $currentDate['seconds'];
			$currentDate = "$date/$month/$year == $hour:$min:$sec";
			$query2 = "INSERT INTO  `dbilh9sp_{{CONFERENCE_NAME}}`.`Responses` (`Recipient`, `RecipientName`, `Directive`,`DirectiveNumber`,`Response` ,`responseDescription` ,`responseID`, `readByDelegate`, `ResponseAllowed`, `MassMessage`, `Timestamp`)VALUES (
					'". $row['UserNameID'] . "','".$row['CharacterName']."',  'NULL', '0', '". $responseTitle . "',  '". $responseText . "', NULL, 'f', 'f','t', '".$currentDate."');";
			if ($test === 1) { 
				$test = 2;
				$query2 = "INSERT INTO  `dbilh9sp_{{CONFERENCE_NAME}}`.`Responses` (`Recipient`, `RecipientName`, `Directive`,`DirectiveNumber`,`Response` ,`responseDescription` ,`responseID`, `readByDelegate`, `ResponseAllowed`, `MassMessage`, `Timestamp`)VALUES (
					'". $row['UserNameID'] . "','".$row['CharacterName']."',  'NULL', '0', '". $responseTitle . "',  '". $responseText . "', NULL, 'f', 'f','f', '".$currentDate."');";
			}
			
	 		$result2 = mysqli_query($con, $query2); 	
	    		if (!$result2) {
	    			echo "ERROR" . mysqli_error($con);
		   		}else {
		   			echo "woo! <Br>";
		   		}

		}
 	}


	$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
 	if (isset($_POST['edit'])) {
		header('Location: backroomReserve.php');
		$cookie_name = "responseTitle";
		$cookie_value = $_POST['title'];
		$cookie_value = str_replace("'", '', $cookie_value);
		$cookie_value = str_replace("\\", '', $cookie_value);

		setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day
		$cookie_name = "responseText";
		$cookie_value = $_POST['description'];
		$cookie_value = str_replace("'", '', $cookie_value);
		$cookie_value = str_replace("\\", '', $cookie_value);
		// $cookie_value = nl2br($cookie_value);
		setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day

		echo $_COOKIE['responseText'] . "  ";
		echo  $_POST['description'] . "<br>";

		echo $_COOKIE['responseTitle'] . "  ";
		echo  $_POST['title'] . "<br>";

 	}else if (isset($_POST['editDirect'])) {
 		if (isset($_POST['recipientCabinet'])){
			header('Location: backroomResponse.php?public=' . $_POST['recipientCabinet']);
		}else if (isset($_POST['getValue'])) {
			header('Location: backroomResponse.php?email=' . $_POST['getValue']);			
		}else {
			header('Location: backroomResponse.php');			
		}
		$cookie_name = "responseTitle";
		$cookie_value = $_POST['title'];
		$cookie_value = str_replace("'", '', $cookie_value);
		$cookie_value = str_replace("\\", '', $cookie_value);
		setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day
		$cookie_name = "responseText";
		$cookie_value = $_POST['description'];
		$cookie_value = str_replace("'", '', $cookie_value);
		$cookie_value = str_replace("\\", '', $cookie_value);
		// $cookie_value = nl2br($cookie_value);
		setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); // 86400 = 1 day
 	}else if (isset($_POST['confirmAndComplete'])){

		// echo "Directive Number: " . $_POST['directiveNumber'] . "<br>";
 		// $query = "UPDATE  `dbilh9sp_{{CONFERENCE_NAME}}`.`Directives` SET  `Status` =  'Completed', `StatusName` = 'Completed', `DirectiveColour` =  '#76EE00'  WHERE  `Directives`.`DirectiveNumber` = " . $_POST["directiveNumber"] . " ";
 		$query = "UPDATE  `dbilh9sp_{{CONFERENCE_NAME}}`.`Directives` SET  `Status` =  'Completed', `StatusName` = '".$_COOKIE['name']."', `DirectiveColour` =  '#76EE00'  WHERE  `Directives`.`DirectiveNumber` = " . $_POST["directiveNumber"] . " ";


 		$result = mysqli_query($con, $query);
 		if (!$result) {
			header('Location: backroomResponse.php?message=error');
 			echo "ERROR" . mysqli_error($con);
		}else {
			header('Location: backroomResponse.php?message=sent');
		}
 		echo "confirmAndComplete";
 		confirmForm();

 	}else if (isset($_POST['failAndComplete'])){

		echo "Directive Number: " . $_POST['directiveNumber'] . "<br>";
 		$query = "UPDATE  `dbilh9sp_{{CONFERENCE_NAME}}`.`Directives` SET  `Status` =  'Completed', `StatusName` = 'Failed', `DirectiveColour` =  '#ff0000'  WHERE  `Directives`.`DirectiveNumber` = " . $_POST["directiveNumber"] . " ";

 		$result = mysqli_query($con, $query);
 		if (!$result) {
			header('Location: backroomResponse.php?message=error');
 			echo "ERROR" . mysqli_error($con);
		}else { 
			header('Location: backroomResponse.php?message=sent');
		}
 		echo "failAndComplete";
 		confirmForm();

 	}else if (isset($_POST['confirmAndOpposite'])){
		header('Location: backroomReserve.php?message=sent');
 		confirmForm();
 		echo "confirmAndOpposite";

 	}else if (isset($_POST['Cancel'])){
		header('Location: backroomResponse.php');

 	}else if (isset($_POST['confirmDirect'])){
		header('Location: backroomResponse.php?message=sent');
 		confirmForm();			
 	}else if (isset($_POST['confirm'])){
		header('Location: backroomResponse.php?message=sent');
		echo $_POST['recipientCabinet'];
		if ($_POST['recipientCabinet'] === 'p') {
	 		confirmForm();			
		}else { 
			sendToAllInCabinet($_POST['recipientCabinet']);
		}

 	}else if (isset($_POST['sortBy'])) {
 		if ($_POST['sortBy'] === 'all') {
			header('Location: backroomResponse.php?sortBy=all');
 		}else {
 			$location = 'Location: backroomResponse.php?sortBy=' . $_POST['sortBy'];
 			header($location);
 		}	
 	}else if (isset($_POST['showAll'])) {
 		if ($_POST['showAll'] === 'all') {
			header('Location: backroomResponse.php?showAll=Y');
 		}else {
 			$location = 'Location: backroomResponse.php?showAll=N';
 			header($location);
 		}	
 	}

 	else {
		header("Location: backroomResponse.php?message=oops");
	}

 	//cancel the cookie :P 

?>
