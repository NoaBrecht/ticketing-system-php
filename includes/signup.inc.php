<?php

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn,  $_POST['name']);
    $fname = mysqli_real_escape_string($conn,  $_POST['fname']);
    $email = mysqli_real_escape_string($conn,  $_POST['email']);
    $username = mysqli_real_escape_string($conn,  $_POST['uid']);
    $usersRol = mysqli_real_escape_string($conn,  $_POST['usersRol']);
    $pwd = mysqli_real_escape_string($conn,  $_POST['pwd']);
    $pwdRepeat = mysqli_real_escape_string($conn,  $_POST['pwdrepeat']);
   

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

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
    

 }
 else {
     header("location: ../signup.php");
     exit();
}