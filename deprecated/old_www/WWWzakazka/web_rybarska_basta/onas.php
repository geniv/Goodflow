<?
echo
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td height=\"10px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"6\" align=\"center\">
<tr>
<td class=\"centralni_nadpis\">O nás</td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td height=\"10px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"740px\">
<tr>
<td align=\"center\">".tlacitka_onas()."</td>
</tr>
<tr>
<td>";

  $default = "kontakt.php";
  $pod = $_GET["pod"];
  if (!Empty($pod))
  {
    if (file_exists("{$pod}.php"))
    {
      include_once "{$pod}.php";
    }
      else
    {
      include_once $default;
    }
  }
    else
  {
    include_once $default;
  }
/*
if(Empty($pod))
{
  require "kontakt.php";
}
  else
{
  if (!Empty($pod) and KontrolaKamOnasWeb("administrace", $pod) == "true")
  {
    require "$pod.php";
  }
    else
  {
    require "kontakt.php";
  }
}
*/
//<div style=\"WIDTH: 740px; HEIGHT: 0px\"></div>

echo
"</td>
</tr>
</table>";
?>
