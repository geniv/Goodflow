<?
echo
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td height=\"10px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"6\" align=\"center\">
<tr>
<td class=\"centralni_nadpis\">Aktuality</td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td height=\"10px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"740px\">
<tr>
<td align=\"left\">

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"700px\">
<tr>
<td align=\"center\">
V této sekci naleznete nejnovější informace o přehledu připravovaných akcí od týmu rybníku Balaton
</td>
</tr>
</table>
<br>

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"609px\" height=\"38px\">
<tr>
<td class=\"pozadi_bezici_text\" align=\"center\"><div style=\"width: 592px; height: 0px\"><marquee scrolldelay=\"20\" truespeed scrollamount=\"1\">".stripslashes(JezdiciTextUvodAktuality("administrace"))."</marquee></div></td>
</tr>
</table>
<br>
".VypisAktualitu("administrace")."
</td>
</tr>
</table>";
/*
------------------------------------------------------------------------------------------------------------------
tato tabulka se bude pridavat, menit, mazat

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"700px\">
<tr>
<td align=\"left\">
<u>SOS RYBÁŘSKÉ POTŘEBY</u><br><br>
<u>15. Srpna 2006</u><br>
14.8.2006 Jsme pro zapomnětlivé rybáře ve spolupráci s rybářskou speciálkou Zábranský spustili SOS prodej drobností a krmení pro ryby.
Brčka, háčky, olova, návazce, silony, atd..
</td>
</tr>
</table>
<hr>
------------------------------------------------------------------------------------------------------------------
a bude to rozdeleno na:

NADPIS (<u>SOS RYBÁŘSKÉ POTŘEBY</u><br><br>)

DATUM (<u>15. Srpna 2006</u><br>)

TEXT (14.8.2006 Jsme pro zapomnětlivé rybáře ve spolupráci s rybářskou speciálkou Zábranský spustili SOS prodej drobností a krmení pro ryby.
Brčka, háčky, olova, návazce, silony, atd..)
------------------------------------------------------------------------------------------------------------------
*/
?>
