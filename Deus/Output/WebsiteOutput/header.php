<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<link href="stylesheet.css" type ="text/css" rel ="stylesheet" />
		<title><?php
			$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testDB") or die(mysql_error());

		$globalResult = $con->query("SELECT * FROM `GlobalVariables`");
		while($row = $globalResult->fetch_assoc()) {
			if ($row['VariableName'] === 'CrisisName') {
				echo $row['VariableValue'] . " Crisis</title>";
			}else if ($row['VariableName'] === 'favicon') {
				echo "<link rel='icon' type='image/png' href='".$row['VariableValue']."'>";
			}
		}

			?> 
				<script src="script.js" type="text/javascript"></script>

				<meta property="og:image" content="http://i.imgur.com/7kJzjwz.png" />

				<meta property="og:description" content="Deus is the world’s first purpose built Crisis platform. Since our inception we’ve helped power international crises. We look forward to power yours too." />
	</head>
<body onload="logOnCheck()" style="background-image:url( <?php 
		$result = $con->query("SELECT * FROM `GlobalVariables` WHERE `VariableName` = 'backgroundImage'");
		while($row = $result->fetch_assoc()) {
			echo $row['VariableValue'];
		}
		 ?>); background-position:0% 50px;background-repeat: repeat">
<? 
	function createNavBar(){ 
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testDB") or die(mysql_error());
		if ($_COOKIE['loggedIn'] === 'YES') { 
			if ($_COOKIE['isBackroom'] === 'f') {
				if ($_COOKIE['isChair'] === 'f') {
					$navBarResult = $con->query("SELECT * FROM `NavBar` WHERE `Privacy` = 1 OR `Privacy` = 2 ORDER BY `ID`");		
				}else {
					$navBarResult = $con->query("SELECT * FROM `NavBar` WHERE `Privacy` = 1 OR `Privacy` = 2 OR `Privacy` = 3 ORDER BY `ID`");			
				}
			}else if ($_COOKIE['isBackroom'] === 't') {
				$navBarResult = $con->query("SELECT * FROM `NavBar` WHERE `Privacy` = 1 OR `Privacy` = 4 ORDER BY `ID`");			
			}else if ($_COOKIE['isBackroom'] === 'a') {
				$navBarResult = $con->query("SELECT * FROM `NavBar` WHERE `Privacy` = 1 OR `Privacy` = 4 OR `Privacy` = 5 ORDER BY `ID`");			
			}
			echo' 	<nav class="navbar navbar-inverse">
			 <div class="container-fluid navbar-inverse">
		      <ul class="nav navbar-nav navbar-right navbar-inverse">';
			while($row = $navBarResult->fetch_assoc()) {
				echo' <li id="'.$row["Name"].'"><a href="'.$row['URL'].'">'.$row['Name'].'';
				if ($row['URL'] === 'profile.php'){
					$result = $con->query("SELECT * FROM Responses WHERE `readByDelegate` = 'f' AND `Recipient` = '".$_COOKIE['user']."'");
					if ($result->num_rows > 0) {
						echo " <span class='badge'> ". $result->num_rows." </span>"; 					
					}
				}else if ($row['URL'] === 'directiveConfirmation.php'){
					$result = $con->query("SELECT * FROM Directives WHERE Status = 'Frozen' AND DirectiveCommittee = '".$_COOKIE['committee']."' ");
					if ($result->num_rows > 0) {
					    echo " <span class='badge progress-bar-danger'>".$result->num_rows."</span>";								
					}	
				}else if ($row['URL'] === 'backroomReserve.php'){
					$result = $con->query("SELECT * FROM  `Directives` WHERE  `Status` = '".$_COOKIE['user']."'");
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
						    echo " <span id='backroomReserve' class='badge'>".$row['DirectiveNumber']."</span>";		
					    }		
					}								
				}
				echo "</a>
				</li>";
			}
			echo '<li ><a id="logOut" ahref = "index.php" onclick="logOut()">Log out</a></li>';
			echo "</ul></div></nav>";
		}else {//YOU ARE /NOT/ LOGGED IN. 
			$navBarResult = $con->query("SELECT * FROM `NavBar` WHERE `Privacy` = 0 ORDER BY `ID`");	
						echo' 	<nav class="navbar navbar-inverse ">
			 <div class="container-fluid navbar-inverse ">
		      <ul class="nav navbar-nav navbar-right navbar-inverse">';
			while($row = $navBarResult->fetch_assoc()) {
				echo' <li id="'.$row["Name"].'"><a href="'.$row['URL'].'">'.$row['Name'].'';
				
				echo "</a>
				</li>";
			}
			echo '<li id="logInFormButton"><a id="logIn" ahref = "index.php" onclick="showLogInForm()">Log In</a></li>';
			echo "</ul><div class ='col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 panel panel-login' id='logInForm' style='display: none;'><form method='POST' action='connectivity.php' id='login-form' role='form'><br>
				<div class='form-group'>
					<input type='text' name='user' id='username' tabindex='1' class='form-control' placeholder=
					'Username'"; 
					 	echo "value='".$_COOKIE['user'] . "'/>";
				echo"</div>
				<div class='form-group'>
					<input type='password' name='pass' id='password' tabindex='2' class='form-control' placeholder='Password'";
					 if (isset($_COOKIE['rememberMe'])) {
					 	if ($_COOKIE['rememberMe'] === "on") {
					 	echo "value='".$_COOKIE['pass'] . "'";}}
					 	echo' />
				</div>
				<div class="form-group text-center">
					<input type="checkbox" tabindex="3" name="remember" id="remember"';
				if (isset($_COOKIE['rememberMe'])) {
					 	if ($_COOKIE['rememberMe'] === "on") {
					 	echo "checked";}}
					 	echo'/>
					<label for="remember"> Remember Me</label>
				</div>
					<div class="row">
				<div class="form-group">
						<div class="col-sm-6">
							<input type="submit" name="submit" id="button" tabindex="4" class="form-control btn btn-login" value="Log-In" />
						</div>
				</div>
				<div class="form-group">
						<div class="col-sm-6">
							<div class="text-center">
								<a href="help.php" class="forgot-password">Forgot Password?</a>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>';
			echo "</div></nav>";		
		}
	}
	createNavBar();
?>	
<script>
	makeNavBarActive();
</script>
<div id="dialogoverlay"></div>
<div id="dialogbox">
  <div>
    <div id="dialogboxhead" onclick="clearAlert()"></div>
    <div id="dialogboxbody" onclick="clearAlert()"></div>
    <div id="dialogboxfoot" onclick="clearAlert()"></div>
  </div>
</div>
