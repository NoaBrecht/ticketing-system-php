<?php
// We kijken of de bezoeker op deze pagina is gekomen door het formulier te verzenden

if (isset($_POST['submit'])) {
    // We halen de gegevens op uit het formulier en doen een eerste controle op SQL injecties

    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $username = $_POST['uid'];
    $usersRol = $_POST['usersRol'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdrepeat'];

    // We voegen het bestand dbh.inc.php toe

    require_once 'dbh.inc.php';
    // We voegen het bestand functions.inc.php toe

    require_once 'functions.inc.php';

    // We roepen verschillende functies op
    if (emptyInputSignup($name, $fname, $email, $username, $pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invalidUid($username) !== false) {
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if (uidExists($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $fname, $email, $username, $usersRol, $pwd);
} else {
    header("location: ../signup.php");
    exit();
}
