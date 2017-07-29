<?php include 'header.php';?>
		<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd'>
	<?php 
		if (isset($_GET['message'])) {
		    $message = $_GET['message'];
		    if ($message === "oops") {
				echo "<script> var alert = new telegramAlert(); alert.render('Oops', 'You reached that page by accident.'); </script>";
		    }else if ($message === "tooSoon") {
				echo "<script> var alert = new telegramAlert(); alert.render('Thank you', 'We appreciate your feedback!'); makeTelegramGreen(); </script>";
		    }else if ($message === "error") {
				echo "<script> var alert = new telegramAlert(); alert.render('Failure', 'Sorry there was an error. Please try resubmitting in a few moments!'); </script>";
		    }
		} 
   	?>

	<h3> MUN Crisis Feedback Page </h3>



<!--	<div id="GoogleForm">
		<iframe src="https://docs.google.com/forms/d/1o3KFc6gG2MsvjFqp4s8FD0T7K_jBFvp3y_XsWT5irTA/viewform?embedded=true" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Telegram Request Form, please wait. Loading...</iframe> 
	</div> -->
	<div class = "googleForm col-sm-11">

		<form method="POST" action="feedbackAcceptance.php" role="form" `class="form-horizontal">						<!-- Form Name -->
						<legend>MUNCrisis Feedback Form - <br>
						Please fill in as much as you can. There are no required questions; but we would appreciate it if you answered all of them. 
						</legend>
						<!-- Multiple Radios -->
						<div class="form-group">
							<label class=" control-label" for="requestSender">Did you find the system easy and intuitive to use?</label>
							<div style="padding-left: 30px">
								<input type="radio" name="Q1" value="Yes">      Yes <br> </input>
								<input type="radio" name="Q1" value="No">      No <br> </input>
<!-- 								<input type="radio" name="Sender" value="Multiple">      Multiple: </input>
								<input type="text" name="otherReason" placeholder=" Other Delegates Character Names" style="width: 300px;"/>
 	--> <br>					
 		</div>
						 	<input type='hidden' name='conferenceName' value='CardiffMUN'">
							<label class=" control-label" for="description">If you have used any previous Crisis systems, which one did you use and what did you prefer about them?</label>
							<div style="padding-left: 30px">
								<textarea class="form-control" id="description" name="Q2" style="height: 50px;"></textarea>
							</div><br>

							<label class=" control-label" for="description">What did you prefer about muncrisis.com?</label>
							<div style="padding-left: 30px">
								<textarea class="form-control" id="description" name="Q3" style="height: 50px;"></textarea>
							</div><br>

							<label class=" control-label" for="description">Please name your favorite thing about this website:</label>
							<div style="padding-left: 30px">
								<textarea class="form-control" id="description" name="Q4" style="height: 50px;"></textarea>
							</div><br>

							<label class=" control-label" for="description">Please name your least favorite thing:</label>
							<div style="padding-left: 30px">
								<textarea class="form-control" id="description" name="Q5" style="height: 50px;"></textarea>
							</div><br>

							<label class=" control-label" for="description">Please list any bugs / difficulties you may have experienced (other than slow responses to directives):</label>
							<div style="padding-left: 30px">
								<textarea class="form-control" id="description" name="Q6" style="height: 50px;"></textarea>
							</div>	<br>
							
							<label class=" control-label" for="description">Would you recommend that other conferences use muncrisis.com?</label>
							<div style="padding-left: 30px">
								<textarea class="form-control" id="description" name="Q7" style="height: 50px;"></textarea>
							</div>
<br>
							<label class=" control-label" for="description">Do you want to discuss using muncrisis.com at your conference with the muncrisis.com team? (If so please enter the best means to contact you; ideally an email address) </label>
							<div style="padding-left: 30px">
								<textarea class="form-control" id="description" name="Q8" style="height: 50px;"></textarea>
							</div>						
 <br><br>
 				<div class="wrapper"><button type="submit" id="singlebutton" name="submit" class="btn btn-primary ">Submit</button></div>
					</div>
	</form>


</body>
</html>


<!-- Q1 Did you find the system easy and intuitive to use?
Q2 If you have used any previous Crisis systems what did you prefer about them?
Q3 What did you prefer about muncrisis.com?
Q4 Please name your favorite thing about the website:
Q5 Please name your least favorite thing:
Q6 Please list any bugs/ difficulties you may have experienced:
Q7 Would you recommend that other conferences use muncrisis.com?
Q8 Do you want to discuss using muncrisis.com at your conference with the muncrisis.com team? -->
