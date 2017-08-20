<?php include 'header.php';?> 		
	<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd'><?php 
		if (isset($_GET['message'])) {
	    if ($_GET['message'] === "success") {
			echo "<script> var alert = new telegramAlert(); alert.render('Success', 'Thank you for your interest. We will be in touch with you shortly :) '); makeTelegramGreen()</script>";
	    }else if ($_GET['message'] === "error") {
			echo "<script> var alert = new telegramAlert(); alert.render('Error', 'Sorry there was a technical problem. Please try again soon, if the problem persists please email us at inquiries@muncrisis.com!'); </script>";
	    }else if ($_GET['message'] === "oops") {
				echo "<script> var alert = new telegramAlert(); alert.render('Oops', 'You reached that page by accident.'); </script>";
		}

	}
	?></h4> 
	<h3> Register for Deus Beta and updates </h3>
	<h3 id="appendMe"> 
	</h3>


<!--	<div id="GoogleForm">
		<iframe src="https://docs.google.com/forms/d/1o3KFc6gG2MsvjFqp4s8FD0T7K_jBFvp3y_XsWT5irTA/viewform?embedded=true" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Telegram Request Form, please wait. Loading...</iframe> 
	</div> -->

	<div class = "googleForm col-sm-10">

		<form method="POST" action="betaAcceptance.php" role="form" `class="form-horizontal">						<!-- Form Name -->
			<legend><span class="googleFormSpan"></span> 
Join us as we develop Deus. By signing up you'll be given a unique opportunity to see new Deus features as they are developed, comment and give your feedback. We would love your feedback, by signing up below you will receive an invitation to our upcoming Deus beta and regular opportunities to give your feedback. Of course, you will be able to opt out at anytime without qualm or difficulty.
<br><br>
			<!-- Multiple Radios -->
			<div class="form-group">
				<label class=" control-label" for="description">Your Name:</label>
				<div style="padding-left: 30px">
					<textarea class="form-control" id="description" name="name" style="height: 30px;"></textarea>
				</div><br>
				<label class=" control-label" for="description">Your Email:</label>
				<div style="padding-left: 30px">
					<textarea class="form-control" id="description" name="email" style="height: 30px;"></textarea>
				</div><br>
 				<div class="wrapper"><button type="submit" id="singlebutton" name="submit" class="btn btn-primary ">Submit</button></div>
					</div>
			</div>

	</form>

</body>
</html>
