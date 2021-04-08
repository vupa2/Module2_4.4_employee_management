<?php

require_once __DIR__ . '/services/EmployeeManager.php';
require_once __DIR__ . '/models/Employee.php';

use services\EmployeeManager;
use models\Employee;

$employeeManager = new EmployeeManager();

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
  if (isset($_POST['add'])) {
    $employeeManager->add(new Employee($_POST['first-name'], $_POST['last-name'], $_POST['age'], $_POST['address'], $_POST['job']));
    header('Location: /');
    exit;
  }

  if (isset($_POST['delete'])) {
    $employeeManager->remove($_POST['id']);
    header('Location: /');
    exit;
  }

  if (isset($_POST['update'])) {
    $employeeManager->update($_POST['id'], new Employee($_POST['first-name'], $_POST['last-name'], $_POST['age'], $_POST['address'], $_POST['job']));
    header('Location: /');
    exit;
  }
}

if ($_SERVER["REQUEST_METHOD"] === 'GET') {
  if (isset($_GET['update-submit'])) {
    $person = [
      "id" => $_GET['id'],
      "firstName" => EmployeeManager::$employeeList[$_GET['id']]->getFirstName(),
      "lastName" => EmployeeManager::$employeeList[$_GET['id']]->getLastName(),
      "age" => EmployeeManager::$employeeList[$_GET['id']]->getAge(),
      "address" => EmployeeManager::$employeeList[$_GET['id']]->getAddress(),
      "job" => EmployeeManager::$employeeList[$_GET['id']]->getJob(),
    ];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>[Bài tập] Quản lí nhân sự</title>
  <style>
    form {
      max-width: 305px;
    }

    form#change div {
      margin: 10px 0;
    }

    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    td {
      text-align: center;
      min-height: 50px;
      min-width: 70px;
    }
  </style>
</head>

<body>
  <h2>[Bài tập] Quản lí nhân sự</h2>

  <form action="" method="post" id="change">
    <fieldset>
      <legend>Thêm nhân sự</legend>
      <div>
        <input type="text" name="first-name" value="<?= $person['firstName'] ?? '' ?>" required>
        <label for="first-name">Tên</label>
      </div>
      <div>
        <input type="text" name="last-name" value="<?= $person['lastName'] ?? '' ?>" required>
        <label for="last-name">Họ</label>
      </div>
      <div>
        <input type="number" name="age" value="<?= $person['age'] ?? '' ?>" required>
        <label for="age">Tuổi</label>
      </div>
      <div>
        <input type="text" name="address" value="<?= $person['address'] ?? '' ?>" required>
        <label for="address">Địa chỉ</label>
      </div>
      <div>
        <input type="text" name="job" value="<?= $person['job'] ?? '' ?>" required>
        <label for="job">Công việc</label>
      </div>
      <div>
        <input type="hidden" name="id" value="<?= $person['id'] ?? '' ?>" />
        <button class="submit" name="add" value="add">Thêm</button>
        <button class="submit" name="update" value="update">Sửa</button>
      </div>
    </fieldset>
  </form>

  <br>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Họ</th>
        <th>Tuổi</th>
        <th>Địa chỉ</th>
        <th>Nghề nghiệp</th>
        <th>Thay đổi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty(EmployeeManager::$employeeList)) : ?>
        <?php foreach (EmployeeManager::$employeeList as $key => $employee) : ?>
          <tr>
            <td><?= $key + 1 ?></td>
            <td><?= $employee->getFirstName() ?></td>
            <td><?= $employee->getLastName() ?></td>
            <td><?= $employee->getAge() ?></td>
            <td><?= $employee->getAddress() ?></td>
            <td><?= $employee->getJob() ?></td>
            <td>
              <form action="" method="get">
                <input type="hidden" name="id" value="<?= $key ?>" />
                <button type="submit" name="update-submit" value="">Sửa</button>
              </form>
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $key ?>" />
                <button type="submit" name="delete" value="">Xóa</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <script>
    if (document.querySelector('input[name=id]').value) {
      document.querySelector('button[name=add]').hidden = true;
      document.querySelector('button[name=update]').hidden = false;
    } else {
      document.querySelector('button[name=add]').hidden = false;
      document.querySelector('button[name=update]').hidden = true;
    }
  </script>
</body>

</html>