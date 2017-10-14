<?php

require_once "DB.php";

class Event {

	private $server = "techmarathon.co.in";
	private $user = "webmaster";
	private $pass = "iPTnnG1EolksQRrA";
	private $dbName = "techmarathon";

	public function getEvents() {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "SELECT * from events";
		$result = $db->query($sql);
		$db->close();

		$events = array();

		$row = $result->fetch_assoc();
		while ($row) {
			array_push($events, $row);
			$row = $result->fetch_assoc();
		}

		return $events;

	}

	public function getEventName($eventId) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "SELECT eventName from events where eventId = '$eventId'";
		$result = $db->query($sql);
		$db->close();

		$row = $result->fetch_assoc();

		return $row['eventName'];

	}

	public function getEventTagline($eventId) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "SELECT eventTagline from events where eventId = '$eventId'";
		$result = $db->query($sql);
		$db->close();

		$row = $result->fetch_assoc();

		return $row['eventTagline'];

	}

	public function getEventDescription($eventId) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "SELECT eventDescription from events where eventId = '$eventId'";
		$result = $db->query($sql);
		$db->close();

		$row = $result->fetch_assoc();

		return $row['eventDescription'];

	}

	public function getEventImage($eventId) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "SELECT eventImage from events where eventId = '$eventId'";
		$result = $db->query($sql);
		$db->close();

		$row = $result->fetch_assoc();

		return $row['eventImage'];

	}

	public function addEvent($eventName, $eventTagline, $eventDescription, $eventImage) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$eventId = substr($eventName, 0, 3);
		$sql = "INSERT into events values('$eventId', '$eventName', '$eventTagline', '$eventDescription', '$eventImage')";
		$result = $db->query($sql);
		$db->close();

		if ($result) {
			return true;
		}

	}

	public function deleteEvent($eventId) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "DELETE from events where eventId = '$eventId'";
		$result = $db->query($sql);
		$db->close();

		if ($result) {
			return true;
		}

	}

	public function updateEvent($eventId, $eventName, $eventTagline, $eventDescription, $eventImage) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$neweventId = substr($eventName, 0, 3);
		$sql = "update events set eventId = '$neweventId', eventName = '$eventName', eventTagline = '$eventTagline', eventDescription = '$eventDescription', eventImage = '$eventImage' where eventId = '$eventId'";
		$result = $db->query($sql);
		$db->close();

		if ($result) {
			return true;
		}

	}


}

?>
