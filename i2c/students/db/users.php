<?php

function registerUser($db, $username, $email, $password, $role) {
    $stmt = mysqli_prepare($db, "
        INSERT INTO users
        (username, email, password_hash,role)
        VALUES
        (?, ?, ?, ?)
    ");
    if ($stmt === false) {
        echo "<h1>Registrace se nezdařila.</h1>";
        echo mysqli_error($db);
        exit;
    }
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPassword, $role);
    $result = mysqli_execute($stmt);

    if ($result === false) {
        echo "<h1>Registrace se nezdařila.</h1>";
        echo mysqli_error($db);
        exit;
    }
}

function login($db, $username, $password) {
    $stmt = mysqli_prepare($db, "
        SELECT * FROM users
        WHERE username = ?
    ");
    if ($stmt === false) {
        echo "<h1>Přihlášení se nezdařilo.</h1>";
        echo mysqli_error($db);
        exit;
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    $result = mysqli_execute($stmt);
    if ($result === false) {
        echo "<h1>Přihlášení se nezdařilo.</h1>";
        echo mysqli_error($db);
        exit;
    }
    $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if ($user === null || password_verify($password, $user["password_hash"])) {
        echo "<p>Neplatné přihlašovací údaje.</p>";
        return;
    }

    $_SESSION["user"] = $user;

    
    if($user["role"]==="spravce"){
        echo "<p>Jste spravce</p>";
    }elseif($user["role"]!=="spravce"){
        echo "<p>nejste spravce</p>";
    }
}