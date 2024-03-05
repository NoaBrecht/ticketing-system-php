<?php
// We voegen het bestand dbh.inc.php toe

include_once 'dbh.inc.php';
// We kijken of de bezoeker op deze pagina is gekomen door het formulier te verzenden

if (isset($_POST['submit'])) {
    // We halen de gegevens op uit het formulier en doen een eerste controle op SQL injecties

    $dienst = mysqli_real_escape_string($conn,  $_POST['dienst']);

    if (condition) {
        # code...
    }
    // We maken de sql klaar om in de databank ingegeven te worden.

    $sql = "INSERT INTO diensten (dienst) VALUES (?)";

    // prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $dienst);

    if ($stmt->execute()) {
    } else {
        header("Location: ../diensten.php?error=error");
    }

    $stmt->close();
    $conn->close();
    header("Location: ../diensten.php?error=succes");
} else {
    header("location: ../diensten-maken.php?error=error");
    exit();
}
