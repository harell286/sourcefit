<?php

namespace app\Controllers;

use app\Base\BaseController;
use app\Models\Employee;

class EmployeeController extends BaseController {

	private $employee;
	public $method;

	public function __construct() {
		$this->employee = new Employee;
	}

	public function save($request) {
		$errors = $this->validate($this->employee->getRules(), $request);

		if (count($errors)) {
			$this->response['message'] = 'Failed to save. Please check fields';
			$this->response['status'] = 0;
			$this->response['results'] = $errors;
		} else {
			$id = $this->employee->add($request);
			if (!$id) {
				$this->response['message'] = 'Unable to save. Please contact your administrator';
				$this->response['status'] = 0;
				$this->response['results'] = [];
			} else {
				$this->response['message'] = 'Employee record successfully saved.';
				$this->response['results'] = ['id' => $id];
				$this->response['status'] = 1;
			}
		}

		return $this;
	}

	public function get() {
		$records = $this->employee->get();
		$this->response['message'] = 'Employee records.';
		$this->response['results'] = $records;
		$this->response['status'] = 1;

		return $this;
	}

	public function view($id) {
		$records = $this->employee->view($id);
		$this->response['message'] = 'Employee records.';
		$this->response['results'] = $records;
		$this->response['status'] = 1;

		return $this;
	}

	public function update($id, $request) {
		$errors = $this->validate($this->employee->getRules(), $request);

		if (count($errors)) {
			$this->response['message'] = 'Failed to save. Please check fields';
			$this->response['status'] = 0;
			$this->response['results'] = $errors;
		} else {
			$id = $this->employee->update($id, $request);
			if (!$id) {
				$this->response['message'] = 'Unable to save. Please contact your administrator';
				$this->response['status'] = 0;
				$this->response['results'] = [];
			} else {
				$this->response['message'] = 'Employee record successfully saved.';
				$this->response['results'] = ['id' => $id];
				$this->response['status'] = 1;
			}
		}

		return $this;
	}

	public function delete($id) {
		
		$id = $this->employee->delete($id);
		if (!$id) {
			$this->response['message'] = 'Unable to delete. Please contact your administrator';
			$this->response['status'] = 0;
			$this->response['results'] = [];
		} else {
			$this->response['message'] = 'Employee record successfully deleted.';
			$this->response['results'] = ['id' => $id];
			$this->response['status'] = 1;
		}
	

		return $this;
	}

	public function returnResponse() {
		return $this->response;
	}
		
}

?>