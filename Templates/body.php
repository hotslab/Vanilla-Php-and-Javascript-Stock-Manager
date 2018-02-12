<?php
namespace Template;

define(__ROOT__, dirname(__FILE__), true);
require_once(__ROOT__.'/Classes/Employee.php');

use Employee\Employee as Employee;

$employee = new Employee("jake", "smith", "new@email.com", "admin", "secret");
var_dump($GLOBALS);
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
