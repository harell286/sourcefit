<?php

include ((dirname(__FILE__) ).'/../base.php');

use app\Models\Employee;

use app\Controllers\EmployeeController;

$employee = new EmployeeController();

return $employee->view($_GET['id'])->apiResponse();

?>