<?php

include ((dirname(__FILE__) ).'/../base.php');

use app\Models\Employee;

use app\Controllers\EmployeeController;

$employee = new EmployeeController();

$employee->delete($_GET['id'])->returnResponse();

header("Location: http://localhost/juanico?deleted=success"); 

?>