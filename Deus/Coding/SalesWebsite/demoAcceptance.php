<?php 

	if(isset($_POST['submit'])) { 

	$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_test") or die(mysql_error());

	//$directivesDescription = mysqli_real_escape_string($con, $_POST['description']);
	// echo $directivesDescription;
	$Q1 = str_replace("'", '', $_POST['Q1']);
	$Skype = str_replace("'", '', $_POST['Skype']);
	$Q2 = str_replace("'", '', $_POST['Q2']);
	$Q3 = str_replace("'", '', $_POST['Q3']);
	$Q4 = str_replace("'", '', $_POST['Q4']);
	$Other = str_replace("'", '', $_POST['Other']);

	if ($_POST['Sender'] !== 'other') {
		$Other = $_POST['Sender'];
	}

	$query = "INSERT INTO `dbilh9sp_test`.`DemoInterest` (`Q1`, `Q2`, `Q3`, `Q4`, `Slot`, `ID`) VALUES ('".nl2br($Q1)."', '".nl2br($Q2)."   |   ".$Skype."', '".nl2br($Q3)."', '".nl2br($Q4)."', '".nl2br($Other)."', NULL);"; 
	// echo $query;
		$result = mysqli_query($con, $query);
		if ($result) {
			header('Location: demo.php?message=success');


			//echo "Success!";
		}else {
			// header('Location: demo.php?message=error');
			die(mysqli_error($con));
		}
		// echo $query;

	}else {
			header("Location: demo.php?message=oops");
	}
 

?>