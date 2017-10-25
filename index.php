<?php
session_start();

require_once 'vendor/autoload.php';
require_once 'utils/form.php';
require_once 'utils/Event.php';
require_once 'utils/utilFunc.php';

if (!isset($_SESSION['id'])) {
	$_SESSION['id'] = 1;
}

if ($_SESSION['id'] == 1) {
	updateCount();
	$_SESSION['id'] = 2;
}

$loader = new Twig_Loader_Filesystem('resources');
$twig = new Twig_Environment($loader);
$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);
$pageFound = false;

if (isset($_POST['logout'])) {

	header('HTTP/1.1 401 Unauthorized');
	goto notFound;
	unset($_POST);

}

if (empty($uri[1])) {
	$pageFound = true;
	$event = new Event;
	$events = $event->getEvents();
	echo $twig->render('web/home.html', array('title' => 'TechMarathon | 2017', 'events' => $events));
}else if ($uri[1] == 'registration') {
	if(empty($uri[2])){
		$pageFound = true;
		$form = new Form;
				$form->startForm('/utils/request.php', 'post', array('header' => '<h2>Registration Form</h2>', 'class' => 'form', 'enctype' => 'multipart/form-data'));
				$form->addItem('text', 'leaderName', array('placeholder' => 'Leader Name'));
				$form-> addItem('text', 'leaderCollege', array('placeholder' => 'Leaders College'));
				$form->addItem('number', 'leaderMobile', array('placeholder' => 'Leader Mobile'));
				$form->addItem('email', 'leaderEmail', array('placeholder' => 'Leader Email'));
				$form->addItem('text', 'member1Name', array('placeholder' => 'Member 1 Name'));
				$form->addItem('email', 'member1Email', array('placeholder' => 'Member 1 Email'));
				$form->addItem('text', 'member2Name', array('placeholder' => 'Member 2 Name'));
				$form->addItem('email', 'member2Email', array('placeholder' => 'Member 2 Email'));
				$form->addItem('text', 'member3Name', array('placeholder' => 'Member 3 Name'));
				$form->addItem('email', 'member3Email', array('placeholder' => 'Member 3 Email'));
				$event = new Event;
				$events = $event->getEvents();
				foreach($events as $event){
					$form->addItem('checkbox', 'event', array('value' => $event["eventName"]));
				}
				$form->addItem('submit', 'Register', array('value' => 'Register'));
				$form->endForm();
				echo $twig->render('web/registration.html', array('title' => 'Registration Form', 'form' => $form));


	}
} else if ($uri[1] == 'adminPanel') {
	if (!auth_user()) {
		goto notFound;
	}
	if (empty($uri[2])) {
		$pageFound = true;
		$event = new Event;

		$count = getCount();

		$counts = new Event;
		$registrations = getRegistrations();

		echo $twig->render('dashboard/dash.html', array('title' => 'Admin Panel', 'counter' => $count, 'totlcount' => $registrations));

	} else if ($uri[2] == 'addEvent') {
		$pageFound = true;
		$form = new Form;
		$form->startForm('/utils/request.php', 'post', array('header' => '<h2>Add Event</h2>', 'class' => 'form', 'enctype' => 'multipart/form-data'));
		$form->addItem('text', 'eventName', array('placeholder' => 'eventName'));
		$form->addItem('text', 'eventTagline', array('placeholder' => 'eventTagline'));
		$form->addItem('textarea', 'eventDescription', array('placeholder' => 'eventDescription'));
		$form->addItem('file', 'eventImage');
		$form->addItem('submit', 'addEvent', array('value' => 'Submit'));
		$form->endForm();
		echo $twig->render('forms/form.html', array('title' => 'Add Event', 'form' => $form, 'script' => 'var editor = CKEDITOR.replace( "eventDescription" );'));
	} elseif ($uri[2] == 'events') {
		if (empty($uri[3])) {
			$pageFound = true;
			$event = new Event;
			$events = $event->getEvents();
			echo $twig->render('dashboard/event.html', array('title' => 'Events', 'events' => $events));
		} elseif (strstr($uri[3], 'deleteEvent')) {
			$pageFound = true;
			$eventId = $_GET['id'];

			$event = new Event;

			$eventDescription = $event->getEventDescription($eventId);
			$eventImage = $event->getEventImage($eventId);

			if ($event->deleteEvent($eventId)) {

				unlink($eventDescription);
				unlink($eventImage);
				header("Location: /adminPanel/events");
				$event = null;
				exit;
			}

		} elseif (strstr($uri[3], 'updateEvent')) {
			$pageFound = true;
			$id = $_GET['id'];
			$event = new Event;
			$form = new Form;
			$form->startForm('/utils/request.php', 'post', array('header' => '<h2>Update Event</h2>', 'class' => 'form', 'enctype' => 'multipart/form-data'));
			$form->addItem('hidden', 'eventId', array('value' => $id));
			$form->addItem('text', 'eventName', array('placeholder' => 'eventName', 'value' => $event->getEventName($id)));
			$form->addItem('text', 'eventTagline', array('placeholder' => 'eventTagline', 'value' => $event->getEventTagline($id)));
			$form->addItem('textarea', 'eventDescription', array('placeholder' => 'eventDescription', 'value' => file_get_contents($event->getEventDescription($id))));
			$form->addItem('file', 'eventImage');
			$form->addItem('submit', 'updateEvent', array('value' => 'Submit'));
			$form->endForm();
			echo $twig->render('forms/form.html', array('title' => 'Update Event', 'form' => $form, 'script' => 'var editor = CKEDITOR.replace( "eventDescription" );'));
		}
	}
}
notFound:if (!$pageFound) {
	echo $twig->render('404.html');
} 
?>