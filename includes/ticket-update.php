<?php
include_once 'dbh.inc.php';
if (isset($_POST['submit'])) {
    session_start();

    $ticket_id = $_SESSION["lastvieuwedticket"];


    // Het ticket uploaden naar de databank
    // $ticket_id = mysqli_real_escape_string($conn,  $_POST['ticket_id']);
    $newprio = mysqli_real_escape_string($conn,  $_POST['newprio']);
    $commentaar = mysqli_real_escape_string($conn,  $_POST['commentaar']);


    // $sql = "UPDATE tickets SET ticket_prioriteit= '$newprio', ticket_commentaar= '$commentaar' WHERE ticket_id = $ticket_id;";

    // mysqli_query($conn, $sql);

    $sql = "UPDATE tickets SET ticket_prioriteit=?, ticket_commentaar=? WHERE ticket_id =?";

    // prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $newprio, $commentaar, $ticket_id);

    if ($stmt->execute()) {
        $n_updates = $stmt->affected_rows;
    } else {
        header("Location: ../tickets.php?error=sql");
    }
    $stmt->close();
    $conn->close();


    header("Location: ../tickets.php");
} else {
    header("location : ../ticket-maken.php?error=filetobig");
    exit();
}
