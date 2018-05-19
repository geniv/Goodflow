<?php

// v�b�r jazyka pro texty aplikace
$lang = "en";      // implicitn� jazyk

// zm�na preferovan�ho jazyka podle parametru v URL
if (IsSet($_GET["changelang"]))
{
  $lang = $_GET["changelang"];
  if ($lang == "auto")
  {
    // vynulov�n� k�du v cookie
    SetCookie("lang");
    // "uh�dnut�" jazyka podle Accept-Language
    list($jazykVaha) = Explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
    list($prvniJazyk) = Explode(";", $jazykVaha);
    if ($prvniJazyk != "") $lang = $prvniJazyk;
  }
  else
  {
    // zapamatov�n� vybran�ho jazyka v cookie na jeden rok
    SetCookie("lang", $lang, time() + 60*60*24*365);
  }
}
else
{
  // na�ten� preferovan�ho jazyka z cookie
  if (IsSet($_COOKIE["lang"])) 
  {
    $lang = $_COOKIE["lang"];
  }
  else
  {
    // "uh�dnut�" jazyka podle Accept-Language
    list($jazykVaha) = Explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
    list($prvniJazyk) = Explode(";", $jazykVaha);
    if ($prvniJazyk != "") $lang = $prvniJazyk;
  }
}

// zm�na jazyka pou��van�ho knihovnou gettext
putenv("LANG=$lang");
setlocale(LC_ALL, $lang);
bindtextdomain("messages", realpath("../locale"));
bind_textdomain_codeset("messages", "utf-8");
textdomain("messages");

?>