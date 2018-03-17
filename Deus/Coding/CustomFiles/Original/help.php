<?php include 'header.php';?>

		<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd'>
<?php 
		if (isset($_GET['message'])) {
		    $message = $_GET['message'];
		    if ($message === "reset") {
				echo "<script> var alert = new telegramAlert(); alert.render('Success', 'Your new password has been emailed to you. Check there and you can change your password in the settings menu!'); makeTelegramGreen(); </script>";
		    }else if ($message === "noUser") {
				echo "<script> var alert = new telegramAlert(); alert.render('Failure', 'Sorry there was no user with that email :( '); </script>";
		    }
		} 
   	?>

	<h3> This is the help screen </h3>

	</br>
	<div class ="row darkBackground"> 
			<div class="col-xs-6">
				<h4>I can't log in</h4>
				<p> If you remember your email but do not remember the password please email us at webmaster@muncrisis.com from that email address and we will reset your password and send you the new password to that account. If there is a problem with that email, please explain it by email.</p>
			</br>
			</br>
			</div>
			<div class="col-xs-6">
				<h4>I can't find sign up button</h4>
			<p> Sorry, this crisis is a private event and all delegates must register with them. If you would like to Deus for your own crisis, please email us at inquiries@muncrisis, find on Facebook at /CrisisDeus or check our primary website: muncrisis.com! Thank you for your interest </p>

			</br>
			</br>
			</div>
	</div>
<div class='jumbotron col-xs-11 col-sm-11 privateEmailUser' >
<div class='wrapper'>
	<?php 
		echo "	<h3 style='color:#555'> Forgot my Password</h3><br>";
		echo "<form method='POST' action='settingsAcceptance.php' role='form' class='form-horizontal'>
		    <input type='text' name='email' class='form-control' placeholder='Please Enter Your Email Here'>";
		echo"<br>";
			echo "<button type='submit' id='singlebutton' name='emailReset' class='btn btn-warning ';'>Reset Password</button>";		 		    	
	?>
	</div>
</div>
	</body>
</html>


