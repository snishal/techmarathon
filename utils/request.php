<?php

require_once 'Event.php';
require_once 'utilFunc.php';

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

	$event = new Event;

	if ($event->addEvent($eventName, $eventTagline, $eventDescription, $eventImage)) {

		$event = null;
		header("Location: /adminPanel/events");
		exit;

	}

} elseif (isset($_POST['updateEvent'])) {

	$event = new Event;

	$eventId = $_POST['eventId'];

	$eventName = $_POST['eventName'];
	$eventTagline = $_POST['eventTagline'];

	$olddesc = $event->getEventDescription($eventId);
	unlink("../" . $olddesc);

	$eventDescription = "description/" . $eventName . ".html";
	$description = $_POST['eventDescription'];
	$descFile = fopen("../" . $eventDescription, "w");
	fwrite($descFile, $description);
	fclose($descFile);

	if (!empty($_FILES['eventImage']['name'])) {

		$oldimg = $event->getEventImage($eventId);
		unlink("../" . $oldimg);
		$eventImage = file_upload('images/', $eventName);

	} else {
		$eventImage = $event->getEventImage($eventId);
	}

	if ($event->updateEvent($eventId, $eventName, $eventTagline, $eventDescription, $eventImage)) {

		$event = null;
		header("Location: /adminPanel/events");
		exit;

	}

}

?>