<?php require_once(ROOT.'/Templates/header.php'); ?>
<div class="employees">
  <h2>Employees</h2>
  <div class="table-container"><table id="employee-table"></table></div>
</div>
<script>
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
          let myHTML = '<tr id="row">' +
          '<th>Name</th>' +
          '<th>Email</th>' +
          '</tr>';
          for (let employee of response.employees) {
            myHTML += '<tr>' +
            '<td>' + employee.name + ' ' + employee.surname + '</td>' +
            '<td>' + employee.email + '</td>' +
            '</tr>';
          }
          document.getElementById("employee-table").innerHTML = myHTML;
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
