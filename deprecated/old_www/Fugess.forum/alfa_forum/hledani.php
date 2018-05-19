<?
echo
"<form action=\"search.php?mode=results\" method=\"POST\"> 
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
      <td colspan=\"3\">
        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
          <tr>
            <td width=\"0%\"><img src=\"images/cat_lcap.gif\" width=\"22\" height=\"51\"></td>
            <td width=\"100%\" background=\"images/cat_bar.jpg\" valign=\"top\">
              <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" height=\"100%\">
                <tr>
                  <td class=\"cBarStart\" valign=\"top\">
                    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                      <tr>
                        <td valign=\"top\"><img src=\"images/cat_arrow.gif\" width=\"25\" height=\"39\"></td>
                        <td class=\"cattitle\">Hledaný řetězec</td>
                      </tr>
                    </table>
                  </td>
                  <td><img src=\"images/spacer.gif\" width=\"1\" height=\"51\"></td>
                </tr>
              </table>
            </td>
            <td width=\"0%\"><img src=\"images/cat_rcap.gif\" width=\"33\" height=\"51\"></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td width=\"0%\"><img src=\"images/spacer.gif\" width=\"16\" height=\"22\"></td>
      <td width=\"100%\">
        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
          <tr>
            <td width=\"0%\" class=\"cboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
            <td width=\"100%\" class=\"cbox\">

              <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                <tr>
                  <td class=\"cBoxStart\">

                    <table width=\"100%\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\">
                      <tr>
                        <td class=\"row1\" width=\"50%\"><span class=\"gen\">Klíčová slova:</span><br>
                          <span class=\"gensmall\">Můžete použít <u>AND</u> pro slova, která musí být ve výsledcích, <u>OR</u> pro taková, která tam mohou náležet a <u>NOT</u> pro taková, která by ve výsledcích neměla být. Znak \"*\" nahradí část řetězce při vyhledávání.</span></td>
                        <td class=\"row2\" valign=\"top\" width=\"50%\"><span class=\"genmed\">
                          <input type=\"text\" style=\"width: 300px\" class=\"post\" name=\"search_keywords\" size=\"30\">
                          <br>
                          <input type=\"radio\" class=\"checkbox\" name=\"search_terms\" value=\"any\" checked>
                          Hledej kterékoliv slovo nebo výraz jak je zadaný<br>
                          <input type=\"radio\" class=\"checkbox\" name=\"search_terms\" value=\"all\">
                          Hledej všechna slova</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\" width=\"50%\">&nbsp;</td>
                        <td class=\"row2\" width=\"50%\">&nbsp;</td>
                      </tr>
                      <tr>
                        <td class=\"row1\" width=\"50%\"><span class=\"gen\">Autora:</span><br>
                          <span class=\"gensmall\">Znak \"*\" nahradí část řetězce při vyhledávání.</span></td>
                        <td class=\"row2\" width=\"50%\"><span class=\"genmed\">
                          <input type=\"text\" style=\"width: 300px\" class=\"post\" name=\"search_author\" size=\"30\">
                          </span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\" width=\"50%\">&nbsp;</td>
                        <td class=\"row2\" width=\"50%\">&nbsp;</td>
                      </tr>
                    </table>

                 </td>
                </tr>
              </table>

  </td>
    <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>
  	<tr>
		<td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
	</tr>

	<tr>
		<td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"genBox\">

              <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                <tr>
                  <td class=\"genBoxStart\">

                    <table class=\"forumline\" width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">
                      <tr>
                        <th class=\"thHead\" colspan=\"4\" height=\"25\">Možnosti hledání</th>
                      </tr>
					</table>

                 </td>
                </tr>
              </table>

  </td>
    <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>
  	<tr>
		<td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
	</tr>

	<tr>
		<td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"genBox\">

              <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                <tr>
                  <td class=\"genBoxStart\" style=\"padding-top: 15px\">

                    <table class=\"forumline\" width=\"100%\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\">
                      <tr>
                        <td class=\"row1\" align=\"right\"><span class=\"gen\">Fórum:&nbsp;</span></td>
                        <td class=\"row2\"><span class=\"genmed\">
                          <select class=\"post\" name=\"search_forum\"><option value=\"-1\">Všechny dostupné</option><option value=\"1\">Stručný popis fóra</option><option value=\"2\">Návrhy a řešení</option><option value=\"3\">Stavba objektů</option><option value=\"4\">Projekty</option><option value=\"5\">Tutoriály</option><option value=\"6\">Programy</option><option value=\"12\">3D Grafika</option><option value=\"9\">Elektro výrobky</option><option value=\"10\">Schémata</option><option value=\"11\">Unikátní fotky a videa</option><option value=\"7\">Reálná železnice</option><option value=\"8\">Modelová železnice</option>
                          </select>
                          </span></td>
                        <td class=\"row1\" align=\"right\" nowrap valign=\"top\"><span class=\"gen\">Prohledej předchozí:&nbsp;</span></td>
                        <td class=\"row2\" valign=\"middle\"><span class=\"genmed\">
                          <select class=\"post\" name=\"search_time\"><option value=\"0\" selected=\"selected\">Všechny příspěvky</option><option value=\"1\">1 den</option><option value=\"7\">1 týden</option><option value=\"14\">2 týdny</option><option value=\"30\">1 měsíc</option><option value=\"90\">3 měsíce</option><option value=\"180\">6 měsíců</option><option value=\"364\">1 rok</option>
                          </select>
                          <br>
                          <input type=\"radio\" class=\"checkbox\" name=\"search_fields\" value=\"all\" checked>
                          Hledej název tématu a text zprávy<br>
                          <input type=\"radio\" class=\"checkbox\" name=\"search_fields\" value=\"msgonly\">
                          Hledat jen text zprávy</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\" align=\"right\"><span class=\"gen\">Kategorie:&nbsp;</span></td>
                        <td class=\"row2\"><span class=\"genmed\">
                          <select class=\"post\" name=\"search_cat\"><option value=\"-1\">Všechny dostupné</option><option value=\"2\">Všeobecné informace o fóru</option><option value=\"3\">TRS 2004 2006</option><option value=\"4\">Grafika</option><option value=\"5\">Elektro</option><option value=\"6\">Ostatní</option>
		                  </select>
                          </span></td>
                        <td class=\"row1\" align=\"right\" valign=\"top\"><span class=\"gen\">Setřídit dle:&nbsp;</span></td>
                        <td class=\"row2\" valign=\"middle\" nowrap><span class=\"genmed\">
                          <select class=\"post\" name=\"sort_by\"><option value=\"0\">Čas odeslání</option><option value=\"1\">Předmětu</option><option value=\"2\">Hlavičky tématu</option><option value=\"3\">Autora</option><option value=\"4\">Fóra</option>
                          </select>
                          <br>
                          <input type=\"radio\" class=\"checkbox\" name=\"sort_dir\" value=\"ASC\">
                          Vzestupně<br>
                          <input type=\"radio\" class=\"checkbox\" name=\"sort_dir\" value=\"DESC\" checked>
                          Sestupně</span>&nbsp;</td>
                      </tr>
                      <tr>
                        <td class=\"row1\" align=\"right\" nowrap><span class=\"gen\">Zobrazit výsledek jako:&nbsp;</span></td>
                        <td class=\"row2\" nowrap>
                          <input type=\"radio\" class=\"checkbox\" name=\"show_results\" value=\"posts\">
                          <span class=\"genmed\">Příspěvky
                          <input type=\"radio\" class=\"checkbox\" name=\"show_results\" value=\"topics\" checked>
                          Témata</span></td>
                        <td class=\"row1\" align=\"right\" valign=\"top\"><span class=\"gen\">Zobraz prvních</span></td>
                        <td class=\"row2\" style=\"padding-bottom: 15px\"><span class=\"genmed\">
                          <select class=\"post\" name=\"return_chars\"><option value=\"-1\">Všechny dostupné</option><option value=\"0\">0</option><option value=\"25\">25</option><option value=\"50\">50</option><option value=\"100\">100</option><option value=\"200\" selected=\"selected\">200</option><option value=\"300\">300</option><option value=\"400\">400</option><option value=\"500\">500</option><option value=\"600\">600</option><option value=\"700\">700</option><option value=\"800\">800</option><option value=\"900\">900</option><option value=\"1000\">1000</option>
                          </select>
                          znaků z příspěvku</span>
						</td>
                        </tr>
                </table>

                </td>
             </tr>
         </table>

  </td>
    <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>
  	<tr>
		<td width=\"0%\" class=\"mainboxMiddleleft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"mainboxMiddlecenter\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"0%\" class=\"mainboxMiddleright\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
	</tr>

	<tr>
		<td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"genBox\">

              <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                <tr>
                  <td class=\"genBoxStart\">

                   <table cellspacing=\"0\" width=\"100%\">
                      <tr>
                        <td class=\"catBottom\" align=\"center\" height=\"28\"><input class=\"liteoption\" type=\"submit\" value=\"Hledat\" name=\"submit\"></td>
                      </tr>
                    </table>

                  </td>
                </tr>
              </table>

            </td>
            <td width=\"0%\" class=\"cboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
          </tr>
          <tr>
            <td width=\"0%\" class=\"cboxLeftbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
            <td width=\"100%\" valign=\"top\" class=\"cboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
            <td width=\"0%\" class=\"cboxRightbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
          </tr>
        </table>

      </td>
      <td class=\"catbox_right\"><img src=\"images/spacer.gif\" width=\"27\" height=\"27\"></td>
    </tr>
  </table>

  <table width=\"100%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\" align=\"center\">
	<tr>
		<td align=\"right\" valign=\"middle\"><span class=\"gensmall\">Časy uváděny v GMT + 1 hodina</span></td>
	</tr>
