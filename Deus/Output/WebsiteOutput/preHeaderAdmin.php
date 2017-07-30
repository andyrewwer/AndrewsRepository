<?php
//HERE IS WHERE WE CHECK 
	$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testDB") or die(mysql_error());
	$result = $con->query("SELECT * FROM  `Users` WHERE  `UserNameID` = '".$_COOKIE['user']."'");
	while($row = $result->fetch_assoc()) {
		if ($row['isBackroom'] !== 'a'){
			header('Location: index.php?error=oops');	
			$cookie_name = "isBackroom";
			$cookie_value = $row['isBackroom'];
			setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day				
		}
		if ($row['isChair'] !== $_COOKIE['isChair']){
			$cookie_name = "isChair";
			$cookie_value = $row['isChair'];
			setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day				
		}
		if ($row['CharacterName'] !== $_COOKIE['name']) {
			header('Location: help.php');	//currentRoom

			$cookie_name = "name";
			$cookie_value = $row["CharacterName"];
			setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day				

		} if ($row['Committee'] !== $_COOKIE['committee']) {
			header('Location: help.php');	//currentRoom
			$cookie_name = "committee";
			$cookie_value = $row["Committee"];
			setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day			
		}
	}
?>
