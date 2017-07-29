<?php include 'preHeaderAdmin.php';include 'header.php';?>
<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd;'>
<?php 
		if (isset($_GET['message'])) {
	    $message = $_GET['message'];
	    if ($message === "rename") {
	    	// echo "Success! Cabinet Name Change Successful!";
			echo "<script> var alert = new telegramAlert(); alert.render('Success!', 'Cabinet Name Change Successful!!'); makeTelegramGreen();  </script>";
	    }else if ($message === "removeF") {
			echo "<script> var alert = new telegramAlert(); alert.render('Failure!', 'Sorry there is a delegate in that committee. Please move all delegates from a cabinet before deleting it!'); </script>";
	    }else if ($message === "removeT") {
	    	// echo "Success! Cabinet has been sucessfully deleted.";
			echo "<script> var alert = new telegramAlert(); alert.render('Success!', 'Cabinet has been sucessfully deleted.'); makeTelegramGreen(); </script>";
	    }else if ($message === "create"){
	    	// echo "Success! The cabinet has been created and can now be found below.";
			echo "<script> var alert = new telegramAlert(); alert.render('Success', 'The cabinet has been created and can now be found below.'); makeTelegramGreen(); </script>";
	    }else if ($message === "bgImageF"){
			echo "<script> var alert = new telegramAlert(); alert.render('Background Image Change Failure', 'Sorry the image must end with .png or .jpg. Please submit another url.'); </script>";
		}else if ($message === "faviconF"){
			echo "<script> var alert = new telegramAlert(); alert.render('Favicon Failure', 'Sorry the image must end with .png or .jpg. Please submit another url.'); </script>";
		}else if ($message === "bgImageT"){
			echo "<script> var alert = new telegramAlert(); alert.render('Success', 'The background image has been changed successfully - you can now see the current image behind this pop-up. Press revert to change back.'); makeTelegramGreen(); </script>";
			// echo "<script> var alert = new telegramAlert(); alert.render('Background Image Change Successful', 'You can now see the current image behind this pop-up. Press revert to change back.'); </script>";
		}else if ($message === "directiveTimerF"){
			echo "<script> var alert = new telegramAlert(); alert.render('Failure!', 'Sorry you must submit a number! 	'); </script>";
		}else if ($message === "directiveTimerT"){
			// echo "Directive Timer has been successfully changed.";
			echo "<script> var alert = new telegramAlert(); alert.render('Time successfully changed.', 'You can see the current amount below!'); makeTelegramGreen(); </script>";
		}else if ($message === "Oops"){
			echo "<script> var alert = new telegramAlert(); alert.render('Oops!', 'You reached that page by accident.'); </script>";
		}else if ($message === "revert"){
			echo "<script> var alert = new telegramAlert(); alert.render('Success', 'You have reverted.'); makeTelegramGreen(); </script>";
			// echo "<script> var alert = new telegramAlert(); alert.render('Success!', 'You can press undo to change the background picture back! '); </script>";
		}else if ($message === "startCrisis"){
			// echo "Success! All delegates have been successfully emailed. Please ask them to check spam if they cannot find it. It should be from webmaster@muncrisis.com - if they really cannot get the email ask them to use forgot password button and another will be sent. Worst case is create them again or email support at webmaster@muncrisis.com.";
			echo "<script> var alert = new telegramAlert(); alert.render('Success!', 'All delegates have been successfully emailed. Please ask them to check spam if they cannot find it. It should be from webmaster@muncrisis.com - if they really cannot get the email ask them to use forgot password button and another will be sent. Worst case is create them again or email support at webmaster@muncrisis.com'); makeTelegramGreen(); </script>";
		}else if ($message === "frozen"){
			// echo " Directives are now frozen and delegates are unable to send directives until you unfreeze them.";
			echo "<script> var alert = new telegramAlert(); alert.render('Directives Frozen!', 'You can unfreeze directives any time - until then delegates will be unable to send directives.'); makeTelegramGreen(); </script>";
		}else if ($message === "unfrozen"){
			// echo "Directives have been UN-Frozen.";
			echo "<script> var alert = new telegramAlert(); alert.render('Directives UN-Frozen! (Hihi)', 'Directives have been unfrozen. ');makeTelegramGreen(); </script>";
		}else if ($message === "error") {
			echo "<script> var alert = new telegramAlert(); alert.render('Failure!', 'Sorry there was an error. Please try again in a few moments and if the error persists email webmaster@muncrisis.com !'); </script>";
	    }else if ($message === "sheetT") {
			echo "<script> var alert = new telegramAlert(); alert.render('Success', 'The google sheet has been changed successfully - you can now see the google sheet in the Delegate Summary Tab. Press revert to change back.');makeTelegramGreen();  </script>";
	    }else if ($message === "faviconT") {
			echo "<script> var alert = new telegramAlert(); alert.render('Success', 'The favicon has been changed successfully - you can now see the logo in the tab (given browser support). Press revert to change back.'); makeTelegramGreen(); </script>";
	    }

	} 
