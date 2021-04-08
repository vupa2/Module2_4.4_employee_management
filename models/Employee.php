<?php

namespace models;

class Employee
{
  private $firstName;
  private $lastName;
  private $age;
  private $address;
  private $job;

  public function __construct($firstName, $lastName, $age, $address, $job)
  {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->age = $age;
    $this->address = $address;
    $this->job = $job;
  }

  public function getFirstName()
  {
    return $this->firstName;
  }

  public function setFirstName($firstName)
  {
    $this->firstName = $firstName;

    return $this;
  }

  public function getLastName()
  {
    return $this->lastName;
  }

  public function setLastName($lastName)
  {
    $this->lastName = $lastName;

    return $this;
  }

  public function getAge()
  {
    return $this->age;
  }

  public function setAge($age)
  {
    $this->age = $age;

    return $this;
  }

  public function getAddress()
  {
    return $this->address;
  }

  public function setAddress($address)
  {
    $this->address = $address;

    return $this;
  }

  public function getJob()
  {
    return $this->job;
  }

  public function setJob($job)
  {
    $this->job = $job;

    return $this;
  }
}
