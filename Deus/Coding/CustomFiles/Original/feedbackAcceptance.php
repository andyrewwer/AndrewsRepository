<?php 

	if(isset($_POST['submit'])) { 

	$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test") or die(mysql_error());

	//$directivesDescription = mysqli_real_escape_string($con, $_POST['description']);
	// echo $directivesDescription;
	$Q1 = str_replace("'", '', $_POST['Q1']);
	$Q2 = str_replace("'", '', $_POST['Q2']);
	$Q3 = str_replace("'", '', $_POST['Q3']);
	$Q4 = str_replace("'", '', $_POST['Q4']);
	$Q5 = str_replace("'", '', $_POST['Q5']);
	$Q6 = str_replace("'", '', $_POST['Q6']);
	$Q7 = str_replace("'", '', $_POST['Q7']);
	$Q8 = str_replace("'", '', $_POST['Q8']);

	$query = "INSERT INTO `d5g9x9d8_test`.`Feedback` (`ID`, `Username`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `Q8`) VALUES (NULL, '".$_COOKIE['user']. " (" . $_COOKIE['isBackroom'].") - ". $_POST['conferenceName']."','".nl2br($Q1)."', '".nl2br($Q2)."', '".nl2br($Q3)."', '".nl2br($Q4)."', '".nl2br($Q5)."', '".nl2br($Q6)."', '".nl2br($Q7)."', '".nl2br($Q8)."');"; 
		//mysqli_query($query);
	//echo $query. "<br><br>";
		$result = mysqli_query($con, $query);
		if ($result) {
			header('Location: feedback.php?message=tooSoon');
			//echo "Success!";
		}else {
			// header('Location: feedback.php?message=error');
			die(mysqli_error($con));
		}
		echo $query;

	}else {
			header("Location: feedback.php?message=oops");
	}
 

?>
