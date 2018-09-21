<?php include 'preHeaderBackroom.php';include 'header.php';?>
<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd;'>
<?php 
		if (isset($_GET['message'])) {
	    $message = $_GET['message'];
	    if ($message === "failure") {
			echo "<script> var alert = new telegramAlert(); alert.render('Sorry form filled in incorrectly', 'Fill in all elements of the form please!'); </script>";
	    }else if ($message === "failureUser") {
			echo "<script> var alert = new telegramAlert(); alert.render('Sorry; that email is already taken', 'Select a new email!'); </script>";
	    }else if ($message === "success") {
			echo "<script> var alert = new telegramAlert(); alert.render('User has been successfully created', 'Woo!'); makeTelegramGreen(); </script>";
	    }else if ($message === "selectCabinet"){
			echo "<script> var alert = new telegramAlert(); alert.render('Cabinet Change unsuccessful', 'Please select a cabinet for the change to proceed.'); </script>";
	    }else if ($message === "selectCabinetY"){
			echo "<script> var alert = new telegramAlert(); alert.render('Cabinet Change successful', 'Woo!'); makeTelegramGreen(); </script>";
		}else if ($message === "delegateDeleted"){
			echo "<script> var alert = new telegramAlert(); alert.render('Delegate successfully Deleted', 'Woo!'); makeTelegramGreen(); </script>";
		}else if ($message === "delegateEdited"){
			echo "<script> var alert = new telegramAlert(); alert.render('Delegate successfully edited', 'Woo!'); makeTelegramGreen(); </script>";
		}else if ($message === "admin") {
				echo "<script> var alert = new telegramAlert(); alert.render('Failure', 'Sorry you cannot change the cabinet of an admin.'); </script>";
	    }else if ($message === "error") {
				echo "<script> var alert = new telegramAlert(); alert.render('Failure', 'Sorry there was a problem; please try again in a few moments.'); </script>";
	    }else if ($message === "oops") {
				echo "<script> var alert = new telegramAlert(); alert.render('Sorry', 'You reached that page by accident!'); </script>";
	    }else if ($message === "alreadyExists") {
				echo "<script> var alert = new telegramAlert(); alert.render('Failure', 'There is already a user with that email!'); </script>";
	    }

	} 
