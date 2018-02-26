<?php require_once(ROOT.'/Templates/header.php'); ?>
<div class="employees">
  <h2>Products</h2>
  <p class="error"></p>
  <table id="product-table"></table>
</div>
<script>
  function openProducts() {
    const http = new XMLHttpRequest();
    http.open(
      "POST", "http://localhost:8700/api/products",
      true
    );
    http.setRequestHeader("Content-type", "application/json; charset=utf-8");
    http.onload = function() {
      const response = http.response ? JSON.parse(http.response) : null;
      if (response) {
        if (response.result === 'success') {
          let myHTML = '<tr id="row">'+
          '<th>ID</th>' +
          '<th>Name</th>' +
          '<th>Decription</th>' +
          '<th>SKU</th>' +
          '<th>Manufacture Code</th>' +
          '<th>Date Added</th>' +
          '<th>Price</th>' +
          '<th>Quantity</th>' +
          '</tr>';
          for (let product of response.products) {
            myHTML += '<tr>'+
            '<td>' + product.id + '</td>' +
            '<td>' + product.name + '</td>' +
            '<td>' + product.description + '</td>' +
            '<td>' + product.SKU + '</td>' +
            '<td>' + product.manufacture_code + '</td>' +
            '<td>' + product.created_at + '</td>' +
            '<td>' + product.price + '</td>' +
            '<td>' + product.quantity + '</td>' +
            '</tr>';
          }
          document.getElementById("product-table").innerHTML = myHTML;
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
      openProducts()
    },
    false);
</script>
<?php require_once(ROOT.'/Templates/footer.php'); ?>
