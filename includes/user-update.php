<?php
include_once 'dbh.inc.php';
if (isset($_POST['submit'])) {
    session_start();

    $edituserID = $_SESSION["lastvieuweduser"];


    // Het ticket uploaden naar de databank
    // $ticket_id = mysqli_real_escape_string($conn,  $_POST['ticket_id']);
    $newrol = mysqli_real_escape_string($conn,  $_POST['usersRol']);

    // $sql = "UPDATE users SET usersRol= '$newrol' WHERE usersId  = $edituserID;";


    // mysqli_query($conn, $sql);
    // header("Location: ../gebruikers.php");

    $sql = "UPDATE users SET usersRol=? WHERE usersId =?";

    // prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $newrol, $edituserID);

    if ($stmt->execute()) {
        $n_updates = $stmt->affected_rows;
    } else {
        header("Location: ../gebruikers.php?error=sql");
    }
    $stmt->close();
    $conn->close();
    header("Location: ../gebruikers.php");
}
