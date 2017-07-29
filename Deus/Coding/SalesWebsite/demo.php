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
	<h3> Register for Deus demo day on March 25th </h3>
	<h3 id="appendMe"> 
	</h3>


<!--	<div id="GoogleForm">
		<iframe src="https://docs.google.com/forms/d/1o3KFc6gG2MsvjFqp4s8FD0T7K_jBFvp3y_XsWT5irTA/viewform?embedded=true" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Telegram Request Form, please wait. Loading...</iframe> 
	</div> -->

	<div class = "googleForm col-sm-10">

		<form method="POST" action="demoAcceptance.php" role="form" `class="form-horizontal">						<!-- Form Name -->
			<legend><span class="googleFormSpan"></span>  	Register Interest </legend> Join Andrew and Miro for a 15min walkthrough of Deus followed by a Q&A. We will be holding three sessions you can register for at 9am, 12pm and 9pm GMT.   <br><br>
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
				<label class=" control-label" for="description">Your Skype ID:</label>
				<div style="padding-left: 30px">
					<textarea class="form-control" id="description" name="Skype" style="height: 30px;"></textarea>
				</div><br>

				<label class=" control-label" for="description">Which MUN Society, Conference or student society are you a member of:</label>
				<div style="padding-left: 30px">
					<textarea class="form-control" id="description" name="Q3" style="height: 30px;"></textarea>
				</div><br>
				<label class=" control-label" for="requestSender">Which demo slot would you like to attend?:</label>
				<div style="padding-left: 30px">
				<input type="radio" name="Sender" value="9am" onclick="hideMe()">      9AM GMT <br> </input>
				<input type="radio" name="Sender" value="12pm"  onclick="hideMe()">      12PM GMT <br> </input>
				<input type="radio" name="Sender" value="9pm"  onclick="hideMe()">      9PM GMT <br> </input>
				<input type="radio" name="Sender" value="other" onclick="showMe()" >      Other:  <textarea class="visuallyhidden" id="ShowOrHideMe" name="Other" style="height: 30px;width: 80%;" placeholder="Please suggest a time either on the 25th or a date that works for you."></textarea><br> </input>
				</div><br>
				<label class=" control-label" for="description">Any other comments, questions or queries?</label>
				<div style="padding-left: 30px">
					<textarea class="form-control" id="description" name="Q4" style="height: 30px;"></textarea>
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
