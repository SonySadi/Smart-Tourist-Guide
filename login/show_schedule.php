<?php

session_start();
include('./../connection.php');
//index.php

$subject = 'smart city suggestions';
$message = '';
$gmap = "https://www.google.com/maps/search/?api=AIzaSyC3F9Gv0o4wXfBRY1WnX48Hr7eBjhYoN8E";
$rest = explode(',', $venues);
for ($i = 1; $i < $_SESSION['index']; $i++) {

	$gmap = "<tabel border=\"1\"><tr><th>" . $rest[$i] . "</th><th></th></tr><tr><td></td></tr><tr><td>" . "https://www.google.com/maps/search/?api=AIzaSyARsQvuyAvwTGLsbP87gkCYvCa4dAXkVMY&query=" . $_SESSION['lat'][$_SESSION['ival']] . ',' . $_SESSION['lng'][$_SESSION['ival']] . PHP_EOL . '</tabel>';
	//$gmap="hello";
	$message .= $gmap . ' ';
	$_SESSION['ival'] = $_SESSION['ival'] + 1;
}




// require 'PHPMailerAutoload.php';
// $mail = new PHPMailer;
// $mail->SMTPDebug = 0;
// $mail->IsSMTP();								//Sets Mailer to send message using SMTP
// $mail->Host = 'smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
// $mail->Port = '587';								//Sets the default SMTP server port
// $mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
// $mail->Username = 'smartguide.mnnit@gmail.com';					//Sets SMTP username
// $mail->Password = '2018is10';					//Sets SMTP password
// $mail->SMTPSecure = 'tls';							//Sets connection prefix. Options are "", "ssl" or "tls"
// $mail->From = "smartguide.mnnit@gmail.com";					//Sets the From email address for the message
// $mail->FromName = 'smart city travelers';				//Sets the From name of the message
// $mail->AddAddress($_SESSION['email'], "Customer");		//Adds a "To" address
// //$mail->AddCC($email, $_POST["name"]);	//Adds a "Cc" address
// $mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
// $mail->IsHTML(true);							//Sets message type to HTML				
// $mail->Subject = $subject;				//Sets the Subject of the message
// $mail->Body = $message;				//An HTML or plain text message body
// $mail->Send();					//Send an Email. Return true on success or false on error



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Smart Guide</title>
	<style>
		#map {
			height: 500px;
			width: 700px;
		}

		.column1 {
			float: left;
			width: 50%;
		}

		.column2 {
			float: right;
			width: 40%;
		}
	</style>
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/util.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<!--===============================================================================================-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>

	<!-- Header -->
	<div class="header">
		<a href="home.php" class="logo">Smart City Traveller</a>
		<div class="header-right">
			<a class="active" href="home.php">Home</a>
			<a href="/logout.php"><img src="images/icons/user_ironman.png" /> <b> <?php echo $_SESSION['name']; ?></b> signout</a>
			<a href="../aboutus/aboutus.html">About us</a>
		</div>
	</div>


	<!-- Content -->
	<div class="bg-contact3" style="background-image: url('images/home_slider.jpg');">
		<div class="container-contact3 container-fluid">
			<div class="row">
				<div class="col-sm">
					<h1>
						<font color="Black">Your Route</font>
					</h1>
					<div id="map"></div>
				</div>
				<div class="col-sm">
					<h1>
						<font color="Black">Venue List</font>
					</h1>
					<div class="wrap-contact3" id="ven"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- <script src="./show_schedule_session.php"></script> -->
	<script src="./show_schedule_map_js.php"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3F9Gv0o4wXfBRY1WnX48Hr7eBjhYoN8E&callback=initMap&libraries=geometry&v=weekly" async></script>


</body>

</html>