<?php
include_once 'components/session.php';
include_once 'includes/dbh.inc.php';
?>

<head>
  <?php include 'components/head-tags.php'; ?>
  <?php
  $usersRol = $_SESSION["usersRol"];
  if ($usersRol <= 1) {
    header("location: index.php");
  }
  ?>
  <title>Gebruiker toevoegen</title>
</head>

<body onload="init()">
  <?php include 'components/header.php'; ?>
  <main>
    <div class="container py-3">
      <h1>Gebruiker toevoegen</h1>
      <?php

      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
      ?>
          <div class="alert alert-danger  d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>
              Gelieve alle velden in te vullen.
            </div>
          </div>
        <?php
        } elseif ($_GET["error"] == "invalidUid") {
        ?>
          <div class="alert alert-danger  d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>
              Gelieve een andere gebruikersnaam kiezen </div>
          </div>
        <?php
        } elseif ($_GET["error"] == "invalidemail") {
        ?>
          <div class="alert alert-danger  d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>
              Gelieve een geldig emailadress in te geven
            </div>
          </div>
        <?php
        } elseif ($_GET["error"] == "passwordsdontmatch") {
        ?>
          <div class="alert alert-danger  d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>
              U heeft 2 verschillende wachtwoorden ingegeven.
            </div>
          </div>
        <?php
        } elseif ($_GET["error"] == "stmtfailed") {
        ?>
          <div class="alert alert-danger  d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>
              Er is iets fout gegaan. Probeer later opnieuw.
            </div>
          </div>
        <?php
        } elseif ($_GET["error"] == "usernametaken") {
        ?>
          <div class="alert alert-danger  d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>
              Deze gebruikersnaam is al in gebruik.
            </div>
          </div>
        <?php
        } elseif ($_GET["error"] == "none") {
        ?>
          <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
          </svg>
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
              <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
              De gebruiker is succesvol aangemaakt.
            </div>
          </div>
      <?php
        }
      }

      ?>
      <form action="includes/signup.inc.php" method="post">

        <div class="form-floating mb-3">
          <input type="text" name="name" class="form-control" id="floatingInput" placeholder="Naam">
          <label for="floatingInput">Naam</label>
        </div>

        <div class="form-floating mb-3">
          <input type="text" name="fname" class="form-control" id="floatingInput" placeholder="Voornaam">
          <label for="floatingInput">Voornaam</label>
        </div>

        <div class="form-floating mb-3">
          <input type="text" name="email" class="form-control" id="floatingInput" placeholder="Email">
          <label for="floatingInput">Email</label>
        </div>

        <div class="form-floating mb-3">
          <input type="text" name="uid" class="form-control" id="floatingInput" placeholder="Gebruikersnaam">
          <label for="floatingInput">Gebruikersnaam</label>
        </div>

        <!-- <input type="text" name="name" placeholder="Naam">
        <input type="text" name="fname" placeholder="Voornaam">
        <input type="email" name="email" placeholder="Email">
        <input type="text " name="uid" placeholder="Username"> -->
        <?php
        if ($usersRol >= 3) {
        ?>
          <select class="form-select form-select-lg mb-3" aria-label="Default select example" name="usersRol" required>
            <option value="1">Gebruiker</option>
            <option value="2">Beheerder</option>
            <option value="3">Super admin</option>
          </select>
        <?php
        } elseif ($usersRol = 2) {
        ?>
          <select class="form-select form-select-lg mb-3" aria-label="Default select example" name="usersRol" required>
            <option value="1">Gebruiker</option>
            <option value="2">Beheerder</option>
          </select>
        <?php
        }
        ?>

        <div class="form-floating mb-3">
          <input type="password" name="pwd" class="form-control" id="floatingInput" placeholder="Wachtwoord">
          <label for="floatingInput">Wachtwoord</label>
        </div>

        <div class="form-floating mb-3">
          <input type="password" name="pwdrepeat" class="form-control" id="floatingInput" placeholder="Herhaal wachtwoord">
          <label for="floatingInput">Herhaal wachtwoord</label>
        </div>
        <!-- 
        <input type="password" name="pwd" placeholder="Wachtwoord">
        <input type="password" name="pwdrepeat" placeholder="Herhaal wachtwoord">
        <div class="mb-3"> -->

        <div class="col-12">
          <button type="submit" name="submit" class="btn btn-primary">Aanmaken</button>
        </div>
      </form>



  </main>


  <?php include 'components/end-tags.php'; ?>
</body>

</html>


<!-- <!DOCTYPE html>
<html>
<head>
<script>
function writeMessage2() {
  document.forms[0].mySecondInput.value = document.forms[0].myInput.value.toLowerCase() + "." + document.forms[0].fname.value.toLowerCase() ;
}
</script>
</head>
<body>

<p>The onkeyup event occurs when the a keyboard key is on its way UP.</p>

<form>
  Enter your name:
  <input type="text" name="myInput" onkeyup="writeMessage2()" size="20">
    <input type="text" name="fname" onkeyup="writeMessage2()" size="20">

  <input type="text" name="mySecondInput" size="20" readonly>
</form>

</body>
</html>
 -->