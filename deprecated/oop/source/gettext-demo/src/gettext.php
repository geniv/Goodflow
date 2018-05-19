<?php

// parametr v URL slouží pro zmìnu jazyka
// pokud jazyk není zadán, pøedpokládá se angliètina
$lang = isset($_GET["lang"]) ? $_GET["lang"] : "en";

// nastavení jazyka pro potøeby gettext
putenv("LANG=$lang");
setlocale(LC_ALL, $lang);
bindtextdomain("messages", realpath("../locale"));
textdomain("messages");

// typické použití funkce gettext() pomocí aliasu
echo "<h1>" . _("Welcome!") . "</h1>\n";

// ukázka použití ngettext() pro rùzné tvary množného èísla 
$num = rand(1,500);
for ($n = 1; $n <= $num; $n++)
{
  printf(ngettext("You have %s new e-mail.", 
                  "You have %s new e-mails.", $n), 
         $n);
  echo "<br>\n";
}

// další ukázky použití
echo _("Thank you for using our application");
echo "<hr><p align='left'><em>";
echo gettext("Your webmaster");
echo "</em></p>";

?>
