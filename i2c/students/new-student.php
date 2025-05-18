<?php

require "./utils/init.php";
require "./db/students.php";

if (isset($_POST["newstudentForm"])) {
    insertAthlete($db, $_POST["name"], $_POST["country"]);
}

require "./layout/head.phtml";
require "./new-student.phtml";
require "./layout/tail.phtml";