<?php include 'preHeaderBackroom.php';include 'header.php';?>
		<h3> Sent messages</h3>

	<?php 
		if (isset($_GET['message'])) {
	    $message = $_GET['message'];
	    if ($message === "failure") {
			echo "<script> var alert = new telegramAlert(); alert.render('You did not complete the form!', 'Please finish filling it out!'); </script>";
	    }

	} ?>


	<div class="col-xs-12 col-sm-12 sidebarJS" id="alreadyAThing">
	<div class="list-group" id="listgroupJSItem">
	<h4 style="	text-align: center;"> Sent Directive <?php echo $_GET['directive']; ?>: </h4>

<?php 

	//commit to Server that this one is reserved. Unreserve others. 
	//Go to user: Get user. See if they have reserved any. If so: Unreserve it 
		$count = 0;
				echo $count;
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","dbilh9sp_{{CONFERENCE_NAME}}") or die(mysql_error());
				echo $count;

		$result = $con->query("SELECT * FROM Responses WHERE `DirectiveNumber` = " .$_GET['directive']);
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
				echo "	 	<div class='wrapper'><div>	<table> <tr><th>Timestamp</th><th>Character Name</th> <th>Directive</th><th>Response Title</th><th>Response Text</th> </tr> <tr> <td>" . $row["Timestamp"]. "</td><td>" . $row["RecipientName"]. "</td><td>" . $row["Directive"] . "</td><td>".$row['Response']."</td><td>".$row['responseDescription']."</tr> </table>";
				echo"<br><br><br><br><br><br><br><br><br>
				</div>
				";
			}
		} else {	
			$result = $con->query("SELECT * FROM Directives WHERE `DirectiveNumber` = " .$_GET['directive']);
			if ($result->num_rows > 0) {
			    while($row = $result->fetch_assoc()) {
					echo "	 	<div class='wrapper'>	<table style='width=1000px'> <tr><th>Timestamp</th><th>Character Name</th> <th>Directive</th></tr> <tr> <td>" . $row["Timestamp"]. "</td><td>" . $row["DirectiveSenderName"]. "</td><td>" . $row["DirectiveText"] . "</td></table>";
				}
			}else { 
				echo "<p>Sorry you seem to have reached this page by mistake!</p><br>";			
				echo"<br><br><br><br><br><br><br><br><br></div>";
			}

		}
?>
</div></div>
</body>
