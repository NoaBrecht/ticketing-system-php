<?php
include_once 'components/session.php';
include_once 'includes/dbh.inc.php';
?>

<head>
  <?php include 'components/head-tags.php'; ?>
  <title>Instellingen</title>
  <script>
    function init() {
      // Zet in de sidebar de huidige pagina actief.
      document.getElementById('instellingen').classList.add("active");
    }
  </script>
</head>

<body onload="init()">
  <?php include 'components/header.php'; ?>
  <main>

    <div class="container py-3">
      <h1>Instellingen</h1>
      <form action="includes/resetpwd.php" method="post">
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Huidig wachtwoord</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="Huidpwd">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Nieuw wachtwoord</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="pwd">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Herhaal nieuw wachtwoord</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="pwdrepeat">
        </div>
        <div class="col-12">
          <button type="submit" name="submit" class="btn btn-danger">Wachtwoord reseten</button>
        </div>
      </form>



  </main>
  <?php include 'components/end-tags.php'; ?>
</body>

</html>