<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';
require_once 'utilFunc.php';
require_once 'Registeration.php';

if (isset($_POST['submitQuery'])) {

	$name = filter_data($_POST['name']);

	$email = filter_data($_POST['email']);

	$query = filter_data($_POST['query']);

	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true,
		),
	);
	$mail->SMTPDebug = 0;
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = "dductechmarathon@gmail.com";
	$mail->Password = "dduc@TM18";
	$mail->setFrom('snishal33@gmail.com', 'Sahil Nishal');
	$mail->addAddress('dductechmarathon@gmail.com', 'TechMarathon Dduc');
	$mail->Subject = 'Query';
	$mail->isHTML(false);
	$mail->Body = 'Name : ' . $name . " \n";
	$mail->Body = $mail->Body . 'Email : ' . $email . " \n";
	$mail->Body = $mail->Body . 'Query : ' . $query;
	$mail->send();

	header('Location: /?param=Query sent successfully.');

} elseif (isset($_POST['addEvent'])) {

	if (!empty($_POST['eventName'])) {

		$eventName = filter_data($_POST['eventName']);

	}
	if (!empty($_POST['eventTagline'])) {

		$eventTagline = filter_data($_POST['eventTagline']);

	}
	if (!empty($_POST['eventDescription'])) {

		$eventDescription = "description/" . $eventName . ".html";
		$description = $_POST['eventDescription'];

		$descFile = fopen("../" . $eventDescription, "w");
		fwrite($descFile, $description);
		fclose($descFile);

	}
	if (!empty($_FILES['eventImage']['name'])) {

		$eventImage = file_upload('images/', $eventName);

	}
	if (!empty($_POST['eventType'])) {

		$eventType = $_POST['eventType'];

	}
	$event = new Event;

	if ($event->addEvent($eventName, $eventTagline, $eventDescription, $eventImage, $eventType)) {
		$event = null;
		header("Location: /adminPanel/events");
	}

} elseif (isset($_POST['updateEvent'])) {

	$event = new Event;

	$oldEventName = filter_data($_POST['oldEventName']);

	$eventName = filter_data($_POST['eventName']);
	$eventTagline = filter_data($_POST['eventTagline']);
	$eventType = filter_data($_POST['eventType']);

	$olddesc = $event->getEventDescription($oldEventName);
	unlink("../" . $olddesc);

	$eventDescription = "description/" . $eventName . ".html";
	$description = $_POST['eventDescription'];
	$descFile = fopen("../" . $eventDescription, "w");
	fwrite($descFile, $description);
	fclose($descFile);

	$img = $event->getEventImage($oldEventName);

	if (!empty($_FILES['eventImage']['name'])) {

		$oldimg = $img;
		unlink("../" . $oldimg);
		$eventImage = file_upload('images/', $eventName);

	} else {

		if ($oldEventName != $eventName) {

			$oldName = explode(".", $img);
			$eventImage = "images/" . $eventName . "." . $oldName[1];
			rename("../" . $img, "../" . $eventImage);
			unlink("../" . $img);

		} else {
			$eventImage = $img;
		}

	}

	if ($event->updateEvent($oldEventName, $eventName, $eventTagline, $eventDescription, $eventImage, $eventType)) {
		$event = null;
		header("Location: /adminPanel/events");
	}

} elseif (isset($_POST['Register'])) {

	$registeration = new Registeration;

	foreach ($_POST['event'] as $key => $event) {
		$registeration->register($event, filter_data($_POST['leaderName']), filter_data($_POST['leaderCollege']), filter_data($_POST['leaderMobile']), filter_data($_POST['leaderEmail']), filter_data($_POST['member1Name']), filter_data($_POST['member1Number']), filter_data($_POST['member2Name']), filter_data($_POST['member2Number']), filter_data($_POST['member2Name']), filter_data($_POST['member3Number']));
	}

	$event = null;
	header("Location: /?param=Registered successfully.");
}

?>