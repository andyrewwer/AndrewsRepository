<?php include 'header.php';?> 		
	<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd'><?php 
		if (isset($_GET['message'])) {
	    if ($_GET['message'] === "success") {
			echo "<script> var alert = new telegramAlert(); alert.render('Success', 'Thank you for your interest. We will be in touch with you shortly'); makeTelegramGreen()</script>";
			echo " test ";
	    }else if ($_GET['message'] === "error") {
			echo "<script> var alert = new telegramAlert(); alert.render('Error', 'Sorry there was a technical problem. Please try again soon, if the problem persists please email us at inquiries@muncrisis.com!'); </script>";
	    }else if ($_GET['message'] === "oops") {
				echo "<script> var alert = new telegramAlert(); alert.render('Oops', 'You reached that page by accident.'); </script>";
		}

	}
	?></h4> 
	<h3> Sales Website </h3>
	<h3 id="appendMe"> 
	</h3>


<!--	<div id="GoogleForm">
		<iframe src="https://docs.google.com/forms/d/1o3KFc6gG2MsvjFqp4s8FD0T7K_jBFvp3y_XsWT5irTA/viewform?embedded=true" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Telegram Request Form, please wait. Loading...</iframe> 
	</div> -->
	<div class = "googleForm col-sm-10">

		<form method="POST" action="salesAcceptance.php" role="form" `class="form-horizontal">						<!-- Form Name -->
			<legend><span class="googleFormSpan"></span>  	Register a Quote </legend> Interested in using Deus? Sign up here</a>! Complete this form and we will reply to you with a quote and logins for our demo website. <br><br>
			<!-- Multiple Radios -->
			<div class="form-group">
				<label class=" control-label" for="description">Your Name:</label>
				<div style="padding-left: 30px">
					<textarea class="form-control" id="description" name="Q1" style="height: 30px;"></textarea>
				</div><br>
				<label class=" control-label" for="description">Your Email:</label>
				<div style="padding-left: 30px">
					<textarea class="form-control" id="description" name="Q2" style="height: 30px;"></textarea>
				</div><br>
				<label class=" control-label" for="description">Your Conference name and Dates:</label>
				<div style="padding-left: 30px">
					<textarea class="form-control" id="description" name="Q3" style="height: 30px;"></textarea>
				</div><br>
				<label class=" control-label" for="description">How many total delegates are you expecting?</label>
				<div style="padding-left: 30px">
					<textarea class="form-control" id="description" name="Q4" style="height: 30px;"></textarea>
				</div><br>
				<label class=" control-label" for="description">How many crisis users are you expecting (delegates and staff)?</label>
				<div style="padding-left: 30px">
					<textarea class="form-control" id="description" name="Q5" style="height: 30px;"></textarea>
				</div><br>
				<label class=" control-label" for="description">How much is your registration fee?</label>
				<div style="padding-left: 30px">
					<textarea class="form-control" id="description" name="Q6" style="height: 30px;"></textarea>
				</div><br>
				<label class=" control-label" for="description">How did you hear about Deus?</label>
				<div style="padding-left: 30px">
					<textarea class="form-control" id="description" name="Q7" style="height: 30px;"></textarea>
				</div><br>
				<label class=" control-label" for="description">Do you have any comments or questions?</label>
				<div style="padding-left: 30px">
					<textarea class="form-control" id="description" name="Q8" style="height: 80px;"></textarea>
				</div>
<!-- 							<select name ="requestSender">
				<option value= "I">Individual</option>
				<option value= "M">Multiple</option>
				<option value= "C">Committee</option>
				</select>
-->
 <br><br>
 				<div class="wrapper"><button type="submit" id="singlebutton" name="submit" class="btn btn-primary ">Submit</button></div>
					</div>
																			</div>

	</form>


</body>
</html>
