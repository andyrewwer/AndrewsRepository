<?php 
	$dataCon = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1") or die(mysql_error());
	$DBnamesArray = array('AfghanistanPIMUN', 'CSUMUN', 'CardiffMUN', 'ContemporaryWarMUN', 'DamMUN', 'HaiMUN', 'HamMUN', 'HistoricalWarMUN', 'HolyLandMUN', 'IranPIMUN', 'LIMUN', 'LSEAMUN', 'LSECuban', 'LSEFrench', 'LSENATO', 'LSEGangs', 'LSEStarWars', 'MUNICE', 'NKPIMUN', 'NancyMUN', 'SGMUN', 'ScotMUN', 'UCLMUN', 'YorkMUN', 'UoB');


	for($arrayName = 0; $arrayName < count($DBnamesArray); $arrayName++) {
		if ($arrayName == 0) { 
			$query = 'SELECT * FROM d5g9x9d8_' . $DBnamesArray[$arrayName];
			echo $query;
			$result = $db_con->query($query);
			$fp = fopen('php://output', 'w');
			if ($fp && $result) {
			    header('Content-Type: text/csv');
				$filename = 'export' . $DBnamesArray[$arrayName] . '.csv';
			    header('Content-Disposition: attachment; filename=$filename');
			    while ($row = $result->fetch_array(MYSQLI_NUM)) {
			        fputcsv($fp, array_values($row));
			    }
			    die;
			}
			break;
			return;
		}


		// $DBname = 'd5g9x9d8_' . $DBnamesArray[$arrayName];
		// // echo $DBname . "<br>";
		// $query = "INSERT INTO d5g9x9d8_data.DirectivesTest SELECT DirectiveNumber, DirectiveSender, DirectiveSenderName, DirectiveCommittee, DirectiveFrom, DirectiveType, DirectiveText, Status, Status Name, DirectiveColour, Timestamp FROM " . $DBname .".Directives";
		// echo $query . "<br>";
		// $result = $dataCon->query($query);
		// if (!$result) {
		// 	echo "There was an error: " . mysqli_error($dataCon);
		// 	break;
		// }

		// $DBname = 'd5g9x9d8_' . $DBnamesArray[$arrayName];
		// // echo $DBname . "<br>";
		// $query = "INSERT INTO d5g9x9d8_data.News SELECT * FROM " . $DBname .".News";
		// $result = $dataCon->query($query);
		// if (!$result) {
		// 	echo "There was an error: " . mysqli_error($dataCon);
		// 	break;
		// }
		// echo $query . "<br>";

		// $query = "INSERT INTO d5g9x9d8_data.Responses SELECT * FROM " . $DBname .".Responses WHERE MassMessage != 't'";
		// $result = $dataCon->query($query);
		// if (!$result) {
		// 	echo "There was an error: " . mysqli_error($dataCon);
		// 	break;
		// }
		// echo $query . "<br>";
	}

	// echo count($DBnamesArray) . " <Br><BR>";

	// // -> Now 
	// $rowNumber = 2;
	// $rowNumber530 = 532;
	// while ($rowNumber < 14489) {
	// 	$query = "UPDATE `d5g9x9d8_data`.`Directives` SET `ID` = ".$rowNumber." WHERE `ID` = ".$rowNumber530;
	// 	$rowNumber++;
	// 	$rowNumber530++;
	// 	echo $query;
	// 	$result = $dataCon->query($query);
	// 	if (!$result) {
	// 		echo "There was an error: " . mysqli_error($dataCon);
	// 		break;
	// 	}


	// }





// 			$tempFix = "UPDATE `Directives` SET `Status`='Available' WHERE Status = ''";
// echo "Public";
// 	 		$query2 = "INSERT INTO  `d5g9x9d8_demo`.`News` (`NewsNumber` ,`NewsTitle` ,`NewsDescription`, `NewsImage` )VALUES (NULL , ' " . $responseTitle . "',  '" .  $responseText ."', '". $responseImage . "');";
// 	 		$result2 = mysqli_query($con, $query2);
?>