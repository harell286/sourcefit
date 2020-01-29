<?php

namespace app\Base;

use Api\Base;
use PDO;

class BaseModel {

	protected $connection;
	protected $fillables;
	protected $table;

	public function __construct() {
		$base = new Base();	
		$this->connection = $base->getConnection();
		$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

}

?>