</table>

</form>

<table width=\"100%\" border=\"0\">
	<tr>
		<td align=\"right\" valign=\"top\">
<form method=\"get\" name=\"jumpbox\" action=\"viewforum.php\" onSubmit=\"if(document.jumpbox.f.value == -1){return false;}\"><table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
	<tr>
		<td nowrap=\"nowrap\"><span class=\"gensmall\">Přejdi na:&nbsp;<select name=\"f\" onchange=\"if(this.options[this.selectedIndex].value != -1){ forms['jumpbox'].submit() }\"><option value=\"-1\">Zvolte fórum</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">Všeobecné informace o fóru</option><option value=\"-1\">----------------</option><option value=\"1\">Stručný popis fóra</option><option value=\"2\">Návrhy a řešení</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">TRS 2004 2006</option><option value=\"-1\">----------------</option><option value=\"3\">Stavba objektů</option><option value=\"4\">Projekty</option><option value=\"5\">Tutoriály</option><option value=\"6\">Programy</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">Grafika</option><option value=\"-1\">----------------</option><option value=\"12\">3D Grafika</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">Elektro</option><option value=\"-1\">----------------</option><option value=\"9\">Elektro výrobky</option><option value=\"10\">Schémata</option><option value=\"11\">Unikátní fotky a videa</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">Ostatní</option><option value=\"-1\">----------------</option><option value=\"7\">Reálná železnice</option><option value=\"8\">Modelová železnice</option></select><input type=\"hidden\" name=\"sid\" value=\"b997929478a956914d7baab13f779a96\">&nbsp;<input type=\"submit\" value=\"jdi\" class=\"liteoption\"></span></td>
	</tr>
</table></form>

</td>
	</tr>
</table>


<div align=\"center\">
	<p>
		<span class=\"copyright\">
			<a href=\"admin/index.php?sid=b997929478a956914d7baab13f779a96\">Administrace fóra</a><br><br>
		</span>
	</p></div>";
?>
********* hled�n� ************
