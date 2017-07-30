<?php
	function createUsers() {
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
		$result = $con->query("SELECT * FROM Users");
		if ($result->num_rows > 0) {
			$myArray = array();
			$usernameIsFree = 'true';
		    while($row = $result->fetch_assoc()) {
		    	if (strcasecmp($_POST['user'],$row['UserNameID']) === 0){
		    		$usernameIsFree = 'false';
		    		break;
		    	}
		    }
		    if ($usernameIsFree === 'true') {
				$username = str_replace("'", '', $_POST['user']);
				$username = str_replace(">", '', $username);
				$username = str_replace(" ", '', $username);
				$characterName = str_replace("'", '', $_POST['name']);
				$characterName = str_replace(">", '', $characterName);
				$committee = $_POST['Cabinet'];
				$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
				$isBackroom = 'f';
				if ($committee === 'b') {
					$isBackroom = 't';
					$committee = '1';
				}
					date_default_timezone_set('Europe/London'); 
					$currentTime = date('Y-m-d H:i:s'); // current time
				$password = generatePassword();
				if (isset($_POST['Chair']) && $_POST['Chair'] === 'Yes') {
					$isChair = 't';
				}else {
					$isChair = 'f';
				}
							$query = "INSERT INTO  `d5g9x9d8_{{CONFERENCE_NAME}}`.`Users` (
					`UserNameID` ,
					`CharacterName` ,
					`Committee` ,
					`pass` ,
					`isBackroom` ,
					`isChair` ,
					`backroomColour` ,
					`reservedDirective` ,
					`id` ,
					`LastDirective`
					)
					VALUES (
					'".$username."',  '".$characterName."',  '".$committee."',  '".$password."',  '".$isBackroom."', '".$isChair."', '#FCA326', NULL , NULL ,  '".$currentTime."');";

				if ($isBackroom === "f") {
					date_default_timezone_set('Europe/London'); // CDT
				$currentDate = getDate();
				$date = $currentDate['mday'];
				$month = $currentDate['mon'];
				$year = $currentDate['year'];
				$hour = $currentDate['hours'];
				$min = $currentDate['minutes'];
				$sec = $currentDate['seconds'];
				$currentDate = "$date/$month/$year == $hour:$min:$sec";
				$globalResult = $con->query("SELECT * FROM `GlobalVariables` WHERE `VariableName` = 'CrisisName'");
				while($row = $globalResult->fetch_assoc()) {
					$crisisNameTwo = $row['VariableValue'];
				}
				$query2 = "INSERT INTO  `d5g9x9d8_{{CONFERENCE_NAME}}`.`Responses` (`Recipient`, `RecipientName`,`Directive`,`DirectiveNumber`,`Response`,`responseDescription` ,`responseID` ,`readByDelegate`, `ResponseAllowed`, `Timestamp`)VALUES ('".$username ."','".$characterName."', 'Original Directive','0',  'Welcome to ". $crisisNameTwo.	" Crisis.', 'All your personal messages will arrive here on the right. When the back room responds  to your directive. Its original text will appear below. To your right you will be able to see all public responses (visible to everyone). If you read something on public news - it is true and the word of the backroom. To submit a telegram; simply click the tab at the top; fill in the aspects and youre off! Any further questions should be addressed to your chair or backroom staff all of whom will have more information.', NULL ,  'f', 'f', '".$currentDate."');";
					$result2 = mysqli_query($con, $query2);
				}
				$result = mysqli_query($con, $query);

				if ($result) {
	    			header('Location: createUser.php?message=success');
		 		}else {
	    			header('Location: createUser.php?message=error');
		 			die(mysqli_error($con));
		 		}


		    }else {
			    	header('Location: createUser.php?message=alreadyExists');
		    }
		    
		}
	}
	function generatePassword(){
	    $chars = 'bcdfghjkmnpqrstvwxyzBCDFGHJLMNPQRSTVWXYZ23456789';
	    $count = mb_strlen($chars);

	    for ($i = 0, $result = ''; $i < 16; $i++) {
	        $index = rand(0, $count - 1);
	        if ($i % 4 === 0 && $i !== 0) {
	        	$result .= '-';
	        }
	        $password .= mb_substr($chars, $index, 1);
	    }
		$password = "123456";#0000000 comment me! 
		$password = hash("sha256", $password);
		//ALGORITHM NEEDED HERE. EVEN THUOGH NOT NEEDED YET.
		return $password;
	}

