<?php
include_once 'components/session.php';
include_once 'includes/dbh.inc.php';
if (!empty($_GET['id'])) {
  $id = $_GET['id'];
}
session_start();

// setcookie("ticketIDupdate", "$id", time() + (86400 * 30), "/");
$_SESSION["lastvieuweddienst"] = $id;
?>

<!DOCTYPE html>
<html lang="nl">

<head>
  <?php include 'components/head-tags.php';
  include 'components/header.php';


  // SELECT `tickets`.*, `users`.`usersFname` FROM `tickets` LEFT JOIN `users` ON `tickets`.`ticket_user` = `users`.`usersId`
  // $sql = "SELECT `tickets`.*, `diensten`.`dienst`, `users`.`usersFname`, `prioriteiten`.`prioriteit`
  // FROM `tickets` 
  //   LEFT JOIN `diensten` ON `tickets`.`ticket_dienst` = `diensten`.`dienstID` 
  //   LEFT JOIN `users` ON `tickets`.`ticket_user` = `users`.`usersId` 
  //   LEFT JOIN `prioriteiten` ON `tickets`.`ticket_prioriteit` = `prioriteiten`.`prioriteitId`; WHERE ticket_id='$id' ;";

  $sql = "SELECT * FROM `diensten`
            WHERE dienstID ='$id';";

  $result = mysqli_query($conn, $sql);
  ?>
  <title>Tickets</title>
</head>

<body onload="init()">

  <main>
    <div class="container py-3">
      <form class="row g-3" method="POST" action="includes/dienst-update.php">

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <h1>Dienst <?php echo $id ?></h1>


          <div class="col-md-3">
            <label for="ID" class="form-label">Dienst ID:</label>
            <input type="text" class="form-control" id="dienst_id" name="dienst_id" value="<?php echo $row['dienstID'] ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="inputPassword4" class="form-label">Dienst naam:</label>
            <input type="text" name="dienstnaam" class="form-control" id="dienstnaam" value="<?php echo $row['dienst'] ?>">
          </div>
          <div class="col-md-4">
            <label for="time" class="form-label">Datum aangemaakt:</label>
            <input type="text" class="form-control" id="toestel" name="toestel" value="<?php echo $row['dienst_time_aangemaakt'] ?>" readonly>
          </div>


          <div class="col-12">
            <a href="diensten.php" class="btn btn-primary" tabindex="-1" role="button">Ga terug.</a>
            <button type="submit" class="btn btn-primary" name="submit">Updaten</button>

          </div>
      </form>
    <?php } ?>


    </div>
    </div>
  </main>


  <?php include 'components/end-tags.php'; ?>
</body>

</html>