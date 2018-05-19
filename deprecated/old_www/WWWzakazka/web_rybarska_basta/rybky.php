<?
$pole = NactiRybky("administrace");
echo
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td height=\"10px\"></td>
</tr>
</table>

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"740px\">
<tr>
<td align=\"center\" class=\"centralni_nadpis\">Prodej nástražných ryb</td>
</tr>
</table>

<br>
<br>

  <table align=\"center\" cellspacing=\"0\" cellpadding=\"0\" id=\"tabulka_rybky\">
    <tr class=\"prvni\">
      <td class=\"mensi_border_right\">Druh</td>
      <td class=\"mensi_border_left_right\">Cena 6 - 8 cm</td>
      <td class=\"mensi_border_left\">Cena 8 - 12 cm</td>
      <td class=\"obrazek_tabulka\"></td>
    </tr>
    <tr class=\"odtuceni_zespodu\">
      <td class=\"mensi_border_right\">{$pole[0]}</td>
      <td class=\"mensi_border_left_right\">{$pole[1]}</td>
      <td class=\"mensi_border_left\">{$pole[2]}</td>
      <td class=\"obrazek_tabulka obrazek_perlin\"></td>
    </tr>
    <tr class=\"odtuceni_zespodu odtuceni_zvrchu\">
      <td class=\"mensi_border_right\">{$pole[3]}</td>
      <td class=\"mensi_border_left_right\">{$pole[4]}</td>
      <td class=\"mensi_border_left\">{$pole[5]}</td>
      <td class=\"obrazek_tabulka obrazek_lin\"></td>
    </tr>
    <tr class=\"odtuceni_zespodu odtuceni_zvrchu\">
      <td class=\"mensi_border_right\">{$pole[6]}</td>
      <td class=\"mensi_border_left_right\">{$pole[7]}</td>
      <td class=\"mensi_border_left\">{$pole[8]}</td>
      <td class=\"obrazek_tabulka obrazek_karas\"></td>
    </tr>
    <tr class=\"odtuceni_zvrchu\">
      <td class=\"mensi_border_right\">{$pole[9]}</td>
      <td class=\"mensi_border_left_right\">{$pole[10]}</td>
      <td class=\"mensi_border_left\">{$pole[11]}</td>
      <td class=\"obrazek_tabulka obrazek_zralok\"></td>
    </tr>
  </table>
<br>



<table border=\"0\" align=\"left\" cellspacing=\"0\" cellpadding=\"0\" style=\"margin-left: 60px;\">
  <tr>
    <td align=\"center\" colspan=\"3\" height=\"20px\"></td>
  </tr>
  <tr>
    <td>Prodejní dny: Po - Pá, So</td>
  </tr>
</table>

<br /><br />

<table border=\"0\" align=\"left\" cellspacing=\"0\" cellpadding=\"0\" style=\"margin-left: 60px;\">
  <tr>
    <td align=\"center\" colspan=\"3\" height=\"10px\"></td>
  </tr>
  <tr>
    <td>Prodej ryb přímo na rybníku od {$pole[12]}</td>
  </tr>
</table>

<br /><br />

<table border=\"0\" align=\"left\" cellspacing=\"0\" cellpadding=\"0\" style=\"margin-left: 60px;\">
  <tr>
    <td align=\"center\" colspan=\"3\" height=\"20px\"></td>
  </tr>
  <tr>
    <td style=\"text-decoration: underline; color: #0066BA;\">Rozvoz</td>
  </tr>
</table>

<br /><br />

<table border=\"0\" align=\"left\" cellspacing=\"0\" cellpadding=\"0\" style=\"margin-left: 60px;\">
  <tr>
    <td>Při odběru 500 kusů a více cena za <span style=\"color: #255586;\">1km ....... {$pole[13]}</span></td>
  </tr>
</table>

<br />

<table border=\"0\" align=\"left\" cellspacing=\"0\" cellpadding=\"0\" style=\"margin-left: 60px;\">
  <tr>
    <td>Při odběru 1000 kusů a více cena za <span style=\"color: #255586;\">1km ...... {$pole[14]}</span></td>
  </tr>
</table>

<br />

<table border=\"0\" align=\"left\" cellspacing=\"0\" cellpadding=\"0\" style=\"margin-left: 60px;\">
  <tr>
    <td>Při odběru více než 1000 kusů cena za <span style=\"color: #255586;\">1km ... {$pole[15]}</span></td>
  </tr>
</table>




<br /><br />


<table border=\"0\" align=\"left\" cellspacing=\"0\" cellpadding=\"0\" style=\"margin-left: 60px;\">
  <tr>
    <td align=\"center\" colspan=\"3\" height=\"20px\"></td>
  </tr>
  <tr>
    <td>Objednávky na e-mailu: <a href=\"mailto:rybarskabasta@centrum.cz\">rybarskabasta@centrum.cz</a>,</td>
  </tr>
  <tr>
    <td>nebo na telefoních číslech: <span style=\"color: #0066BA;\">604 204 442</span>, <span style=\"color: #0066BA;\">777 597 421</span></td>
  </tr>
</table>

<br /><br /><br /><br />

<table border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td><img src=\"obr/obrazek_rybky_1.png\" alt=\"obrazek_rybky_1\" width=\"230px\" height=\"170px\" border=\"2\" /></td>
    <td>&nbsp;</td>
    <td><img src=\"obr/obrazek_rybky_2.png\" alt=\"obrazek_rybky_2\" width=\"230px\" height=\"170px\" border=\"2\" /></td>
    <td>&nbsp;</td>
    <td><img src=\"obr/obrazek_rybky_3.png\" alt=\"obrazek_rybky_3\" width=\"230px\" height=\"170px\" border=\"2\" /></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"3\" height=\"10px\"></td>
  </tr>
  <tr>
    <td colspan=\"5\" align=\"center\">
      <img src=\"obr/obrazek_rybky_4.png\" alt=\"obrazek_rybky_1\" width=\"230px\" height=\"170px\" border=\"2\" />
      <img src=\"obr/obrazek_rybky_5.png\" alt=\"obrazek_rybky_2\" width=\"230px\" height=\"170px\" border=\"2\" />
    </td>
  </tr>
</table>








";
?>
