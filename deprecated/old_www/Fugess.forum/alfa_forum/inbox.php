<?
echo
"<script language=\"Javascript\" type=\"text/javascript\">
	//
	// Should really check the browser to stop this whining ...
	//
	function select_switch(status)
	{
		for (i = 0; i < document.privmsg_list.length; i++)
		{
			document.privmsg_list.elements[i].checked = status;
		}
	}
</script>

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
	<td valign=\"top\" align=\"center\" width=\"100%\">
	  <div class=\"pmFolderLinks\">
            <table cellspacing=\"2\" cellpadding=\"0\" border=\"0\" align=\"center\">
              <tr>
            	<td valign=\"middle\"><img src=\"images/msg_inbox.gif\" border=\"0\" alt=\"Doručené\"></td>
            	<td valign=\"middle\"><span class=\"gen\"><b>Doručené</b>&nbsp;&nbsp;</span></td>
            	<td valign=\"middle\"><a href=\"privmsg.php?folder=sentbox\"><img src=\"images/msg_sentbox.gif\" border=\"0\" alt=\"Odeslané\"></a></td>
            	<td valign=\"middle\"><span class=\"gen\"><b><a href=\"privmsg.php?folder=sentbox\">Odeslané</a></b>&nbsp;&nbsp;</span></td>
            	<td valign=\"middle\"><a href=\"privmsg.php?folder=outbox\"><img src=\"images/msg_outbox.gif\" border=\"0\" alt=\"Nedoručené\"></a></td>
            	<td valign=\"middle\"><span class=\"gen\"><b><a href=\"privmsg.php?folder=outbox\">Nedoručené</a></b>&nbsp;&nbsp;</span></td>
            	<td valign=\"middle\"><a href=\"privmsg.php?folder=savebox\"><img src=\"images/msg_savebox.gif\" border=\"0\" alt=\"Uložené\"></a></td>
            	<td valign=\"middle\"><span class=\"gen\"><b><a href=\"privmsg.php?folder=savebox\">Uložené</a></b></span></td>
              </tr>
            </table>
	  </div>
	</td>
	<td align=\"right\">


<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
  <tr>
    <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"100%\" class=\"mainboxTop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>
  <tr>
		<td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" class=\"privmsgsBox\">



			  <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
				<tr>
				  <td class=\"privmsgsBoxStart\">



					  <table width=\"175\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\">
						<tr>
						  <td colspan=\"3\" width=\"100%\" class=\"row1\" nowrap><span class=\"gensmall\">Schránka je zaplněna z 0%.</span></td>
						</tr>
						<tr>
						  <td colspan=\"3\" width=\"100%\" class=\"row2\">

							<table cellspacing=\"0\" cellpadding=\"1\" border=\"0\">
							  <tr>
								<td bgcolor=\"#FFFFFF\"><img src=\"images/spacer.gif\" width=\"0\" height=\"8\" alt=\"0\"></td>
							  </tr>
							</table>

						  </td>
						</tr>
						<tr>
						  <td width=\"33%\" class=\"row1\"><span class=\"gensmall\">0%</span></td>
						  <td width=\"34%\" align=\"center\" class=\"row1\"><span class=\"gensmall\">50%</span></td>
						  <td width=\"33%\" align=\"right\" class=\"row1\"><span class=\"gensmall\">100%</span></td>
						</tr>
					  </table>

				  </td>
				</tr>
			  </table>



		</td>
    	<td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>
  <tr>
    	<td width=\"0%\" class=\"mainboxLeftbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
		<td width=\"0%\" class=\"mainboxRightbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
  </tr>
</table>





	</td>
  </tr>
</table>

<br clear=\"all\">

