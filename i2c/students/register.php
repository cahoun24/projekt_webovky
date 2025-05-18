<?php

require "./utils/init.php";
require "./db/users.php";

require "./layout/head.phtml";

if (isset($_POST["registerForm"])) {
    if ($_POST["password"] !== $_POST["confirmPassword"]) {
        echo "<p>Hesla se neshodují!</p>";
    } else {
        registerUser($db, $_POST["username"], $_POST["password"],$_POST["email"],$_POST["role"]);
    }
}

require "./register.phtml";
require "./layout/tail.phtml";