<?php
	function SignIn() { 
	$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_fredmun") or die(mysql_error());
	$ID = $_POST['user'];
		$result = $con->query("SELECT * FROM Users");
		if ($result->num_rows > 0) {
			$isTrue = "FALSE";
			$user = $_POST['user']; 
			$user = str_replace(' ', '', $user);

			$password = $_POST['pass']; 
			$password = str_replace(' ', '', $password);
			$password = hash("sha256", $password);
			while($row = $result->fetch_assoc()) {
				if (strtolower($user) === strtolower($row["UserNameID"]) && $password === $row["pass"]) {
					$isTrue = "TRUE";
					$cookie_name = "user";
					$cookie_value = $row['UserNameID'];
					setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day

					$cookie_name = "isBackroom";
					$cookie_value = $row["isBackroom"];
					setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
					if (!$result) {
						header("Location: profile.php?error=error");
		    			echo "ERROR: " . mysqli_error($con);		   		
			   		}else {
						if ($cookie_value !== 'f') {
							header('Location: backroomResponse.php');						
						}else {
							header('Location: profile.php');						
						}	
					}
					
					$cookie_name = "isChair";
					$cookie_value = $row['isChair'];
					setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
					
					$cookie_name = "loggedIn";
					$cookie_value = "YES";
					setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day

					$cookie_name = "name";
					$cookie_value = $row["CharacterName"];
					setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day

					$cookie_name = "committee";
					$cookie_value = $row["Committee"];
					setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day

					$cookie_name = "backroomColour";
					$cookie_value = $row["backroomColour"];
					setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
		        }
		    }
		    if ($isTrue == "FALSE") {
				$cookie_name = "user";
				$cookie_value = $_POST['user'];
				setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
		    	header('Location: index.php?error=failure');
		    	
			}
			if (isset($_POST['remember'])) {
				$cookie_name2 = "rememberMe";
				$cookie_value2 = "on";
				setcookie($cookie_name2, $cookie_value2, time() + (86400 * 365), "/"); // 86400 = 1 day
			}else { 
				setcookie( "rememberMe" , 'off' , time() - 3600);
			}
		} else {
			header('Location: login.php?message=noResults');
		    echo "0 results";
		}
	} 

	if(isset($_POST['submit'])) { 
		SignIn(); 
	}else if (isset($_POST['reserve'])) {
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_fredmun") or die(mysql_error());
		$location = "Location: profile.php?privatemessage=".$_POST['directiveNumber'];
		
		$query = "UPDATE  `d5g9x9d8_fredmun`.`Responses` SET  `readByDelegate` =  't' WHERE  `Responses`.`responseID` =". $_POST['directiveNumber'] . " LIMIT 1 ";
		$result = mysqli_query($con, $query);
		if (!$result) {
				header("Location: profile.php?error=error");
				echo "ERROR: " . mysqli_error($con);		   		
	   		}else {
				header($location);
	   		}
	}else if (isset($_POST['unReserve'])) {
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_fredmun") or die(mysql_error());
		$location = "Location: profile.php?privatemessage=".$_POST['directiveNumber'];
		$query = "UPDATE  `d5g9x9d8_fredmun`.`Responses` SET  `readByDelegate` =  'f' WHERE  `Responses`.`responseID` =". $_POST['directiveNumber'] . " LIMIT 1 ";
		$result = mysqli_query($con, $query);
		if (!$result) {
				header("Location: profile.php?error=error");
    			echo "ERROR: " . mysqli_error($con);		   		
	   		}else {
				header($location);
	   		}
	}else if (isset($_POST['submitNewsChange'])){
		if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['image'])) {
			// $title = $_POST['title'];
			$title = str_replace("'", '', $_POST['title']);
			// $title = str_replace(">", '', $title);
			$description = $_POST['description'];
			$description = str_replace("'", '', $_POST['description']);
			// $description = str_replace(">", '', $description);
			$image = str_replace("'", '', $_POST['image']);
			// $image = str_replace(">", '', $image);


			$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_fredmun") or die(mysql_error());
			$location = "Location: index.php?message=".$_POST['newsNumber']."&error=editT";
			// header($location);
			$query = "UPDATE  `d5g9x9d8_fredmun`.`News` SET  `NewsTitle` =  '" .$title ."',
			`NewsDescription` =  '". nl2br($description) . "', `NewsImage` = '".$image. "' WHERE  `News`.`NewsNumber` =" . $_POST['newsNumber'] ." LIMIT 1 ;";	 		
			$result = mysqli_query($con, $query);	
			if (!$result) {
				header("Location: index.php?error=edit");
    			echo "ERROR: " . mysqli_error($con);		   		
	   		}else {
				header($location);
	   		}
		}else {
			$location = "Location: index.php?error=edit";
			header($location);
		}
		//THISF SFNSD:KN EF:KN WHAT I"M DOING NOW 

	}else if (isset($_POST['deleteNewsItem'])){
							 	// <input type='hidden' name='newsNumber' value='" . $aNumber . "''>;
			$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_fredmun") or die(mysql_error());
			$location = "Location: index.php?error=deleteT";
			$query = "DELETE FROM `d5g9x9d8_fredmun`.`News` WHERE NewsNumber=".$_POST['newsNumber'];
			$result = mysqli_query($con, $query);	
			if (!$result) {
				header("Location: index.php?error=deleteF");
				echo "ERROR: " . mysqli_error($con);		   		
    			echo $query;
   	   		}else {
				header($location);
	   		}
		//THISF SFNSD:KN EF:KN WHAT I"M DOING NOW 

	}else if (isset($_POST['changeWorldMapImage'])){
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_fredmun") or die(mysql_error());
		$userResult = $con->query("SELECT * FROM GlobalVariables WHERE `VariableName` = 'worldMap'");
		while ($row = $userResult->fetch_assoc()){
			$query =  "UPDATE `d5g9x9d8_fredmun`.`GlobalVariables` SET `VariableValue` = '".$_POST['image']. "' WHERE `GlobalVariables`.`VariableName` = 'worldMap';";
			$query2 = " UPDATE `d5g9x9d8_fredmun`.`GlobalVariables` SET `VariableValue` = '".$row['VariableValue']."' WHERE `GlobalVariables`.`VariableName` = 'worldMapBackup';";
		 	$result = mysqli_query($con, $query);
		 	$result2 = mysqli_query($con, $query2);
		 	if ($result2) {
				header("Location: worldmap.php?message=bgImageT");
	 		}else {
				header("Location: worldmap.php?message=error");
	 			die(mysqli_error($con));
	 		}
		}		

	}else {
		header("Location: index.php?message=oops");
	}


	?>	

