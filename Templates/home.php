<?php require_once(ROOT.'/Templates/header.php'); ?>
<div class="content">
  <h2>
   WELCOME TO SIMPLE STOCK MANAGER
  </h2>
  <p><bold>This application is written in simple vanilla php and javascript.</bold></p>
  <p>It aims to create a functional stock manger running on the native languages without any dependencies coming form package managers like npm or composer.</p>
  <button type="button" onclick="loadDoc()">Change Content</button>
  <table id="demo"></table>
</div>
<script type="text/javascript">
  function loadDoc() {
      if (!document.getElementById("row")) {
        var table='<tr id="row"><th>Artist</th><th>Title</th></tr>';
        document.getElementById("demo").innerHTML = table;
      } else {
        document.getElementById("demo").innerHTML = null;
      }
  }
</script>
<?php require_once(ROOT.'/Templates/footer.php'); ?>
