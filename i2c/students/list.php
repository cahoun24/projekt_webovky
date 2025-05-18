<?php

require "./utils/init.php";
require "./db/students.php";

if (isset($_POST["deletestudent"])) {
    deleteAthlete($db, $_POST["id"]);
}

require "./layout/head.phtml";

if (isset($_GET["id"])) {
    if (isset($_POST["editstudentForm"])) {
        editAthlete($db, $_GET["id"], $_POST["name"], $_POST["country"]);
    }

    $student = getAthlete($db, $_GET["id"]);
    require "./edit-student.phtml";
} else {
    $students = listAthletes($db);
    require "./list.phtml";
}

require "./layout/tail.phtml";