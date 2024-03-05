<?php
include_once 'components/session.php';
include_once 'includes/dbh.inc.php';
if (!empty($_GET['id'])) {
  $id = $_GET['id'];
}
session_start();

// setcookie("ticketIDupdate", "$id", time() + (86400 * 30), "/");
$_SESSION["lastvieuweduser"] = $id;
$currentusersRol = $_SESSION["usersRol"];
$currentusersID = $_SESSION["userid"];

if ($currentusersRol <= 1) {
  header("location: index.php");
}
if ($id == $currentusersID) {
  header("location: gebruikers.php");
}
?>


<!DOCTYPE html>
<html lang="nl">

<head>
  <?php include 'components/head-tags.php';
  include 'components/header.php';



  $sql = "SELECT * FROM users WHERE usersId ='$id' ;";
  $result = mysqli_query($conn, $sql);
  ?>
  <title>Gebruiker aanpassen</title>
</head>

<body onload="init()">

  <main>
    <div class="container py-3">
      <form class="row g-3" method="POST" action="includes/user-update.php">

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <h1>Gebruiker <?php echo $id ?></h1>


          <div class="col-md-3">
            <label for="ID" class="form-label">Gebruiker ID:</label>
            <input type="text" class="form-control" id="ticket_id" name="ticket_id" value="<?php echo $row['usersId'] ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="inputPassword4" class="form-label">Naam:</label>
            <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row['usersName'] ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="toestel" class="form-label">Voornaam:</label>
            <input type="text" class="form-control" id="toestel" name="toestel" value="<?php echo $row['usersFname'] ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="toestel" class="form-label">Email:</label>
            <input type="text" class="form-control" id="toestel" name="toestel" value="<?php echo $row['usersEmail'] ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="toestel" class="form-label">Gebruikersnaam:</label>
            <input type="text" class="form-control" id="toestel" name="toestel" value="<?php echo $row['usersUid'] ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="toestel" class="form-label">rol:</label>

            <?php
            switch ($row['usersRol']) {
              case "1":
            ?><td><button type="button" class="btn btn-info" disabled>Gebruiker</button></td>
              <?php
                break;
              case "2":
              ?><td><button type="button" class="btn btn-primary" disabled>Beheerder</button></td>
              <?php
                break;
              case "3":
              ?><td><button type="button" class="btn btn-danger" disabled>Super admin</button></td>
            <?php
                break;
            }
            ?>
          </div>

          <?php
          if ($currentusersRol >= 3) {
          ?>
            <select class="form-select mb-3" aria-label="Default select example" name="usersRol" required>
              <option value="1">Gebruiker</option>
              <option value="2">Beheerder</option>
              <option value="3">Super admin</option>
            </select>
          <?php
          }
          ?>

          <div class="col-12">
            <a href="gebruikers.php" class="btn btn-primary" tabindex="-1" role="button">Ga terug.</a>
            <?php
            if ($currentusersRol >= 3) {
            ?>
              <button type="submit" class="btn btn-primary" name="submit">Updaten</button>
            <?php } ?>
          </div>
      </form>
    <?php } ?>


    </div>
    </div>
  </main>


  <?php include 'components/end-tags.php'; ?>
</body>

</html>