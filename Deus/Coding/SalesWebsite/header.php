<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<link href="stylesheet.css" type ="text/css" rel ="stylesheet" />
		<title><?php
			$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test") or die(mysql_error());

		$globalResult = $con->query("SELECT * FROM `GlobalVariables`");
		while($row = $globalResult->fetch_assoc()) {
			if ($row['VariableName'] === 'CrisisName') {
				echo "Deus Crisis Website</title>";
			}else if ($row['VariableName'] === 'favicon') {
				echo "<link rel='icon' type='image/png' href='".$row['VariableValue']."'>";
			}
		}

			?> 
				<script src="script.js" type="text/javascript"></script>



				<meta property="og:image" content="http://i.imgur.com/7kJzjwz.png" />

				<meta property="og:description" content="Deus is the world’s first purpose built Crisis platform. Since our inception we’ve helped power international crises. We look forward to power yours too." />

				<meta property="og:title" content="Deus Crisis Platform" />

	</head>
	<body style="background-image:url( <?php 
		$result = $con->query("SELECT * FROM `GlobalVariables` WHERE `VariableName` = 'backgroundImage'");
		while($row = $result->fetch_assoc()) {
			echo $row['VariableValue'];
		}
		 ?>); background-position:0% 50px;background-repeat: repeat">

<? 
	function createNavBar(){ 
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test") or die(mysql_error());
		$navBarResult = $con->query("SELECT * FROM `NavBar` ORDER BY ID ASC");		
		echo' 	<nav class="navbar navbar-inverse">
			 <div class="container-fluid navbar-inverse">
		      <ul class="nav navbar-nav navbar-right navbar-inverse">';
		while($row = $navBarResult->fetch_assoc()) {
			echo' <li id="'.$row["Name"].'"><a style="font-size:1.3em; font-weight:bold;" href="'.$row['URL'].'">'.$row['Name'].'';
			echo "</a>
			</li>";
		}
		echo "</ul></div></nav>";
		
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