<form method=\"post\" name=\"privmsg_list\" action=\"privmsg.php?folder=inbox\">
  <table width=\"100%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\" align=\"center\">
	<tr>
	  <td align=\"left\" valign=\"middle\"><a href=\"privmsg.php?mode=post\"><img src=\"images/lang_english/msg_newpost.gif\" alt=\"Poslat zprávu\" border=\"0\"></a></td>
	  <td align=\"left\" width=\"100%\">&nbsp;<span class=\"nav\"><a href=\"index.php\" class=\"nav\">Obsah fóra Fugessovo fórum</a></span></td>
	  <td align=\"right\" nowrap><span class=\"gensmall\">Zobrazit zprávy za předchozí:
		<select name=\"msgdays\"><option value=\"0\" selected=\"selected\">Všechny příspěvky</option><option value=\"1\">1 den</option><option value=\"7\">1 týden</option><option value=\"14\">2 týdny</option><option value=\"30\">1 měsíc</option><option value=\"90\">3 měsíce</option><option value=\"180\">6 měsíců</option><option value=\"364\">1 rok</option></select>
		<input type=\"submit\" value=\"jdi\" name=\"submit_msgdays\" class=\"liteoption\">
		</span></td>
	</tr>
  </table>

  <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
    <tr>
      <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
      <td width=\"100%\" class=\"mainboxTop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
      <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    </tr>
    <tr>
      <td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
      <td width=\"100%\" class=\"privmsgsBox\">

        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
          <tr>
            <td class=\"privmsgsBoxStart\">
              <table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\" class=\"forumline\">
                <tr>
                  <th width=\"25\" height=\"25\" class=\"thCornerL\" nowrap>&nbsp;Příznak&nbsp;</th>
                  <th width=\"60%\" class=\"thTop\" nowrap>&nbsp;Předmět&nbsp;</th>
                  <th width=\"25%\" class=\"thTop\" nowrap>&nbsp;Od&nbsp;</th>
                  <th width=\"15%\" class=\"thTop\" nowrap>&nbsp;Datum&nbsp;</th>
                  <th width=\"25\" class=\"thCornerR\" nowrap>&nbsp;Označit&nbsp;</th>
                </tr>
                <tr>
                  <td class=\"row1\" colspan=\"5\" align=\"center\" valign=\"middle\"><span class=\"gen\"><p>Nemáte žádné zprávy v této složce.</p></span></td>
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
      <td width=\"100%\" class=\"privmsgsBox\">

        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
          <tr>
            <td class=\"privmsgsBoxStart\">
              <table width=\"100%\" border=\"0\" cellspacing=\"0\">
                <tr>
                  <td class=\"catBottom\" colspan=\"5\" height=\"28\" align=\"right\">
                    
                    <input type=\"submit\" name=\"save\" value=\"Uložit označené\" class=\"mainoption\">
                    &nbsp;
                    <input type=\"submit\" name=\"delete\" value=\"Odstranit označené\" class=\"liteoption\">
                    &nbsp;
                    <input type=\"submit\" name=\"deleteall\" value=\"Odstranit vše\" class=\"liteoption\">&nbsp;
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
      <td width=\"0%\" class=\"mainboxLeftbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
      <td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
      <td width=\"0%\" class=\"mainboxRightbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
    </tr>
  </table>
  <table width=\"100%\" cellspacing=\"2\" border=\"0\" align=\"center\" cellpadding=\"2\">
	<tr>
	  <td align=\"left\" valign=\"middle\" class=\"tdNewImgBottom\"\"><span class=\"nav\"><a href=\"privmsg.php?mode=post\"><img src=\"images/lang_english/msg_newpost.gif\" alt=\"Poslat zprávu\" border=\"0\"></a></span></td>
	  <td align=\"left\" valign=\"middle\" width=\"100%\"><span class=\"nav\"></span></td>
	  <td align=\"right\" valign=\"top\" nowrap><b><span class=\"gensmall\"><a href=\"javascript:select_switch(true);\" class=\"gensmall\">Označit vše</a> :: <a href=\"javascript:select_switch(false);\" class=\"gensmall\">Odznačit vše</a></span></b><br><span class=\"nav\"><br></span><span class=\"gensmall\">Časy uváděny v GMT + 1 hodina</span></td>
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
*********** inbox *********
