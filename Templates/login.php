<?php require_once(ROOT.'/Templates/header.php'); ?>
  <div class="login-form">
    <h2 class="teal-color">Login to Stocker</h2>
    <input id="email" type="email" name="email" placeholder="email"/>
    <input id="password" type="password" name="password" placeholder="password"/>
    <div class="login-buttons">
      <p><button class="button">Login</button></p>
      <p class="cursor-pointer">
        Do not have an account ?
        <a class="teal-color" href="http://localhost:8700/register">
          Register here
        <a>
      </p>
  </div>
  </div>
<?php require_once(ROOT.'/Templates/footer.php'); ?>
