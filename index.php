<?php
include_once 'includes/dbh.inc.php';
include_once 'components/session.php';
?>

<!DOCTYPE html>
<html lang="nl">

<head>
  <?php include 'components/head-tags.php'; ?>
  <title>home</title>
  <script>
    function init() {
      // Zet in de sidebar de huidige pagina actief.
      document.getElementById('index').classList.add("active");
    }
  </script>
</head>

<body onload="init()">
  <?php include 'components/header.php'; ?>
  <main>
    <div class="container py-3">
      <h1>Home</h1>
      <div class="container-fluid  py-3">
        <div class="row">
          <div class="col col-sm-12 col-md-4">
            <div class="card">
              <a href="tickets.php"><img src="images/tickets.png" class="card-img-top img-fluid" alt="..."></a>
              <div class="card-body">
                <?php
                $sql = "SELECT `tickets`.*, `prioriteiten`.*, `diensten`.`dienst`, `users`.*
                FROM `tickets` 
                  LEFT JOIN `prioriteiten` ON `tickets`.`ticket_prioriteit` = `prioriteiten`.`prioriteitId` 
                  LEFT JOIN `diensten` ON `tickets`.`ticket_dienst` = `diensten`.`dienstID` 
                          LEFT JOIN `users` ON `tickets`.`ticket_user` = `users`.`usersId` 
                              ORDER BY ticket_id ASC;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                while ($row = mysqli_fetch_assoc($result)) {
                  $tickets++;
                }
                ?>
                <h5 class="card-title">Tickets</h5>
                <p class="card-text"><?php echo "Er zijn " . $tickets . " tickets gevonden." ?></p>

              </div>
            </div>
          </div>
          <div class="col col-sm-12 col-md-4">
            <div class="card">
              <a href="diensten.php"><img src="images/diensten.png" class="card-img-top img-fluid" alt="..."></a>
              <div class="card-body">
                <h5 class="card-title">Diensten</h5>
                <?php
                $sql = "SELECT * FROM diensten;";

                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                while ($row = mysqli_fetch_assoc($result)) {
                  $diensten++;
                }
                ?>
                <p class="card-text"><?php echo "Er zijn " . $diensten . " diensten gevonden." ?></p>

              </div>
            </div>
          </div>
          <div class="col col-sm-12 col-md-4">
            <div class="card">
              <a href="instellingen.php"> <img src="images/Settings-icon.png" class="card-img-top img-fluid" alt="..."></a>
              <div class="card-body">
                <h5 class="card-title">Instellingen</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
  </main>


  <?php include 'components/end-tags.php'; ?>
</body>

</html>