<div style="WIDTH: 740px; HEIGHT: 0px"></div>
<?
if (!Empty($_COOKIE["R_jmeno"]) && !Empty($_COOKIE["R_heslo"]) && !Empty($_COOKIE["R_ID"]) && LogAdmin("administrace", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0) == "true1")
{
  echo
  "<head>
  <meta http-equiv=\"refresh\" content=\"1;URL=administrace\">
  </head>
  <center><a href=\"administrace\">".pristup_povolen()."</a></center>";
}
  else
{
  echo "<head>
    <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=admin\">
    </head>
    <center><a href=\"index.php?kam=admin\">".pristup_zamitnut()."</a></center>";
}

?>
