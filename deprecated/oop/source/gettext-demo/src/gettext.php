<?php

// parametr v URL slou�� pro zm�nu jazyka
// pokud jazyk nen� zad�n, p�edpokl�d� se angli�tina
$lang = isset($_GET["lang"]) ? $_GET["lang"] : "en";

// nastaven� jazyka pro pot�eby gettext
putenv("LANG=$lang");
setlocale(LC_ALL, $lang);
bindtextdomain("messages", realpath("../locale"));
textdomain("messages");

// typick� pou�it� funkce gettext() pomoc� aliasu
echo "<h1>" . _("Welcome!") . "</h1>\n";

// uk�zka pou�it� ngettext() pro r�zn� tvary mno�n�ho ��sla 
$num = rand(1,500);
for ($n = 1; $n <= $num; $n++)
{
  printf(ngettext("You have %s new e-mail.", 
                  "You have %s new e-mails.", $n), 
         $n);
  echo "<br>\n";
}

// dal�� uk�zky pou�it�
echo _("Thank you for using our application");
echo "<hr><p align='left'><em>";
echo gettext("Your webmaster");
echo "</em></p>";

?>
