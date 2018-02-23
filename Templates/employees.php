<?php require_once(ROOT.'/Templates/header.php'); ?>
<?php
require_once(ROOT.'/Config/Database.php');
require_once(ROOT.'/Controllers/EmployeeController.php');
require_once(ROOT.'/Controllers/AuthenticationController.php');
require_once(ROOT.'/Models/Employee.php');

use Config\Database as Database;
use Model\Employee as Employee;
use Controller\EmployeeController as EmployeeController;
use Controller\AuthenticationController as Auth;

// $employee = new Employee("jake", "smith", "new@email.com", 1, "secret");
// $newResult = EmployeeController::save($employee);
// echo $newResult["result"].", ".$newResult['message']." <br><br>";
?>
<div class="heading">
  <button type="button" onclick="loadDoc()">Change Content</button>
  <table id="demo"></table>
</div>
<script>
  function loadDoc() {
    if (!document.getElementById("row")) {
      var table='<tr id="row"><th>Artist</th><th>Title</th></tr>';
      document.getElementById("demo").innerHTML = table;
    } else {
      document.getElementById("demo").innerHTML = null;
    }
  }
  function openEmployees() {
    const http = new XMLHttpRequest();
    http.open(
      "POST", "http://localhost:8700/api/employees",
      true
    );
    http.setRequestHeader("Content-type", "application/json; charset=utf-8");
    http.onload = function() {
      const response = http.response ? JSON.parse(http.response) : null;
      if (response) {
        if (response.result === 'success') {
          console.log(response.employees)
          let myHTML = '<tr id="row"><th>Name</th><th>Email</th></tr>';
          for (let employee of response.employees) {
            myHTML += '<tr><td></td>'+employee.name + ' ' + employee.surname +'<td>'+ employee.email+'</td></tr>';
          }
          document.getElementById("demo").innerHTML = myHTML;
        } else {
          document.querySelector('.error').innerHTML = response.message;
        }
      }
    }
    http.send();
  }
  document.addEventListener(
    'DOMContentLoaded',
    () => {
      openEmployees()
    },
    false);
</script>
<?php include(ROOT.'/Templates/footer.php'); ?>
