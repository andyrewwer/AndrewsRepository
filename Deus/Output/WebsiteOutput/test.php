<?php include 'header.php';?>


<?php 
//Testing to send a message to everyone: 

$con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test2AndrewForLife") or die(mysql_error());
//#001 - Send a PM response to every delegates
date_default_timezone_set('Europe/London'); // CDT
$currentDate = getDate();
$date = $currentDate['mday'];
$month = $currentDate['mon'];
$year = $currentDate['year'];
$hour = $currentDate['hours'];
$min = $currentDate['minutes'];
$sec = $currentDate['seconds'];
$currentDate = "$date/$month/$year == $hour:$min:$sec";$result = $con->query("SELECT * FROM Users ORDER BY CharacterName");

 
while($row = $result->fetch_assoc()) {   

    $queryUpdate = "INSERT INTO  `d5g9x9d8_test2AndrewForLife`.`Responses` (
    `Recipient`,
    `RecipientName`,
    `Directive`,
    `DirectiveNumber`,
    `Response`,
    `responseDescription` 
    `responseID`, 
    `readByDelegate`, 
    `ResponseAllowed`, 
    `Timestamp`) VALUES (
    '".$row['UserNameID'] ."', // CHECK THIS PLEASE :P 
    '".$row['CharacterName']."',
    '',
    '0', 
    'Thank you for using Deus, Feedback Request!', 
    'Thank you for using Deus, we hope that you enjoyed this your crisis and that Deus Crisis Platform helped make it more enjoyable. We would love it if you would be able to give us feedback on your experience on using Deus, both things we did well but also where you had problems we any improvements or suggestions you may have. Click feedback in the nav bar or <a href='feedback.php' style='text-family: Helvetica, sans-serif;font-size: 1em;color:#888> click here </a>. <br> <br> We would also appreciate it if you would like us on <a href=`https://facebook.com/CrisisDeus` style=`text-family: Helvetica, sans-serif;font-size: 1em;color:#888`> Facebook </a><br><br><a href=`https://www.facebook.com/CrisisDeus/`><img style=`width:75%; height:75%; padding-left: 12.5%` src=`http://i.imgur.com/wRaKY0A.jpg` align=`middle`/></a> ', 
    NULL ,  
    'f', 
    'f', 
    '".$currentDate."');";
    $resultUpdate = mysqli_query($con, $queryUpdate);     
    if (!$resultUpdate) {
        echo "ERROR" . mysqli_error($con);
        break;
        return;

    }
}

//#002 - Publish a public news item
// $queryNews = "INSERT INTO  `d5g9x9d8_test2AndrewForLife`.`News` (
// `NewsNumber`, 
// `NewsTitle`, 
// `NewsDescription`, 
// `NewsImage` )VALUES (NULL, 
// `Thank you for using Deus, Feedback Request!',  
//     'Thank you for using Deus, we hope that you enjoyed this your crisis and that Deus Crisis Platform helped make it more enjoyable. We would love it if you would be able to give us feedback on your experience on using Deus, both things we did well but also where you had problems we any improvements or suggestions you may have. Click feedback in the nav bar or <a href='feedback.php' style='text-family: Helvetica, sans-serif;font-size: 1em;color:#888> click here </a>. <br> <br> We would also appreciate it if you would like us on <a href='https://facebook.com/CrisisDeus' style='text-family: Helvetica, sans-serif;font-size: 1em;color:#888> Facebook </a> `, 
// 'http://i.imgur.com/wRaKY0A.jpg');";
// $resultNews = mysqli_query($con, $queryNews);     
// if (!$resultNews) {
//     echo "ERROR" . mysqli_error($con);
//     break;
//     return;
// }
// //#003  Makes 'Feedback.php' appear in NavBar for all logged in Users
// $queryUpdateNavBar = "UPDATE `d5g9x9d8_test2AndrewForLife`.`NavBar` SET `Privacy` = 1 WHERE `ID` = 15";
// $resultNavBar = mysqli_query($con, $queryUpdateNavBar);     
// if (!$resultNavBar) {
//     echo "ERROR" . mysqli_error($con);
//     break;
//     return;
// }
/* end test 1. */
?>
