<?php
	if(isset($_POST['rename'])){
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
		$query =  "UPDATE  `d5g9x9d8_test2AndrewForLife`.`Cabinets` SET  `CabinetName` =  '". $_POST['name'] ."' WHERE  `Cabinets`.`ID` =".$_POST['cabinetID']." LIMIT 1 ;";
	 	$result = mysqli_query($con, $query);
	 	if (!$queryResult) {
  			// echo "ERROR" . mysqli_error($con);
		 	header("Location: settings.php?message=error");
 		}else {
		 	header("Location: settings.php?message=rename");
 			//success
 		}
	}else if (isset($_POST['remove'])){
	$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
	$result = $con->query("SELECT * FROM  `Users` WHERE `Committee` = " . $_POST['cabinetID']);
	$users = 0;
		if ($result->num_rows > 0) {

			while($row = $result->fetch_assoc()) {
				if ($row['isBackroom'] === 'f') {
					$users = 1;
				}
			}
			if ($users === 0) {
				$query = "DELETE FROM `Cabinets` WHERE id=". $_POST['cabinetID'];
				$query2 = "ALTER TABLE Cabinets AUTO_INCREMENT = 1";
			 	$queryResult = mysqli_query($con, $query);
			 	$queryResult2 = mysqli_query($con, $query2);
	     		if (!$queryResult) {
				 	header("Location: settings.php?message=error");
	      			echo "ERROR" . mysqli_error($con);
	     		}else {
				 	header("Location: settings.php?message=removeT");
	     		}
	     		if (!$queryResult2) {
	      			echo "ERROR" . mysqli_error($con);
	     		}	
			}
		}else {
		 	// echo "2: " . $_POST['cabinetID'];
			$query = "DELETE FROM `Cabinets` WHERE id=". $_POST['cabinetID'];
			$query2 = "ALTER TABLE Cabinets AUTO_INCREMENT = 1";
		 	$queryResult = mysqli_query($con, $query);
		 	$queryResult2 = mysqli_query($con, $query2);
     		if (!$queryResult) {
			 	header("Location: settings.php?message=error");
      			echo "ERROR" . mysqli_error($con);
     		}else {
			 	header("Location: settings.php?message=removeT");
     		}
     		if (!$queryResult2) {
      			echo "ERROR" . mysqli_error($con);
     		}
		}
		//check there are NO users in the removed cabinet. 

	}else if (isset($_POST['create'])){
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
		$query =  "INSERT INTO `d5g9x9d8_test2AndrewForLife`.`Cabinets` (`ID`, `CabinetName`) VALUES (NULL, '".$_POST['name']."');";
	 	$result = mysqli_query($con, $query);
	 	if ($result) {
		 	header("Location: settings.php?message=create");
 		}else {
		 	header("Location: settings.php?message=error");
 			die(mysqli_error($con));
 		}
	}else if (isset($_POST['bgImagebtn'])){
		if (endsWith($_POST['bgImage'], '.png') || endsWith($_POST['bgImage'], '.jpg')){
			setcookie("bgImageText", "", time() - 1, "/"); // 86400 = 1 day
			$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
			$userResult = $con->query("SELECT * FROM GlobalVariables WHERE `VariableName` = 'backgroundImage'");
			while ($row = $userResult->fetch_assoc()){
				$query =  "UPDATE `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET `VariableValue` = '".$_POST['bgImage']. "' WHERE `GlobalVariables`.`VariableName` = 'backgroundImage';";
				$query2 = " UPDATE `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET `VariableValue` = '".$row['VariableValue']."' WHERE `GlobalVariables`.`VariableName` = 'backgroundImageBackup';";
			 	$result = mysqli_query($con, $query);
		 			die(mysqli_error($con));
			 	$result2 = mysqli_query($con, $query2);
			 			 			die(mysqli_error($con));
			 	if ($result2) {
					header("Location: settings.php?message=bgImageT");
		 		}else {
					// header("Location: settings.php?message=error");
		 			die(mysqli_error($con));
		 		}
			}		

		}else {
			$cookie_name = "bgImageText";
			$cookie_value = $_POST['bgImage'];
			setcookie($cookie_name, $cookie_value, time() + (86400 * 3), "/"); // 86400 = 1 day
			header("Location: settings.php?message=bgImageF");
		}	
	}else if (isset($_POST['directiveTimerbtn'])){
		if (is_numeric($_POST['directiveTimer'])) {
			$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
			$query =  "UPDATE  `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET  `VariableValue` =  '". $_POST['directiveTimer'] ."' WHERE  `GlobalVariables`.`VariableName` = 'DirectiveTimer' LIMIT 1 ;";
		 	$result = mysqli_query($con, $query);
		 	if ($result) {
				header("Location: settings.php?message=directiveTimerT");
	 		}else {
				header("Location: settings.php?message=error");
	 			die(mysqli_error($con));
	 		}
		}else {
			header("Location: settings.php?message=directiveTimerF");
		}
	}else if (isset($_POST['bgImageRevert'])) {
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
		$userResult = $con->query("SELECT * FROM `GlobalVariables`");
		$newBackup;
		$newCurrent;
		while ($row = $userResult->fetch_assoc()){
			if ($row['VariableName'] === 'backgroundImage'){
				$newBackup = $row['VariableValue'];
			}else if ($row['VariableName'] === 'backgroundImageBackup') {
				$newCurrent = $row['VariableValue'];
			}
		}		
		$query =  "UPDATE `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET `VariableValue` = '".$newCurrent. "' WHERE `GlobalVariables`.`VariableName` = 'backgroundImage';";
		$query2 = " UPDATE `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET `VariableValue` = '".$newBackup."' WHERE `GlobalVariables`.`VariableName` = 'backgroundImageBackup';";
	 	$result = mysqli_query($con, $query);
	 	$result2 = mysqli_query($con, $query2);
	 	if ($result) {
			header("Location: settings.php?message=revert");
 		}else {
			header("Location: settings.php?message=error");
 			die(mysqli_error($con));
 		}
	 	if ($result2) {
 		}else {

 			die(mysqli_error($con));
 		}
	}else if (isset($_POST['startCrisis'])) {
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
		$result = $con->query("SELECT * FROM Users");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				emailPerson($row['id'], $row['UserNameID'] , '1');
			}
			$query =  "UPDATE  `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET  `VariableValue` =  'Y' WHERE  `GlobalVariables`.`VariableName` = 'CrisisHasStarted' LIMIT 1 ;";
	 		$result = mysqli_query($con, $query); 
		 	if ($result) {
				header("Location: settings.php?message=startCrisis");
	 		}else {
				header("Location: settings.php?message=error");
	 			die(mysqli_error($con));
	 		}
		}

	} else if (isset($_POST['emailReset']))	{///THIS IS FROM HELP.PHP DFKLJNSDFKNJSDFKNSBFLKJSDFSDKJNFSDLKFN ________________________________________________________________________________________________________
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
		$result = $con->query("SELECT * FROM Users");
		if ($result->num_rows > 0) {
			$isTrue = 'false';
			while($row = $result->fetch_assoc()) {
				if (strtolower($_POST['email']) === strtolower($row["UserNameID"])) {
					$isTrue = 'true';
					emailPerson($row['id'], $row['UserNameID'], '2');
				}
			}
			if ($isTrue === 'false') {
				header("Location: help.php?message=noUser");
			} else {
				header("Location: help.php?message=reset");
			}
		}
	}else if (isset($_POST['directiveFreeze'])) {
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
		$query =  "UPDATE  `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET  `VariableValue` =  '".$_POST['directiveFreeze']."' WHERE  `GlobalVariables`.`VariableName` = 'DirectiveFreeze' LIMIT 1 ;";
		$result = mysqli_query($con, $query); 
		// if ($result) {
		//  		}else {

		//  			die(mysqli_error($con));
		//  		}
		if ($_POST['directiveFreeze'] === 'F'){
			header("Location: settings.php?message=unfrozen");
		}else {
		 	if ($result) {
				header("Location: settings.php?message=frozen");			
	 		}else {
				header("Location: settings.php?message=error");
	 			die(mysqli_error($con));
	 		}
		}
	}else if (isset($_POST['sheetbtn'])){
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
		$userResult = $con->query("SELECT * FROM GlobalVariables WHERE `VariableName` = 'GoogleDoc'");
		while ($row = $userResult->fetch_assoc()){
			$query =  "UPDATE `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET `VariableValue` = '".$_POST['sheet']. "' WHERE `GlobalVariables`.`VariableName` = 'GoogleDoc';";
			$query2 = " UPDATE `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET `VariableValue` = '".$row['VariableValue']."' WHERE `GlobalVariables`.`VariableName` = 'GoogleDocBackup';";
		 	$result = mysqli_query($con, $query);
		 	$result2 = mysqli_query($con, $query2);
		 	if ($result2) {
				header("Location: settings.php?message=sheetT");
	 		}else {
				header("Location: settings.php?message=error");
	 			die(mysqli_error($con));
	 		}
		}		

	}else if (isset($_POST['sheetRevert'])) {
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
		$userResult = $con->query("SELECT * FROM `GlobalVariables`");
		$newBackup;
		$newCurrent;
		while ($row = $userResult->fetch_assoc()){
			if ($row['VariableName'] === 'GoogleDoc'){
				$newBackup = $row['VariableValue'];
			}else if ($row['VariableName'] === 'GoogleDocBackup') {
				$newCurrent = $row['VariableValue'];
			}
		}		
		$query =  "UPDATE `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET `VariableValue` = '".$newCurrent. "' WHERE `GlobalVariables`.`VariableName` = 'GoogleDoc';";
		$query2 = " UPDATE `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET `VariableValue` = '".$newBackup."' WHERE `GlobalVariables`.`VariableName` = 'GoogleDocBackup';";
	 	$result = mysqli_query($con, $query);
	 	$result2 = mysqli_query($con, $query2);
	 	if ($result) {
			header("Location: settings.php?message=revert");
 		}else {
			header("Location: settings.php?message=error");
 			die(mysqli_error($con));
 		}
	 	if ($result2) {
 		}else {

 			die(mysqli_error($con));
 		}
	}else if (isset($_POST['faviconbtn'])){
		if (endsWith($_POST['favicon'], '.png') || endsWith($_POST['favicon'], '.jpg')){
			setcookie("faviconText", "", time() - 1, "/"); // 86400 = 1 day
			$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
			$userResult = $con->query("SELECT * FROM GlobalVariables WHERE `VariableName` = 'favicon'");
			while ($row = $userResult->fetch_assoc()){
				$query =  "UPDATE `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET `VariableValue` = '".$_POST['favicon']. "' WHERE `GlobalVariables`.`VariableName` = 'favicon';";
				$query2 = " UPDATE `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET `VariableValue` = '".$row['VariableValue']."' WHERE `GlobalVariables`.`VariableName` = 'faviconBackup';";
			 	$result = mysqli_query($con, $query);
			 	$result2 = mysqli_query($con, $query2);
			 	if ($result2) {
					header("Location: settings.php?message=faviconT");
		 		}else {
					header("Location: settings.php?message=error");
		 			die(mysqli_error($con));
		 		}
			}		

		}else {
			$cookie_name = "faviconText";
			$cookie_value = $_POST['favicon'];
			setcookie($cookie_name, $cookie_value, time() + (86400 * 3), "/"); // 86400 = 1 day
			header("Location: settings.php?message=faviconF");
		}	
	}else if (isset($_POST['faviconRevert'])) {
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
		$userResult = $con->query("SELECT * FROM `GlobalVariables`");
		$newBackup;
		$newCurrent;
		while ($row = $userResult->fetch_assoc()){
			if ($row['VariableName'] === 'favicon'){
				$newBackup = $row['VariableValue'];
			}else if ($row['VariableName'] === 'faviconBackup') {
				$newCurrent = $row['VariableValue'];
			}
		}		
		$query =  "UPDATE `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET `VariableValue` = '".$newCurrent. "' WHERE `GlobalVariables`.`VariableName` = 'favicon';";
		$query2 = " UPDATE `d5g9x9d8_test2AndrewForLife`.`GlobalVariables` SET `VariableValue` = '".$newBackup."' WHERE `GlobalVariables`.`VariableName` = 'faviconBackup';";
	 	$result = mysqli_query($con, $query);
	 	$result2 = mysqli_query($con, $query2);
	 	if ($result) {
			header("Location: settings.php?message=revert");
 		}else {
			header("Location: settings.php?message=error");
 			die(mysqli_error($con));
 		}
	 	if ($result2) {
 		}else {

 			die(mysqli_error($con));
 		}
	}else {
		header("Location: settings.php?message=Oops");
	
	}

	function emailPerson($id, $email, $type){
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
		$password = generatePassword();
		//HERE NEED TO EMAIL THE PERSON 



	//	HERE IS WHERE WE ACCESS THE GLOBALVARIABLES DB. Get THE NAME OF THE CURRENT CRISIS. ADD IT TO TITLE.

		$to = $email;
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
		$globalResult = $con->query("SELECT * FROM `GlobalVariables` WHERE `VariableName` = 'CrisisName'");
		if ($type === '1') {
			while($row = $globalResult->fetch_assoc()) {
				$subject = $row['VariableValue'] . ' Crisis - Has started';
			}
			$message = 'Dear Delegate,

Welcome to muncrisis.com, the first purpose built Crisis website. 
Please head to http://cuimun.muncrisis.com/ and log in using your email address as your username and the following password: ' . $password . '
Unless you log out you will remain logged in for the entire duration of the crisis. If you like you can change your password once you’ve logged in by going to “Settings”.
If you experience any difficulties please contact: Webmaster@muncrisis.com

Kind Regards,

Andrew Weeks,
MUNCrisis Webmaster';


			$headers = 'From: Webmaster from MUNCrisis.com' . "\r\n" .
			    'Reply-To: webmaster@muncrisis.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();
		}else if ($type === '2') {
			while($row = $globalResult->fetch_assoc()) {
				$subject = $row['VariableValue'] . ' Crisis - Password Reset';
			}
			// $message = 'Hello delegate, 

			// 			Here is your new password: ' .$password. ' you can easily change it from the Settings tab. Sorry for the mild inconvenience. 

			// 			Kind Regards,
			// 			    muncrisis.com Support';
			// 				$headers = 'From: Webmaster from MUNCrisis.com' . "\r\n" .
			// 			    'Reply-To: webmaster@muncrisis.com' . "\r\n" .
			// 			    'X-Mailer: PHP/' . phpversion();
		$password = "123456"; //$#0000000 uncomment me
			$message = 'Whooooops, it seems you forgot your password?
Please use your email address as your username and the following password to log into your account: ' . $password . '
 Then head to “Settings” to change your password to something you can remember, 123456 is usually a good one ;-)

Kind Regards,

Andrew Weeks
MUNCrisis Webmaster';
			$headers = 'From: Webmaster from MUNCrisis.com' . "\r\n" .
			    'Reply-To: webmaster@muncrisis.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

		}
		// echo $password;
		mail($to, $subject, $message, $headers); #0000000 uncomment me
		// mail('a.andyrewwer@gmail.com', $subject, $message, $headers); #0000000 uncomment me
		// mail('webmaster@muncrisis.com', $subject, $message, $headers); #0000000 uncomment me

		// echo $password;
		// echo "<br>" . $to;
		$password = encryptPassword($password);
		//HERE NEED TO SET THE PASSWORD
		$query =  "UPDATE  `d5g9x9d8_test2AndrewForLife`.`Users` SET  `pass` =  '".$password."' WHERE  `Users`.`id` = ".$id." LIMIT 1 ;";
 		$result = mysqli_query($con, $query);#000000 uncomment me
 		// echo $query;
	
		//email person for given ID
	}
	function generatePassword(){
	    $chars = 'bcdfghjkmnpqrstvwxyzBCDFGHJLMNPQRSTVWXYZ23456789';
	    $count = mb_strlen($chars);

	    for ($i = 0, $result = ''; $i < 6; $i++) {
	        $index = rand(0, $count - 1);
	        // echo $i . $i %4 . "<br>";
	        if ($i % 3 === 0 && $i !== 0) {
	        	// echo "working";
	        	$password .= '-';
	        }
	        $password .= mb_substr($chars, $index, 1);
	    }
		//ALGORITHM NEEDED HERE. EVEN THUOGH NOT NEEDED YET.
		return $password;
	}
	function encryptPassword ($password) {
		$password = hash("sha256", $password);
		return $password;
	}
	



	function endsWith($haystack, $needle)
	{
	    $length = strlen($needle);
	    if ($length == 0) {
	        return true;
	    }

	    return (substr($haystack, -$length) === $needle);
	}
?>
