<?php

function insertAthlete($db, $name, $country) {
    $stmt = mysqli_prepare($db, "
        INSERT INTO athletes (name, country)
        VALUES (?, ?)
    ");
    if ($stmt === false) {
        echo "<h1>Nepodařilo se přidat studenta</h1>";
        echo mysqli_error($db);
        exit;
    }
    mysqli_stmt_bind_param($stmt, "ss", $name, $country);
    $result = mysqli_execute($stmt);
    if ($result === false) {
        echo "<h1>Nepodařilo se přidat studenta</h1>";
        echo mysqli_error($db);
        exit;
    }
}

function getAthlete($db, $id) {
    $stmt = mysqli_prepare($db, "
        SELECT * FROM athletes
        WHERE id = ?
    ");
    if ($stmt === false) {
        echo "<h1>Nepodařilo se načíst studenta</h1>";
        echo mysqli_error($db);
        exit;
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_execute($stmt);
    if ($result === false) {
        echo "<h1>Nepodařilo se načíst studenta</h1>";
        echo mysqli_error($db);
        exit;
    }
    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

function listAthletes($db) {
    $result = mysqli_query($db, "SELECT * FROM athletes");
    if ($result === false) {
        echo "<h1>Nepodařilo se získat seznam studentů</h1>";
        echo mysqli_error($db);
        exit;
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function editAthlete($db, $id, $name, $country) {
    $stmt = mysqli_prepare($db, "
        UPDATE athletes
        SET name = ?, country = ?
        WHERE id = ?
    ");
    if ($stmt === false) {
        echo "<h1>Nepodařilo se upravit studenta</h1>";
        echo mysqli_error($db);
        exit;
    }
    mysqli_stmt_bind_param($stmt, "ssi", $name, $country, $id);
    $result = mysqli_execute($stmt);
    if ($result === false) {
        echo "<h1>Nepodařilo se upravit studenta</h1>";
        echo mysqli_error($db);
        exit;
    }
}

function deleteAthlete($db, $id) {
    $stmt = mysqli_prepare($db, "
        DELETE FROM athletes
        WHERE id = ?
    ");
    if ($stmt === false) {
        echo "<h1>Nepodařilo se odebrat studenta</h1>";
        echo mysqli_error($db);
        exit;
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_execute($stmt);
    if ($result === false) {
        echo "<h1>Nepodařilo se odebrat studenta</h1>";
        echo mysqli_error($db);
        exit;
    }
}