<?php

namespace app\Config;

use PDO;

class Connection {

	private $username;
	private $password;
	private $host;
	private $database;

	public function __construct() {
		$this->username = 'root';
		$this->password = 'root123';
		$this->host = 'localhost';
		$this->database = 'exam_juanico';
	}

	public function connect() {
		try {
			$myPDO = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username);
			return $myPDO;
		} catch (Exception $ex) {
			return $ex->message;
		}

	}

}

?>