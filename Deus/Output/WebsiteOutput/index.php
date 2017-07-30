<?php include 'preHeaderFrontroom.php';include 'header.php';?>	
	<h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd'><?php 
		if (isset($_GET['error'])) {
		    $message = $_GET['error'];
	    if ($message === "logOn") {
			echo "<script> var alert = new telegramAlert(); alert.render('Error', 'You need to be logged on to access that page'); </script>";
	    }else if ($message === "edit") {
			echo "<script> var alert = new telegramAlert(); alert.render('Form filled incorrectly', 'Please make sure all aspects of the form are filled in!'); </script>";
	    }else if ($message === "oops") {
				echo "<script> var alert = new telegramAlert(); alert.render('Oops', 'You reached that page by accident.'); </script>";
		}else if ($message === "editT") {
				echo "<script> var alert = new telegramAlert(); alert.render('Success', 'News has been sucessfully edited.'); makeTelegramGreen(); </script>";
		}else if ($message === "deleteT") {
				echo "<script> var alert = new telegramAlert(); alert.render('Success', 'News has been sucessfully deleted.'); makeTelegramGreen(); </script>";
		}else if ($message === "deleteF") {
				echo "<script> var alert = new telegramAlert(); alert.render('Failure', 'Sorry there was an error editing the news; please try again in a few moments.'); </script>";
		}else if ($message === "failure") {
				echo "<script> var alert = new telegramAlert(); alert.render('Incorrect password', 'Please try again.'); showLogInForm();</script>";
		}else {
			echo "<script> var alert = clearAlert(); </script>";
		}

	} else {
			echo "<script> var alert = clearAlert(); </script>";
		}
	?></h4> 
	<h3 id="appendMe"> 
	<h3> News Screen </h3>
<?php include 'newsEverywhere.php';?>
	</h3>
	 		<?php 
  				$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testDB") or die(mysql_error());
				$result = $con->query("SELECT * FROM News");
				if ($result->num_rows > 0) {
					echo "<div class='jumbotron col-xs-8 col-sm-8' id='jumbotron'>";
				    while($row = $result->fetch_assoc()) {
				    	if (isset($_POST['edit']) ) {
				    		if ($_POST['newsNumber'] === $row['NewsNumber']) {
	    						$NewsDescription = str_replace("<br />", '', $row['NewsDescription']);
								echo "<form method='POST' action='connectivity.php' role='form' class='form-horizontal'>
			    						<input type='hidden' name='newsNumber' value='" . $_POST['newsNumber'] . "'>
	 								<textarea class='form-control' name='title' style='height: 60px;'>".$row['NewsTitle']."</textarea>
	 								<br>
									<textarea class='form-control' name='description' style='height: 250px;'>".$NewsDescription."</textarea>
	 								<br>"; 
	 								//if($row['NewsImage'] !== '') {
										echo "<textarea class='form-control' name='image' style='height: 50px;' placeholder='Your image URL here ending in .png or .jpeg'>".$row['NewsImage']."</textarea>
	 								<br>";
	 								//}
	 		    					echo "<button type='submit' id='singlebutton' name='submitNewsChange' class='btn btn-primary'; style='float:left;'>Submit</button> </form>";	
	 		    					echo "<form method='POST' action='connectivity.php' role='form' `class='form-horizontal'>
					 	<input type='hidden' name='newsNumber' value='" . $_POST['newsNumber']  . "''>
						<button type='submit' id='singlebutton' name='deleteNewsItem' class='btn btn-danger' style='float:right;'>Delete</button> </form>";	

	 		    				}
				    	}else {
							if ($_GET['message'] === $row["NewsNumber"]) {
			  					$message = $_GET['message'];
			  					addEditButton($_GET['message']);		
			  					echo "<p><b>" . $publicDisplayNewsNumber . ": " . $row["NewsTitle"] . "</b></p>" . $row["NewsDescription"];
								if ($row['NewsImage'] !== 'NULL') {
									echo "<br> <br><img style='width:100%; height:100%' src='".$row['NewsImage']."' align='middle'/>";
					    
								}

		    				}else if ($row["NewsNumber"] === "1" && !is_numeric($_GET['message'])) {
	    						addEditButton('1');
								echo "<p><b>" . $publicDisplayNewsNumber . ": " . $row["NewsTitle"] . "</b></p>" . $row["NewsDescription"];
								if ($row['NewsImage'] !== 'NULL') {
				    				echo "<br> <br><img style='width:100%; height:100%' src='".$row['NewsImage']."' align='middle'/>";
								}

		    				}

		    			}
					}
				}
				function addEditButton($aNumber){
					if ($_COOKIE['isBackroom'] !== "f" && $_COOKIE['loggedIn'] === "YES") {												
						if (!isset($_POST['edit'])) {
							echo "<form method='POST' action='index.php?message=" . $aNumber . "' role='form' `class='form-horizontal'>
		    						 	<input type='hidden' name='newsNumber' value='" . $aNumber . "''>
 		    					<button type='submit' id='singlebutton' name='edit' class='btn btn-primary' style='float:right;'>Edit</button> </form>";													
						}	
			
					}
				}
				 ?> 
				
				

			</div>
		


	</body>



	
</html>
