<?php
session_start();

require_once 'vendor/autoload.php';
require_once 'utils/form.php';
require_once 'utils/Event.php';
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
	echo $twig->render('web/home.html', array('title' => 'TechMarathon | 2017', 'events' => $events));
} else if ($uri[1] == 'registration') {
	if (empty($uri[2])) {
		$pageFound = true;
		$form = new Form;
		$form->startForm('/utils/request.php', 'post', array('onsubmit' => 'return validateForm(this.form)', 'legend' => '<h2>Registration Form</h2>', 'class' => 'form', 'fieldset' => 'true'));

		$form->addItem('text', 'leaderName', array('onkeyup' => 'validateText(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'Only alphabets', 'id' => 'leaderName', 'label' => 'Leader Name', 'div' => '<div class="input-field col s12"> <i class="material-icons md-light prefix">account_circle</i>'));

		$form->addItem('text', 'leaderCollege', array('onkeyup' => 'validateText(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'Only alphabets', 'id' => 'leaderCollege', 'label' => 'Leaders College', 'div' => '<div class="input-field col s12"> <i class="material-icons md-light prefix">location_city</i>'));

		$form->addItem('number', 'leaderMobile', array('onkeyup' => 'validateNumber(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => '10 digit mobile number', 'id' => 'leaderMobile', 'label' => 'Leader Mobile', 'div' => '<div class="input-field col s12"> <i class="material-icons md-light prefix">phone_iphone</i>'));

		$form->addItem('email', 'leaderEmail', array('onkeyup' => 'validateEmail(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'A valid e-mail id', 'id' => 'leaderEmail', 'label' => 'Leader Email', 'div' => '<div class="input-field col s12"> <i class="material-icons md-light prefix">mail</i>'));

		$form->addItem('text', 'member1Name', array('onkeyup' => 'validateText(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'Only alphabets', 'id' => 'member1Name', 'label' => 'Member 1 Name', 'div' => '<div class="input-field col s6"> <i class="material-icons md-light prefix">person</i>'));

		$form->addItem('email', 'member1Email', array('onkeyup' => 'validateEmail(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'A valid e-mail id', 'id' => 'member1Email', 'label' => 'Member 1 Email', 'div' => '<div class="input-field col s6"> <i class="material-icons md-light prefix">email</i>'));

		$form->addItem('text', 'member2Name', array('onkeyup' => 'validateText(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'Only alphabets', 'id' => 'member2Name', 'label' => 'Member 2 Name', 'div' => '<div class="input-field col s6"> <i class="material-icons md-light prefix">person</i>'));

		$form->addItem('email', 'member2Email', array('onkeyup' => 'validateEmail(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'A valid e-mail id', 'id' => 'member2Email', 'label' => 'Member 2 Email', 'div' => '<div class="input-field col s6"> <i class="material-icons md-light prefix">email</i>'));

		$form->addItem('text', 'member3Name', array('onkeyup' => 'validateText(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'Only alphabets', 'id' => 'member3Name', 'label' => 'Member 3 Name', 'div' => '<div class="input-field col s6"> <i class="material-icons md-light prefix">person</i>'));

		$form->addItem('email', 'member3Email', array('onkeyup' => 'validateEmail(this)', 'class' => 'tooltipped', 'data-position' => 'top', 'data-delay' => '50', 'data-tooltip' => 'A valid e-mail id', 'id' => 'member3Email', 'label' => 'Member 3 Email', 'div' => '<div class="input-field col s6"> <i class="material-icons md-light prefix">email</i>'));

		$event = new Event;
		$events = $event->getEvents();

		$x = 0;
		$y = 0;
		foreach ($events as $event) {

			if ($event["eventType"] == "Technical") {
				$technical[$x++] = $event["eventName"];
			} else {
				$nontechnical[$y++] = $event["eventName"];
			}
		}

		$form->addItem('text', 'trialText', array('placeholder' => 'Non-Technical'));
		foreach ($nontechnical as $nontech) {
			$form->addItem('checkbox', 'event', array('id' => $nontech, 'label' => $nontech));
		}

		$form->addItem('text', 'trialText', array('placeholder' => 'Technical'));
		foreach ($technical as $tech) {
			$form->addItem('checkbox', 'event', array('id' => $tech, 'label' => $tech));
		}

		/*
			foreach ($events as $event) {
				$form->addItem('checkbox', 'event', array('id' => $event["eventName"], 'label' => $event["eventName"]));
			}
		*/
		$form->addItem('submit', 'Register', array('value' => 'Register', 'class' => "btn waves-effect waves-light col s3 offset-s5"));
		$form->endForm(array('fieldset' => 'true'));
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