<?php
	header('Location: backroomReserve.php');
	header('Location: backroomResponse.php');

<?php



// //sets it to correct timezone
// date_default_timezone_set('Europe/London'); 
// $currentTime = date('Y-m-d H:i:s'); // current time
// $con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_fredmun") or die(mysql_error());
// $query = "SELECT * FROM GlobalVariables WHERE `VariableName` = 'DirectiveTimer'";
// $queryUsers = "SELECT * FROM Users WHERE `UserNameID` = '" . $_COOKIE['user'] . "'";
// $result = mysqli_query($con, $query);
// $resultUsers = mysqli_query($con, $queryUsers);
// while($row = $result->fetch_assoc()) {
// 	$directiveTimer = $row['VariableValue'];
// }while($row = $resultUsers->fetch_assoc()) {
// 	$lastDirectiveAndDirectiveTimer = date('Y-m-d H:i:s',(strtotime($row['LastDirective']) + $directiveTimer*60));//time on Server + Directive Timer * 60 (in mins)
// //		echo "Test: currentTime > test     " . $currentTime . " > " . $lastDirectiveAndDirectiveTimer;
	
// 	// echo $currentTime . "  vs  " . $lastDirectiveAndDirectiveTimer . "<br>";

// 	// if ($currentTime > $lastDirectiveAndDirectiveTimer) {
// 	// 	//allow directive
// 	// 	echo "    success <br>";
// 	// }else {
// 	// 	//do no allow directive
// 	// 	echo "    failure <br>";
// 	// }
// }


// echo $_COOKIE['user'];
// $datetime1 = strtotime($currentTime);
// $datetime2 = strtotime($lastDirectiveAndDirectiveTimer);

// echo $datetime2 . "<br>";
// $secs = $datetime2 - $datetime1;// == <seconds between the two times>
// $days = $secs / 86400;

// echo "SECS: " . $secs . "<br>";
// echo "DAYS: " . $days . "<br>";

// if ($secs > 0) {
// 	echo "You can send a message in: " . date ('i', $secs). " minutes " . date('s', $secs) . " seconds.";
// }else {
// 	echo "CAN SEND A MESSAGE ";
// }


// //updates time to current. 
// $queryUpdate = "UPDATE  `d5g9x9d8_fredmun`.`Users` SET  `LastDirective` =  '". $currentTime ."'";
// // $result2 = mysqli_query($con, $queryUpdate);




?>


<!-- I'm getting a list of items from my database, each has a CURRENT_TIMESTAMP which i have changed into 'x minutes ago' with the help of timeago. So that's working fine. But the problem is i also want a "NEW" banner on items which are less than 30 minutes old. How can i take the generated timestamp (for example: 2012-07-18 21:11:12) and say if it's less than 30 minutes from the current time, then echo the "NEW" banner on that item.
 -->
<?php
// if(strtotime($mysql_timestamp) > strtotime("-30 minutes")) {
//  $this_is_new = true;
// }
?>