//ACTUAL CALLING METHOD S
	// _ _ _ _ __ _ _ _ __ _ _ _ __ _ _ _ __ _ F_FF __ _ __ _ _ __ _ _ _ _ __ _ _ _ - - - -- - - - - - -- - - - -

	if(isset($_POST['createUser'])) { 
		if ($_POST['user'] !== '' && $_POST['name'] !== '' && isset($_POST['Cabinet'])) {
			createUsers();
		}else {
			header('Location: createUser.php?messages=failure');
		
		}
	}else if (isset($_POST['changeCabinet'])) {
		if (isset($_POST['Cabinet'])) {
		 	$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
			$result = $con->query("SELECT * FROM Users WHERE `Users`.`id` =".$_POST['delegateID'].";");
				while($userRow = $result->fetch_assoc()) {
					if ($userRow['isBackroom'] === 'a') {
				    	header('Location: createUser.php?message=admin');
				    	exit;
					}
				}
				// echo "oops";
		 	$cabinet = $_POST['Cabinet'];
		 	if ($cabinet === 'backroom') {
				$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());

		 		$query = "UPDATE `d5g9x9d8_{{CONFERENCE_NAME}}`.`Users` SET `isBackroom` = 't', `backroomColour` = '#FCA326' WHERE `Users`.`id` =" .$_POST['delegateID'] ." LIMIT 1";

		 	}else {
				$query =  "UPDATE  `d5g9x9d8_{{CONFERENCE_NAME}}`.`Users` SET  `Committee` =  '". $cabinet ."',
`isBackroom` =  'f',
`backroomColour` =  '#FCA326', reservedDirective = '' WHERE  `Users`.`id` =".$_POST['delegateID']." LIMIT 1 ;";

				$changedUserResult = $con->query("SELECT * FROM Users WHERE `Users`.`id` = ". $_POST['delegateID']);
				while($row = $changedUserResult->fetch_assoc()) {
					$removeReservedDirective = "UPDATE `d5g9x9d8_{{CONFERENCE_NAME}}`.`Directives` SET `Status` = 'Available', `StatusName` = 'Available', `DirectiveColour` = '' WHERE `Status` = '".$row['UserNameID']."';";
				 	$resultNew = mysqli_query($con, $removeReservedDirective);
					if ($resultNew) {
			 		}else {

			 			die(mysqli_error($con));
			 		}
				}	
		 	}

		 	$result = mysqli_query($con, $query);

			$location = "Location: createUser.php?message=selectCabinetY"; 
			if ($result) {
				header($location);
	 		}else {
				header("Location: createUser.php?message=error");
	 			die(mysqli_error($con));
	 		}


		}else {
			$location = "Location: createUser.php?email=" . $_POST['delegateID']. "&cabinet=" . $_POST['cabinetID'] . "&message=selectCabinet"; 
			header($location);
		}

	}else if (isset($_POST['killRevive'])) {
		if (isset($_POST['Cabinet']) && isset($_POST['name']) && $_POST['name'] !== "") {
		 	$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
//		 	echo "Cabinet: " . $_POST['cabinet'];
			$name = $_POST['name'];
			if (isset($_POST['Chair']) && $_POST['Chair'] === 'Yes') {
				$query = "UPDATE  `d5g9x9d8_{{CONFERENCE_NAME}}`.`Users` SET  `CharacterName` =  '". $name."',`Committee` =  '". $_POST['Cabinet'] ."',`isBackroom` = 'f', `BackroomColour` = '#FCA326', reservedDirective = '', `isChair` = 't' WHERE  `Users`.`id` =". $_POST['delegateID'] . " LIMIT 1 ;";			
			}else {
				$query = "UPDATE  `d5g9x9d8_{{CONFERENCE_NAME}}`.`Users` SET  `CharacterName` =  '". $name."',`Committee` =  '". $_POST['Cabinet'] ."',`isBackroom` = 'f', `BackroomColour` = '#FCA326', reservedDirective = '', `isChair` = 'f' WHERE  `Users`.`id` =". $_POST['delegateID'] . " LIMIT 1 ;";			
			}
		 	$result = mysqli_query($con, $query);
						$location = "Location: createUser.php?message=selectCabinetY"; 
			if ($result) {
				header($location);
	 		}else {
				header("Location: createUser.php?message=error");
	 			die(mysqli_error($con));
	 		}
		 	// echo "name: " . $_POST['name'];
		 	// echo "<br>query : " . $query;

			$theResult = $con->query("SELECT * FROM Users");
			if ($theResult->num_rows > 0) {
				$usernameIsFree = 'true';
			    while($row = $theResult->fetch_assoc()) {
			    	if ($_POST['name'] === $row['CharacterName']){
			    		// echo "Username: " . $row['UserNameID'];
			    		$username = $row['UserNameID']; 
			    		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
						$searchQuery = "SELECT * FROM  Cabinets WHERE ID = ". $_POST['Cabinet'];
						$result = $con->query($searchQuery);
						while($row2 = $result->fetch_assoc()) {
							$committee = $row2['CabinetName'];
							echo $committee;
						}
date_default_timezone_set('Europe/London'); // CDT
			$currentDate = getDate();
			$date = $currentDate['mday'];
			$month = $currentDate['mon'];
			$year = $currentDate['year'];
			$hour = $currentDate['hours'];
			$min = $currentDate['minutes'];
			$sec = $currentDate['seconds'];
			$currentDate = "$date/$month/$year == $hour:$min:$sec";


    					$query2 = "INSERT INTO  `d5g9x9d8_{{CONFERENCE_NAME}}`.`Responses` (
						`Recipient` ,
						`RecipientName`,
						`Directive` ,
						`Response` ,
						`responseDescription` ,
						`responseID` ,
						`readByDelegate`,`ResponseAllowed`, `Timestamp`
						)
						VALUES (
						'".$username ."','".$row['CharacterName']."',  'NULL',  'To whom it may concern: Sorry for your loss. You have died. Rest in Peace.', 'This is very sad; but a necessary part of crisis. Your new name is <b>" . $_POST['name'] . "</b> and you are in the <b>" . $committee. "</b> cabinet. Expect a message soon from the backroom with your new characters biography (either through here; email or in print). Good luck!', NULL ,  'f', 'f', '".$currentDate."'
						);";	
						// echo "<br> " . $query2 . "<br>";
					 	$queryResult = mysqli_query($con, $query2);
							if ($queryResult) {
					 			echo "Success!";
					 		}else {

					 			die(mysqli_error($con));
					 		}			    		break;
						    	}
						    }
			}
			$changedUserResult = $con->query("SELECT * FROM Users WHERE `Users`.`id` = ". $_POST['delegateID']);
			while($row = $changedUserResult->fetch_assoc()) {
				$removeReservedDirective = "UPDATE `d5g9x9d8_{{CONFERENCE_NAME}}`.`Directives` SET `Status` = 'Available', `StatusName` = 'Available', `DirectiveColour` = '' WHERE `Status` = '".$row['UserNameID']."';";
			 	$resultNew = mysqli_query($con, $removeReservedDirective);
				if ($resultNew) {
		 		}else {

		 			die(mysqli_error($con));
		 		}
		 	}
		}else {
			$location = "Location: createUser.php?email=" . $_POST['delegateID']. "&cabinet=" . $_POST['cabinetID'] . "&message=selectCabinet"; 
			header($location);
		}			
	}else if (isset($_POST['deleteDelegate'])){
		// echo "Delete Character";
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
		$deleteQuery = 'DELETE FROM Users WHERE id =' .$_POST['delegateID'];
		// echo "<br>". $deleteQuery;
		$queryResult = mysqli_query($con, $deleteQuery);
		if ($queryResult) {
			// echo "working";
			header("Location: createUser.php?message=delegateDeleted");
			$deleteQuery2 = 'DELETE FROM Responses WHERE Recipient = "' .$_POST['Email'].'"';
			$queryResult2 = mysqli_query($con, $deleteQuery2);
			if (!$queryResult2) {	
	 			die(mysqli_error($con));
			}
			$deleteQuery3 = 'DELETE FROM Directives WHERE DirectiveSender = "' .$_POST['Email'].'"';
			$queryResult3 = mysqli_query($con, $deleteQuery3);
			if (!$queryResult3) {	
	 			die(mysqli_error($con));
			}	


 		}else {
 						// echo "not working";
			header("Location: createUser.php?message=error");
 			die(mysqli_error($con));
 		}

	}else if (isset($_POST['editCharacter'])){
		$username = str_replace("'", '', $_POST['Email']);
		$username = str_replace(">", '', $username);
		$username = str_replace(" ", '', $username);

		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
		$updateQuery = "UPDATE Users SET `UserNameID` = '".$username."', `CharacterName` = '".$_POST['CharacterName']."' WHERE `Users`.`id` = " .$_POST['delegateID'];
		// echo "<br>". $deleteQuery;
		$updateQueryResult = mysqli_query($con, $updateQuery);
		if ($updateQueryResult) {
			// echo "working";
			header("Location: createUser.php?message=delegateEdited");
			$updateQuery2 = 'UPDATE Responses SET Recipient = "'.$username.'" WHERE Recipient = "' .$_POST['delegateEmailOriginal'].'"';
			$queryResult2 = mysqli_query($con, $updateQuery2);
			if (!$queryResult2) {	
	 			die(mysqli_error($con));
			}
			$updateQuery3 = 'UPDATE Directives SET DirectiveSender = "'.$username.'" WHERE DirectiveSender = "' .$_POST['delegateEmailOriginal'].'"';
			$queryResult3 = mysqli_query($con, $updateQuery3);
			if (!$queryResult3) {	
	 			die(mysqli_error($con));
			}	


 		}else {
 						// echo "not working";
			header("Location: createUser.php?message=error");
 			die(mysqli_error($con));
 		}
		

		// echo "edit information with: <br> Email: " . $username."<Br> and DelegateName: " .$_POST['CharacterName']."<br>";
	}else {
			header("Location: createUser.php?message=oops");
	}
?>
