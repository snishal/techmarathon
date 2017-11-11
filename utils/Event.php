<?php

require_once "DB.php";

class Event {

	private $server = "techmarathon.co.in";
	private $user = "webmaster";
	private $pass = "iPTnnG1EolksQRrA";
	private $dbName = "techmarathon";

	public function eventExists($eventName) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "SELECT * from events where eventName = '$eventName'";
		$result = $db->query($sql);
		$db->close();

		if ($result->num_rows == 1) {
			return $result->num_rows;
		} else {
			return false;
		}

	}

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

	public function getEventTagline($eventName) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "SELECT eventTagline from events where eventName = '$eventName'";
		$result = $db->query($sql);
		$db->close();

		$row = $result->fetch_assoc();

		return $row['eventTagline'];

	}

	public function getEventDescription($eventName) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "SELECT eventDescription from events where eventName = '$eventName'";
		$result = $db->query($sql);
		$db->close();

		$row = $result->fetch_assoc();

		return $row['eventDescription'];

	}

	public function getEventImage($eventName) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "SELECT eventImage from events where eventName = '$eventName'";
		$result = $db->query($sql);
		$db->close();

		$row = $result->fetch_assoc();

		return $row['eventImage'];

	}

	public function getEventType($eventName) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "SELECT eventType from events where eventName = '$eventName'";
		$result = $db->query($sql);
		$db->close();

		$row = $result->fetch_assoc();

		return $row['eventType'];

	}

	public function addEvent($eventName, $eventTagline, $eventDescription, $eventImage, $eventType) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "INSERT into events values('$eventName', '$eventTagline', '$eventDescription', '$eventImage', '$eventType')";
		$result = $db->query($sql);
		$db->close();

		if ($result) {
			return true;
		}

	}

	public function deleteEvent($eventName) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "DELETE from events where eventName = '$eventName'";
		$result = $db->query($sql);
		$db->close();

		if ($result) {
			return true;
		}

	}

	public function updateEvent($oldEventName, $eventName, $eventTagline, $eventDescription, $eventImage, $eventType) {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$sql = "update events set eventName = '$eventName', eventTagline = '$eventTagline', eventDescription = '$eventDescription', eventImage = '$eventImage', eventType='$eventType' where eventName = '$oldEventName'";
		$result = $db->query($sql);
		$db->close();

		if ($result) {
			return true;
		}

	}

}

?>
