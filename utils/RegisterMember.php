<?php

/**
 * Register Member for Event
 */
require_once "DB.php";
require_once "Event.php";

class RegisterMember {

	private $server = "techmarathon.co.in";
	private $user = "webmaster";
	private $pass = "iPTnnG1EolksQRrA";
	private $dbName = "techmarathon";

	public function register($eventName, $leaderName, $college, $leaderMobile, $leaderEmail, $member1Name = '', $member1Number = '', $member2Name = '', $member2Number = '', $member3Name = '', $member3Number = '') {

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$eventName = str_replace(" ", "", $eventName);
		$eventName = str_replace("-", "", $eventName);
		$sql = "Insert into $eventName(leaderName, leaderEmail, leaderNumber, college, member1Name, member1Number, member2Name, member2Number, member3Name, member3Number) values('$leaderName', '$leaderEmail', '$leaderMobile', '$college', '$member1Name', '$member1Number', '$member2Name', '$member2Number', '$member3Name', '$member3Number')";
		$result = $db->query($sql);
		$db->close();

		if ($result) {
			return true;
		}

	}

	public function getRegistrations() {

		$registrations = array();

		$db = new DB;
		$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
		$event = new Event;
		$result = $event->getEvents();
		foreach ($result as $key => $event) {
			$eventName = $event['eventName'];
			$eventName = str_replace(" ", "", $eventName);
			$eventName = str_replace("-", "", $eventName);

			$db = new DB;
			$db->mk_conn($this->server, $this->user, $this->pass, $this->dbName);
			$sql = "SELECT * from $eventName";
			$registration = $db->query($sql);
			$db->close();

			$registrations[$eventName] = array();

			$row = $registration->fetch_assoc();
			while ($row) {
				array_push($registrations[$eventName], $row);
				$row = $registration->fetch_assoc();
			}

		}

		return $registrations;

	}

}

?>