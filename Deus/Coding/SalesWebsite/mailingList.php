<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link href="stylesheet.css" type ="text/css" rel ="stylesheet" />
    <title>Deus Mailing List</title><?php
        $con = mysqli_connect("localhost", "d5g9x9d8_user","1qwerty1","d5g9x9d8_test") or die(mysql_error());

        $globalResult = $con->query("SELECT * FROM `GlobalVariables`");
        while($row = $globalResult->fetch_assoc()) {
           if ($row['VariableName'] === 'favicon') {
                echo "<link rel='icon' type='image/png' href='".$row['VariableValue']."'>";
            }
        }

        ?>
        <script src="script.js" type="text/javascript"></script>



        <meta property="og:image" content="http://i.imgur.com/7kJzjwz.png" />

        <meta property="og:description" content="Deus is the world’s first purpose built Crisis platform. Click here to sign up to our mailing list. Since our inception we’ve helped power international crises. We look forward to power yours too." />

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
</div><h4 id="messageMe" style='color:#F00;  text-decoration: none; text-align: center; background-color: #ddd'><?php
    if (isset($_GET['message'])) {
        if ($_GET['message'] === "success") {
            echo "<script> var alert = new telegramAlert(); alert.render('Success', 'Thank you for your interest. We will be in touch with you shortly :) '); makeTelegramGreen()</script>";
        }else if ($_GET['message'] === "error") {
            echo "<script> var alert = new telegramAlert(); alert.render('Error', 'Sorry there was a technical problem. Please try again soon, if the problem persists please email us at inquiries@muncrisis.com!'); </script>";
        }else if ($_GET['message'] === "oops") {
            echo "<script> var alert = new telegramAlert(); alert.render('Oops', 'You reached that page by accident.'); </script>";
        }

    }
    ?></h4>
<h3> Deus Mailing List</h3>
<h3 id="appendMe">
</h3>


<!--	<div id="GoogleForm">
		<iframe src="https://docs.google.com/forms/d/1o3KFc6gG2MsvjFqp4s8FD0T7K_jBFvp3y_XsWT5irTA/viewform?embedded=true" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Telegram Request Form, please wait. Loading...</iframe>
	</div> -->

<div class = "googleForm col-sm-10">

    <form method="POST" action="mailingListAcceptance.php" role="form" `class="form-horizontal">						<!-- Form Name -->
        <legend><span class="googleFormSpan"></span>


            <br><br>
            <!-- Multiple Radios -->
            <div class="form-group">
                <label class=" control-label" for="description">Official Conference Name:</label>
                <div style="padding-left: 30px">
                    <textarea class="form-control" id="description" name="name" style="height: 30px;"></textarea>
                </div><br>
                <label class=" control-label" for="description">Official Conference Email:</label>
                <div style="padding-left: 30px">
                    <textarea class="form-control" id="description" name="email" style="height: 30px;"></textarea>
                </div><br>
                <div class="wrapper"><button type="submit" id="singlebutton" name="submit" class="btn btn-primary ">Submit</button></div>
            </div>
        </legend>
    </form>
</div>


</body>
</html>
