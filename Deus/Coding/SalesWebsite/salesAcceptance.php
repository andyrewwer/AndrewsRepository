<?php 

	if(isset($_POST['submit'])) { 

	$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_test") or die(mysql_error());

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

	$query = "INSERT INTO `dbilh9sp_test`.`Sales` (`Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `Q8`, `ID`) VALUES ('".nl2br($Q1)."', '".nl2br($Q2)."', '".nl2br($Q3)."', '".nl2br($Q4)."', '".nl2br($Q5)."', '".nl2br($Q6)."', '".nl2br($Q7)."', '".nl2br($Q8)."', NULL);"; 
		//mysqli_query($query);
	//echo $query. "<br><br>";
		$result = mysqli_query($con, $query);
		if ($result) {
							$to      = 'inquiries@muncrisis.com';
				$subject = 'NEW RESPONSE TO SALES FORM: ' .nl2br($Q1);
				$message = 'Conference information : ' . nl2br($Q3) . '. 

Find out more at muncrisis.com/salesResponses.php.

Thanks! Sorry for the faff.

~Andrew <3';
				$headers = 'From: webmaster@muncrisis.com' . "\r\n" .
				    'Reply-To: webmaster@muncrisis.com' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);

			header('Location: sales.php?message=success');


			//echo "Success!";
		}else {
			header('Location: sales.php?message=error');
			die(mysqli_error($con));
		}
		echo $query;

	}else {
			header("Location: sales.php?message=oops");
	}
 

?>