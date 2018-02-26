<?php require_once(ROOT.'/Templates/header.php'); ?>
<div class="employees">
  <button type="button" onclick="loadDoc()">Change Content</button>
  <h2>Employees</h2>
  <table id="employee-table"></table>
</div>
<script>
  function loadDoc() {
    if (!document.getElementById("row")) {
      const table='<tr id="row"><th>Artist</th><th>Title</th></tr>';
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
            myHTML += '<tr><td>' +
            employee.name + ' ' + employee.surname +
            '</td><td>' + employee.email + '</td></tr>';
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
