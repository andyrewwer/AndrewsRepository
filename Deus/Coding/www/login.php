<?php include 'header.php';?>

	<nav class="navbar navbar-default navbar-inverse">
		 <div class="container-fluid navbar-inverse">
		    <div class="navbar-header">
		      <a id="profileTitle" class="navbar-brand" href=
		   <?php
		      	if ($_COOKIE['loggedIn'] === "YES") {
		      		echo "'profile.php'>".$_COOKIE['name'];
		      	}else {
		      		echo "'index.php'>MUN Crisis";
		      	}?> </a>		    
		      	</div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right navbar-inverse">
		        <li><a href="index.php">Home</a></li>
		        <li class="active"><a href="#">Log in</a></li>
		        <li><a id="helpButton" href="help.php">Help <span class="sr-only"></span></a></li>
</ul>
		    </div><!-- /.navbar-collapse -->
		    <div class="container" id="form-container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form method="POST" action="connectivity.php" id="login-form" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="user" id="username" tabindex="1" class="form-control" placeholder="Username"  <?php 
										 	echo "value='".$_COOKIE['user'] . "'";?>/>
									</div>
									<div class="form-group">
										<input type="password" name="pass" id="password" tabindex="2" class="form-control" placeholder="Password" <?php if (isset($_COOKIE['rememberMe'])) {
										 	if ($_COOKIE['rememberMe'] === "on") {
										 	echo "value='".$_COOKIE['pass'] . "'";}}?> />
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" name="remember" id="remember" 
										 <?php if (isset($_COOKIE['rememberMe'])) {
										 	if ($_COOKIE['rememberMe'] === "on") {
										 	echo "checked";}}?>/>
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		</div><!-- /.container-fluid -->
	</nav> 	
<div id="dialogoverlay"></div>
<div id="dialogbox">
  <div>
    <div id="dialogboxhead" onclick="clearAlert()"></div>
    <div id="dialogboxbody" onclick="clearAlert()"></div>
    <div id="dialogboxfoot" onclick="clearAlert()"></div>
  </div>
</div>
		<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd'>
	<?php 
		if (isset($_GET['message'])) {
	    $message = $_GET['message'];
	    if ($message === "success") {
	         echo "Success";
	    } else if (is_numeric($message) !== TRUE){
			echo "<script> var alert = new telegramAlert(); alert.render('Incorrect Password', 'please try again!'); </script>";
		}

	} ?>

			     	<h3 id="loginH3"> This is the login screen <br>

</h3>

	<h3 id="appendMe"> 
	<div class="col-xs-6 col-sm-3 sidebarJS" id="alreadyAThing">
	<div class="list-group" id="listgroupJSItem">
	<h4 style="padding: 0px 60px 0px 60px"> News </h4>
	<?php 
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
		$result = $con->query("SELECT * FROM News");
		if ($result->num_rows > 0) {
			$myArray = array();
		     while($row = $result->fetch_assoc()) {
		     	if ($_GET['message'] === $row['NewsNumber']) {
			     	$arrayElement = "<a class='list-group-item active' href='login.php?message="  . $row["NewsNumber"] . "'>" . $row["NewsNumber"] . ": " . $row["NewsTitle"] . "</a> ";
		     	}else {
			     	$arrayElement = "<a class='list-group-item' href='login.php?message="  . $row["NewsNumber"] . "'>" . $row["NewsNumber"] . ": " . $row["NewsTitle"] . "</a> ";		     		
		     	}
		     	$myArray[] = $arrayElement;
//		     	echo 
		     }
		     $myArray = array_reverse($myArray);
		     foreach ($myArray as $element) {
		     	echo $element;
		     }
		}
	?>
		</div>
		</div>
	</h3>
	 		<?php 
  				$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
				$result = $con->query("SELECT * FROM News");
				if ($result->num_rows > 0) {
					echo "<div class='jumbotron col-xs-8 col-sm-8' id='jumbotron'>";
				    while($row = $result->fetch_assoc()) {
							if ($_GET['message'] === $row["NewsNumber"]) {
				  				$message = $_GET['message'];
								echo "<p><b>" . $row["NewsNumber"] . ": " . $row["NewsTitle"] . "</b></p>" . $row["NewsDescription"];
								if ($row['NewsImage'] !== 'NULL') {
				    				echo "<br> <br><img style='width:100%; height:100%' src='".$row['NewsImage']."' align='middle'/>";
								}

		    				}else if ($row["NewsNumber"] === "1" && !is_numeric($_GET['message'])) {
								echo "<p><b>" . $row["NewsNumber"] . ": " . $row["NewsTitle"] . "</b></p>" . $row["NewsDescription"];
								if ($row['NewsImage'] !== 'NULL') {
				    				echo "<br> <br><img style='width:100%; height:100%' src='".$row['NewsImage']."' align='middle'/>";
		    				}
		    			}
					}
				}?>
		</br>

		</body>
</html>
