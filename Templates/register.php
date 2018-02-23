<?php require_once(ROOT.'/Templates/header.php'); ?>
  <div class="register-form">
    <h2 class="teal-color">Register to Stocker</h2>
    <input id="name" type="text" name="name" placeholder="name"/>
    <input id="surname" type="text" name="surname" placeholder="surname"/>
    <input id="email" type="email" name="email" placeholder="email"/>
    <!--<select id="role" name="role">
      <option value="1">Floor Hand</option>
      <option value="2">Supervisor</option>
      <option value="3">Administrator</option>
      <option value="4">Manager</option>
    </select>-->
    <input id="password" type="password" name="password" placeholder="password"/>
    <div class="register-buttons">
      <p><button class="button">Register</button></p>
      <p class="cursor-pointer">
        Already have an account ?
        <a class="teal-color" href="http://localhost:8700/login">
          Login here
        <a>
      </p>
  </div>
  </div>
<?php require_once(ROOT.'/Templates/footer.php'); ?>
