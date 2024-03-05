<?php
// We voegen het bestand dbh.inc.php toe

include_once 'dbh.inc.php';
// We kijken of de bezoeker op deze pagina is gekomen door het formulier te verzenden

if (isset($_POST['submit'])) {
    // We starten de sessie

    session_start();
    // We kijken naar de dienst die geupdate moet worden
    $dienst_id = $_SESSION["lastvieuweddienst"];


    // We gaan de dienst updaten in de databank
    // We halen de nieuwe naam op uit het formulier en doen een eerste controle op SQL injecties
    $newname = mysqli_real_escape_string($conn,  $_POST['dienstnaam']);

    // We maken de sql klaar om in de databank ingegeven te worden.

    $sql = "UPDATE diensten SET dienst=? WHERE dienstID =?";

    // prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newname, $dienst_id);

    if ($stmt->execute()) {
        $n_updates = $stmt->affected_rows;
        // echo $n_updates;
        // print_r($stmt);
    } else {
        header("Location: ../diensten.php?error=error");
    }
    $stmt->close();
    $conn->close();
    header("Location: ../diensten.php?error=succes");
} else {
    header("location : ../diensten.php?error=error");
    exit();
}
