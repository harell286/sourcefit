<?php

namespace app\Base;

class BaseController {

	protected $response = [];

	public function __construct() {
		$this->response['message'] = 'Success';
		$this->response['status'] = 1;
	}

	protected function validate($rules, $post) {

		$errorArray = [];

		foreach ($rules as $field => $rules) {
			if (!empty($post)) {
				foreach ($post as $inputFieldsName => $inputFields) {
					if ($field == $inputFieldsName) {
						$rulesArray = explode('|', $rules);
						
						foreach ($rulesArray as $rule) {
							if ($rule == 'integer') {
								if (!preg_match('/^\d+$/', $inputFields)) {
									$errorArray[] = ['field' => $inputFieldsName , 'message' => $inputFieldsName . ' should be numeric.'];
								}
							} else if ($rule == 'required') {
								if (empty($inputFields)) {
									$errorArray[] = ['field' => $inputFieldsName , 'message' => $inputFieldsName . ' is required.'];
								}
							}
						}
						
					}
				}	
			} else {
				$errorArray[] = ['field' => '' , 'message' => 'No input field'];	
				$this->response['message'] = 'You have no input fields.';
			}
			
		}

		return $errorArray;
	}

	public function apiResponse() {
		if ($this->response['status'] == 0) {
			header('HTTP/1.1 500 ' . $this->response['message']);
			echo json_encode($this->response);
		} else {
			echo json_encode($this->response);
		}
	}

}

?>