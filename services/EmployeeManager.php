<?php

namespace services;

use models\Employee;
use models\JsonData;

class EmployeeManager
{
  public static $employeeList;

  public function __construct()
  {
    self::$employeeList = JsonData::load();
  }

  public function display()
  {
    return self::$employeeList;
  }

  public function add(Employee $employee)
  {
    self::$employeeList[] = $employee;
    JsonData::save();
  }

  public function remove($index)
  {
    array_splice(self::$employeeList, $index, 1);
    JsonData::save();
  }

  public function update($index, Employee $employee)
  {
    self::$employeeList[$index] = $employee;
    JsonData::save();
  }
}
