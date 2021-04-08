<?php

namespace models;

use Exception;
use services\EmployeeManager;

class JsonData
{
  private const FILE_NAME = 'data.json';

  public static function load()
  {
    $arrData = [];
    if (file_exists(self::FILE_NAME)) {
      $jsonData = file_get_contents(self::FILE_NAME);
      $arrTemp = json_decode($jsonData, true);
      if (!empty($arrTemp)) {
        foreach ($arrTemp as $value) {
          $arrData[] = new Employee($value['firstName'], $value['lastName'], $value['age'], $value['address'], $value['job']);
        }
      }
    } else {
      file_put_contents(self::FILE_NAME, '');
    }
    return $arrData;
  }

  public static function save()
  {
    try {
      $jsondata = json_encode(self::jsonSerialize());
      file_put_contents(self::FILE_NAME, $jsondata);
      // echo "Đăng ký thành công";
    } catch (Exception $exception) {
      echo "Lỗi: " . $exception->getMessage() . "<br>";
    }
  }

  public static function jsonSerialize()
  {
    $arr = [];
    foreach (EmployeeManager::$employeeList as $employee) {
      $arr[] = [
        "firstName" => $employee->getFirstName(),
        "lastName" => $employee->getLastName(),
        "age" => $employee->getAge(),
        "address" => $employee->getAddress(),
        "job" => $employee->getJob(),
      ];
    }
    var_dump($arr);
    return $arr;
  }
}
