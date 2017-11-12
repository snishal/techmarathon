<?php
require_once 'utilFunc.php';
require_once 'RegisterMember.php';

if (isset($_POST['addEvent'])) {

	if (!empty($_POST['eventName'])) {

		$eventName = $_POST['eventName'];

	}
	if (!empty($_POST['eventTagline'])) {

		$eventTagline = $_POST['eventTagline'];

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
		exit;

	}

} elseif (isset($_POST['updateEvent'])) {

	$event = new Event;

	$oldEventName = $_POST['oldEventName'];

	$eventName = $_POST['eventName'];
	$eventTagline = $_POST['eventTagline'];
	$eventType = $_POST['eventType'];

	$olddesc = $event->getEventDescription($eventId);
	unlink("../" . $olddesc);

	$eventDescription = "description/" . $eventName . ".html";
	$description = $_POST['eventDescription'];
	$descFile = fopen("../" . $eventDescription, "w");
	fwrite($descFile, $description);
	fclose($descFile);

	if (!empty($_FILES['eventImage']['name'])) {

		$oldimg = $event->getEventImage($eventName);
		unlink("../" . $oldimg);
		$eventImage = file_upload('images/', $eventName);

	} else {
		$eventImage = $event->getEventImage($eventName);
	}

	if ($event->updateEvent($oldEventName, $eventName, $eventTagline, $eventDescription, $eventImage, $eventType)) {

		$event = null;
		header("Location: /adminPanel/events");
		exit;

	}

} elseif (isset($_POST['Register'])) {

	$member = new RegisterMember;

	foreach ($_POST['event'] as $key => $event) {
		$member->register($event, $_POST['leaderName'], $_POST['leaderCollege'], $_POST['leaderMobile'], $_POST['leaderEmail'], $_POST['member1Name'], $_POST['member1Number'], $_POST['member2Name'], $_POST['member2Number'], $_POST['member2Name'], $_POST['member3Number']);
	}

	$event = null;
	header("Location: /");
	exit;

}

?>