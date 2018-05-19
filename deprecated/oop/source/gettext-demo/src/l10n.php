<?php

// výbìr jazyka pro texty aplikace
$lang = "en";      // implicitní jazyk

// zmìna preferovaného jazyka podle parametru v URL
if (IsSet($_GET["changelang"]))
{
  $lang = $_GET["changelang"];
  if ($lang == "auto")
  {
    // vynulování kódu v cookie
    SetCookie("lang");
    // "uhádnutí" jazyka podle Accept-Language
    list($jazykVaha) = Explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
    list($prvniJazyk) = Explode(";", $jazykVaha);
    if ($prvniJazyk != "") $lang = $prvniJazyk;
  }
  else
  {
    // zapamatování vybraného jazyka v cookie na jeden rok
    SetCookie("lang", $lang, time() + 60*60*24*365);
  }
}
else
{
  // naètení preferovaného jazyka z cookie
  if (IsSet($_COOKIE["lang"])) 
  {
    $lang = $_COOKIE["lang"];
  }
  else
  {
    // "uhádnutí" jazyka podle Accept-Language
    list($jazykVaha) = Explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
    list($prvniJazyk) = Explode(";", $jazykVaha);
    if ($prvniJazyk != "") $lang = $prvniJazyk;
  }
}

// zmìna jazyka používaného knihovnou gettext
putenv("LANG=$lang");
setlocale(LC_ALL, $lang);
bindtextdomain("messages", realpath("../locale"));
bind_textdomain_codeset("messages", "utf-8");
textdomain("messages");

?>