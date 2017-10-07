<?php

/*

user: webmaster
pass: iPTnnG1EolksQRrA

 */

class DB {

	private $conn;

	function mk_conn($server, $username, $password, $db) {
		$this->conn = new mysqli($server, $username, $password, $db);

		if ($this->conn->connect_error) {

			error_log("Failed to connect to database!", 0);
		}
	}

	function query($sql) {

		$result = $this->conn->query($sql);
		if ($result) {
			return $result;
		} else {
			error_log($sql . "\t" . $this->conn->error, 0);
		}
	}

	function close() {
		$this->conn->close();
	}

}

?>