<?php include 'preHeaderFrontroom.php';include 'header.php';?>	
	<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd'><?php 
		if (isset($_GET['message'])) {
		    $message = $_GET['message'];
	    if ($message === "logOn") {
			echo "<script> var alert = new telegramAlert(); alert.render('Error', 'You need to be logged on to access that page'); </script>";
	    }if ($message === "bgImageT") {
				echo "<script> var alert = new telegramAlert(); alert.render('Success', 'Image has been successfully updated.'); </script>";
		}else if ($message === "revert") {
				echo "<script> var alert = new telegramAlert(); alert.render('Success', 'Image has been sucessfully reverted to the previous image.'); </script>";
		}else if ($message === "error") {
				echo "<script> var alert = new telegramAlert(); alert.render('Failure', 'Sorry there was an error reverting the image; please try again in a few moments.'); </script>";
		}else {
			echo "<script> var alert = clearAlert(); </script>";
		}

	} else {
			echo "<script> var alert = clearAlert(); </script>";
		}
	?></h4> 
	<h3 id="appendMe"> 
	<h3> World Map </h3>

	</h3>
	 		<?php 
  				$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_LIMUN") or die(mysql_error());
				$result = $con->query("SELECT * FROM GlobalVariables");
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						if ($row['VariableName'] === 'worldMap') {
							echo "<div class='jumbotron col-xs-11 col-sm-11' id='jumbotron'>";		 		    
							echo "<p><b>World Map. Spring 1559</b></p>Political Map of Europe 1559.";						
							echo "<br> <br><img style='width:100%; height:100%' src='".$row['VariableValue']."' align='middle'/>";
							echo"<br><br>";
							if ($_COOKIE['isBackroom'] !== 'f' && $_COOKIE['loggedIn'] === 'YES') {

								echo "<form method='POST' action='connectivity.php' role='form' class='form-horizontal'><br><textarea class='form-control' name='image' style='height: 50px;' placeholder='Your update image URL (make sure it is an image address)'>".$row['NewsImage']."</textarea>
		 								<br>";
		 								//}
		 		    					echo "<button type='submit' id='singlebutton' name='changeWorldMapImage' class='btn btn-primary'; style='float:left;'>Submit</button> ";		 		    				
		 		    						echo "<button type='submit' id='singlebutton' name='revertWorldMapImage' class='btn btn-warning'; style='float:left;'>Revert</button> </form>";	
							}

	

						}
					}
		    		
				}
				
				 ?> 
				
				

			</div>
		


	</body>



	
</html>
