<?php

namespace Api;

require_once (dirname(__FILE__) ) .'../../config/Autoloader.php';

use app\Config\Connection;

class Base {
	private $connection;

	public function __construct() {
		$this->connection = new Connection();
	}

	public function getConnection() {
		return $this->connection->connect();
	}
}


?>