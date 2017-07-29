<?php
	$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testMUN") or die(mysql_error());
 	if (isset($_POST['approve'])) {
 		$query = "UPDATE  `d5g9x9d8_testMUN`.`Directives` SET  `Status` =  'Available', `StatusName` = 'Available'  WHERE  `Directives`.`DirectiveNumber` = " . $_POST["directiveNumber"] . " ";
 		$result = mysqli_query($con, $query);

 		if (!$result) {
			header('Location: directiveConfirmation.php?message=error');
 			echo "ERROR" . mysqli_error($con);
		}else {
			header('Location: directiveConfirmation.php?message=approved');
		}
 	}else if (isset($_POST['reject'])) {
 		$query = "UPDATE  `d5g9x9d8_testMUN`.`Directives` SET  `Status` =  'Rejected', `StatusName` = 'Rejected'  WHERE  `Directives`.`DirectiveNumber` = " . $_POST["directiveNumber"] . " ";
 		$result = mysqli_query($con, $query);

 		if (!$result) {
			header('Location: directiveConfirmation.php?message=error');
 			echo "ERROR" . mysqli_error($con);
		}else {
			header('Location: directiveConfirmation.php?message=rejected');
		}
 	}else {
		header("Location: directiveConfirmation.php?message=oops");
	}

 	//cancel the cookie :P 

?>
