<?php

    if(!require_once("./config.php")) {print("<div align=\"center\"><br /><br /><br />Chyba 702</div>"); exit();} else{}

    if(!require_once("./functions.php")) {print("<div align=\"center\"><br /><br /><br />Chyba 702</div>"); exit();} else {}

    pconnect_mysql($host, $user, $password, $db);
    
    // akcie
    
    if($odpoved = $_GET["odpoved"]) {
        $odpoved = addslashes(substr($odpoved, 0, 1));
        $voting_zoznam_action = mysql_query(" SELECT ip FROM voting_zoznam ");
        while($voting_zoznam = mysql_fetch_assoc($voting_zoznam_action)) {
            if($ip == $voting_zoznam["ip"]) {
                @header("Location: index.php");
                print("<div align=\"center\">Nemôžete hlasovať viac krát. <a href=\"index.php\" target=\"_self\">Pokračovať</a></div>");
                exit();
            }
            else {}
        }
        mysql_query(" INSERT INTO voting_zoznam (ip, odpoved) VALUES ('$ip', '$odpoved') ");
        @header("Location: index.php");
        print("<div align=\"center\">Hlasovanie prebehlo úspešne. <a href=\"index.php\" target=\"_self\">Pokračovať</a></div>");
    }
    else{
        @header("Location: index.php");
        print("<div align=\"center\">Nemôžete hlasovať. <a href=\"index.php\" target=\"_self\">Pokračovať</a></div>");
    }
    
    mysql_close();

?>
