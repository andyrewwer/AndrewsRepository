<?php 

	if(isset($_POST['submit'])) { 

	$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_data") or die(mysql_error());

	//$directivesDescription = mysqli_real_escape_string($con, $_POST['description']);
	// echo $directivesDescription;
	$Name = str_replace("'", '', $_POST['name']);
	$Email = str_replace("'", '', $_POST['email']);
	$Email = str_replace(" ", '', $Email);

	if ($_POST['Sender'] !== 'other') {
		$Other = $_POST['Sender'];
	}
	$query = "INSERT INTO `d5g9x9d8_data`.`DeusMailingList` (`ID`, `Name`, `Email`) VALUES (NULL, '".$Name."', '".$Email."');"; 
	// echo $query;
		$result = mysqli_query($con, $query);
		if ($result) {
			header('Location: beta.php?message=success');


			//echo "Success!";
		}else {
			// header('Location: demo.php?message=error');
			die(mysqli_error($con));
		}
		// echo $query;

	}else {
			header("Location: beta.php?message=oops");
	}
 

?>