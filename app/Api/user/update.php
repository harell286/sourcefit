<?php

include ((dirname(__FILE__) ).'/../base.php');

use app\Models\Employee;

use app\Controllers\EmployeeController;

$employee = new EmployeeController();

return $employee->update($_GET['id'], $_POST)->apiResponse();

?>