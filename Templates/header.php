<!DOCTYPE>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocker</title>
    <!--<link rel="stylesheet" type="text/css" href="./Assets/css/style.css">-->
    <style>
      html {
        background: #009999;
      }
      body {
        margin: 0;
        background: #FFF5EE;
        color: black;
        font-family: Arial, Helvetica, sans-serif;
      }
      .navbar {
        padding: 15px;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-around;
        align-items: center;
        background: #009999;
      }
      .menu-item {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
      }
      .content {
        padding: 15px;
        min-height: 500px;
      }
      .not-found {
        font-size: 50px;
        text-align: center;
      }
      .login-form {
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: space-around;
        align-items: center;
      }
      .login-buttons {
        width:100%;
      }
      .register-form {
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: space-around;
        align-items: center;
      }
      .register-buttons {
        width:100%;
      }
      footer {
        padding: 15px;
        color: white;
        font-weight: bold;
        background: #009999;
        height: 100vh;
      }
      .error {
        color: red;
      }
      .table-container {
        width: 100%;
        overflow-x:auto;
      }
      table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }
      td, th {
        border: 1px solid #ddd;
        min-width: 100px;
        padding: 8px;
      }
      tr:nth-child(even){background-color: #f2f2f2;}
      tr:hover {background-color: #ddd;}
      th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #009999;
          color: white;
      }
      .employees {
        width: 100%;
      }
      /*HELPER CLASSES*/
      a {
        text-decoration: none;
        color: white;
      }
      .big-text {
        font-size: 30px;
      }
      .cursor-pointer {
        cursor: pointer;
      }
      .centered {
        text-align: center;
      }
      .teal-color {
        color: #009999;
      }
      .button {
        background: #009999;
        padding: 10px;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 4px;
      }
      .warning-button {
        background: red;
        padding: 10px;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 4px;
      }
      input {
        width: 100%;
        border: solid 1px #d9d9d9;
        padding: 12px 20px;
        border-radius: 4px;
        margin: 8px 0;
        box-sizing: border-box;
      }
      input:focus {
        outline: none;
        border: solid 1px #009999;
      }
      select {
        border: none;
        background: #009999;
        width: 100%;
        padding: 12px 20px;
        color: white;
      }
      option {
        padding: 12px 20px;
        background: #00cccc;
        color: white;
      }
      .two-column {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-between;
        align-items: center;
      }
    </style>
  </head>
  <body>
    <div class="navbar">
      <div  class="home-link menu-item cursor-pointer">
        <a class="big-text" href="http://localhost:8700/">&#9951;</a>
      </div>
      <div class="products-link menu-item cursor-pointer">
        <a href="http://localhost:8700/products">Products</a>
      </div>
      <div class="employees-link menu-item cursor-pointer">
        <a href="http://localhost:8700/employees">Employees</a>
      </div>
      <div class="login-link menu-item cursor-pointer">
        <a href="http://localhost:8700/login">Login</a>
      </div>
      <div class="register-link menu-item cursor-pointer">
        <a href="http://localhost:8700/register">Register</a>
      </div>
      <div class="logout-link menu-item cursor-pointer">
        <a onclick="logout()">Logout</a>
      </div>
    </div>
    <div class="content">
    <script>
      function logout() {
        sessionStorage.clear();
        configureNavBar();
        location.href = 'http://localhost:8700/';
      }
      function configureNavBar() {
        let auth = JSON.parse(sessionStorage.getItem('auth'));
        if (auth) {
          document.querySelector('.employees-link').style.display = 'block';
          document.querySelector('.products-link').style.display = 'block';
          document.querySelector('.logout-link').style.display = 'block';
          document.querySelector('.register-link').style.display = 'none';
          document.querySelector('.login-link').style.display = 'none';
        } else {
          document.querySelector('.employees-link').style.display = 'none';
          document.querySelector('.products-link').style.display = 'none';
          document.querySelector('.logout-link').style.display = 'none';
          document.querySelector('.register-link').style.display = 'block';
          document.querySelector('.login-link').style.display = 'block';
        }
      }
      document.addEventListener(
      'DOMContentLoaded',
      () => {
        configureNavBar()
      },
      false);
    </script>
