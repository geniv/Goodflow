<?
echo
"<script language=\"JavaScript\" type=\"text/javascript\">
<!--
// bbCode control by
// subBlue design
// www.subBlue.com

// Startup variables
var imageTag = false;
var theSelection = false;

// Check for Browser & Platform for PC & IE specific bits
// More details from: http://www.mozilla.org/docs/web-developer/sniffer/browser_type.html
var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version

var is_ie = ((clientPC.indexOf(\"msie\") != -1) && (clientPC.indexOf(\"opera\") == -1));
var is_nav = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
                && (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1)
                && (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));
var is_moz = 0;

var is_win = ((clientPC.indexOf(\"win\")!=-1) || (clientPC.indexOf(\"16bit\") != -1));
var is_mac = (clientPC.indexOf(\"mac\")!=-1);

// Helpline messages
b_help = \"Tučné: [b]text[/b]  (alt+b)\";
i_help = \"Kurzíva: [i]text[/i]  (alt+i)\";
u_help = \"Podtržené: [u]text[/u]  (alt+u)\";
q_help = \"Citace: [quote]text[/quote]  (alt+q)\";
c_help = \"Zobrazení kódu: [code]code[/code]  (alt+c)\";
l_help = \"Seznam: [list]text[/list] (alt+l)\";
o_help = \"Uspořádaný seznam: [list=]text[/list]  (alt+o)\";
p_help = \"Vložit obrázek: [img]http://image_url[/img]  (alt+p)\";
w_help = \"Vložit URL: [url]http://url[/url] or [url=http://url]URL text[/url]  (alt+w)\";
a_help = \"Zavře všechny otevřené značky\";
s_help = \"Barva písma: [color=red]text[/color] Tip: můžete použít také color=#FF0000\";
f_help = \"Velikost písma: [size=x-small]malý text[/size]\";

// Define the bbCode tags
bbcode = new Array();
bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[quote]','[/quote]','[code]','[/code]','[list]','[/list]','[list=]','[/list]','[img]','[/img]','[url]','[/url]');
imageTag = false;

// Shows the help messages in the helpline window
function helpline(help) {
	document.post.helpbox.value = eval(help + \"_help\");
}


// Replacement for arrayname.length property
function getarraysize(thearray) {
	for (i = 0; i < thearray.length; i++) {
		if ((thearray[i] == \"undefined\") || (thearray[i] == \"\") || (thearray[i] == null))
			return i;
		}
	return thearray.length;
}

// Replacement for arrayname.push(value) not implemented in IE until version 5.5
// Appends element to the array
function arraypush(thearray,value) {
	thearray[ getarraysize(thearray) ] = value;
}

// Replacement for arrayname.pop() not implemented in IE until version 5.5
// Removes and returns the last element of an array
function arraypop(thearray) {
	thearraysize = getarraysize(thearray);
	retval = thearray[thearraysize - 1];
	delete thearray[thearraysize - 1];
	return retval;
}


function checkForm() {

	formErrors = false;

	if (document.post.message.value.length < 2) {
		formErrors = \"Musíte zadat text příspěvku!\";
	}

	if (formErrors) {
		alert(formErrors);
		return false;
	} else {
		bbstyle(-1);
		//formObj.preview.disabled = true;
		//formObj.submit.disabled = true;
		return true;
	}
}

function emoticon(text) {
	var txtarea = document.post.message;
	text = ' ' + text + ' ';
	if (txtarea.createTextRange && txtarea.caretPos) {
		var caretPos = txtarea.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? caretPos.text + text + ' ' : caretPos.text + text;
		txtarea.focus();
	} else {
		txtarea.value  += text;
		txtarea.focus();
	}
}

function bbfontstyle(bbopen, bbclose) {
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (!theSelection) {
			txtarea.value += bbopen + bbclose;
			txtarea.focus();
			return;
		}
		document.selection.createRange().text = bbopen + theSelection + bbclose;
		txtarea.focus();
		return;
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, bbopen, bbclose);
		return;
	}
	else
	{
		txtarea.value += bbopen + bbclose;
		txtarea.focus();
	}
	storeCaret(txtarea);
}


function bbstyle(bbnumber) {
	var txtarea = document.post.message;

	txtarea.focus();
	donotinsert = false;
	theSelection = false;
	bblast = 0;

	if (bbnumber == -1) { // Close all open tags & default button names
		while (bbcode[0]) {
			butnumber = arraypop(bbcode) - 1;
			txtarea.value += bbtags[butnumber + 1];
			buttext = eval('document.post.addbbcode' + butnumber + '.value');
			eval('document.post.addbbcode' + butnumber + '.value =\"' + buttext.substr(0,(buttext.length - 1)) + '\"');
		}
		imageTag = false; // All tags are closed including image tags :D
		txtarea.focus();
		return;
	}

	if ((clientVer >= 4) && is_ie && is_win)
	{
		theSelection = document.selection.createRange().text; // Get text selection
		if (theSelection) {
			// Add tags around selection
			document.selection.createRange().text = bbtags[bbnumber] + theSelection + bbtags[bbnumber+1];
			txtarea.focus();
			theSelection = '';
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, bbtags[bbnumber], bbtags[bbnumber+1]);
		return;
	}

	// Find last occurance of an open tag the same as the one just clicked
	for (i = 0; i < bbcode.length; i++) {
		if (bbcode[i] == bbnumber+1) {
			bblast = i;
			donotinsert = true;
		}
	}

	if (donotinsert) {		// Close all open tags up to the one just clicked & default button names
		while (bbcode[bblast]) {
				butnumber = arraypop(bbcode) - 1;
				txtarea.value += bbtags[butnumber + 1];
				buttext = eval('document.post.addbbcode' + butnumber + '.value');
				eval('document.post.addbbcode' + butnumber + '.value =\"' + buttext.substr(0,(buttext.length - 1)) + '\"');
				imageTag = false;
			}
			txtarea.focus();
			return;
	} else { // Open tags

		if (imageTag && (bbnumber != 14)) {		// Close image tag before adding another
			txtarea.value += bbtags[15];
			lastValue = arraypop(bbcode) - 1;	// Remove the close image tag from the list
			document.post.addbbcode14.value = \"Img\";	// Return button back to normal state
			imageTag = false;
		}

		// Open tag
		txtarea.value += bbtags[bbnumber];
		if ((bbnumber == 14) && (imageTag == false)) imageTag = 1; // Check to stop additional tags after an unclosed image tag
		arraypush(bbcode,bbnumber+1);
		eval('document.post.addbbcode'+bbnumber+'.value += \"*\"');
		txtarea.focus();
		return;
	}
	storeCaret(txtarea);
}

// From http://www.massless.org/mozedit/
function mozWrap(txtarea, open, close)
{
	var selLength = txtarea.textLength;
	var selStart = txtarea.selectionStart;
	var selEnd = txtarea.selectionEnd;
	if (selEnd == 1 || selEnd == 2)
		selEnd = selLength;

	var s1 = (txtarea.value).substring(0,selStart);
	var s2 = (txtarea.value).substring(selStart, selEnd)
	var s3 = (txtarea.value).substring(selEnd, selLength);
	txtarea.value = s1 + open + s2 + close + s3;
	return;
}

// Insert at Claret position. Code from
// http://www.faqts.com/knowledge_base/view.phtml/aid/1052/fid/130
function storeCaret(textEl) {
	if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

//-->
</script>


<form action=\"privmsg.php\" method=\"post\" name=\"post\" onsubmit=\"return checkForm(this)\">
  <table width=\"100%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\" align=\"center\">
    <tr>
      <td align=\"left\">  </td>

    </tr>
  </table>
  <table width=\"100%\" cellspacing=\"2\" border=\"0\" align=\"center\" cellpadding=\"2\">
    <tr>
      <td valign=\"top\"><span  class=\"nav\"><a href=\"index.php\" class=\"nav\">Obsah fóra Fugessovo fórum</a>

    </tr>
  </table>
  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
      <td colspan=\"3\">
        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
          <tr>
            <td width=\"0%\"><img src=\"images/cat_lcap_post.gif\" width=\"22\" height=\"51\"></td>
            <td width=\"100%\" background=\"images/cat_bar.jpg\" valign=\"top\">
              <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" height=\"100%\">
                <tr>
                  <td class=\"cBarStart\" valign=\"top\">
                    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                      <tr>
                        <td valign=\"top\"><img src=\"images/post_item.gif\" width=\"25\" height=\"39\"></td>
                        <td class=\"cattitle\"><span class=\"cattitle\"><b>Odeslat novou soukromou zprávu</b></span></td>
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

                    <table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\" class=\"forumline\">
                      <tr>
                        <td class=\"row1\" align=\"right\"><span class=\"genmed\"><b>Uživatel</b></span></td>
                        <td class=\"row2\"><span class=\"genmed\">
                          <input type=\"text\"  class=\"post\" name=\"username\" maxlength=\"25\" size=\"25\" tabindex=\"1\" value=\"Fugess\" />
                          &nbsp;
                          <input type=\"submit\" name=\"usersubmit\" value=\"Hledat uživatele\" class=\"liteoption\" onClick=\"window.open('search.php?mode=searchuser', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;\" />
                          </span></td>
                      </tr>
                      <tr>
                        <td class=\"row1\" width=\"22%\" align=\"right\"><span class=\"genmed\"><b>Předmět</b></span></td>
                        <td class=\"row2\" width=\"78%\"> <span class=\"gen\">
                          <input type=\"text\" name=\"subject\" size=\"45\" maxlength=\"60\" style=\"width:450px\" tabindex=\"2\" class=\"post\" value=\"\" />
                          </span>
                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\" valign=\"top\">

                          <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">
                            <tr>
                              <td align=\"right\"><span class=\"genmed\"><b>Tělo zprávy</b></span>
                              </td>
                            </tr>
                            <tr>
                              <td valign=\"middle\" align=\"center\"> <br />
                                <table width=\"100\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\">
                                  <tr align=\"center\">
                                    <td colspan=\"4\" class=\"gensmall\"><b>Smajlíky (emotikony)</b></td>
                                  </tr>
                                  <tr align=\"center\" valign=\"middle\">
                                    <td><a href=\"javascript:emoticon(':D')\"><img src=\"images/smiles/icon_biggrin.gif\" border=\"0\" alt=\"Very Happy\" title=\"Very Happy\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':)')\"><img src=\"images/smiles/icon_smile.gif\" border=\"0\" alt=\"Smile\" title=\"Smile\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':(')\"><img src=\"images/smiles/icon_sad.gif\" border=\"0\" alt=\"Sad\" title=\"Sad\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':o')\"><img src=\"images/smiles/icon_surprised.gif\" border=\"0\" alt=\"Surprised\" title=\"Surprised\" /></a></td>
                                  </tr>
                                  <tr align=\"center\" valign=\"middle\">
                                    <td><a href=\"javascript:emoticon(':shock:')\"><img src=\"images/smiles/icon_eek.gif\" border=\"0\" alt=\"Shocked\" title=\"Shocked\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':?')\"><img src=\"images/smiles/icon_confused.gif\" border=\"0\" alt=\"Confused\" title=\"Confused\" /></a></td>
                                    <td><a href=\"javascript:emoticon('8)')\"><img src=\"images/smiles/icon_cool.gif\" border=\"0\" alt=\"Cool\" title=\"Cool\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':lol:')\"><img src=\"images/smiles/icon_lol.gif\" border=\"0\" alt=\"Laughing\" title=\"Laughing\" /></a></td>
                                  </tr>
                                  <tr align=\"center\" valign=\"middle\">
                                    <td><a href=\"javascript:emoticon(':x')\"><img src=\"images/smiles/icon_mad.gif\" border=\"0\" alt=\"Mad\" title=\"Mad\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':P')\"><img src=\"images/smiles/icon_razz.gif\" border=\"0\" alt=\"Razz\" title=\"Razz\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':oops:')\"><img src=\"images/smiles/icon_redface.gif\" border=\"0\" alt=\"Embarassed\" title=\"Embarassed\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':cry:')\"><img src=\"images/smiles/icon_cry.gif\" border=\"0\" alt=\"Crying or Very sad\" title=\"Crying or Very sad\" /></a></td>
                                  </tr>
                                  <tr align=\"center\" valign=\"middle\">
                                    <td><a href=\"javascript:emoticon(':evil:')\"><img src=\"images/smiles/icon_evil.gif\" border=\"0\" alt=\"Evil or Very Mad\" title=\"Evil or Very Mad\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':twisted:')\"><img src=\"images/smiles/icon_twisted.gif\" border=\"0\" alt=\"Twisted Evil\" title=\"Twisted Evil\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':roll:')\"><img src=\"images/smiles/icon_rolleyes.gif\" border=\"0\" alt=\"Rolling Eyes\" title=\"Rolling Eyes\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':wink:')\"><img src=\"images/smiles/icon_wink.gif\" border=\"0\" alt=\"Wink\" title=\"Wink\" /></a></td>
                                  </tr>
                                  <tr align=\"center\" valign=\"middle\">
                                    <td><a href=\"javascript:emoticon(':!:')\"><img src=\"images/smiles/icon_exclaim.gif\" border=\"0\" alt=\"Exclamation\" title=\"Exclamation\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':?:')\"><img src=\"images/smiles/icon_question.gif\" border=\"0\" alt=\"Question\" title=\"Question\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':idea:')\"><img src=\"images/smiles/icon_idea.gif\" border=\"0\" alt=\"Idea\" title=\"Idea\" /></a></td>
                                    <td><a href=\"javascript:emoticon(':arrow:')\"><img src=\"images/smiles/icon_arrow.gif\" border=\"0\" alt=\"Arrow\" title=\"Arrow\" /></a></td>
                                  </tr>
                                  <tr align=\"center\">
                                    <td colspan=\"4\"><span  class=\"nav\"><a href=\"posting.php?mode=smilies\" onClick=\"window.open('posting.php?mode=smilies', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=250');return false;\" target=\"_phpbbsmilies\" class=\"nav\">Zobrazit další smajlíky (emotikony)</a></span></td>
                                  </tr>
                                </table>
                                </td>
                            </tr>
                          </table>

                        </td>
                        <td class=\"row2\" valign=\"top\">

                          <table width=\"450\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
                            <tr align=\"center\" valign=\"middle\">
                              <td><span class=\"gen\">
                                <input type=\"button\" class=\"button\" accesskey=\"b\" name=\"addbbcode0\" value=\" B \" style=\"font-weight:bold; width: 30px\" onClick=\"bbstyle(0)\" onMouseOver=\"helpline('b')\" />
                                </span></td>
                              <td><span class=\"gen\">
                                <input type=\"button\" class=\"button\" accesskey=\"i\" name=\"addbbcode2\" value=\" i \" style=\"font-style:italic; width: 30px\" onClick=\"bbstyle(2)\" onMouseOver=\"helpline('i')\" />
                                </span></td>
                              <td><span class=\"gen\">
                                <input type=\"button\" class=\"button\" accesskey=\"u\" name=\"addbbcode4\" value=\" u \" style=\"text-decoration: underline; width: 30px\" onClick=\"bbstyle(4)\" onMouseOver=\"helpline('u')\" />
                                </span></td>
                              <td><span class=\"gen\">
                                <input type=\"button\" class=\"button\" accesskey=\"q\" name=\"addbbcode6\" value=\"Quote\" style=\"width: 50px\" onClick=\"bbstyle(6)\" onMouseOver=\"helpline('q')\" />
                                </span></td>
                              <td><span class=\"gen\">
                                <input type=\"button\" class=\"button\" accesskey=\"c\" name=\"addbbcode8\" value=\"Code\" style=\"width: 40px\" onClick=\"bbstyle(8)\" onMouseOver=\"helpline('c')\" />
                                </span></td>
                              <td><span class=\"gen\">
                                <input type=\"button\" class=\"button\" accesskey=\"l\" name=\"addbbcode10\" value=\"List\" style=\"width: 40px\" onClick=\"bbstyle(10)\" onMouseOver=\"helpline('l')\" />
                                </span></td>
                              <td><span class=\"gen\">
                                <input type=\"button\" class=\"button\" accesskey=\"o\" name=\"addbbcode12\" value=\"List=\" style=\"width: 40px\" onClick=\"bbstyle(12)\" onMouseOver=\"helpline('o')\" />
                                </span></td>
                              <td><span class=\"gen\">
                                <input type=\"button\" class=\"button\" accesskey=\"p\" name=\"addbbcode14\" value=\"Img\" style=\"width: 40px\"  onClick=\"bbstyle(14)\" onMouseOver=\"helpline('p')\" />
                                </span></td>
                              <td><span class=\"gen\">
                                <input type=\"button\" class=\"button\" accesskey=\"w\" name=\"addbbcode16\" value=\"URL\" style=\"text-decoration: underline; width: 40px\" onClick=\"bbstyle(16)\" onMouseOver=\"helpline('w')\" />
                                </span></td>
                            </tr>
                            <tr>
                              <td colspan=\"9\">

                                <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                  <tr>
                                    <td> <span class=\"genmed\">&nbsp;Barva písma:
                                      <select name=\"addbbcode18\" onChange=\"bbfontstyle('[color=' + this.form.addbbcode18.options[this.form.addbbcode18.selectedIndex].value + ']', '[/color]');this.selectedIndex=0;\" onMouseOver=\"helpline('s')\">
                                        <option style=\"color:white; background-color: #13619F\" value=\"#FFFFFF\" class=\"genmed\">Výchozí</option>
                                        <option style=\"color:darkred; background-color: #13619F\" value=\"darkred\" class=\"genmed\">Kaštanová</option>
                                        <option style=\"color:red; background-color: #13619F\" value=\"red\" class=\"genmed\">Červená</option>
                                        <option style=\"color:orange; background-color: #13619F\" value=\"orange\" class=\"genmed\">Oranžová</option>
                                        <option style=\"color:brown; background-color: #13619F\" value=\"brown\" class=\"genmed\">Hnědá</option>
                                        <option style=\"color:yellow; background-color: #13619F\" value=\"yellow\" class=\"genmed\">Žlutá</option>
                                        <option style=\"color:lime; background-color: #13619F\" value=\"lime\" class=\"genmed\">Zelená</option>
                                        <option style=\"color:olive; background-color: #13619F\" value=\"olive\" class=\"genmed\">Olivová</option>
                                        <option style=\"color:cyan; background-color: #13619F\" value=\"cyan\" class=\"genmed\">Azurová</option>
                                        <option style=\"color:blue; background-color: #13619F\" value=\"blue\" class=\"genmed\">Modrá</option>
                                        <option style=\"color:darkblue; background-color: #13619F\" value=\"darkblue\" class=\"genmed\">Tmavě modrá</option>
                                        <option style=\"color:indigo; background-color: #13619F\" value=\"indigo\" class=\"genmed\">Fialová</option>
                                        <option style=\"color:violet; background-color: #13619F\" value=\"violet\" class=\"genmed\">Fuchsiová</option>
                                        <option style=\"color:white; background-color: #13619F\" value=\"white\" class=\"genmed\">Bílá</option>
                                        <option style=\"color:black; background-color: #13619F\" value=\"black\" class=\"genmed\">Černá</option>
                                      </select>
                                      &nbsp;Velikost písma:
                                      <select name=\"addbbcode20\" onChange=\"bbfontstyle('[size=' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + ']', '[/size]')\" onMouseOver=\"helpline('f')\">
                                        <option value=\"7\" class=\"genmed\">Drobné</option>
                                        <option value=\"9\" class=\"genmed\">Malé</option>
                                        <option value=\"12\" selected class=\"genmed\">Výchozí</option>
                                        <option value=\"18\" class=\"genmed\">Velké</option>
                                        <option  value=\"24\" class=\"genmed\">Obrovské</option>
                                      </select>
                                      </span></td>
                                    <td nowrap align=\"right\"><span class=\"gen\"><a href=\"javascript:bbstyle(-1)\" class=\"genmed\" onMouseOver=\"helpline('a')\">zavřít značky</a></span></td>
                                  </tr>
                                </table>

                              </td>
                            </tr>
                            <tr>
                              <td colspan=\"9\"> <span class=\"gen\">
                                <input type=\"text\" name=\"helpbox\" size=\"45\" maxlength=\"100\" style=\"width:450px; font-size:10px\" class=\"helpline\" value=\"Tip: Styl můžete aplikovat rychleji na označeném textu.\" />
                                </span></td>
                            </tr>
                            <tr>
                              <td colspan=\"9\"><span class=\"gen\">
                                <textarea name=\"message\" rows=\"15\" cols=\"35\" wrap=\"virtual\" style=\"width:450px\" tabindex=\"3\" class=\"post\" onSelect=\"storeCaret(this);\" onClick=\"storeCaret(this);\" onKeyUp=\"storeCaret(this);\"></textarea>
                                </span></td>
                            </tr>
                          </table>

                        </td>
                      </tr>
                      <tr>
                        <td class=\"row1\" valign=\"top\"><span class=\"gen\"><b>Předvolby</b></span><br />
                          <span class=\"gensmall\">HTML: <u>VYPNUTO</u><br />
                          <a href=\"faq.php?mode=bbcode\" target=\"_phpbbcode\">Značky</a>: <u>POVOLENY</u><br />
                          Smajlíky: <u>POVOLENY</u></span></td>
                        <td class=\"row2\"><span class=\"gen\"> </span>
                          <table cellspacing=\"0\" cellpadding=\"1\" border=\"0\" width=\"100%\">
                            <tr>
                              <td width=\"0%\">
                                <input type=\"checkbox\" class=\"checkbox\" name=\"disable_bbcode\"  />
                              </td>
                              <td width=\"100%\"><span class=\"genmed\">Zakázat značky v této zprávě</span></td>
                            </tr>
                            <tr>
                              <td width=\"0%\">
                                <input type=\"checkbox\" class=\"checkbox\" name=\"disable_smilies\"  />
                              </td>
                              <td width=\"100%\"><span class=\"genmed\">Zakázat smajlíky v této zprávě</span></td>
                            </tr>
                            <tr>
                              <td width=\"0%\">
                                <input type=\"checkbox\" class=\"checkbox\" name=\"attach_sig\"  checked=\"checked\" />
                              </td>
                              <td width=\"100%\"><span class=\"genmed\">Připojit podpis (podpis můžete změnit ve vašem nastavení)</span></td>
                            </tr>
                          </table>

                        </td>
                      </tr>


                      <tr>
                      </tr>

                      

                      <tr>
                        <td colspan=\"2\" align=\"center\" class=\"buttons\">
                          <input type=\"hidden\" name=\"folder\" value=\"inbox\" /><input type=\"hidden\" name=\"mode\" value=\"post\" /><input type=\"hidden\" name=\"sid\" value=\"b997929478a956914d7baab13f779a96\" />
                          <input type=\"submit\" tabindex=\"5\" name=\"preview\" class=\"mainoption\" value=\"Náhled\" />
                          &nbsp;
                          <input type=\"submit\" accesskey=\"s\" tabindex=\"6\" name=\"post\" class=\"mainoption\" value=\"Odeslat\" />
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
            <td width=\"100%\" class=\"mainBox\" cellpadding=\"0\">

                    <table cellspacing=\"0\" width=\"100%\" cellpadding=\"4\">
		      <tr>
                        <td class=\"catBottom\" colspan=\"2\" align=\"right\" height=\"28\">
                          <span class=\"gensmall\"><span class=\"bottom\">Časy uváděny v GMT + 1 hodina</span></span>
                        </td>
                      </tr>
                    </table>



            </td>
            <td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
          </tr>
          <tr>
            <td width=\"0%\" class=\"mainboxLeftbottom\">&nbsp;</td>
            <td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
            <td width=\"0%\" class=\"mainboxRightbottom\">&nbsp;</td>
          </tr>
        </table>
      </td>
      <td class=\"catbox_right\"><img src=\"images/spacer.gif\" width=\"27\" height=\"27\"></td>
    </tr>
  </table>
</form>

<table width=\"100%\" cellspacing=\"2\" border=\"0\" align=\"center\">
  <tr>
	<td valign=\"top\" align=\"right\">
<form method=\"get\" name=\"jumpbox\" action=\"viewforum.php\" onSubmit=\"if(document.jumpbox.f.value == -1){return false;}\"><table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
	<tr>
		<td nowrap=\"nowrap\"><span class=\"gensmall\">Přejdi na:&nbsp;<select name=\"f\" onchange=\"if(this.options[this.selectedIndex].value != -1){ forms['jumpbox'].submit() }\"><option value=\"-1\">Zvolte fórum</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">Všeobecné informace o fóru</option><option value=\"-1\">----------------</option><option value=\"1\">Stručný popis fóra</option><option value=\"2\">Návrhy a řešení</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">TRS 2004 / 2006</option><option value=\"-1\">----------------</option><option value=\"3\">Stavba objektů</option><option value=\"4\">Projekty</option><option value=\"5\">Tutoriály</option><option value=\"6\">Programy</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">Grafika</option><option value=\"-1\">----------------</option><option value=\"12\">3D Grafika</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">Elektro</option><option value=\"-1\">----------------</option><option value=\"9\">Elektro výrobky</option><option value=\"10\">Schémata</option><option value=\"11\">Unikátní fotky a videa</option><option value=\"-1\">&nbsp;</option><option value=\"-1\">Ostatní</option><option value=\"-1\">----------------</option><option value=\"7\">Reálná železnice</option><option value=\"8\">Modelová železnice</option></select><input type=\"hidden\" name=\"sid\" value=\"b997929478a956914d7baab13f779a96\" />&nbsp;<input type=\"submit\" value=\"jdi\" class=\"liteoption\" /></span></td>
	</tr>
</table></form>

</td>
  </tr>
</table>




<div align=\"center\">
	<p>
		<span class=\"copyright\">
			<a href=\"admin/index.php?sid=b997929478a956914d7baab13f779a96\">Administrace fóra</a><br /><br />
		</span>
	</p></div>";
?>
inbox messages
