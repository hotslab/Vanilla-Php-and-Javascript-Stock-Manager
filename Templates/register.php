<?php require_once(ROOT.'/Templates/header.php'); ?>
  <div class="register-form">
    <h2 class="teal-color">Register into Stocker</h2>
    <p class="error"></p>
    <input class="name" type="text" name="name" placeholder="name"/>
    <input class="surname" type="text" name="surname" placeholder="surname"/>
    <input class="email" type="email" name="email" placeholder="email"/>
    <!--<select class="role" name="role">
      <option value="1">Floor Hand</option>
      <option value="2">Supervisor</option>
      <option value="3">Administrator</option>
      <option value="4">Manager</option>
    </select>-->
    <input class="password" type="password" name="password" placeholder="password"/>
    <div class="register-buttons">
      <p><button class="button" onclick="register()">Register</button></p>
      <p class="cursor-pointer">
        Already have an account ?
        <a class="teal-color" href="http://localhost:8700/login">
          Login here
        <a>
      </p>
    </div>
  </div>
  <script>
    function register() {
      document.querySelector('.error').innerHTML = null;
      const name = document.querySelector('.name').value.trim();
      const surname = document.querySelector('.surname').value.trim();
      const email = document.querySelector('.email').value.trim();
      const password = document.querySelector('.password').value.trim();
      console.log(name, surname, email, password, 'CREDENTIALS')
      if (name && surname && email && password) {
        const http = new XMLHttpRequest();
        http.open(
          "POST", "http://localhost:8700/api/register",
          true
        );
        http.setRequestHeader("Content-type", "application/json; charset=utf-8");
        http.onload = function() {
          const response = http.response ? JSON.parse(http.response) : null;
          if (response) {
            if (response.result === 'success') {
              sessionStorage.setItem(
                "auth",
                JSON.stringify({
                  employee: response.employee,
                  token: response.token
                })
              );
              location.href = 'http://localhost:8700/products';
            } else {
              document.querySelector('.error').innerHTML = response.message;
            }
          }
        }
        let data = JSON.stringify({
            "name": name,
            "surname": surname,
            "email": email,
            "password": password
        });
        http.send(data);
      } else {
        document.querySelector('.error').innerHTML = 'Please add your credentials';
      }
    }
  </script>
<?php require_once(ROOT.'/Templates/footer.php'); ?>