?></h4>

	<div class = "googleForm col-sm-11">

		<form method="POST" action="createUserAcceptance.php" role="form" `class="form-horizontal">						<!-- Form Name -->
						<legend><span class="googleFormSpan">a</span>  	Add User Form</legend>
						<!-- Multiple Radios -->
						<div class="form-group">
						<input type="text" name="user" id="user" class="form-control createUser" placeholder="Delegate Email" />
						<textarea type="text" name="name" id="name" class="form-control createUser" placeholder="Character Name"  /></textarea>
						<label class="control-label" for="requestSender">Committee:</label><br>
						<?php
							$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
							$result = $con->query("SELECT * FROM Cabinets ORDER BY CabinetName");
							while($row = $result->fetch_assoc()) {
								echo "<input style='margin-left:20px;' type='radio' name='Cabinet' value=". $row['ID'] .">          " . $row['CabinetName'] . "</input><br>";
							}
						?>
							<!-- <label class="control-label" for="requestSender">Are they backroom:</label><br>
							 -->
							 <input style='margin-left:20px;' type="radio" name="Cabinet" value="b" ><i> Backroom </i><br> </input>
								<!-- <input style='margin-left:20px;' type="radio" name="isBackroom" value="t">  Yes <br> </input> -->
															</div>
						<div class="form-group">
						<label class="control-label" for="requestSender">Are they the chair? </label><br>
						 <input style='margin-left:20px;' type="radio" name="Chair" value="Yes" > Yes<br> </input>		
		 				 <input style='margin-left:20px;' type="radio" name="Chair" value="No" checked="checked"> No<br><br> </input>

								<!-- <input style='margin-left:20px;' type="radio" name="isBackroom" value="t">  Yes <br> </input> -->
															</div>									<button type="submit" id="singlebutton" name="createUser" class="btn btn-primary">Create User</button>

								<br>
					
	</form>
	</div>

	<br><br><br>	<br><br><br>	<br><br><br>	<br><br><br>	<br><br><br>	<br><br><br>	<br><br><br>
	<br><br><br>	<br><br><br>	<br><br><br>	

	<div class='jumbotron col-xs-11 col-sm-11 privateEmailUser' >
			<h3 style='color:#555'>Edit Characters (Change Cabinet / Death & Rebirth):</h3><br>
			<div class= 'col-xs-6 col-sm-3 list-group' id="listgroupJSItem">
			<?php 
			if (isset($_GET['cabinet']) || isset($_GET['email'])) {

		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
				$result = $con->query("SELECT * FROM Users ORDER BY CharacterName");
				$theVariable;
				if ($result->num_rows > 0) {
					 echo "<a class='list-group-item titleUnderline' href='createUser.php'> Back</a>";
					
				    while($row = $result->fetch_assoc()) 
				    {	
				    	if ($_GET['cabinet']=== "backroom"){
							if ($_GET['email'] === $row["id"]) {
						     	$arrayElement = "<a class='list-group-item active' href='createUser.php?email="  . $row["id"] . "&cabinet=" . $_GET['cabinet'] ."'>" . $row["CharacterName"] . " </a> ";
						     	$theVariable = $row['UserNameID'];
 							 	echo $arrayElement;
							}else if ($row['isBackroom'] !== "f") {
								$arrayElement = "<a class='list-group-item' href='createUser.php?email="  . $row["id"] . "&cabinet=" . $_GET['cabinet'] ."'>" . $row["CharacterName"] . " </a> ";
	 							 	echo $arrayElement;
							}

							continue;
				    	}
						if (isset($_GET['email'])) {
							$message = $_GET['email'];
							if ($message === $row["id"]) {
						     	$arrayElement = "<a class='list-group-item active' href='createUser.php?email="  . $row["id"] . "&cabinet=" . $_GET['cabinet'] ."'>" . $row["CharacterName"] . " </a> ";
						     	$theVariable = $row['UserNameID'];
 							  echo $arrayElement;
							}
						}

			    		if ($row['isBackroom'] !== "f"||$row['Committee'] !== $_GET['cabinet'] || $row['id'] === $_GET['email']) {
				    		continue;
						}

						$arrayElement = "<a class='list-group-item' href='createUser.php?email="  . $row["id"] . "&cabinet=" . $_GET['cabinet'] ."'>" . $row["CharacterName"] . " </a> ";
				    	
				     	//$arrayElement = "<a class='list-group-item' href='index.php?message="  . $row["NewsNumber"] . "'>" . $row["NewsNumber"] . ": " . $row["NewsTitle"] . "</a> ";
						  echo $arrayElement;
					}
				}
				echo "<script>
			function scrollWin() {
			    window.scrollBy(0,300);
				console.log('test');
			}
			scrollWin();
		</script>";
			}else {
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
				$result = $con->query("SELECT * FROM Cabinets ORDER BY CabinetName");
				$theVariable;
				if ($result->num_rows > 0) {
					 echo "<a class='list-group-item titleUnderline'> Cabinet:</a>";
					
				    while($row = $result->fetch_assoc()) 
				    {	
				     	$arrayElement = "<a class='list-group-item' href='createUser.php?cabinet="  . $row["ID"] . "'>" . $row["CabinetName"] . " </a> ";
						  echo $arrayElement;
					}
					echo "<a class='list-group-item' href='createUser.php?cabinet=backroom'><i>Backroom Staff<i> </a> ";
				}
			}
			echo "</div>";
			echo "<div class= 'col-xs-6 col-sm-9 list-group' id='listgroupJSItem'>";
			if (isset($_GET['email'])) {
				if (isset($_POST['kill'])) {
						echo "<form method='POST' action='createUserAcceptance.php' role='form' class='form-horizontal'>
						    <input type='hidden' name='delegateID' value='" . $_GET['email'] . "'>
						    <input type='hidden' name='cabinetID' value='" . $_GET['cabinet'] . "'>
						    <textarea type='text' name='name' id='name' class='form-control createUser' placeholder='New Character Name'  /></textarea>";
						echo "<label class='control-label' for='requestSender'>New Cabinet: </label><br>";
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
						$result = $con->query("SELECT * FROM Cabinets ORDER BY CabinetName");
						while($row = $result->fetch_assoc()) {
							echo "<input style='margin-left:20px;' type='radio' name='Cabinet' value=". $row['ID'] .">          " . $row['CabinetName'] . "</input><br>";
						}
						echo'<label class="control-label" for="requestSender">Are they the chair? (If left blank assumed no)</label><br>
						 <input style="margin-left:20px;" type="radio" name="Chair" value="Yes" > Yes<br> </input>		
		 				 <input style="margin-left:20px;" type="radio" name="Chair" value="No" > No<br> </input>';

						echo"</div>";
						echo "<button type='submit' id='singlebutton' name='killRevive' class='btn btn-primary';'>Confirm</button> </form>";	
				}else if (isset($_POST['cabinetChange'])){
						echo "<form method='POST' action='createUserAcceptance.php' role='form' class='form-horizontal'>
						    <input type='hidden' name='delegateID' value='" . $_GET['email'] . "'>
						    <input type='hidden' name='cabinetID' value='" . $_GET['cabinet'] . "'>";
						echo "<label class='control-label' for='requestSender'>New Cabinet: </label><br>";
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
						$result = $con->query("SELECT * FROM Cabinets ORDER BY CabinetName");
						while($row = $result->fetch_assoc()) {
							echo "<input style='margin-left:20px;' type='radio' name='Cabinet' value=". $row['ID'] .">          " . $row['CabinetName'] . "</input><br>";
						}
						echo "<input style='margin-left:20px;' type='radio' name='Cabinet' value='backroom'> Backroom </input><br><br>
		 		    		<button type='submit' id='singlebutton' name='changeCabinet' class='btn btn-primary';'>Confirm</button> </form>";	




				}else if (isset($_POST['editEmail'])){
						echo "<form method='POST' action='createUserAcceptance.php' role='form' class='form-horizontal'>
						    <input type='hidden' name='delegateID' value='" . $_GET['email'] . "'>
						    <input type='hidden' name='cabinetID' value='" . $_GET['cabinet'] . "'>";
						echo "<label class='control-label' for='requestSender'>Edit Delegate Information: </label><br>";
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
						$result = $con->query("SELECT * FROM Users WHERE id = ".$_GET['email']);
						while($row = $result->fetch_assoc()) {
							echo "<i>Delegate Email:</i><br><textarea type='text' name='Email' id='name' class='form-control createUser' placeholder='Delegate Email'  />".$row['UserNameID']."</textarea>";
						    echo"<input type='hidden' name='delegateEmailOriginal' value='" . $row['UserNameID'] . "'>";
							echo "<i>Character Name:</i><textarea type='text' name='CharacterName' id='name' class='form-control createUser' placeholder='Character Name'  />".$row['CharacterName']."</textarea><br><br>";
						}
						echo "
		 		    		<button type='submit' id='singlebutton' name='editCharacter' class='btn btn-primary';'>Confirm Changes</button><button type='submit' id='singlebutton' name='deleteDelegate' class='btn btn-danger';'>Delete Delegate</button><button type='submit' id='singlebutton' name='deleteDelegate' class='btn btn-danger';'>Delete Delegate</button>  </form>";	




				}else {

					echo "<form method='POST' action='createUser.php?email=".$_GET['email']."&cabinet=".$_GET['cabinet'] . "' role='form' class='form-horizontal'>
				    <input type='hidden' name='delegateID' value='" . $_GET['email'] . "'>
		 								<br>
		 								<input type='hidden' name ='delegateCabinet' value='". $_GET['cabinet']."'>
		 		    					<button type='submit' name='kill' id='singlebutton' class='btn btn-primary';'>Kill Player & Revive</button> <br>
		 		    					<br>
		 		    					<button type='submit' id='singlebutton' name='cabinetChange' class='btn btn-primary';'>Change Cabinet #Betrayal (or backroom shift)</button>";

		 		    					if ($_COOKIE['isBackroom'] === 'a'){
		 		    						echo "<br>

		 		    					<br>
		 		    					<button type='submit' id='singlebutton' name='editEmail' class='btn btn-primary';'>Edit Delegate Information (Name & Email)</button> 

		 		    					</form>";
		 		    					} 	

				}

			}
			?>
			</div>




			<?php 

			// if ($_COOKIE['isBackroom'] === 'a') {
			// 	$con = mysqli_connect("mysql11.000webhost.com", "a2551823_a","1qwerty1","a2551823_a") or die(mysql_error());
			// 	$result = $con->query("SELECT * FROM Cabinets");
			// 	while($row = $result->fetch_assoc()) {
			// 		if $START_CRISIS === false;
			// 		START_CRISIS === true 
			// 		//EMAIL EVERYONE
			// 	echo "<br><br> START CRISIS !?!?!!?!?<br><br>";
			// }


			?>
	</body>