?>

	 <h4>


	<div class = "googleForm col-sm-11 col-xs-11">

		<form method="POST" action="settingsAcceptance.php" role="form" `class="form-horizontal">						<!-- Form Name -->
	<legend><span class="googleFormSpan"></span> Admin Panel</legend>
	<!-- Multiple Radios -->
	<div class="form-group">
	<div class='col-sm-6 col-xs-6'>
		<input type="text" name="directiveTimer" id="user" class="form-control createUser" placeholder="Current: <?php 					$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testMUN") or die(mysql_error());
					$result = $con->query("SELECT * FROM  `GlobalVariables` WHERE  `VariableName` = 'DirectiveTimer'");
					while($row = $result->fetch_assoc()) {
						echo $row['VariableValue'];
					}?> minutes | Minimum time between delegates submitting directives. " /> 
	</div>
	<!-- Directive Timer -->
	<div class='col-sm-6 col-xs-6'>
		<button type="submit" id="singlebutton" name="directiveTimerbtn" class="btn btn-primary createUser" style='width:120px'>Change Time</button><?php 
			$result = $con->query("SELECT * FROM  `GlobalVariables` WHERE  `VariableName` = 'DirectiveFreeze'");
		    while($row = $result->fetch_assoc()) {
		    	if ($row['VariableValue'] === 'F') {
					echo '<button type="submit" id="singlebutton" name="directiveFreeze" value="T" class="btn btn-warning createUser" style="width:240px">Freeze Directives</button>';		    		
		    	}else {
					echo '<button type="submit" id="singlebutton" name="directiveFreeze" value="F" class="btn btn-success createUser" style="width:240px">Unfreeze Directives</button>';		    		
		    	}
		    }
		?>
	</div>
	<!-- Background Image -->
	<div class='col-sm-6 col-xs-6'>
		<input type="text" name="bgImage" id="user" class="form-control createUser" placeholder="New Background Image (.png or .jpg only)" value="<?php echo $_COOKIE['bgImageText'];?>" />
	</div>
	<div class='col-sm-6 col-xs-6'>
	<button type="submit" id="singlebutton" name="bgImagebtn" class="btn btn-primary createUser" style='width:120px'>Change Image</button>
	<button type="submit" id="singlebutton" name="bgImageRevert" class="btn btn-warning createUser" style="width:240px">Revert to last background image</button>
	</div>
		<!-- Google Sheet -->
	<div class='col-sm-6 col-xs-6'>
		<input type="text" name="sheet" id="user" class="form-control createUser" placeholder="New Google Sheet (make sure everyone can edit it) for Delegate Summary" value="" />
	</div>
	<div class='col-sm-6 col-xs-6'>
	<button type="submit" id="singlebutton" name="sheetbtn" class="btn btn-primary createUser" style='width:120px'>Change Sheet</button>
	<button type="submit" id="singlebutton" name="sheetRevert" class="btn btn-warning createUser" style="width:240px">Revert to last Google Sheet</button>
	</div>
		<!-- Favicon -->
	<div class='col-sm-6 col-xs-6'>
		<input type="text" name="favicon" id="user" class="form-control createUser" placeholder="New Favicon - little icon in the browser tab (.png or .jpg only)" value="<?php echo $_COOKIE['faviconText'];?>" />
	</div>
	<div class='col-sm-6 col-xs-6'>
	<button type="submit" id="singlebutton" name="faviconbtn" class="btn btn-primary createUser" style='width:120px'>Change Favicon</button>
	<button type="submit" id="singlebutton" name="faviconRevert" class="btn btn-warning createUser" style="width:240px">Revert to last favicon </button>
	</div>
	</div>					
</form>
</div>


	<div class='jumbotron col-xs-11 col-sm-11 privateEmailUser' >
	<?php 


	function printJSTable($active) {
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testMUN") or die(mysql_error());
		$result = $con->query("SELECT * FROM Cabinets ORDER BY CabinetName");
		$theVariable;
		if ($result->num_rows > 0) {
			 echo "<a class='list-group-item titleUnderline'> Cabinet:</a>";
			
		    while($row = $result->fetch_assoc()) 
		    {	
		    	if ($row['ID'] === $active) {
			     	$arrayElement = "<a class='list-group-item active' href='settings.php?cabinet="  . $row["ID"] . "'>" . $row["CabinetName"] . " </a> ";
			     			echo "<input type='hidden' name='cabinetID' value='" . $row['ID'] . "'>";
		    	}else {
			     	$arrayElement = "<a class='list-group-item' href='settings.php?cabinet="  . $row["ID"] . "'>" . $row["CabinetName"] . " </a> ";		    		
		    	}
				  echo $arrayElement;
			}	
		}
		if ($active === 'new') {
			echo "<a class='list-group-item active' href='settings.php?cabinet=new'><i>Add Cabinet</i></a> ";	
		}else {
			echo "<a class='list-group-item' href='settings.php?cabinet=new'><i>Add Cabinet</i></a> ";
		}
	 	echo "</div></div>";
	}
	if (isset($_GET['cabinet'])){
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testMUN") or die(mysql_error());
		$result = $con->query("SELECT * FROM Cabinets WHERE `ID` = " . $_GET['cabinet']);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) 
			{
				echo "<h3 style='color:#555'>Edit <b> <span style='color:#006699'>".$row['CabinetName']. "</span> </b>(Change Cabinet Name / Remove):</h3><br>";
			}
		}else if ($_GET['cabinet'] === 'new') {
			echo "	<h3 style='color:#555'><b> <span style='color:#006699'>Add New Cabinet</span></b> </h3><br>";
		}

		echo "<div class='col-sm-3 col-xs-6'>";
		echo "<div class='list-group' id='listgroupJSItem'>";
		echo "<form method='POST' action='settingsAcceptance.php' role='form' class='form-horizontal'>";
		printJSTable($_GET['cabinet']);
		echo "<div class='col-sm-9 col-xs-6'>";
		echo "<textarea type='text' name='name' id='name' class='form-control createUser' placeholder='New Cabinet Name' /></textarea>";
		echo"<br>";
		if ($_GET['cabinet'] !== 'new') {
			echo "<button type='submit' id='singlebutton' name='rename' class='btn btn-warning';'>Rename Cabinet</button>";		 		    					
			echo "<button type='submit' id='singlebutton' name='remove' class='btn btn-danger';'>Delete Cabinet</button> </form>";		 		    					
		}else { 
			echo "<button type='submit' id='singlebutton' name='create' class='btn btn-success';'>Create Cabinet</button> </form>";	
		}
		echo "</div>";
	}

	else {
		echo "	<h3 style='color:#555'>Edit Cabinets (Change Cabinet Names / Add Cabinet):</h3><br>	<div class= 'col-xs-6 col-sm-3 list-group' id='listgroupJSItem'>";
		printJSTable($_GET['cabinet']);


	}
			?>
</div>
<br><br><br><br>


	<?php 
	echo "<form method='POST' action='settingsAcceptance.php' role='form' class='form-horizontal'>";
	echo"<br>";
	$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testMUN") or die(mysql_error());
	$result = $con->query("SELECT * FROM GlobalVariables WHERE `VariableName` = 'CrisisHasStarted'");
	while($row = $result->fetch_assoc()) {
		if ($row['VariableValue'] === 'N'){
			echo "<div class ='col-sm-12 col-xs-12 col-md-12'>"; 
				echo "<div class ='wrapper'>"; 
					echo "<button type='submit' id='singlebutton' name='startCrisis' class='btn btn-danger'>Let the games begin!</button> </form>";									
				echo "</div>";
			echo "</div>";
		}
	}
	
	?>
	</body>
