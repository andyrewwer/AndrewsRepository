	<div class="col-xs-6 col-sm-3 sidebarJS" id="alreadyAThing">
	<div class="list-group" id="listgroupJSItem">
	<h4 style="padding: 0px 60px 0px 60px"> News </h4>
<?php 
		$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_testDB") or die(mysql_error());
		$result = $con->query("SELECT * FROM News ORDER BY NewsNumber ASC");
		if ($result->num_rows > 0) {
			$myArray = array();
			$publicNewsNumber = 0;
			$publicDisplayNewsNumber = 1;
		    while($row = $result->fetch_assoc()) {
		    	$publicNewsNumber ++;

				if (is_numeric($_GET['message'])) {
					$message = $_GET['message'];
					if ($message === $row["NewsNumber"]) {
				     	$arrayElement = "<a class='list-group-item active' href='index.php?message="  . $row["NewsNumber"] . "'>" . $publicNewsNumber . ": " . $row["NewsTitle"] . "</a> ";
				     	$publicDisplayNewsNumber = $publicNewsNumber;
					}else {
						$arrayElement = "<a class='list-group-item' href='index.php?message="  . $row["NewsNumber"] . "'>" . $publicNewsNumber . ": " . $row["NewsTitle"] . "</a> ";
					}
				}else if ($row['NewsNumber'] === "1"){
			     	$arrayElement = "<a class='list-group-item active' href='index.php?message="  . $row["NewsNumber"] . "'>" . $publicNewsNumber . ": " . $row["NewsTitle"] . "</a> ";
		    	}else {
			     	$arrayElement =  "<a class='list-group-item' href='index.php?message="  . $row["NewsNumber"] . "'>" . $publicNewsNumber . ": " . $row["NewsTitle"] . "</a> ";

		    	}
		     	//$arrayElement = "<a class='list-group-item' href='index.php?message="  . $row["NewsNumber"] . "'>" . $row["NewsNumber"] . ": " . $row["NewsTitle"] . "</a> ";
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
