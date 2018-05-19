<?php

    @header("Content-Type: text/html; charset=utf-8");

// Trvale pripojenie k DB MySQL
    function pconnect_mysql($host, $user, $password, $db) {
	    mysql_pconnect($host, $user, $password) or die(mysql_error());
       	mysql_select_db($db) or die(mysql_error());
        @mysql_query("SET CHARACTER SET UTF8");
        @mysql_query("SET NAMES UTF8");
        @mysql_query("SET COLLATION_CONNECTION=UTF8_UNICODE_CI");
    }

?>
