<?php require_once(ROOT.'/Templates/header.php'); ?>
  <div class="login-form">
    <h2 class="teal-color">Login to Stocker</h2>
    <p class="error"></p>
    <input class="email" type="email" name="email" placeholder="email"/>
    <input class="password" type="password" name="password" placeholder="password"/>
    <div class="login-buttons">
      <p>
        <button onclick="register()" class="button">
          Login
        </button>
      </p>
      <p class="cursor-pointer">
        Do not have an account ?
        <a class="teal-color" href="http://localhost:8700/register">
          Register here
        <a>
      </p>
  </div>
  </div>
  <script>
    function register() {
      document.querySelector('.error').innerHTML = null;
      const email = document.querySelector('.email').value.trim();
      const password = document.querySelector('.password').value.trim();
      if (email && password) {
        const http = new XMLHttpRequest();
        http.open(
          "POST", "http://localhost:8700/api/login",
          true
        );
        http.setRequestHeader("Content-type", "application/json; charset=utf-8");
        http.onload = function() {
          const response = http.response ? JSON.parse(http.response) : null;
          if (response) {
            if (response.result === 'success') {
              sessionStorage.setItem(
                "auth",
                JSON.stringfiy({
                  employee: response.employee,
                  token: response.token
                })
              );
              location.href = 'http://localhost:8700/employees';
            } else {
              document.querySelector('.error').innerHTML = response.message;
            }
          }
        }
        let data = JSON.stringify(
          {
            "email": email,
            "password": password
          }
        );
        http.send(data);
      } else {
        document.querySelector('.error').innerHTML = 'Please add your credentials';
      }
    }
  </script>
<?php require_once(ROOT.'/Templates/footer.php'); ?>
