<?
echo
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"740px\">
<tr>
<td height=\"10px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"600px\">
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"6\" align=\"center\">
<tr>
<td class=\"centralni_nadpis\">Akce</td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td height=\"20px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\">Tato sekce slouží pro popis připravovaných ackí.</td>
  </tr>
</table>
</td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td height=\"10px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"609px\" height=\"38px\">
  <tr>
    <td class=\"pozadi_bezici_text\" align=\"center\"><div style=\"width: 592px; height: 0px\"><marquee scrolldelay=\"20\" truespeed scrollamount=\"1\">".stripslashes(JezdiciTextAkce("administrace"))."</marquee></div></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td height=\"20px\"></td>
  </tr>
</table>

".VypisAkci("administrace")."

";
/*
<table border=\"1\" cellspacing=\"2\" cellpadding=\"3\" align=\"center\" width=\"720px\" borderColorDark=\"black\" borderColorLight=\"black\">
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_fotografie\"><img src=\"obr/logo001.jpg\" border=\"1\"></td>
    <td align=\"center\" valign=\"top\" rowspan=\"4\" width=\"100%\" class=\"prechod_tabulka_akce\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td height=\"106px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td class=\"vel1\">Grilování selat</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td height=\"10px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\" class=\"akce_font\">Rádi by jsme Vás pozvali na akci grilování selat, která se uskuteční v sobotu 14.11.2007, jste srdečně zváni.</td>
  </tr>
</table>
  </td>
    <td align=\"center\" class=\"prechod_tabulka_fotografie\"><img src=\"obr/logo_rybarska_basta_misto_obrazku.jpg\" border=\"1\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_fotografie\"><img src=\"obr/logo_rybarska_basta_misto_obrazku.jpg\" border=\"1\"></td>
    <td align=\"center\" class=\"prechod_tabulka_fotografie\"><img src=\"obr/logo004.jpg\" border=\"1\"></td>
  </tr>
</table>



<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td height=\"20px\"></td>
  </tr>
</table>


<table border=\"1\" cellspacing=\"2\" cellpadding=\"3\" align=\"center\" width=\"720px\" borderColorDark=\"black\" borderColorLight=\"black\">
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_fotografie\"><img src=\"obr/logo_rybarska_basta_misto_obrazku.jpg\" border=\"1\"></td>
    <td align=\"center\" valign=\"top\" rowspan=\"4\" width=\"100%\" class=\"prechod_tabulka_akce\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td height=\"106px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td class=\"vel1\">Nadpis druhé akce</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td height=\"10px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\" class=\"akce_font\">Zde je ilustrativní popis druhé akce.</td>
  </tr>
</table>
  </td>
    <td align=\"center\" class=\"prechod_tabulka_fotografie\"><img src=\"obr/logo002.jpg\" border=\"1\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_fotografie\"><img src=\"obr/logo003.jpg\" border=\"1\"></td>
    <td align=\"center\" class=\"prechod_tabulka_fotografie\"><img src=\"obr/logo_rybarska_basta_misto_obrazku.jpg\" border=\"1\"></td>
  </tr>
</table>


<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td height=\"20px\"></td>
  </tr>
</table>


<table border=\"1\" cellspacing=\"2\" cellpadding=\"3\" align=\"center\" width=\"720px\" borderColorDark=\"black\" borderColorLight=\"black\">
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_fotografie\"><img src=\"obr/logo_rybarska_basta_misto_obrazku.jpg\" border=\"1\"></td>
    <td align=\"center\" valign=\"top\" rowspan=\"4\" width=\"100%\" class=\"prechod_tabulka_akce\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td height=\"106px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td class=\"vel1\">Nadpis třetí akce</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td height=\"10px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
  <tr>
    <td align=\"center\" class=\"akce_font\">Zde je ilustrativní popis druhé akce.</td>
  </tr>
</table>
  </td>
    <td align=\"center\" class=\"prechod_tabulka_fotografie\"><img src=\"obr/logo_rybarska_basta_misto_obrazku.jpg\" border=\"1\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"prechod_tabulka_fotografie\"><img src=\"obr/logo_rybarska_basta_misto_obrazku.jpg\" border=\"1\"></td>
    <td align=\"center\" class=\"prechod_tabulka_fotografie\"><img src=\"obr/logo_rybarska_basta_misto_obrazku.jpg\" border=\"1\"></td>
  </tr>
</table>";
*/

/*
text PO - NE: 10.00 - 24.00 hod. se bude upravovat v adminu
jidelnicek: <a href=\"menu.doc\">Menu</a><br> se bude uploadovat a mazat !!!

borderColorDark=black borderColorLight=black style="border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;"


*/
?>
