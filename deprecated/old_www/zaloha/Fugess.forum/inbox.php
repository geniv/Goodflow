<?
if(!Empty($Jmeno_r) and !Empty($Heslo_r) and login($Jmeno_r,$Heslo_r)=="true")
{
echo
"<script language=\"Javascript\" type=\"text/javascript\">

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
            	<td valign=\"middle\"><img src=\"images/msg_inbox.gif\" border=\"0\" alt=\"Doru�en�\"></td>
            	<td valign=\"middle\"><span class=\"gen\"><b>Doru�en�</b>&nbsp;&nbsp;</span></td>
            	<td valign=\"middle\"><a href=\"privmsg.php?folder=sentbox\"><img src=\"images/msg_sentbox.gif\" border=\"0\" alt=\"Odeslan�\"></a></td>
            	<td valign=\"middle\"><span class=\"gen\"><b><a href=\"privmsg.php?folder=sentbox\">Odeslan�</a></b>&nbsp;&nbsp;</span></td>
            	<td valign=\"middle\"><a href=\"privmsg.php?folder=outbox\"><img src=\"images/msg_outbox.gif\" border=\"0\" alt=\"Nedoru�en�\"></a></td>
            	<td valign=\"middle\"><span class=\"gen\"><b><a href=\"privmsg.php?folder=outbox\">Nedoru�en�</a></b>&nbsp;&nbsp;</span></td>
            	<td valign=\"middle\"><a href=\"privmsg.php?folder=savebox\"><img src=\"images/msg_savebox.gif\" border=\"0\" alt=\"Ulo�en�\"></a></td>
            	<td valign=\"middle\"><span class=\"gen\"><b><a href=\"privmsg.php?folder=savebox\">Ulo�en�</a></b></span></td>
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
						  <td colspan=\"3\" width=\"100%\" class=\"row1\" nowrap><span class=\"gensmall\">Schr�nka je zapln�na z 0%.</span></td>
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
	  <td align=\"left\" valign=\"middle\"><a href=\"privmsg.php?mode=post\"><img src=\"images/lang_english/msg_newpost.gif\" alt=\"Poslat zpr�vu\" border=\"0\"></a></td>
	  <td align=\"left\" width=\"100%\">&nbsp;<span class=\"nav\"><a href=\"index.php\" class=\"nav\">Obsah f�ra Fugessovo f�rum</a></span></td>
	  <td align=\"right\" nowrap><span class=\"gensmall\">Zobrazit zpr�vy za p�edchoz�:
		<select name=\"msgdays\">
     <option value=\"0\" selected=\"selected\">V�echny p��sp�vky</option>
     <option value=\"1\">1 den</option>
     <option value=\"7\">1 t�den</option>
     <option value=\"14\">2 t�dny</option>
     <option value=\"30\">1 m�s�c</option>
     <option value=\"90\">3 m�s�ce</option>
     <option value=\"180\">6 m�s�c�</option>
     <option value=\"364\">1 rok</option>
    </select>
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
                  <th width=\"25\" height=\"25\" class=\"thCornerL\" nowrap>&nbsp;P��znak&nbsp;</th>
                  <th width=\"60%\" class=\"thTop\" nowrap>&nbsp;P�edm�t&nbsp;</th>
                  <th width=\"25%\" class=\"thTop\" nowrap>&nbsp;Od&nbsp;</th>
                  <th width=\"15%\" class=\"thTop\" nowrap>&nbsp;Datum&nbsp;</th>
                  <th width=\"25\" class=\"thCornerR\" nowrap>&nbsp;Ozna�it&nbsp;</th>
                </tr>
                <tr>
                  <td class=\"row1\" colspan=\"5\" align=\"center\" valign=\"middle\">
                    <span class=\"gen\"><p>Nem�te ��dn� zpr�vy v t�to slo�ce.</p></span>
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
      <td width=\"100%\" class=\"privmsgsBox\">

        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
          <tr>
            <td class=\"privmsgsBoxStart\">
              <table width=\"100%\" border=\"0\" cellspacing=\"0\">
                <tr>
                  <td class=\"catBottom\" colspan=\"5\" height=\"28\" align=\"right\">
                    
                    <input type=\"submit\" name=\"save\" value=\"Ulo�it ozna�en�\" class=\"mainoption\">
                    &nbsp;
                    <input type=\"submit\" name=\"delete\" value=\"Odstranit ozna�en�\" class=\"liteoption\">
                    &nbsp;
                    <input type=\"submit\" name=\"deleteall\" value=\"Odstranit v�e\" class=\"liteoption\">&nbsp;
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
	  <td align=\"left\" valign=\"middle\" class=\"tdNewImgBottom\"\"><span class=\"nav\"><a href=\"privmsg.php?mode=post\"><img src=\"images/lang_english/msg_newpost.gif\" alt=\"Poslat zpr�vu\" border=\"0\"></a></span></td>
	  <td align=\"left\" valign=\"middle\" width=\"100%\"><span class=\"nav\"></span></td>
	  <td align=\"right\" valign=\"top\" nowrap><b><span class=\"gensmall\"><a href=\"javascript:select_switch(true);\" class=\"gensmall\">Ozna�it v�e</a> :: <a href=\"javascript:select_switch(false);\" class=\"gensmall\">Odzna�it v�e</a></span></b><br><span class=\"nav\"><br></span></td>
	</tr>
  </table>
</form>

<table width=\"100%\" border=\"0\">
  <tr>
	<td align=\"right\" valign=\"top\">
<form method=\"get\" name=\"jumpbox\" action=\"viewforum.php\" onSubmit=\"if(document.jumpbox.f.value == -1){return false;}\"><table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
</table></form>

</td>
  </tr>
</table>


";
}
else
{
echo "<body onload=\"nalog.click();\"><a name=\"nalog\" href=\"index.php?kam=login\"></a></body>";
}
?>
