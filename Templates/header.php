<!DOCTYPE>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocker</title>
    <!--<link rel="stylesheet" type="text/css" href="./Assets/css/style.css">-->
    <style>
      body {
        margin: 0;
        background: #FFF5EE;
        color: black;
        font-family: arial, sans-serif;
      }
      a {
        text-decoration: none;
        color: white;
      }
      .cursor-pointer {
        cursor: pointer;
      }
      .navbar {
        padding: 15px;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-around;
        align-items: center;
        background: #008080;
      }
      .menu-item {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
      }
      .content {
        padding: 15px;
      }
      footer {
        padding: 15px;
        color: white;
        font-weight: bold;
        background: #004d4d;
        height: 100vh;
      }
    </style>
  </head>
  <body>
    <div class="navbar">
      <div  class="menu-item cursor-pointer">
        <a href="http://localhost:8700/">Home</a>
      </div>
      <div class="menu-item cursor-pointer">
        <a href="http://localhost:8700/products">Products</a>
      </div>
      <div class="menu-item cursor-pointer">
        <a href="http://localhost:8700/employees">Employees</a>
      </div>
    </div>
    <div class="content">
