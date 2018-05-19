<?php

    $host     = "localhost";
    $user     = "skweb-apps";
    $password = "swarm822";
    $db       = "skweb-apps";

    $ip = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];

    define("URL", "http://web-apps.php5.sk/");

?>