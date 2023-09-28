<?php
include_once 'dbh.inc.php';

$dienst = mysqli_real_escape_string($conn,  $_POST['dienst']);

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




// $sql = "INSERT INTO diensten (dienst) VALUES ('$dienst');";
// mysqli_query($conn, $sql);

// header("Location: ../diensten.php");
