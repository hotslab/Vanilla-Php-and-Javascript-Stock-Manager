<?php
namespace Template;

require_once(ROOT.'/Config/Database.php');
require_once(ROOT.'/Controller/EmployeeController.php');
require_once(ROOT.'/Controller/AuthenticationController.php');
require_once(ROOT.'/Model/Employee.php');

use Config\Database as Database;
use Model\Employee as Employee;
use Controller\EmployeeController as EmployeeController;
use Controller\AuthenticationController as Auth;

$creds = new \stdClass;
$creds->email = "new@email.com";
$creds->password = "secret";
$result = Auth::login($creds);
// echo $result["result"].", ".$result['message']."<br><br>";
// var_dump($result["employee"]);
// echo "<br><br>";
// var_dump($result["token"]);
$employee = new Employee("jake", "smith", "new@email.com", 1, "secret");
// $newResult = EmployeeController::save($employee);
// echo $newResult["result"].", ".$newResult['message']." <br><br>";
?>
<body>
  <div class="heading">
    <h2>
      Hello there. I am
      <?php echo $employee->name.' '.$employee->surname; ?>
    </h2>
    <p>
      You can contact me on
      <?php echo $employee->email; ?>
    </p>
    <button type="button" onclick="loadDoc()">Change Content</button>
    <table id="demo"></table>
  </div>
</body>
<script>
  function loadDoc() {
      if (!document.getElementById("row")) {
        var table='<tr id="row"><th>Artist</th><th>Title</th></tr>';
        document.getElementById("demo").innerHTML = table;
      } else {
        document.getElementById("demo").innerHTML = null;
      }
  }
</script>
