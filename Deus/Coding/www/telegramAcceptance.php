<?php 

//make sure to submit character name
//cookie name ="name"


	$ID = $_POST['user'];
	$Password = $_POST['pass'];
	function submitTelegram() { 
		 		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_fredmun") or die(mysql_error());

 		$directiveSender = str_replace("'", '', $_COOKIE['user']);
		$directiveSender = str_replace(">", '', $directiveSender);
 		$directiveSenderName = str_replace("'", '', $_COOKIE['name']);
		$directiveSenderName = str_replace(">", '', $directiveSenderName);
 		//$directiveSender = mysqli_real_escape_string($con, $_COOKIE['user']);
		$directiveFrom = $_POST['Sender'];		
		if ($directiveFrom === 'Multiple') {
			if(!empty($_POST['Characters'])){
	// Loop to store and display values of individual checked checkbox.
				foreach($_POST['Characters'] as $selected){
					$array = explode('|',$selected);
					if (strpos($directiveSender, $array[0]) === false) {
						$directiveSender .= "|".$array[0];
					}
					if (strpos($directiveSenderName, $array[1]) === false) {
						$directiveSenderName .= "<br>" . $array[1];
					}
					// echo $array[0] . "  " . $array[1];
					// echo "<br>";
					// now have Sender | SenderName 
					// need to add Sender to $directiveSender and SenderName to $directiveSenderName and remove/split at the | should be fun! Then backroom showing is easy; and everything. When they respond. Should be a simple case of replacing WHERE ___ = ___ to WHERE ___ LIKE %___% #hopefully #checkTest I believe #hopeI didn't delete it
					// echo $selected."</br>";
				}
			}
		}

		$directiveCommittee = $_COOKIE['committee'];
		//echo "Directive COmmittiee " . $directiveCommittee;
		$directivesDescription = str_replace("'", '', $_POST['description']);
		$directivesDescription = str_replace(">", '', $directivesDescription);
		$directivesDescription = nl2br($directivesDescription);
		$directiveType = $_POST['Type'];
		//$directivesDescription = mysqli_real_escape_string($con, $_POST['description']);
		// echo $directivesDescription;
date_default_timezone_set('Europe/London'); // CDT
			$currentDate = getDate();
			$date = $currentDate['mday'];
			$month = $currentDate['mon'];
			$year = $currentDate['year'];
			$hour = $currentDate['hours'];
			$min = $currentDate['minutes'];
			$sec = $currentDate['seconds'];
			$currentDate = "$date/$month/$year == $hour:$min:$sec";
		$query = "INSERT INTO `Directives` (`DirectiveNumber` ,`DirectiveSender`, `DirectiveSenderName`,`DirectiveCommittee` ,`DirectiveFrom` ,`DirectiveType` ,`DirectiveText` ,`Status`,`StatusName`, `DirectiveColour`, `Timestamp` )
			VALUES (
			NULL , '$directiveSender', '$directiveSenderName', '$directiveCommittee', '$directiveFrom', '$directiveType', '$directivesDescription', 'Available','Available', '', '".$currentDate."')"; 
			if ($directiveFrom === 'Committee'){
				$query = "INSERT INTO `Directives` (`DirectiveNumber` ,`DirectiveSender`, `DirectiveSenderName`,`DirectiveCommittee` ,`DirectiveFrom` ,`DirectiveType` ,`DirectiveText` ,`Status`,`StatusName`, `DirectiveColour`, `Timestamp` )
				VALUES (
				NULL , '$directiveSender', '$directiveSenderName', '$directiveCommittee', '$directiveFrom', '$directiveType', '$directivesDescription', 'Frozen','Frozen', '', '".$currentDate."')"; 
			}
 		//mysqli_query($query);
 //echo $query. "<br><br>";
 		$result = mysqli_query($con, $query);
 		if ($result) {
			header('Location: telegram.php?message=success');
	   	}else {
			// header('Location: telegram.php?message=error');
			$cookie_name = "telegramText";
			$cookie_value = $_POST["description"];
			$cookie_value = str_replace("'", '', $cookie_value);
			$cookie_value = str_replace(">", '', $cookie_value);
			// $cookie_value = nl2br($cookie_value);
			setcookie($cookie_name, $cookie_value, time() + (86400 * 3), "/");
			die(mysqli_error($con));
		}



 		// if ($con->query($query) === TRUE) {
 		// 	echo "new record created";
 		// }else {
 		// 	echo "<br>failure</br>";
 		// }

	} 

	if(isset($_POST['submit'])) { 
		if (!isset($_POST['Sender']) || !isset($_POST['Type']) || !isset($_POST['description'])) {
			header('Location: telegram.php?message=failure');
			$cookie_name = "telegramText";
			$cookie_value = $_POST["description"];
			$cookie_value = str_replace("'", '', $cookie_value);
			$cookie_value = str_replace(">", '', $cookie_value);
			// $cookie_value = nl2br($cookie_value);
			setcookie($cookie_name, $cookie_value, time() + (86400 * 3), "/"); // 86400 = 1 day
			// echo "test " . $_COOKIE['telegramText'] . "<br>";
		}else {
			date_default_timezone_set('Europe/London'); 
			$currentTime = date('Y-m-d H:i:s'); // current time
			$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_fredmun") or die(mysql_error());
			$query = "SELECT * FROM GlobalVariables ";
			$queryUsers = "SELECT * FROM Users WHERE `UserNameID` = '". $_COOKIE['user'] ."'";
			$result = mysqli_query($con, $query);
			$resultUsers = mysqli_query($con, $queryUsers);
			while($row = $result->fetch_assoc()) {
				if ($row['VariableName'] === 'DirectiveTimer'){
					$directiveTimer = $row['VariableValue'];
				}
				if ($row['VariableName'] === 'DirectiveFreeze'){
					if ($row['VariableValue'] === 'T') {
						$cookie_name = "telegramText";
						$cookie_value = $_POST["description"];
						$cookie_value = str_replace("'", '', $cookie_value);
						$cookie_value = str_replace(">", '', $cookie_value);
						// $cookie_value = nl2br($cookie_value);
						setcookie($cookie_name, $cookie_value, time() + (86400 * 3), "/");
						// echo $cookie_value;
						header('Location: telegram.php?message=frozen');
						exit;
						return;
					}
				}
			}while($row = $resultUsers->fetch_assoc()) {
				$lastDirectiveAndDirectiveTimer = date('Y-m-d H:i:s',(strtotime($row['LastDirective']) + $directiveTimer*60));//time on Server + Directive Timer * 60 (in mins)
					// echo "Test: currentTime > test     " . $currentTime . " > " . $lastDirectiveAndDirectiveTimer;

				if ($currentTime > $lastDirectiveAndDirectiveTimer) {
					//allow directive
					submitTelegram();
					$queryUpdate = "UPDATE  `d5g9x9d8_fredmun`.`Users` SET  `LastDirective` =  '". $currentTime ."' WHERE `UserNameID` = '". $_COOKIE['user'] ."'";
					$result2 = mysqli_query($con, $queryUpdate); 
					if (!$result2) {
						// die(mysqli_error($con));
				   	}
			   	
			
				}else {
					//do no allow directive
						// echo $cookie_value;

					header('Location: telegram.php?message=tooSoon');
						$cookie_name = "telegramText";
						$cookie_value = $_POST["description"];
						$cookie_value = str_replace("'", '', $cookie_value);
						$cookie_value = str_replace(">", '', $cookie_value);
						setcookie($cookie_name, $cookie_value, time() + (86400 * 3), "/");
						return;
				}
			}

			//updates time to current. 
			setcookie("telegramText", "", time() + (86400 * 3), "/"); // 86400 = 1 day
			// echo "Submitted By: " . $_COOKIE["name"] . "<br>";
		}
		// if(isset($_POST['Sender']))
		// {
		// 	echo "You have selected :".$_POST['Sender'] . "<br>";  //  Displaying Selected Valu
		// }
		// if(isset($_POST['Type']))
		// {
		// 	echo "Type :".$_POST['Type'] . "<br>";  //  Displaying Selected Value
		// }
		// if(isset($_POST['description']))
		// {
		// 	echo "Description :".$_POST['description'] . "<br>";  //  Displaying Selected Value
		// }

	}else if (isset($_POST['superResonspe'])){
		if ($_POST['description'] === '') {
			$loc = "Location: profile.php?privatemessage=".$_POST['directiveNumber'].'&message=noWords';
			header($loc);
			exit;
		}
 		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_fredmun") or die(mysql_error());
 		$directiveSender = $_COOKIE['user'];
 		$directiveSenderName = $_COOKIE['name'];
		$directiveFrom = "RESPONSE AT BACKROOM REQUEST SEE: " . $_POST['DirectiveNumber'];		
		$directiveCommittee = $_COOKIE['committee'];
		// echo "Directive COmmittiee " . $directiveCommittee;
		
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_fredmun") or die(mysql_error());
		$result = $con->query("SELECT * FROM Responses WHERE `responseID` = ". $_POST['responseNumber']);
   		if ($result) {
 			// echo "Success!";
 		}else {
 			// echo "test!";

 			die(mysqli_error($con));
 		}

	   // echo "test";
	   		if ($result->num_rows > 0) {
	   			// echo "scucess";
	    while($row = $result->fetch_assoc()) {
    		$directivesDescription = str_replace("'", '', $_POST['description']);
			$directivesDescription = str_replace(">", '', $directivesDescription);
			$directivesDescription = "<b>" . $row['Response'] . "</b><br><i>" . $row['responseDescription'] . "</i><br><br>" . $directivesDescription;
			// echo $directivesDescription;
	    }
			// echo $directivesDescription;
			date_default_timezone_set('Europe/London'); // CDT
			$currentDate = getDate();
			$date = $currentDate['mday'];
			$month = $currentDate['mon'];
			$year = $currentDate['year'];
			$hour = $currentDate['hours'];
			$min = $currentDate['minutes'];
			$sec = $currentDate['seconds'];
			$currentDate = "$date/$month/$year == $hour:$min:$sec";

		$directiveType = "RESPONSE AT BACKROOM REQUEST SEE: " . $_POST['directiveNumber'];
		$query = "INSERT INTO `Directives` (`DirectiveNumber` ,`DirectiveSender`, `DirectiveSenderName`,`DirectiveCommittee` ,`DirectiveFrom` ,`DirectiveType` ,`DirectiveText` ,`Status`, `StatusName`, `DirectiveColour`, `Timestamp`)
		VALUES (
		NULL , '$directiveSender', '$directiveSenderName', '$directiveCommittee', '$directiveFrom', '$directiveType', '$directivesDescription', 'Available', 'Available', '', '".$currentDate."')"; 
		$query2 = "UPDATE `d5g9x9d8_fredmun`.`Responses` SET `ResponseAllowed` = 'f' WHERE `Responses`.`Recipient` = '". $_COOKIE['user']."';";
}
 		// mysqli_query($query);
 // echo $query. "<br><br>";
 		$result = mysqli_query($con, $query);
 		$result2 = mysqli_query($con, $query2);
		if ($result) {
			header("Location: profile.php?message=complete");
 		}else {
			$cookie_name = "respond";
			$cookie_value = $_POST["description"];
			$cookie_value = str_replace("'", '', $cookie_value);
			$cookie_value = str_replace(">", '', $cookie_value);
			setcookie($cookie_name, $cookie_value, time() + (86400 * 3), "/");
			// header("Location: profile.php?message=error");
 			die(mysqli_error($con));
 		}



	} else {
			header("Location: telegram.php?message=oops");
	}
 

?>