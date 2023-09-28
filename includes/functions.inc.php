<?php

function emptyInputSignup($name, $fname, $email, $username, $pwd, $pwdRepeat)
{
    $result;
    if (empty($name) || empty($fname) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function emptyInputreset($Huidpwd, $pwd, $pwdRepeat)
{
    $result;
    if (empty($Huidpwd) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUid($username)
{
    $result;
    if (!preg_match("/^[a-zA-Z0-9.]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
    $result;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfauled");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $fname, $email, $username, $usersRol, $pwd)
{
    $sql = "INSERT INTO users (usersName, usersFname, usersEmail, usersUid, usersRol, usersPwd) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfauled");
        exit();
    }

    $hashedPdw = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssss", $name, $fname, $email, $username, $usersRol, $hashedPdw);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}



function emptyInputLogin($username, $pwd)
{
    $result;
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function loginUser($conn, $username, $pwd)
{
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    } elseif ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        $_SESSION["usersFname"] = $uidExists["usersFname"];
        $_SESSION["usersName"] = $uidExists["usersName"];
        $_SESSION["usersEmail"] = $uidExists["usersEmail"];
        $_SESSION["usersRol"] = $uidExists["usersRol"];
        $_SESSION["usersPwd"] = $uidExists["usersPwd"];






        header("location: ../index.php");
        exit();
    }
}
function resetpwd($conn, $newpwd, $edituserID)
{
    // $sql = "UPDATE users SET usersPwd= '$newpwd' WHERE usersId  = $edituserID;";
    // echo $sql;
    // die;
    $stmt = mysqli_stmt_init($conn);


    $hashedPdw = password_hash($newpwd, PASSWORD_DEFAULT);

    // $sql = "UPDATE users SET usersPwd= '$hashedPdw' WHERE usersId  = $edituserID;";
    // if (!mysqli_stmt_prepare($stmt, $sql)) {
    //     header("location: ../instellingen.php?error=stmtfauled");
    //     exit();
    // }
    // mysqli_query($conn, $sql);


    $sql = "UPDATE users SET usersPwd=? WHERE usersId =?";

    // prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $hashedPdw, $edituserID);

    if ($stmt->execute()) {
        $n_updates = $stmt->affected_rows;
        // echo '<div class="alert alert-success" role="alert">
        // Admin aangepast. Het aantal rijen die aangepast zijn: ' . $n_updates . '
        // </div>';
    } else {
        header("location: ../instellingen.php?error=error");
    }
    $stmt->close();
    $conn->close();


    header("location: logout.inc.php");
    exit();
}
function pwdcheck($pwdNow, $usersPwd)
{
    $checkPwd = password_verify($pwdNow, $usersPwd);

    if ($checkPwd === false) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
