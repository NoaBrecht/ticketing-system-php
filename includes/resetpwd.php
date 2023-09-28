<?php

if (isset($_POST['submit'])) {
    session_start();
    // print_r($_SESSION);
    // die;
    $edituserID = $_SESSION["userid"];
    $usersPwd = $_SESSION["usersPwd"];


    $pwdNow = $_POST['Huidpwd'];
    $newpwd = $_POST['pwd'];
    $newpwdrepeat = $_POST['pwdrepeat'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputreset($pwdNow, $newpwd, $newpwdrepeat) !== false) {
        header("location: ../instellingen.php?error=emptyinput");
        exit();
    }
    if (pwdcheck($pwdNow, $usersPwd) !== false) {
        header("location: ../instellingen.php?error=wrongpwd");
        exit();
    }
    
    if (pwdMatch($newpwd, $newpwdrepeat) !== false) {
        header("location: ../instellingen.php?error=passwordsdontmatch");
        exit();
    }

    // createUser($conn, $name, $fname, $email, $username, $usersRol, $pwd);
    resetpwd($conn, $newpwd, $edituserID);

    // $sql = "UPDATE users SET usersRol= '$newrol' WHERE usersId  = $edituserID;";


    // echo "wachtwoorden kloppen";
} else {
    header("location: ../instellingen.php");
    exit();
}
