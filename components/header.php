<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark bg-gradient" aria-label="Main navigation">
  <div class="container-fluid">
    <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav me-auto mb-2 mb--0">
        <span class="border-end-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php" id="index">Home</a>
          </li>
        </span>
        <span class="border-end-nav">
          <li class="nav-item">
            <a class="nav-link" href="tickets.php" id="tickets">Tickets</a> 
          </li>
        </span>
        <span class="border-end-nav">

          <li class="nav-item">
            <a class="nav-link" href="diensten.php" id="diensten">Diensten</a>
          </li>
        </span>
        <span class="border-end-nav">
          <li class="nav-item">
            <a class="nav-link" href="instellingen.php" id="instellingen">Instellingen</a>
          </li>
        </span>
        <!-- Alleen voor admin -->
        <?php
        $usersRol = $_SESSION["usersRol"];
        if ($usersRol >= 2) {
        ?> <span class="border-end-nav">
            <li class="nav-item">
              <a class="nav-link" href="gebruikers.php" id="gebruikers">Gebruikers</a>
            </li>
          </span>
        <?php
        }
        ?>

        <span class="border-end-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Maken</a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdown01">
              <li><a class="dropdown-item" href="ticket-maken.php">Ticket aanmaken</a></li>
              <div class="dropdown-divider"></div>
              <li><a class="dropdown-item" href="dienst-toevoegen.php">Dienst aanmaken</a></li>
            </ul>
          </li>
        </span>
        <li class="nav-item">
          <a class="nav-link disabled active">
            <!-- <?php echo 'Welkom ' . $_SESSION["usersFname"] ?> -->
          </a>
        </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION["usersFname"] ?></a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdown01">
              <li><a class="dropdown-item" href="instellingen.php">Instellingen</a></li>
              <div class="dropdown-divider"></div>
              <li><a class="dropdown-item" href="includes/logout.inc.php">Afmelden</a></li>
            </ul>
          </li>
        <!-- </span> -->
        <!-- <li class="nav-item">
          <a class="nav-link disabled active">
            <?php echo 'Welkom ' . $_SESSION["useruid"] ?>
          </a>
        </li> -->
      </ul>
      <!-- <span class="navbar-text">
        <?php echo 'Welkom ' . $_SESSION["usersFname"] ?>
      </span>
      <span class="border-end-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdown01">
            <li><a class="dropdown-item" href="instellingen.php">Instellingen</a></li>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="includes/logout.inc.php">Afmelden</a></li>
          </ul>
        </li>
      </span>
      <div class="dropdown">  
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          Account
        </button>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="instellingen.php">Instellingen</a></li>
          <div class="dropdown-divider"></div>
          <li><a class="dropdown-item" href="includes/logout.inc.php"><i class="fas fa-door-open"></i> Afmelden</a></li>
        </ul>
      </div>   -->

    </div>
  </div>
</nav>