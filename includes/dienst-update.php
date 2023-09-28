<?php
include_once 'dbh.inc.php';
if (isset($_POST['submit'])) {
    session_start();

    $dienst_id = $_SESSION["lastvieuweddienst"];


    // Het ticket uploaden naar de databank
    // $ticket_id = mysqli_real_escape_string($conn,  $_POST['ticket_id']);
    $newname = mysqli_real_escape_string($conn,  $_POST['dienstnaam']);

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

    // $sql = "UPDATE diensten SET dienst= '$newname', WHERE dienstID  = $dienst_id;";


    // mysqli_query($conn, $sql);
    // header("Location: ../diensten.php");
} else {
    header("location : ../diensten.php?error=error");
    exit();
}
