<?php
include_once 'components/session.php';
include_once 'includes/dbh.inc.php';
?>

<head>
    <?php include 'components/head-tags.php'; ?>
    <?php
    $usersRol = $_SESSION["usersRol"];
    if ($usersRol <= 1) {
        header("location: index.php");
    }
    ?>
    <title>Gebruiker toevoegen</title>
</head>

<body onload="init()">
    <?php include 'components/header.php'; ?>
    <main>
        <div class="container py-3">
            <h1>Gebruiker toevoegen</h1>




    </main>


    <?php include 'components/end-tags.php'; ?>
</body>

</html>