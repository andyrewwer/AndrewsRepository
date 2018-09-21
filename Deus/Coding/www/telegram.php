<?php include 'preHeaderFrontroom.php';include 'header.php';?> 		
	<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd;'> 

	<?php 
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
				$query = "SELECT * FROM GlobalVariables WHERE `VariableName` = 'DirectiveTimer'";
			$queryUsers = "SELECT * FROM Users WHERE `UserNameID` = '" . $_COOKIE['user'] . "'";
			date_default_timezone_set('Europe/London'); 
			$currentTime = date('Y-m-d H:i:s'); // current time
			$result = mysqli_query($con, $query);
			$resultUsers = mysqli_query($con, $queryUsers);
			while($row = $result->fetch_assoc()) {
				$directiveTimer = $row['VariableValue'];
			}while($row = $resultUsers->fetch_assoc()) {
				$lastDirectiveAndDirectiveTimer = date('Y-m-d H:i:s',(strtotime($row['LastDirective'])));//time on Server + Directive Timer * 60 (in mins)
			//		echo "Test: currentTime > test     " . $currentTime . " > " . $lastDirectiveAndDirectiveTimer;
			}
				$datetime1 = strtotime($currentTime);
				$datetime2 = strtotime($lastDirectiveAndDirectiveTimer);
					// echo "Test: currentTime > test     " . $currentTime . " > " . $lastDirectiveAndDirectiveTimer;
				$secs = $datetime2 - $datetime1;// == <seconds between the two times>


		if (isset($_GET['message'])) {
		    $message = $_GET['message'];
		    if ($message === "failure") {
				echo "<script> var alert = new telegramAlert(); alert.render('Form not filled in', 'Sorry, please fill in all elements of the telegram form!'); </script>";
		    }else if ($message === "success") {
				echo "<script> var alert = new telegramAlert(); alert.render('Directive Submitted', 'Backroom will respond to your directive either directly or by a news annoucement shortly. Responses can be seen in your profile.'); makeTelegramGreen(); </script>";
				// echo "<script> var alert = new telegramAlert(); alert.render('Directive submitted', 'Thank you. B'); </script>";
		    }else if ($message === "oops") {
				echo "<script> var alert = new telegramAlert(); alert.render('Oops!', 'You reached that page by accident.'); </script>";
		    }else if ($message === "tooSoon") {
				echo "<script> var alert = new telegramAlert(); alert.render('Sorry', 'Directives are time limited. Check behind this to find out how long you have left to wait!'); </script>";
		    }else if ($message === "frozen"){
				echo "<script> var alert = new telegramAlert(); alert.render('Directives Frozen', 'You are unable to send directives.'); </script>";
			}else if ($message === "error"){
				echo "<script> var alert = new telegramAlert(); alert.render('Error submitting directive', 'Sorry there was an error submitting your directive! Please try again in just a few moments.'); </script>";
			}
		} 
   	?>
   	</h4>
	<h3> This is the Telegram Request Page </h3>
	<h3 id="appendMe"> 
<?php include 'newsProfile.php';?>

	</h3>


