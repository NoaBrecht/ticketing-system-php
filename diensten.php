<?php
include_once 'components/session.php';
include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="nl">

<head>
  <?php include 'components/head-tags.php'; ?>
  <title>Diensten</title>
  <script>
    function init() {
      // Zet in de sidebar de huidige pagina actief.
      document.getElementById('diensten').classList.add("active");
    }
  </script>
</head>

<body onload="init()">
  <?php include 'components/header.php'; ?>
  <main>
    <div class="container py-3">
      <h1>Diensten</h1>
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
          <thead class="table-dark">
            <tr>
              <th scope="col">Dienst ID</th>
              <th scope="col">Dienst</th>
              <th scope="col">Aanpassen</th>

            </tr>
          </thead>
          <tbody>

            <?php

            $sql = "SELECT * FROM diensten;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
            ?> <tr>
                  <th scope="row"> <?php echo $row['dienstID'] ?> </th>
                  <td><?php echo $row['dienst'] ?></td>
                  <td><a class="btn btn-secondary" href="dienst.php?id=<?php echo $row['dienstID'] ?>">Aanpassen</a></td>
                <?php
              }
            } else {
                ?>
                <div class="alert alert-info" role="alert">
                  Er zijn geen diensten gevonden.
                </div>
              <?php
            }
              ?>

          </tbody>
        </table>
        <a href="dienst-toevoegen.php" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true"><i class="bi bi-plus-circle"> Voeg een nieuwe dienst toe</i></a>

      </div>
    </div>
  </main>


  <?php include 'components/end-tags.php'; ?>
</body>

</html>