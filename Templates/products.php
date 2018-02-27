<?php require_once(ROOT.'/Templates/header.php'); ?>
<div class="products">
  <h2 class="two-column">
    Products
    <button class="button product-open" onclick="openAddProduct()">
      Add Product
    </button>
    <button class="close-button product-close" onclick="cancelAddProduct()">
      Cancel
    </button>
  </h2>
  <p class="error"></p>
  <div class="table-container"><table class="product-table"></table></div>
  <div class="product-addition">
    <h3>Add a new product below:</h3>
    <input type="text" class="name" name="name" placeholder="Name">
    <input type="text" class="description" name="description" placeholder="Description">
    <input type="text" class="SKU" name="SKU" placeholder="SKU">
    <input type="text" class="manufacture-code" name="manufacture-code" placeholder="Manufacture Code">
    <input type="text" class="price" name="price" placeholder="Price">
    <input type="number" class="quantity" name="quantity" placeholder="Quantity">
    <br><br>
    <button class="button" onclick="createProduct()">
      Submit
    </button>
  </div>
</div>
<script>
  function openAddProduct() {
    document.querySelector(".error").innerHTML = null;
    document.querySelector(".product-table").style.display = 'none';
    document.querySelector(".product-addition").style.display = 'block';
    document.querySelector(".product-open").style.display = 'none';
    document.querySelector(".product-close").style.display = 'block';
  }
  function cancelAddProduct() {
    document.querySelector(".error").innerHTML = null;
    document.querySelector(".product-table").style.display = 'block';
    document.querySelector(".product-addition").style.display = 'none';
    document.querySelector(".product-open").style.display = 'block';
    document.querySelector(".product-close").style.display = 'none';
  }
  function createProduct() {
    document.querySelector(".error").innerHTML = null;
    const name = document.querySelector('.name').value.trim();
    const description = document.querySelector('.description').value.trim();
    const SKU = document.querySelector('.SKU').value.trim();
    const manufactureCode = document.querySelector('.manufacture-code').value.trim();
    const price = document.querySelector('.price').value.trim();
    const quantity = document.querySelector('.quantity').value.trim();
    if (name && description && SKU && manufactureCode && price && quantity) {
      const http = new XMLHttpRequest();
      http.open(
        "POST", "http://localhost:8700/api/products/create",
        true
      );
      http.setRequestHeader("Content-type", "application/json; charset=utf-8");
      http.onload = function() {
        const response = http.response ? JSON.parse(http.response) : null;
        if (response) {
          if (response.result === 'success') {
            document.querySelector(".product-addition").style.display = 'none';
            document.querySelector(".product-table").style.display = 'block';
            document.querySelector(".product-open").style.display = 'block';
            document.querySelector(".product-close").style.display = 'none';
            document.querySelector('.name').value = null;
            document.querySelector('.description').value = null;
            document.querySelector('.SKU').value = null;
            document.querySelector('.manufacture-code').value = null;
            document.querySelector('.price').value = null;
            document.querySelector('.quantity').value = null;
            openProducts()
          } else {
            document.querySelector('.error').innerHTML = response.message;
          }
        }
      }
      let data = JSON.stringify({
          "description": description,
          "manufacture_code": manufactureCode,
          "name": name,
          "price": price,
          "quantity":quantity,
          "SKU":SKU
      });
      http.send(data);
    } else {
      document.querySelector('.error').innerHTML = 'Please add your credentials';
    }
  }
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
          let myHTML = '<tr>'+
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
          document.querySelector(".product-table").innerHTML = myHTML;
        } else {
          document.querySelector(".error").innerHTML = response.message;
        }
      }
    }
    http.send();
  }
  document.addEventListener(
    'DOMContentLoaded',
    () => {
      document.querySelector(".product-table").style.display = 'block';
      document.querySelector(".product-addition").style.display = 'none';
      document.querySelector(".product-open").style.display = 'block';
      document.querySelector(".product-close").style.display = 'none';
      openProducts()
    },
    false);
</script>
<?php require_once(ROOT.'/Templates/footer.php'); ?>
