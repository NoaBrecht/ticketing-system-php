<?php
include_once 'components/session.php';
include_once 'includes/dbh.inc.php';
if (!empty($_GET['id'])) {
  $id = $_GET['id'];
}
session_start();

// setcookie("ticketIDupdate", "$id", time() + (86400 * 30), "/");
$_SESSION["lastvieuwedticket"] = $id;
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

  $sql = "SELECT `tickets`.*, `prioriteiten`.*, `diensten`.`dienst`, `users`.*
  FROM `tickets` 
    LEFT JOIN `prioriteiten` ON `tickets`.`ticket_prioriteit` = `prioriteiten`.`prioriteitId` 
    LEFT JOIN `diensten` ON `tickets`.`ticket_dienst` = `diensten`.`dienstID` 
            LEFT JOIN `users` ON `tickets`.`ticket_user` = `users`.`usersId` 
            WHERE ticket_id='$id';";

  $result = mysqli_query($conn, $sql);
  ?>
  <title>Tickets</title>
</head>

<body onload="init()">

  <main>
    <div class="container py-3">
      <form class="row g-3" method="POST" action="includes/ticket-update.php">

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <h1>Ticket <?php echo $id ?></h1>


          <div class="col-md-3">
            <label for="ID" class="form-label">Ticket ID:</label>
            <input type="text" class="form-control" id="ticket_id" name="ticket_id" value="<?php echo $row['ticket_id'] ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="inputPassword4" class="form-label">Korte omschrijving:</label>
            <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row['ticket_korte_omschrijving'] ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="toestel" class="form-label">Soort toestel:</label>
            <input type="text" class="form-control" id="toestel" name="toestel" value="<?php echo $row['ticket_toestel'] ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="toestel" class="form-label">Prioriteit:</label>
            <td><button type="button" class="btn btn-<?php echo $row['prioriteit_kleur'] ?>" disabled><?php echo $row['prioriteit'] ?></button></td>

            <!-- <?php
                  switch ($row['ticket_prioriteit']) {
                    case "4":
                  ?><td><button type="button" class="btn btn-info" disabled>Afgerond</button></td>
              <?php
                      break;
                    case "2":
              ?><td><button type="button" class="btn btn-warning" disabled>Gemiddeld</button></td>
              <?php
                      break;
                    case "3":
              ?><td><button type="button" class="btn btn-danger" disabled>Hoog</button></td>
              <?php
                      break;
                    case "1":
              ?><td><button type="button" class="btn btn-success" disabled>Laag</button></td>
            <?php
                      break;
                      /*
      Voorbeeld hoe een nieuwe statuskleur aan te maken
        case "STATUSNAAM":
          ?><td><button type="button" class="btn btn-KLEUR" disabled><?php echo $row['prioriteit']?></button></td>
        <?php
            break;
      */
                  }
            ?> -->
          </div>
          <div class="mb-3">
            <label for="lOmschrijving" class="form-label">Lange omschrijving:</label>

            <textarea class="form-control" name="lange-omschrijving" id="lOmschrijving" rows="3" readonly><?php echo $row['ticket_lange_omschrijving'] ?></textarea>
          </div>

          <div class="col-md-3">
            <label for="ID" class="form-label">Dienst:</label>
            <input type="text" class="form-control" id="ID" name="dienst" value="<?php echo $row['dienst'] ?>" readonly>
          </div>
          <div class="col-md-3">
            <label for="ID" class="form-label">Datum gemeld:</label>
            <input type="text" class="form-control" id="ID" name="date" value="<?php echo $row['ticket_datum_gemeld'] ?>" readonly>
          </div>
          <div class="col-md-3">
            <label for="ID" class="form-label">Datum aangemaakt:</label>
            <input type="text" class="form-control" id="ID" name="date" value="<?php echo $row['ticket_datum_aangemaakt'] ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="toestel" class="form-label">Gebruiker:</label>
            <input type="text" class="form-control" id="toestel" name="toestel" value="<?php echo $row['usersFname'] ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="toestel" class="form-label">Wie heeft het probleem:</label>
            <input type="text" class="form-control" id="toestel" name="toestel" value="<?php echo $row['ticket_user_probleem'] ?>" readonly>
          </div>

          <?php
          if ($row['ticket_filepath'] != "uploads/nofile.php") {
          ?>
            <div class="col-md-3">
              <a href=<?php echo $row['ticket_filepath'] ?> class="btn btn-primary" tabindex="-1" role="button" target="_blank" rel="noopener noreferrer">Bestand openen</a>
            </div>
          <?php
          }
          ?>


          <div class="mb-3">
            <label for="commentaar" class="form-label">commentaar:</label>

            <textarea class="form-control" name="commentaar" id="commentaar" rows="3"><?php echo $row['ticket_commentaar'] ?></textarea>
          </div>
          <div class="mb-3">

            <?php
            $sql = "SELECT * FROM prioriteiten;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            ?>
            <select class="form-select mb-3" aria-label="Default select example" name="newprio" id="newprio" required>
              <?php
              if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
              ?>
                  <option value="<?php echo $row['prioriteitId'] ?>"><?php echo $row['prioriteit'] ?></option>
              <?php
                }
              }
              ?>
            </select>


            <div class="col-12">
              <a href="tickets.php" class="btn btn-primary" tabindex="-1" role="button">Ga terug.</a>
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