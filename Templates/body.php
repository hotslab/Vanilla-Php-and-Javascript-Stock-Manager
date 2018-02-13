<?php
namespace Template;

require_once(ROOT.'/Classes/Employee.php');
require_once(ROOT.'/Config/Database.php');
require_once(ROOT.'/Classes/Authentication.php');
use Employee\Employee as Employee;
use Authentication\Authentication as Authentication;
use Config\Database as Database;

$creds = new \stdClass;
$creds->email = "new@email.com";
$creds->password = "secret";
$result = Authentication::login($creds);
echo $result["result"].", ".$result['message']."<br><br>";
var_dump($result["employee"]);
echo "<br><br>";
var_dump($result["token"]);
$employee = new Employee("jake", "smith", "new@email.com", 1, "secret");
// $newResult = Employee::save($employee);
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
  </div>
</body>