<!--	<div id="GoogleForm">
		<iframe src="https://docs.google.com/forms/d/1o3KFc6gG2MsvjFqp4s8FD0T7K_jBFvp3y_XsWT5irTA/viewform?embedded=true" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Telegram Request Form, please wait. Loading...</iframe> 
	</div> -->
	<div class = "googleForm col-sm-8">

		<form method="POST" action="telegramAcceptance.php" role="form" `class="form-horizontal">						<!-- Form Name -->
						<legend><span class="googleFormSpan">a</span>  	Telegram Request Form - <?php 
date_default_timezone_set('Europe/London'); 
$currentTime = date('Y-m-d H:i:s'); // current time
$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
$query = "SELECT * FROM GlobalVariables WHERE `VariableName` = 'DirectiveTimer'";
$queryUsers = "SELECT * FROM Users WHERE `UserNameID` = '" . $_COOKIE['user'] . "'";
$result = mysqli_query($con, $query);
$resultUsers = mysqli_query($con, $queryUsers);
while($row = $result->fetch_assoc()) {
	$directiveTimer = $row['VariableValue'];
}while($row = $resultUsers->fetch_assoc()) {
	$lastDirectiveAndDirectiveTimer = date('Y-m-d H:i:s',(strtotime($row['LastDirective']) + $directiveTimer*60));//time on Server + Directive Timer * 60 (in mins)
}


$datetime1 = strtotime($currentTime);
// $lastDirectiveAndDirectiveTimer = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($lastDirectiveAndDirectiveTimer)));
$datetime2 = strtotime($lastDirectiveAndDirectiveTimer);
$secs = $datetime2 - $datetime1;
echo "<script>    console.log('hi');
    var distance = ".date('s', $secs)." + ".date('i', $secs)."*60 + ".(date('g', $secs)-1)." *3600;

 var x = setInterval(function() {


    // Get todays date and time
    var now = new Date().getTime();
    console.log(now);
    console.log('test' + distance);
    distance = distance - 1;
    
    // Time calculations for days, hours, minutes and seconds
    var hours = Math.floor((distance % (60 * 60 * 24)) / (60 * 60));
    var minutes = Math.floor((distance % (60 * 60)) / ( 60));
    var seconds = Math.floor((distance % (60)));
    
    // Output the result in an element with id='demo'
    if (hours > 0) {
	    document.getElementById('demo').innerHTML = hours + ' hours ' 
    + minutes + ' minutes ' + seconds + ' seconds ';	
    }else {
	    document.getElementById('demo').innerHTML = minutes + ' minutes ' + seconds + ' seconds ';	
    }
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById('demo').innerHTML = 'Message send Available';
    }
}, 1000);</script>";
// == <seconds between the two times>

$GlobalVariablesQuery = "SELECT * FROM GlobalVariables WHERE `VariableName` = 'DirectiveFreeze'";
$GlobalVarresult = mysqli_query($con, $GlobalVariablesQuery);
$freezeOn = 'f';
while($row = $GlobalVarresult->fetch_assoc()) {
	if ($row['VariableValue'] === 'T') {
		$freezeOn = 't';
		echo "<b>Directives are currently frozen for all delegates</b>";
	}else if ($secs > 0) {
		if (date('h', $secs) > 1) {
			echo "Next message in: <b id='demo'>" . (date('g', $secs)-1). " hours " . intval(date('i', $secs)). " minutes " . date('s', $secs) . " seconds.</b>";
		}else if (date('i', $secs) > 0) {
			echo "Next message in: <b id='demo'>" . intval(date ('i', $secs)). " minutes " . intval(date('s', $secs)) . " seconds.</b>";
		}else { 
			echo "Next message in: <b id='demo'>" . intval(date('s', $secs)) . " seconds.</b>";
		}
	}else if ($freezeOn === 'f') {
		echo "Message Send Available ";
	}
}



	?>

						</legend>
						<!-- Multiple Radios -->
						<div class="form-group">
							<label class=" control-label" for="requestSender">Request Sent on Behalf of:</label>
							<div style="padding-left: 30px">
								<input type="radio" name="Sender" value="Individual" onclick='hideThem()'>      Individual <br> </input>
								<input type="radio" name="Sender" value="Committee" onclick='hideThem()' >      Committee <br> </input>
								 <input type="radio" name="Sender" value="Multiple" onclick='showThem()' >      Multiple (Select any and all): </input> 	
								<?php $con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
	$result = $con->query("SELECT * FROM Users WHERE isBackroom = 'f' AND Committee = '".$_COOKIE['committee']."' ORDER BY CharacterName");
	$i = 0;
	$count= $result->num_rows;
	if ($count %2 !== 0) {
		$count ++;
	}
	echo'<div class="col-sm-12 col-xs-12">
  		<div class="col-sm-6 col-xs-6">';

	while($row = $result->fetch_assoc()) {
		if ($i < $count/2) { 
			// echo "a";
			echo "<label class='visuallyhidden'><input type='checkbox' value='".$row['UserNameID']."|".$row['CharacterName']."' name='Characters[]'>   ".$row['CharacterName']. "</input><br></label>" ; 
		}else if ($i === $count/2){ 
			// echo "b";
			echo "</div><div class='col-sm-6 col-xs-6'><label class='visuallyhidden'><input type='checkbox' value='".$row['UserNameID']."|".$row['CharacterName']."' name='Characters[]'>   ".$row['CharacterName']. "</input><br></label>" ; 
		}else {
			// echo "c";
			echo "<label class='visuallyhidden'><input type='checkbox' value='".$row['UserNameID']."|".$row['CharacterName']."' name='Characters[]'>   ".$row['CharacterName']. "</input><br></label> " ; 
		}
			// echo "";
		$i ++;
	}?>
		</div>
		</div>
 		</div>
 		</div>
 		<br>
							<label class=" control-label" for="requestSender">Request Type:</label>
							<div style="padding-left: 30px">
								<input type="radio" name="Type" value="Communication">      Communication <br>
								<input type="radio" name="Type" value="Diplomatic">      Diplomatic <br>
								<input type="radio" name="Type" value="Economic">      Economic <br>
								<input type="radio" name="Type" value="Intelligence">      Intelligence <br>
								<input type="radio" name="Type" value="Internal affairs">      Internal affairs <br>							
								<input type="radio" name="Type" value="Personal">      Personal <br> </input>
								<input type="radio" name="Type" value="Press Release">      Press Release <br> </input>
								<input type="radio" name="Type" value="Military">      Military <br> </input>
								<input type="radio" name="Type" value="Strategic">      Strategic <br>
								<input type="radio" name="Type" value="Other">      Other <br> </input>
<br>
							</br>
							</div>
							<br>
							<label class=" control-label" for="description">Description:</label>
							<div style="padding-left: 30px">
								<p> Make sure to specify as much detail as possible to ensure succesful completion of your intended action.</p>     
								<textarea class="form-control" id="description" name="description" style="height: 250px;"><?php   echo $_COOKIE["telegramText"]; ?></textarea>
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