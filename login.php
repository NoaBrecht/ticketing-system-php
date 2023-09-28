<?php
include_once 'includes/dbh.inc.php';

?>

<head>
  <title>home</title>
  <?php
  include_once 'components/head-tags.php';

  ?>
</head>

<body>
  <div class="jumbotron vertical-center">
    <div class="container">
      <!-- username = admin
    wachtwoord = admin -->

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
        } elseif ($_GET["error"] == "wronglogin") {
        ?>
          <div class="alert alert-danger  d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>
              Gebruikersnaam/Email en/of wachtwoord is onbekend.</div>
          </div>
      <?php
        }
      }
      ?>
      <div class="row">
        <div class="col-md-6">
          <img src="images/logo.jpg" alt="Het logo van de gemeente Brecht" class="img-fluid">
        </div>
        <div class="col-md-6">
          <div class="card shadow-2-strong bg-light" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <form action="includes/login.inc.php" method="post">


                <div class="form-outline mb-4 form-floating mb-3">
                  <input type="text" class="form-control" name="uid" id="gebruikersnaam" placeholder="Gebruikersnaam/Email" required>
                  <label for="Gebruikersnaam">Gebruikersnaam/Email</label>
                </div>
                <div class="form-outline mb-4 form-floating mb-3">
                  <input type="password" name="pwd" class="form-control form-control-lg" id="password" placeholder="Wachtwoord" required>
                  <label for="password">Wachtwoord</label>

                </div>
                <div class="d-grid gap-2">
                  <button class="btn btn-primary btn-lg" type="submit" name="submit" class="btn btn-primary">Inloggen</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  include_once 'components/end-tags.php';
  ?>
</body>