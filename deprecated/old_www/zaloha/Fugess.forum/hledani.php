<?
if(!Empty($Jmeno_r) and !Empty($Heslo_r) and login($Jmeno_r,$Heslo_r)=="true")
{
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
                        <td class=\"cattitle\">Hledan� �et�zec</td>
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
                        <td class=\"row1\" width=\"50%\"><span class=\"gen\">Kl��ov� slova:</span><br>
                          <span class=\"gensmall\">M��ete pou��t <u>AND</u> pro slova, kter� mus� b�t ve v�sledc�ch, <u>OR</u> pro takov�, kter� tam mohou n�le�et a <u>NOT</u> pro takov�, kter� by ve v�sledc�ch nem�la b�t. Znak \"*\" nahrad� ��st �et�zce p�i vyhled�v�n�.</span></td>
                        <td class=\"row2\" valign=\"top\" width=\"50%\"><span class=\"genmed\">
                          <input type=\"text\" style=\"width: 300px\" class=\"post\" name=\"search_keywords\" size=\"30\">
                          <br>
                          <input type=\"radio\" class=\"checkbox\" name=\"search_terms\" value=\"any\" checked>
                          Hledej kter�koliv slovo nebo v�raz jak je zadan�<br>
                          <input type=\"radio\" class=\"checkbox\" name=\"search_terms\" value=\"all\">
                          Hledej v�echna slova</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\" width=\"50%\">&nbsp;</td>
                        <td class=\"row2\" width=\"50%\">&nbsp;</td>
                      </tr>
                      <tr>
                        <td class=\"row1\" width=\"50%\"><span class=\"gen\">Autora:</span><br>
                          <span class=\"gensmall\">Znak \"*\" nahrad� ��st �et�zce p�i vyhled�v�n�.</span></td>
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
                        <th class=\"thHead\" colspan=\"4\" height=\"25\">Mo�nosti hled�n�</th>
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
                        <td class=\"row1\" align=\"right\"><span class=\"gen\">F�rum:&nbsp;</span></td>
                        <td class=\"row2\"><span class=\"genmed\">
                          <select class=\"post\" name=\"search_forum\"><option value=\"-1\">V�echny dostupn�</option><option value=\"1\">Stru�n� popis f�ra</option><option value=\"2\">N�vrhy a �e�en�</option><option value=\"3\">Stavba objekt�</option><option value=\"4\">Projekty</option><option value=\"5\">Tutori�ly</option><option value=\"6\">Programy</option><option value=\"12\">3D Grafika</option><option value=\"9\">Elektro v�robky</option><option value=\"10\">Sch�mata</option><option value=\"11\">Unik�tn� fotky a videa</option><option value=\"7\">Re�ln� �eleznice</option><option value=\"8\">Modelov� �eleznice</option>
                          </select>
                          </span></td>
                        <td class=\"row1\" align=\"right\" nowrap valign=\"top\"><span class=\"gen\">Prohledej p�edchoz�:&nbsp;</span></td>
                        <td class=\"row2\" valign=\"middle\"><span class=\"genmed\">
                          <select class=\"post\" name=\"search_time\"><option value=\"0\" selected=\"selected\">V�echny p��sp�vky</option><option value=\"1\">1 den</option><option value=\"7\">1 t�den</option><option value=\"14\">2 t�dny</option><option value=\"30\">1 m�s�c</option><option value=\"90\">3 m�s�ce</option><option value=\"180\">6 m�s�c�</option><option value=\"364\">1 rok</option>
                          </select>
                          <br>
                          <input type=\"radio\" class=\"checkbox\" name=\"search_fields\" value=\"all\" checked>
                          Hledej n�zev t�matu a text zpr�vy<br>
                          <input type=\"radio\" class=\"checkbox\" name=\"search_fields\" value=\"msgonly\">
                          Hledat jen text zpr�vy</span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\" align=\"right\"><span class=\"gen\">Kategorie:&nbsp;</span></td>
                        <td class=\"row2\"><span class=\"genmed\">
                          <select class=\"post\" name=\"search_cat\"><option value=\"-1\">V�echny dostupn�</option><option value=\"2\">V�eobecn� informace o f�ru</option><option value=\"3\">TRS 2004 2006</option><option value=\"4\">Grafika</option><option value=\"5\">Elektro</option><option value=\"6\">Ostatn�</option>
		                  </select>
                          </span></td>
                        <td class=\"row1\" align=\"right\" valign=\"top\"><span class=\"gen\">Set��dit dle:&nbsp;</span></td>
                        <td class=\"row2\" valign=\"middle\" nowrap><span class=\"genmed\">
                          <select class=\"post\" name=\"sort_by\"><option value=\"0\">�as odesl�n�</option><option value=\"1\">P�edm�tu</option><option value=\"2\">Hlavi�ky t�matu</option><option value=\"3\">Autora</option><option value=\"4\">F�ra</option>
                          </select>
                          <br>
                          <input type=\"radio\" class=\"checkbox\" name=\"sort_dir\" value=\"ASC\">
                          Vzestupn�<br>
                          <input type=\"radio\" class=\"checkbox\" name=\"sort_dir\" value=\"DESC\" checked>
                          Sestupn�</span>&nbsp;</td>
                      </tr>
                      <tr>
                        <td class=\"row1\" align=\"right\" nowrap><span class=\"gen\">Zobrazit v�sledek jako:&nbsp;</span></td>
                        <td class=\"row2\" nowrap>
                          <input type=\"radio\" class=\"checkbox\" name=\"show_results\" value=\"posts\">
                          <span class=\"genmed\">P��sp�vky
                          <input type=\"radio\" class=\"checkbox\" name=\"show_results\" value=\"topics\" checked>
                          T�mata</span></td>
                        <td class=\"row1\" align=\"right\" valign=\"top\"><span class=\"gen\">Zobraz prvn�ch</span></td>
                        <td class=\"row2\" style=\"padding-bottom: 15px\"><span class=\"genmed\">
                          <select class=\"post\" name=\"return_chars\"><option value=\"-1\">V�echny dostupn�</option><option value=\"0\">0</option><option value=\"25\">25</option><option value=\"50\">50</option><option value=\"100\">100</option><option value=\"200\" selected=\"selected\">200</option><option value=\"300\">300</option><option value=\"400\">400</option><option value=\"500\">500</option><option value=\"600\">600</option><option value=\"700\">700</option><option value=\"800\">800</option><option value=\"900\">900</option><option value=\"1000\">1000</option>
                          </select>
                          znak� z p��sp�vku</span>
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



</form>


";
}
else
{
echo "<body onload=\"nalog.click();\"><a name=\"nalog\" href=\"index.php?kam=login\"></a></body>";
}
?>
