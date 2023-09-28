<?php
include_once 'components/session.php';
include_once 'includes/dbh.inc.php';
?>

<head>
  <?php include 'components/head-tags.php';
  ?>

  <title>Diensten</title>
</head>

<body onload="init()">
  <?php include 'components/header.php'; ?>
  <main>
    <div class="container py-3">
      <h1>Dienst toevoegen</h1>


      <form action="includes/diensten-maken.php" method="POST">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" name="dienst" placeholder="Soort toestel" required>
          <label for="floatingInput">Dienst</label>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Aanmaken</button>
      </form>
    </div>
  </main>


  <?php include 'components/end-tags.php'; ?>
</body>

</html>