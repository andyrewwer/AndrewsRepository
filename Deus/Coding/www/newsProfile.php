	<div class="col-xs-3 col-sm-3 sidebarJS" id="alreadyAThing" style='float:left;'>
	<div class="list-group" id="listgroupJSItem">
	<h4 style="padding: 0px 60px 0px 60px"> News </h4>
	<br>
<?php 
		$con = mysqli_connect("localhost", "dbilh9sp_user","1qwerty1","d5g9x9d8_{{CONFERENCE_NAME}}") or die(mysql_error());
		$result = $con->query("SELECT * FROM News ORDER BY NewsNumber ASC");
		if ($result->num_rows > 0) {
			$myArray = array();
			$publicNewsNumber = 0;
			$publicDisplayNewsNumber = 1;
			$messageValue = 0;
			if (isset($_GET['message'])) {
		     	$messageValue = $_GET['message'];		
		     }
		     while($row = $result->fetch_assoc()) {
		    	$publicNewsNumber ++;
		     	if (isset($_GET['message'])) {
					$message = $_GET['message'];
					if ($message === $row["NewsNumber"]) {
				     	$arrayElement = "<a class='list-group-item active' href='profile.php?message="  . $row["NewsNumber"] . "'>" . $publicNewsNumber . ": " . $row["NewsTitle"] . "</a> ";
				     	$publicDisplayNewsNumber = $publicNewsNumber;
					}else {
						$arrayElement = "<a class='list-group-item' href='profile.php?message="  . $row["NewsNumber"] . "'>" . $publicNewsNumber . ": " . $row["NewsTitle"] . "</a> ";
					}
				}else {
			     	$arrayElement =  "<a class='list-group-item' href='profile.php?message="  . $row["NewsNumber"] . "'>" . $publicNewsNumber . ": " . $row["NewsTitle"] . "</a> ";

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
