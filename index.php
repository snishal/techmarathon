<?php
session_start();

require_once 'vendor/autoload.php';
require_once 'utils/form.php';
require_once 'utils/utilFunc.php';

if (!isset($_SESSION['id'])) {
	$_SESSION['id'] = 1;
}

$script = '';

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

	$form = new Form;
	$form->startForm('/utils/request.php', 'post', array('class' => 'form'));
	$form->addItem('text', 'name', 'name', array('id' => 'name', 'label' => 'Name'));
	$form->addItem('text', 'email', 'email', array('id' => 'email', 'label' => 'Email'));
	$form->addItem('textarea', 'query', 'query', array('id' => 'query', 'placeholder' => 'Write Your Query here'));
	$form->addItem('submit', 'submitQuery', 'submitQuery', array('value' => 'Submit', 'class' => "btn waves-effect waves-light col s3 offset-s5"));
	$form->endForm();

	echo $twig->render('web/home.html', array('title' => 'TechMarathon | 2017', 'events' => $events, 'contactUsForm' => $form));
} else if ($uri[1] == 'register') {
	if (empty($uri[2])) {
		$pageFound = true;
		$form = new Form;
		$form->startForm('/utils/request.php', 'post', array('onsubmit' => 'return validateForm(this.form)', 'class' => 'form'));

		$form->addItem('text', 'leaderName', 'leaderName', array('onkeyup' => 'validateText(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'Only alphabets', 'id' => 'leaderName', 'label' => 'Leader Name'));

		$form->addItem('text', 'leaderCollege', 'leaderCollege', array('onkeyup' => 'validateText(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'Only alphabets', 'id' => 'leaderCollege', 'label' => 'Leaders College'));

		$form->addItem('number', 'leaderMobile', 'leaderMobile', array('onkeyup' => 'validateNumber(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => '10 digit mobile number', 'id' => 'leaderMobile', 'label' => 'Leader Mobile'));

		$form->addItem('text', 'leaderEmail', 'leaderEmail', array('onkeyup' => 'validateEmail(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'A valid e-mail id', 'id' => 'leaderEmail', 'label' => 'Leader Email'));

		$form->addItem('text', 'member1Name', 'member1Name', array('onkeyup' => 'validateText(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'Only alphabets', 'id' => 'member1Name', 'label' => 'Member 1 Name'));

		$form->addItem('number', 'member1Number', 'member1Number', array('onkeyup' => 'validateNumber(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => '10 digits Mobile Number', 'id' => 'member1Number', 'label' => 'Member 1 Number'));

		$form->addItem('text', 'member2Name', 'member2Name', array('onkeyup' => 'validateText(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'Only alphabets', 'id' => 'member2Name', 'label' => 'Member 2 Name'));

		$form->addItem('number', 'member2Number', 'member2Number', array('onkeyup' => 'validateNumber(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => '10 digits Mobile Number', 'id' => 'member2Number', 'label' => 'Member 2 Number'));

		$form->addItem('text', 'member3Name', 'member3Name', array('onkeyup' => 'validateText(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'Only alphabets', 'id' => 'member3Name', 'label' => 'Member 3 Name'));

		$form->addItem('number', 'member3Number', 'member3Number', array('onkeyup' => 'validateNumber(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => '10 digits Number', 'id' => 'member3Number', 'label' => 'Member 3 Number'));

		$event = new Event;
		$events = $event->getEvents();

		foreach ($events as $event) {

			if ($event["eventType"] == "Technical") {
				$form->addItem('checkbox', 'event[]', 'Technical', array('id' => $event["eventName"], 'label' => $event["eventName"], 'value' => $event["eventName"]));
			} else {
				$form->addItem('checkbox', 'event[]', 'Non-Technical', array('id' => $event["eventName"], 'label' => $event["eventName"], 'value' => $event["eventName"]));
			}
		}

		//$form->addItem('submit', 'Register', 'Register', array('value' => 'Register', 'class' => "btn waves-effect waves-light col s3 offset-s5", 'onclick' => 'console.log("clicked");'));
		$form->endForm();
		echo $twig->render('web/registration.html', array('title' => 'Registration Form', 'form' => $form));

	}
} else if ($uri[1] == 'sponsors') {
	$pageFound = true;
	echo $twig->render('web/sponsors.html', array('title' => 'Sponsors'));

} else if ($uri[1] == 'events') {

	$eventName = urldecode($uri[2]);

	$event = new Event;

	$title = $event->eventExists($eventName);

	if ($title) {
		$pageFound = true;
		echo $twig->render('web/event.html', array('title' => $eventName, 'tagline' => $event->getEventTagline($eventName), 'description' => file_get_contents($event->getEventDescription($eventName)), 'image' => $event->getEventImage($eventName)));
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

		echo $twig->render('dashboard/dash.html', array('title' => 'Admin Panel', 'counter' => $count, 'registrations' => $registrations));

	} else if ($uri[2] == 'addEvent') {
		$pageFound = true;
		$form = new Form;
		$form->startForm('/utils/request.php', 'post', array('header' => '<h2>Add Event</h2>', 'class' => 'form', 'enctype' => 'multipart/form-data'));
		$form->addItem('text', 'eventName', 'eventName', array('placeholder' => 'eventName'));
		$form->addItem('text', 'eventTagline', 'eventTagline', array('placeholder' => 'eventTagline'));
		$form->addItem('textarea', 'eventDescription', 'eventDescription', array('placeholder' => 'eventDescription'));
		$form->addItem('file', 'eventImage', 'eventImage');
		$form->addItem('text', 'eventType', 'eventType', array('placeholder' => 'eventType'));
		$form->addItem('submit', 'addEvent', 'addEvent', array('value' => 'Submit'));
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
			$eventName = $_GET['name'];

			$event = new Event;

			$eventDescription = $event->getEventDescription($eventName);
			$eventImage = $event->getEventImage($eventName);

			if ($event->deleteEvent($eventName)) {

				unlink($eventDescription);
				unlink($eventImage);
				header("Location: /adminPanel/events");
				$event = null;
				exit;

			}

		} elseif (strstr($uri[3], 'updateEvent')) {
			$pageFound = true;
			$eventName = $_GET['name'];
			$event = new Event;
			$form = new Form;
			$form->startForm('/utils/request.php', 'post', array('header' => '<h2>Update Event</h2>', 'class' => 'form', 'enctype' => 'multipart/form-data'));
			$form->addItem('hidden', 'oldEventName', 'oldEventName', array('value' => $eventName));
			$form->addItem('text', 'eventName', 'eventName', array('placeholder' => 'eventName', 'value' => $eventName));
			$form->addItem('text', 'eventTagline', 'eventTagline', array('placeholder' => 'eventTagline', 'value' => $event->getEventTagline($eventName)));
			$form->addItem('textarea', 'eventDescription', 'eventDescription', array('placeholder' => 'eventDescription', 'value' => file_get_contents($event->getEventDescription($eventName))));
			$form->addItem('file', 'eventImage', 'eventImage');
			$form->addItem('text', 'eventType', 'eventType', array('placeholder' => 'eventType', 'value' => $event->getEventType($eventName)));
			$form->addItem('submit', 'updateEvent', 'updateEvent', array('value' => 'Submit'));
			$form->endForm();
			echo $twig->render('forms/form.html', array('title' => 'Update Event', 'form' => $form, 'script' => 'var editor = CKEDITOR.replace( "eventDescription" );'));
		}
	}
}
notFound:if (!$pageFound) {
	echo $twig->render('404.html');
}
?>