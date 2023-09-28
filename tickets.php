<?php
include_once 'components/session.php';
include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="nl">

<head>
  <?php include 'components/head-tags.php'; ?>
  <title>Tickets</title>
  <script>
    function init() {
      // Zet in de sidebar de huidige pagina actief.
      document.getElementById('tickets').classList.add("active");
    }
  </script>
  <style>
    #myInput {
      background-image: url('images/searchicon.png');
      /* Add a search icon to input */
      background-position: 10px 12px;
      /* Position the search icon */
      background-repeat: no-repeat;
      /* Do not repeat the icon image */
      width: 100%;
      /* Full-width */
      font-size: 16px;
      /* Increase font-size */
      padding: 12px 20px 12px 40px;
      /* Add some padding */
      border: 1px solid #ddd;
      /* Add a grey border */
      margin-bottom: 12px;
      /* Add some space below the input */
    }
  </style>
</head>

<body onload="init()">
  <?php include 'components/header.php'; ?>
  <main>
    <div class="container py-3">
      <h1>Tickets</h1>
      <div class="table-responsive">


        <?php

$sql = "SELECT `tickets`.*, `prioriteiten`.*, `diensten`.`dienst`, `users`.*
FROM `tickets` 
  LEFT JOIN `prioriteiten` ON `tickets`.`ticket_prioriteit` = `prioriteiten`.`prioriteitId` 
  LEFT JOIN `diensten` ON `tickets`.`ticket_dienst` = `diensten`.`dienstID` 
          LEFT JOIN `users` ON `tickets`.`ticket_user` = `users`.`usersId` 
              ORDER BY ticket_id ASC;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
        ?><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Zoeken op korte omschrijving">
          <?php
          ?> <table class="table table-striped table-hover table-bordered" id="myTable">
            <thead class="table-dark">
              <tr>
                <th scope="col">Ticket ID</th>
                <th scope="col">Korte omschrijving</th>
                <th scope="col">Prioriteit</th>
                <th scope="col">Soort toestel</th>
                <th scope="col">Dienst</th>
                <th scope="col">Datum gemeld</th>
                <th scope="col">Meer informatie</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($result)) {
              ?> <tr>
                  <th scope="row"> <?php echo $row['ticket_id'] ?> </th>
                  <td><?php echo $row['ticket_korte_omschrijving'] ?></td>
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
                  <td><?php echo $row['ticket_toestel'] ?></td>
                  <td><?php echo $row['dienst'] ?></td>
                  <td><?php echo $row['ticket_datum_gemeld'] ?></td>
                  <td><a class="btn btn-secondary" href="ticket.php?id=<?php echo $row['ticket_id'] ?>">Meer informatie</a></td>

                </tr>
              <?php
              }
            } else {
              ?>
              <div class="alert alert-info" role="alert">
                Er zijn geen tickets gevonden
              </div>
            <?php
            }
            ?>

            </tbody>
          </table>
          <script>
            function myFunction() {
              // Declare variables
              var input, filter, table, tr, td, i, txtValue;
              input = document.getElementById("myInput");
              filter = input.value.toUpperCase();
              table = document.getElementById("myTable");
              tr = table.getElementsByTagName("tr");

              // Loop through all table rows, and hide those who don't match the search query
              for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                  txtValue = td.textContent || td.innerText;
                  if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                  }
                }
              }
            }
          </script>
      </div>
      <a href="ticket-maken.php" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true"><i class="bi bi-plus-circle"> Maak een nieuw ticket aan</i></a>


    </div>
  </main>


  <?php include 'components/end-tags.php'; ?>
</body>

</html>