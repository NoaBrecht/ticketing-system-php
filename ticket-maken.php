<?php
include_once 'components/session.php';
include_once 'includes/dbh.inc.php';
?>

<head>
  <?php include 'components/head-tags.php'; ?>
  <title>Ticket aanmaken</title>
</head>

<body>
  <?php include 'components/header.php'; ?>
  <main>
    <div class="container py-3">
      <h1>Ticket aanmaken</h1>


      <form action="includes/aanmaken.php" method="POST" enctype="multipart/form-data">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" name="korte-omschrijving" placeholder="Korte omschrijving">
          <label for="floatingInput">Korte omschrijving</label>

        </div>
        <div class="form-floating mb-3">
          <textarea class="form-control" name="lange-omschrijving" id="floatingInput" style="height: 100px" placeholder="Lange omschrijving"></textarea>
          <label for="floatingInput">Lange omschrijving</label>

        </div>
        <div class="form mb-3">
          <?php
          $sql = "SELECT * FROM prioriteiten;";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
          ?>
          <select class="form-select mb-3" aria-label="Default select example" name="prio" id="id" required>
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
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="toestel" id="floatingInput" placeholder="Soort toestel" required>
            <label for="floatingInput">Soort toestel</label>

          </div>
          <div class="form mb-3">
            <?php
            $sql = "SELECT * FROM diensten;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            ?>
            <select class="form-select mb-3 form-control" aria-label="Default select example" name="dienst" id="dienst" required>
              <?php
              if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
              ?>
                  <option value="<?php echo $row['dienstID'] ?>"><?php echo $row['dienst'] ?></option>
              <?php
                }
              }
              ?>
            </select>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="ticket_user_probleem" id="floatingInput" placeholder="Wie heeft het probleem" required>
            <label for="floatingInput">Wie heeft het probleem</label>

          </div>
          <div class="form mb-3">
            <input type="date" class="form-control" name="date" placeholder="datum gemeld" required>

          </div>
          <div class="form mb-3">
            <input type="file" class="form-control" name="file" placeholder="Bestand kiezen">
          </div>

          <button type="submit" class="btn btn-primary" name="submit">Aanmaken</button>
      </form>
    </div>
  </main>


  <?php include 'components/end-tags.php'; ?>
</body>

</html>