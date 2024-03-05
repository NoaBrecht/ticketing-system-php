<?php
include_once 'components/session.php';
include_once 'includes/dbh.inc.php';

$currentusersRol = $_SESSION["usersRol"];

if ($currentusersRol <= 1) {
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
  <?php include 'components/head-tags.php'; ?>
  <?php
  $usersRol = $_SESSION["usersRol"];
  if ($usersRol <= 1) {
    header("location: index.php");
  }
  ?> <title>Gebruikers</title>
  <script>
    function init() {
      // Zet in de sidebar de huidige pagina actief.
      document.getElementById('gebruikers').classList.add("active");
    }
  </script>
</head>

<body onload="init()">
  <?php include 'components/header.php'; ?>
  <main>
    <div class="container py-3">
      <!-- <?php echo $_SESSION["lastvieuweduser"];
      ?> -->
      <h1>Gebruikers</h1>
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
          <thead class="table-dark">
            <tr>
              <th scope="col">Gebruiker ID</th>
              <th scope="col">Naam</th>
              <th scope="col">Voornaam</th>
              <th scope="col">Email</th>
              <th scope="col">Gebruikersnaam</th>
              <th scope="col">rol</th>
              <th scope="col">Gebruiker aanpassen</th>


            </tr>
          </thead>
          <tbody>

            <?php

            $sql = "SELECT * FROM users;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
            ?> <tr>
                  <th scope="row"> <?php echo $row['usersId'] ?> </th>
                  <td><?php echo $row['usersName'] ?></td>
                  <td><?php echo $row['usersFname'] ?></td>
                  <td><?php echo $row['usersEmail'] ?></td>
                  <td><?php echo $row['usersUid'] ?></td>
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
                  <td><a class="btn btn-secondary" href="user.php?id=<?php echo $row['usersId'] ?>">Meer informatie</a></td>


              <?php
              }
            }
              ?>

          </tbody>
        </table>
        <a href="signup.php" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true"><i class="bi bi-plus-circle"> Voeg een nieuwe gebruiker toe</i></a>

      </div>
    </div>
  </main>


  <?php include 'components/end-tags.php'; ?>
</body>

</html>