<?php include 'header.php';?>
	<h3> <b>What others have said about Deus </b><br><br>If you would like submit a testimonial please email us at inquiries@muncrisis.com or message us on Facebook</h3>


	<?php 
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test") or die(mysql_error());
		$result = $con->query("SELECT * FROM Testimonials ORDER BY `Name` ASC");
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		    	echo "<div class = 'googleForm col-sm-10 col-xs-10 col-md-10'>
				<legend> <b>". $row['Name'].", </b><i>".$row['Title']."</i> 	</legend> 

				<div class='col-sm-12 col-md-12 col-xs-12'> 
				<div class='col-sm-3 col-md-3 col-xs-3'>
				<img style='width:100%; height:100%' src='".$row['Image']."' align='left'/>
				</div>
				<div class='col-sm-9 col-md-9 col-xs-9'>
				". $row['Testimonial'] . " 

				</div>
				</div>
				</div><br><br><br>";

		    }
		}else {
			echo "oops, " . $result->num_rows;
		}
	?>
