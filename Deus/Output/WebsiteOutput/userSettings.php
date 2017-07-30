<?php include 'preHeaderFrontroom.php';include 'header.php';?> 	 	
	<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd;'> 

<?php 
		if (isset($_GET['message'])) {
	    $message = $_GET['message'];
	    if ($message === "failure") {
			echo "<script> var alert = new telegramAlert(); alert.render('Sorry form filled in incorrectly', 'Fill in all elements of the form please!'); </script>";
	    }else if ($message === "oops") {
			echo "<script> var alert = new telegramAlert(); alert.render('Sorry', 'You reached that page accidentally!'); </script>";
	    }else if ($message === "nopass") {
			echo "<script> var alert = new telegramAlert(); alert.render('Sorry', 'That is not your current password!'); </script>";
	    }else if ($message === "nomatch") {
			echo "<script> var alert = new telegramAlert(); alert.render('Sorry', 'The passwords you entered did not match!'); </script>";
	    }else if ($message === "changed") {
			echo "<script> var alert = new telegramAlert(); alert.render('Success', 'Your password has been successfully changed. '); makeTelegramGreen(); </script>";
	    }else if ($message === "error") {
			echo "<script> var alert = new telegramAlert(); alert.render('Failure', 'There was a problem with the server. Please try again in a few moments.'); </script>";
	    }

	} 
?>
</h4>
	<div class = "googleForm col-sm-11">

<form method="POST" action="userSettingsAcceptance.php" role="form" `class="form-horizontal">						<!-- Form Name -->
	<legend><span class="googleFormSpan">a</span> Settings Panel</legend>
	<!-- Multiple Radios -->
	<div class="form-group">
		<label class=" control-label" for="requestSender">Passwords must be at least 6 letters and contains no spaces. </label>
		<input type="password" name="pass1" class="form-control changePassword" placeholder="Enter your current password" /> 
		<input type="password" name="pass2a" class="form-control changePassword" placeholder="Enter your new password" />
		<input type="password" name="pass2b" class="form-control changePassword" placeholder="Confirm your new password" />
	<div class='wrapper'>
	<button type="submit" id="singlebutton" name="changePassword" class="btn btn-warning createUser">Change Password</button>
	</div>
	</div>							
</form>
	</div>




