<?php
// We kijken of de bezoeker op deze pagina is gekomen door het formulier te verzenden

if (isset($_POST['submit'])) {
// We vragen de gegevens van het formulier op
$username = $_POST["uid"];
$pwd = $_POST["pwd"];

// We voegen het bestand dbh.inc.php toe

require_once 'dbh.inc.php';
// We voegen het bestand functions.inc.php toe

require_once 'functions.inc.php';

if (emptyInputLogin ($username, $pwd) !== false) {
    header ("location : ../login.php?error=emptyinput");
    exit ();
}


loginUser ($conn, $username, $pwd);
}
else {
    header ("location : ../login.php");
    exit ();
}