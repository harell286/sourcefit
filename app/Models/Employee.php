<?php

namespace app\Models;

use Api\Base;
use app\Base\BaseModel;
use PDO;

class Employee extends BaseModel {

	protected $table = 'employees';

	private $rules = [
		'name' => 'required',
		'contact' => 'required|integer',
		'address' => 'required',
		'email' => 'required',
		'birthday' => 'required'
	];

	protected $fillables = [
		'name',
		'contact',
		'address',
		'email',
		'birthday',
	];

	public function __construct() {
		parent::__construct();

	}

	public function getRules() {
		return $this->rules;
	}

	public function get() {
		$sql = "SELECT *, DATE_FORMAT(birthday, '%b %e, %Y') as birthday FROM ".$this->table. ' WHERE status = 1';
        $stmt = $this->connection->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
	}

	public function view($id) {
		$sql = "SELECT * FROM ".$this->table. ' WHERE id = :id';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        $stmt->execute();

        $rec = $stmt->fetchAll();
        return $rec[0];
	}

	public function add($request) {

		$sql = "INSERT INTO ".$this->table." (name, contact, address, email, birthday) VALUES (:name, :contact, :address, :email, :birthday)";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':name', $request['name'], PDO::PARAM_STR);
		$stmt->bindParam(':contact', $request['contact'], PDO::PARAM_STR);
		$stmt->bindParam(':address', $request['address'], PDO::PARAM_STR);
		$stmt->bindParam(':email', $request['email'], PDO::PARAM_STR);
		$stmt->bindParam(':birthday', $request['birthday'], PDO::PARAM_STR);

        $k = $stmt->execute();

        return $k;
	}

	public function update($id, $request) {
		$sql = "UPDATE ".$this->table." set name = :name, contact = :contact, address = :address, email = :email, birthday = :birthday where id = :id";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':name', $request['name'], PDO::PARAM_STR);
		$stmt->bindParam(':contact', $request['contact'], PDO::PARAM_STR);
		$stmt->bindParam(':address', $request['address'], PDO::PARAM_STR);
		$stmt->bindParam(':email', $request['email'], PDO::PARAM_STR);
		$stmt->bindParam(':birthday', $request['birthday'], PDO::PARAM_STR);
		$stmt->bindParam(':id', $id, PDO::PARAM_STR);

        return $k = $stmt->execute();
	}

	public function delete($id) {
		$sql = "UPDATE ".$this->table." set status = 0  where id = :id";
        $stmt = $this->connection->prepare($sql);

		$stmt->bindParam(':id', $id, PDO::PARAM_STR);

        return $k = $stmt->execute();
	}

}

?>