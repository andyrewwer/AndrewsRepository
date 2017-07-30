<?php
	if(isset($_POST['changePassword'])){
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
		$result = $con->query("SELECT * FROM Users WHERE `Users`.`UserNameID` = '". $_COOKIE['user'] . "'");
		if ($result->num_rows > 0) {
			$password = $_POST['pass1']; 
			$password = str_replace(' ', '', $password);
			$password = hash("sha256", $password);
			while($row = $result->fetch_assoc()) {
				if ($password === $row["pass"]) {
					if ((strcmp($_POST['pass2a'],$_POST['pass2b']) === 0) && strlen($_POST['pass2a']) >= 5) {
				   	 	header("Location: userSettings.php?message=changed"); 	
 						$cookie_name = "pass";
						$cookie_value = $_POST['pass2a'];
						$password = $_POST['pass2a']; 
						$password = hash("sha256", $password);
						setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
						$query =  "UPDATE  `d5g9x9d8_{{CONFERENCE_NAME}}`.`Users` SET  `pass` =  '". $password ."' WHERE  `Users`.`UserNameID` = '". $_COOKIE['user'] . "'";
					 	$result2 = mysqli_query($con, $query);
						if (!$result2) {
				   	 		header("Location: userSettings.php?message=error"); 	
						}else {
				   	 		header("Location: userSettings.php?message=changed"); 	
						}
				//HERE IS WHERE WE ACCESS THE GLOBALVARIABLES DB. Get THE NAME OF THE CURRENT CRISIS. ADD IT TO TITLE.

					}else {
	        		 	header("Location: userSettings.php?message=nomatch");
					}
		        }else {
        		 	header("Location: userSettings.php?message=nopass");
		        }
		    }

		} else {
			header('Location: userSettings.php?message=noResults');
		    echo "<br>0 results";
		}
	}else {
		header("Location: userSettings.php?message=Oops");
	
	}


?>
