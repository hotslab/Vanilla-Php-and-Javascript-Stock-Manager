<?php
namespace Template;

define(__ROOT__, dirname(__FILE__), true);
require_once(__ROOT__.'/Classes/Employee.php');
require_once(__ROOT__.'/Config/Database.php');

use Employee\Employee as Employee;
use Config\Database as Database;

Database::connectDB();
$employee = new Employee("jake", "smith", "new@email.com", "admin", "secret");
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
