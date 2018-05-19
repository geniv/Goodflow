<?

/*
$nazev="naz_topik_$csl.php";
$poct=delka_nadpisu();
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$nadpis=explode("--TPK--",fread($u,$delkasoub));
fclose($u);

$nazev1="f_topik_{$csl}_{$cislo1}.php";
$delkasoub=delka_souboru();
$u=fopen($nazev1,"r");
$pris=explode("--ZPR--",fread($u,$delkasoub));
fclose($u);
$del=delka_obsahu();
$datum=$pris[count($pris)-2];
*/
//$pole=array("jmeno"=>"aaaa","bbbb","cccc","prijmeni"=>"fryšta","dddd","eeee");
//print_r ($pole);
/*
function test($neco)
{
return $neco." tadá";
}
$i="ahoj";
print test($i);
*/
//print "$HTTP_ACCEPT, $REMOTE_ADDR, $HTTP_USER_AGENT, $REQUEST_METHOD, $SERVER_PORT, $SERVER_PROTOCOL, $GATEWAY_INTERFACE, $SERVER_NAME, $QUERY_STRING, $SCRIPT_NAME, $PATH_TRANSLATED, $SERVER_SOFTWARE, ";

//print gethostbyaddr($REMOTE_ADDR);
//basename(getcwd());

//print $link;
//"<a href=\"http://$server/$slozka/$soub\">http://$server/$slozka/$soub</a>";


/*
seznamy a pomocný admin:
ak_ti_v_li_nky_qwpfoeijgsfnxiokmsciovsnviuojsdcvuisfnvmcoiaesdvjnsudnvsdounosdncoiudanciodnviusbvuzwreg.php
admin_hlavni.php
admin_index.php
admin_menu.php

logování:
akt_iv_log_qepfsovjdnviwekjfviuedhwiuegvieusfnwribvizeuhfwriugbvebviewriuhfjfoiwjvoiwrnfnfvnnnv.php
hlav_ni_log_qpfcmiruhgniewijfveuiccoiwrehnviunfenrzuibirunvowieufniuruwenbfiunbreiunrefgiunreiuniuneiunbugerunb.php
prih_l_log_qwpofjsuoimwvnieunviueoiwrngvoiweunvzubadflkjofnvoiujsdfnvoikjdfmvoiunedfoibnuoinbqpwoeirdkslcmmbgzhezhgewewwwfnbreuxy.php
seznam_akti_vace_qpewfmonfvdvkmwoibndslkfjmeoijgvkfmwfgnvdkfjiworebpiojweolfiljnoslkmnfoiksdnoesdjrng.php
zas_la_ni_h_es_la_qwpfdkcosiovnsriunvsornvsnoijnvsfoinsokjkjnsfjniujbndonrsonkjnskjvnbrfjnjn.php
poh_yb_po_sstr_qpwjfcsodnvsdalnjaodkjqipojfcuifsncwevbisciusjvnwisvbisucoahncalfvndfuhznbv.php

jine:
ban_li_di_qpwdfjwoiunvrnvirwezbvbzeuivnwruzniwujenviuubnwieufzuhqzqwvfvwf.php
del_ky_qwpdfojaedsvinuidfsvjnaosdfnvuaidfghnvsdifviufhvnriugvnsaidfhnasfviodufgnrsforglnasfqwpoidfjajdfioqp.php
nad_pi_s_qwpdojsniufcojsiufvhjnviurebhfcbvjdoiqpowdfncwdfkjmvnwriufcmireuíhjoiewghvisucjwruvbwiuijfiwuhfuehfiwhufeueueuuueueuckaeinef.php
te_ma_qpwdemwriuvjuoiejdcwriuhvneuirbvuiernvenclnqwdpkweoimcqeodcmrievneiuvwioiwrjnvoierjvoijwiojfoiwrjvrvrv.php
poz_namky_dlkjfhiwocniwspqwejfowwchnzsiudcmrweiuvbcnwreuivzbuisfnvezuhvbnwrezuisjfhvnerjhkfvherniuvnervjkhejhverhjv.php
re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php

delka_novoty_forum_qwpodfjniejniedfkjvnrdiineivnieujruernie.php
delka_novoty_hlavni_owevnisujfvdfokjnefjhnjlekbj.php

//$delkasoub=delka_souboru();
//---------------------------------------------------------------------
function ()
{

}
//---------------------------------------------------------------------
function ()
{

}
//---------------------------------------------------------------------
function ()
{

}
//---------------------------------------------------------------------
function ()
{

}
//---------------------------------------------------------------------
function ()
{

}//---------------------------------------------------------------------
function ()
{

}
//---------------------------------------------------------------------
function ()
{

}
//---------------------------------------------------------------------
function ()
{

}
*/
//---------------------------------------------------------------------
/*
function celkovy_pocet_zhlednuti_tema($cislo)
{
$celkem=0;
$nazev="naz_topik_{$cislo}.php";
if(file_exists($nazev)=="true")
{
$poct=delka_nadpisu();
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$nadpis=explode("--TPK--",fread($u,$delkasoub));
fclose($u);
for($i=1;$i<((count($nadpis)-1)/$poct)+1;$i++)
{$celkem+=$nadpis[($i*$poct)];}//end for
return $celkem;
}//end exists
return 0;
}*/
//---------------------------------------------------------------------
function uprava_novoty($cislo,$prispevek)
{
$nazev1="f_topik_{$cislo}_{$prispevek}_novota.php";
if(file_exists($nazev1))
{
$u=fopen($nazev1,"r");
$novota=fread($u,10);
fclose($u);
}//end file exists

if(!Empty($novota) and $novota=="nove")
{return "<a href=\"index.php?kam=nov&cis=$cislo&pris=$prispevek\">...<img src=\"images/topic_lock.gif\" alt=\"Vypnout novotu pøíspìvku\" title=\"Vypnout novotu pøíspìvku\" border=\"0\">...</a>";}
}
//---------------------------------------------------------------------
function smazani_novoty($cislo,$prispevek)
{
$nazev2="f_topik_{$cislo}_{$prispevek}_novota.php";
if(file_exists($nazev2)=="true")
{
$u=fopen($nazev2,"w");
fclose($u);
}
}
//---------------------------------------------------------------------
function novota_fora($cislo)
{
$nazev="naz_topik_{$cislo}.php";
if(file_exists($nazev)=="true")
{
$delkasoub=delka_souboru();
$poct=delka_nadpisu();

$u=fopen($nazev,"r");
$nadpis=explode("--TPK--",fread($u,$delkasoub));
fclose($u);

for($i=1;$i<((count($nadpis)-1)/$poct)+1;$i++)
{
$nazev1="f_topik_{$cislo}_{$i}_novota.php";
if(file_exists($nazev1))
{
$u=fopen($nazev1,"r");
return $novota=fread($u,10);
fclose($u);
}//end file exists
}//end for
}//end exists
return "";
}
//---------------------------------------------------------------------
function umazat_sledovani($cislo,$prispevek,$strana)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);
$pocet=delka_registrace();

for($i=1;$i<(count($udaj)-1)/$pocet;$i++)
{
$delkasoub=delka_souboru();
$soub="{$udaj[($i*$pocet)-22]}_pqaovdnsfijnsfvlknvjnsdfivjnsdkjvndxkljvnsfjnvsfvisujdjbvfjsoinv.php";
if(file_exists($soub)=="true")
{
$uk=fopen($soub,"r");
$mej=explode("--EMA--",fread($uk,$delkasoub));
fclose($uk);

$poc=0;
for($i1=1;$i1<count($mej)-1;$i1++)//kontrola obsahu
{
if($mej[$i1]==$cislo and $mej[$i1+1]==$prispevek){$poc=$i1;}
}//end for

if($poc!=0)
{
$nove[0]="<?php";
$pvp=0;
for($i=1;$i<$poc;$i++)//1 ze 2
{
$pvp++;
$nove[$pvp]=$mej[$pvp];
}

for($i3=$poc+2;$i3<count($mej);$i3++)//2 ze 2
{
$pvp++;
$nove[$pvp]=$mej[$i3];
}

$u=fopen($soub,"w");
fwrite($u,implode($nove,"--EMA--"));
fclose($u);
}//end poc
}//end exist
}//end for
}
//---------------------------------------------------------------------
function uzivatel_sleduje($jmeno)
{
$delkasoub=delka_souboru();
$soub="{$jmeno}_pqaovdnsfijnsfvlknvjnsdfivjnsdkjvndxkljvnsfjnvsfvisujdjbvfjsoinv.php";
if(file_exists($soub)=="true")
{
$uk=fopen($soub,"r");
$mej=explode("--EMA--",fread($uk,$delkasoub));
fclose($uk);

$tab1="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
<tr>
<td>
   <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
			<tr>
			  <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			</tr>
			<tr>
			  <td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"ErrorConfirmBox\">

<table cellspacing=\"1\" cellpadding=\"3\" border=\"0\" align=\"center\" class=\"forumline\" width=\"100%\">
	<tr>
	  <th class=\"row2\" align=\"center\">#</th>
	  <th class=\"row2\" align=\"left\">Název tématu</th>
	  <th class=\"row2\" align=\"left\">Nastavení sledování</th>
	</tr>";
$tab2="</table>
      </td>
      <td width=\"0%\" class=\"mainboxRight\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
    </tr>
    <tr>
      <td width=\"0%\" class=\"mainboxLeftbottom\">&nbsp;</td>
      <td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
      <td width=\"0%\" class=\"mainboxRightbottom\">&nbsp;</td>
    </tr>
  </table>
</td>
</tr>
</table>";

$tabob="";
$poc=0;
if((count($mej)-1)!=0)
{
for($i=1;$i<(count($mej)-1);$i+=2)
{
$poc++;
$tema=temata_topiku($mej[$i],$mej[$i+1]);
$tabob.="<tr><td class=\"input\" align=\"center\"><span class=\"genmed\"><strong>$poc</strong></span></td><td class=\"input\"><span class=\"genmed\"><strong>$tema</strong></span></td><td class=\"input\"><strong><a href=\"index.php?kam=sledovani&cis={$mej[$i]}&pris={$mej[$i+1]}&str=1&prik=del&kdo=$jmeno\" class=\"genmed\">Pøestat sledovat odpovìdi na toto téma.</a></strong></td></tr>";
}//end for
}
else
{$tabob="<tr><td class=\"input\" align=\"center\" colspan=3><span class=\"genmed\"><strong>Nesledujete žádné odpovìdi na témata</strong></span></td></tr>";}
return $tab1.$tabob.$tab2;
}
else
{return "<tr><td class=\"input\" align=\"center\" colspan=3><span class=\"genmed\"><strong>Nebyl nalezen Váš soubor pro sledování. Kontaktujte prosím administrátora.</strong></span></td></tr>";}
}
//---------------------------------------------------------------------
function smaz_novotu_vlakna($cislo)//omezeno!!!
{
$delkasoub=delka_souboru();
$sb_hes="novota_hlav_str_qpoefjnsiuvnsofnivbsdivbsihvisdhvisdjvskdjfbbsdfkjhvbsdfjhvbadfhbvjadfhbvkjhadfbvkjadbvbdf.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--PD--",fread($u,$delkasoub));
fclose($u);

$udaj[$cislo]="";

$u=fopen($sb_hes,"w");
fwrite($u,implode($udaj,"--PD--"));
fclose($u);
}
//---------------------------------------------------------------------
function sledovanost_fora($jmeno,$cislo,$prispevek,$strana)
{
$delkasoub=delka_souboru();
$soub="{$jmeno}_pqaovdnsfijnsfvlknvjnsdfivjnsdkjvndxkljvnsfjnvsfvisujdjbvfjsoinv.php";
if(file_exists($soub)=="true")
{
$uk=fopen($soub,"r");
$mej=explode("--EMA--",fread($uk,$delkasoub));
fclose($uk);

$poc=0;
for($i=1;$i<count($mej);$i++)
{
if(!Empty($mej[$i]) and $mej[$i]==$cislo and !Empty($mej[$i+1]) and $mej[$i+1]==$prispevek){$poc=$i;}
}//end for

if($poc==0)
{return "<a href=\"index.php?kam=sledovani&cis=$cislo&pris=$prispevek&str=$strana\">Sledovat odpovìdi na toto téma</a>";}
else
{return "<a href=\"index.php?kam=sledovani&cis=$cislo&pris=$prispevek&str=$strana&prik=del&kdo=$jmeno\">Pøestat sledovat odpovìdi na toto téma</a>";}
}
return "<tr><td class=\"input\" align=\"center\" colspan=3><span class=\"genmed\"><strong>Nebyl nalezen Váš soubor pro sledování. Kontaktujte prosím administrátora.</strong></span></td></tr>";
}
//---------------------------------------------------------------------
function zrusit_sledovani_prispevku($jmeno,$cislo,$prispevek,$strana)
{
$delkasoub=delka_souboru();
$soub="{$jmeno}_pqaovdnsfijnsfvlknvjnsdfivjnsdkjvndxkljvnsfjnvsfvisujdjbvfjsoinv.php";
if(file_exists($soub)=="true")
{
$uk=fopen($soub,"r");
$mej=explode("--EMA--",fread($uk,$delkasoub));
fclose($uk);

$poc=0;
for($i1=1;$i1<count($mej)-1;$i1++)//kontrola obsahu
{
if($mej[$i1]==$cislo and $mej[$i1+1]==$prispevek){$poc=$i1;}
}//end for

if($poc!=0)
{
$nove[0]="<?php";
$pvp=0;
for($i=1;$i<$poc;$i++)//1 ze 2
{
$pvp++;
$nove[$pvp]=$mej[$pvp];
}

for($i3=$poc+2;$i3<count($mej);$i3++)//2 ze 2
{
$pvp++;
$nove[$pvp]=$mej[$i3];
}

$u=fopen($soub,"w");
fwrite($u,implode($nove,"--EMA--"));
fclose($u);

return
"<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Sledování fóra \"".temata_topiku($cislo,$prispevek)."\" ukonèeno</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\">Pøestal jste sledovat odpovìdi ve fóru <b>".temata_topiku($cislo,$prispevek)."</b>.</span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php?kam=obsah_tema&cis=$cislo&pris=$prispevek&str=$strana\" class=\"genmed\"><b>zde</b></a> pro návrat.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";
}//end if poc
return
"<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Fórum \"".temata_topiku($cislo,$prispevek)."\" jste nesledoval.</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\">Ve fóru <b>".temata_topiku($cislo,$prispevek)."</b> jste nesledoval odpovìdi.</span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php?kam=obsah_tema&cis=$cislo&pris=$prispevek&str=$strana\" class=\"genmed\"><b>zde</b></a> pro návrat.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";
}//end file exists
}
//---------------------------------------------------------------------
function stav_sledovani_prispevku($cislo,$prispevek,$strana,$pozice)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);
$pocet=delka_registrace();

for($i=1;$i<(count($udaj))/$pocet;$i++)//kontrola souboru
{
//print "$i {$udaj[($i*$pocet)-22]}, {$udaj[($i*$pocet)-21]}<br>";
$soub="{$udaj[($i*$pocet)-22]}_pqaovdnsfijnsfvlknvjnsdfivjnsdkjvndxkljvnsfjnvsfvisujdjbvfjsoinv.php";
if(file_exists($soub)=="true")
{
$uk=fopen($soub,"r");
$mej=explode("--EMA--",fread($uk,$delkasoub));
fclose($uk);

if(Empty($pozice)){$pozice=1;}

for($i1=1;$i1<count($mej);$i1++)//kontrola obsahu
{
if(!Empty($mej[$i1]) and $mej[$i1]==$cislo and !Empty($mej[$i1+1]) and $mej[$i1+1]==$prispevek)
{
$zprava="Dobrý den,\n
Tento email jste obdržel(a) jelikož sledujete téma \"".temata_topiku($cislo,$prispevek)."\" na Fugessovì fóru. Toto téma zaznamenalo od vaší poslední návštìvy nový pøíspìvek. Následující odkaz mùžete použít k zobrazení nových pøíspìvkù. \n
http://fugess.trainz.cz/forum/index.php?kam=obsah_tema&cis=$cislo&pris=$prispevek&str=$strana#pz$pozice \n
Pokud si již nepøejete sledovat toto téma, mùžete sledování ukonèit buï kliknutím na odkaz \"Pøestat sledovat odpovìdi na toto téma\" nacházející se na spodku tématu, nebo kliknutím na následující odkaz. \n
http://fugess.trainz.cz/forum/index.php?kam=sledovani&cis=$cislo&pris=$prispevek&prik=del&kdo={$udaj[($i*$pocet)-22]} \n \n 
---
Fugess";
mail($udaj[($i*$pocet)-21],"Upozornìní na odpovìï v tématu - ".temata_topiku($cislo,$prispevek),$zprava); //pro klienta
}
}//end for

}//end id exists

}//end for

}
//---------------------------------------------------------------------
function nastavit_sledovani($jmeno,$cislo,$prispevek,$strana)
{
//soubor s emaily  --EMA--
//$tex="<?php--EMA--";
//fwrite($uk,$tex);
$delkasoub=delka_souboru();
$soub="{$jmeno}_pqaovdnsfijnsfvlknvjnsdfivjnsdkjvndxkljvnsfjnvsfvisujdjbvfjsoinv.php";
$uk=fopen($soub,"r");
$udaj=explode("--EMA--",fread($uk,$delkasoub));
fclose($uk);

$poc=0;
for($i=1;$i<count($udaj);$i++)//kontrola duplicity
{
if(!Empty($udaj[$i]) and $udaj[$i]==$cislo and !Empty($udaj[$i+1]) and  $udaj[$i+1]==$prispevek){$poc=$i;}
}//end for

if($poc==0)//kontrola duplicity
{
$udaj[count($udaj)+1]=$cislo;
$udaj[count($udaj)+2]=$prispevek;
$u=fopen($soub,"w");
fwrite($u,implode($udaj,"--EMA--"));
fclose($u);
return
"<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Zaèal jste sledovat fórum \"".temata_topiku($cislo,$prispevek)."\"</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\">Zaèal jste sledovat odpovìdi ve fóru <b>".temata_topiku($cislo,$prispevek)."</b>.</span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php?kam=obsah_tema&cis=$cislo&pris=$prispevek&str=$strana\" class=\"genmed\"><b>zde</b></a> pro návrat.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";
}
else
{return
"<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Fórum \"".temata_topiku($cislo,$prispevek)."\" již sledujete</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\">Odpovìdi ve fóru <b>".temata_topiku($cislo,$prispevek)."</b> již sledujete.</span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php?kam=obsah_tema&cis=$cislo&pris=$prispevek&str=$strana\" class=\"genmed\"><b>zde</b></a> pro návrat.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";}
}
//---------------------------------------------------------------------
function setings_avatar($cislo)
{
$delkasoub=delka_souboru();
$nazev="sys_avatar_qpdonmsdiuvnsdivmndfasivnflkvnmaifjvbfkjvnsdfiajbvakdfjnvakdjfbvdfakjvn.php";
$u=fopen($nazev,"r");
$udaj=explode("--AV--",fread($u,$delkasoub));
fclose($u);

return $udaj[$cislo];
}
//---------------------------------------------------------------------
function popis_fora()
{
$sb_hes="popis_fora_qpwodjihciwsudfzbvndiscnsruvbnsiudbczusdbvsbnvizsbvisdbvisudbvisdbvisudbv.php";
$u=fopen($sb_hes,"r");
return fread($u,1000);
fclose($u);
}
//---------------------------------------------------------------------
function stav_zamku_vlakna($cislo)
{
$delkasoub=delka_souboru();
$nazev="zam_ek_vlaken_qwpofibsduvbnaecvjnisudvaeoiljvhnsizudalekjvsivbkesjksujoidvcbsdjhibclkjsdhfjhibwesd.php";
$u=fopen($nazev,"r");
$nadpis=explode("--PZ--",fread($u,$delkasoub));
fclose($u);

return $nadpis[$cislo];
}
//---------------------------------------------------------------------
function zamknout_vlakno($cislo,$jak)
{
$delkasoub=delka_souboru();
$nazev="zam_ek_vlaken_qwpofibsduvbnaecvjnisudvaeoiljvhnsizudalekjvsivbkesjksujoidvcbsdjhibclkjsdhfjhibwesd.php";
$u=fopen($nazev,"r");
$nadpis=explode("--PZ--",fread($u,$delkasoub));
fclose($u);

$nadpis[$cislo]=$jak;

$u=fopen($nazev,"w");
fwrite($u,implode($nadpis,"--PZ--"));
fclose($u);

if($jak=="true")
{return "<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Fórum odemknuto</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Fórum bylo odemknuto.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php?kam=forum&cis=$cislo&str=1\" class=\"genmed\"><b>zde</b></a> pro návrat.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";}
else
{return "<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Fórum zamknuto</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Fórum bylo zamknuto.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php?kam=forum&cis=$cislo&str=1\" class=\"genmed\"><b>zde</b></a> pro návrat.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";}

}
//---------------------------------------------------------------------
/*
function nacti_novotu_vlakna($cislo)//omezeno!!!!!!
{
$delkasoub=delka_souboru();
$sb_hes="novota_hlav_str_qpoefjnsiuvnsofnivbsdivbsihvisdhvisdjvskdjfbbsdfkjhvbsdfjhvbadfhbvjadfhbvkjhadfbvkjadbvbdf.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--PD--",fread($u,$delkasoub));
fclose($u);

return $udaj[$cislo];
}*/
//---------------------------------------------------------------------
function uprav_obrazek_na_hlavnim($cislo)//omezeno!!
{
$delkasoub=delka_souboru();
$sb_hes="novota_hlav_str_qpoefjnsiuvnsofnivbsdivbsihvisdhvisdjvskdjfbbsdfkjhvbsdfjhvbadfhbvjadfhbvkjhadfbvkjadbvbdf.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--PD--",fread($u,$delkasoub));
fclose($u);

$udaj[$cislo]=Date((Date("j")+1).".n.");//nový

$u=fopen($sb_hes,"w");
fwrite($u,implode($udaj,"--PD--"));
fclose($u);
}
//---------------------------------------------------------------------
function pocet_uzivatelu_na_strance()
{
$sb_hes="po_uziv_qwpoifjhsiuvndvhnsvydkjvshksvsdjviksjvidjhsfvkjdfhbvjhsdfbvkjsdbvjhdfbvij.php";
$u=fopen($sb_hes,"r");
return fread($u,50);
fclose($u);
}
//---------------------------------------------------------------------
function pocet_topiku_na_strance()
{
$sb_hes="poc_topiku_qpofndfivnjsoighviudfjisufhviusdhijfvidflksjdfviuskjvbsdfjvbsfkjvbskjfhbvksdjfvbsdfkjvbsfikjhnaijcn.php";
$u=fopen($sb_hes,"r");
return fread($u,50);
fclose($u);
}
//---------------------------------------------------------------------
function pocet_prispevku_na_strance()
{
$sb_hes="poc_pris_pevku_pqwmfvjivnsdjvsniuhnhvzvzusdovjnsfvjnasdfvojndafvjndfavjnadfjokvjnsdvcoikn.php";
$u=fopen($sb_hes,"r");
return fread($u,50);
fclose($u);
}
//---------------------------------------------------------------------
function jdi_na_stranku($stranka,$cislo,$prispevek,$pocet_stran,$sekce)
{
//$ppm=0;
$dalstr=$stranka+1;
$predstr=$stranka-1;

if($stranka>1)
{$pred="( <a href=\"index.php?kam=$sekce&cis=$cislo&pris=$prispevek&str=$predstr\" class=\"genmed\">Pøedchozí</a> ) ";}
else
{$pred="";}

$zc="";
for($i=1;$i<=$pocet_stran;$i++)
{
//$ppm=$i+1;
if($i!=$pocet_stran)
{
if($i==$stranka)//ruší a href
{$zc.="$i, ";}//zaèátek
else
{$zc.="<a href=\"index.php?kam=$sekce&cis=$cislo&pris=$prispevek&str=$i\"><u>$i</u></a>, ";}
}
else
{
if($pocet_stran==$stranka)//dohlíží na další
{$kn="$i";}//konec
else
{$kn="<a href=\"index.php?kam=$sekce&cis=$cislo&pris=$prispevek&str=$i\"><u>$i</u></a> ( <a href=\"index.php?kam=$sekce&cis=$cislo&pris=$prispevek&str=$dalstr\" class=\"genmed\">Další</a> )";}
}
}//end for

return "Jdi na stránku: {$pred}{$zc}{$kn}";
}
//---------------------------------------------------------------------
function pocet_souboru($cesta)
{
$handle=opendir($cesta);
$poc=0;
while($soub=readdir($handle))
{
$poc+=1;
}
closedir($handle);

return $poc-2;
}
//---------------------------------------------------------------------
function velikost_vsech_obrazku()
{
$vl[0]=velikost_adresare("../images/",false);
$vl[1]=velikost_adresare("../images/avatars",false);
$vl[2]=velikost_adresare("../images/ranks",false);
$vl[3]=velikost_adresare("../images/smiles",false);
$vl[4]=velikost_adresare("../images/tlacitka",false);

$vel=0;
for($i=0;$i<count($vl);$i++)
{
$vel+=$vl[$i];
}//end for

if($vel>=1048576)
{return sprintf("%.2f MB",$vel/1048576);}
else
if($vel>=1024)
{return sprintf("%.2f KB",$vel/1024);}
else
{return sprintf("%.2f Bytes",$vel);}
}
//---------------------------------------------------------------------
function celkova_velikost_fora()
{
$vl[0]=velikost_adresare("../",false);
$vl[1]=velikost_adresare("../images/",false);
$vl[2]=velikost_adresare("../images/avatars",false);
$vl[3]=velikost_adresare("../images/ranks",false);
$vl[4]=velikost_adresare("../images/smiles",false);
$vl[5]=velikost_adresare("../images/tlacitka",false);
$vl[6]=velikost_adresare("../administrace",false);

$vel=0;
for($i=0;$i<count($vl);$i++)
{
$vel+=$vl[$i];
}//end for

if($vel>=1048576)
{return sprintf("%.2f MB",$vel/1048576);}
else
if($vel>=1024)
{return sprintf("%.2f KB",$vel/1024);}
else
{return sprintf("%.2f Bytes",$vel);}
}
//---------------------------------------------------------------------
function velikost_adresare($jmeno,$koncovka)
{
$handle=opendir($jmeno);
$vel=0;
while($soub=readdir($handle))
{
$vel+=filesize("$jmeno/$soub");
}
closedir($handle);

if($koncovka=="true")
{
if($vel>=1048576)
{return sprintf("%.2f MB",round($vel/1048576*100)/100);}
else
if($vel>=1024)
{return sprintf("%.2f KB",round($vel/1024*100)/100);}
else
{return sprintf("%.2f Bytes",$vel);}
}
else//else koncovka
{return $vel;}
}
//---------------------------------------------------------------------
/*function velikost_souboru($soubor)
{
return filesize($soubor);
}*/
//---------------------------------------------------------------------
function vykresli_ikonky()
{
$delkasoub=delka_souboru();
$sb_hes="skr_ypt_zn_ack_y_pqwkdfciournviowemvionvmsvinsokfmwirumviowjdvmiojvmifovjnmwroviksjkmowirkvjkowivjvikmweoivnoiwrejnv.php";
$u=fopen($sb_hes,"r");
$zdroj=explode("--z--",fread($u,$delkasoub));
fclose($u);

$sb_hes="skry_p_t_zn_prevod_qpfomcieufnbviomciwnvisnmvosdmvosfnmvosnvjfdnbslkmvsokfmvosikdmvfolksdvnslkfmvsdfolkvmdolkfvmed.php";
$u=fopen($sb_hes,"r");
$nahrada=explode("--zp--",fread($u,$delkasoub));
fclose($u);

$poct=79;
if(count($zdroj)==count($nahrada))
{
echo
"<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
<tr>
<td><table width=\"100\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\">";

$pom=0;
for($i=$poct;$i<count($zdroj);$i++)
{
if($i==($poct+10) or $i==($poct+30) or $i==($poct+50) or $i==($poct+70) or $i==($poct+90) or $i==($poct+110))
{print "<tr align=\"center\" valign=\"middle\">";}

echo
"<td valign=\"center\" align=\"center\"><a href=\"javascript:emoticon('{$zdroj[$i]}')\">{$nahrada[$i]}</a></td>";

if($i==($poct+19) or $i==($poct+39) or $i==($poct+59) or $i==($poct+79) or $i==($poct+99) or $i==($poct+119))
{print "</tr>";}

}//end for
echo
"</table>
</td>
</tr>
<tr>
<td align=\"center\"><br><span class=\"genmed\"><a href=\"javascript:window.close();\" class=\"genmed\">Zavøít okno</a><br><br></span></td>
</tr>
</table>";
}
else
{print "<font color=\"red\"><b>Chyba ".count($zdroj).":".count($nahrada)."</b></font>";}
}
//---------------------------------------------------------------------
function prava_uzivatele($kdo,$idecko)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$poz=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$kdo and $udaj[$i+13]==$idecko){$poz=$i;}
}//end for

return $udaj[$poz+16];
}
//---------------------------------------------------------------------
function stav_zamku($cislo,$prispevek)
{
$delkasoub=delka_souboru();
$del=delka_nadpisu();
$nazev="naz_topik_{$cislo}.php";
if(file_exists($nazev)=="true")
{
$u=fopen($nazev,"r");
$nadpis=explode("--TPK--",fread($u,$delkasoub));
fclose($u);

return $nadpis[($prispevek*$del)-2];
}
else
{return "";}
}
//---------------------------------------------------------------------
function zamknout_topik($cislo,$prispevek,$jak)
{
$delkasoub=delka_souboru();
$del=delka_nadpisu();
$nazev="naz_topik_{$cislo}.php";

$u=fopen($nazev,"r");
$nadpis=explode("--TPK--",fread($u,$delkasoub));
fclose($u);

$nadpis[($prispevek*$del)-2]=$jak;

$u=fopen($nazev,"w");
fwrite($u,implode($nadpis,"--TPK--"));
fclose($u);

if($jak=="true")
{return "<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Téma odemknuto</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Téma bylo odemknuto.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php?kam=obsah_tema&cis=$cislo&pris=$prispevek&str=1\" class=\"genmed\"><b>zde</b></a> pro návrat.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";}
else
{return "<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Téma zamknuto</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Téma bylo zamknuto.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php?kam=obsah_tema&cis=$cislo&pris=$prispevek&str=1\" class=\"genmed\"><b>zde</b></a> pro návrat.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";}

}
//---------------------------------------------------------------------
function odstranit_prispevek($cislo,$prispevek,$pozice,$jmeno,$idecko,$strana)
{
$nazev1="f_topik_{$cislo}_{$prispevek}.php";
$delkasoub=delka_souboru();
if($pozice>1)
{
$nazev2="f_topik_{$cislo}_{$prispevek}_novota.php";
if(file_exists($nazev2)=="true")
{
$u=fopen($nazev2,"w");
fclose($u);
}

$u=fopen($nazev1,"r");
$pris=explode("--ZPR--",fread($u,$delkasoub));
fclose($u);

$del=delka_obsahu();
$pz=(($pozice*$del)-1)-6; 

$poc=0;
$nove[]="";
for($i=1;$i<$pz;$i++)//1 ze 2
{
$poc++;
$nove[$poc]=$pris[$i];
}//end for

for($i1=$pz+$del;$i1<count($pris);$i1++)//2 ze 2
{
$poc++;
$nove[$poc]=$pris[$i1];
}//end for

odeber_odpoved($cislo,$prispevek);;//odeètení pøíspìvku

odebrat_pocet_prispevku($jmeno,$idecko);//odeète pøíspìvek

vyprazdni_posledni_prispevek_v_hlavnim($cislo);//musí být

//smaz_novotu_vlakna($cislo);

umazat_sledovani($cislo,$prispevek,$strana);//umaže sledování

$u=fopen($nazev1,"w");
fwrite($u,implode($nove,"--ZPR--"));
fclose($u);

return 
"<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Smazání pøíspìvku</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Pøíspìvek byl odstranìn.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php?kam=obsah_tema&cis=$cislo&pris=$prispevek&str=$strana\" class=\"genmed\"><b>zde</b></a> pro návrat.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";
}
else
{
//celý topik
$nazev="naz_topik_{$cislo}.php";
$u=fopen($nazev,"r");
$nadpis=explode("--TPK--",fread($u,$delkasoub));
fclose($u);

$nazev2="f_topik_{$cislo}_{$prispevek}_novota.php";
if(file_exists($nazev2)=="true")
{
$u=fopen($nazev2,"w");
fclose($u);
}

odebrat_pocet_prispevku($jmeno,$idecko);//odebere poèet pøíspìvkù

vyprazdni_posledni_prispevek_v_hlavnim($cislo);//musí být!!

//smaz_novotu_vlakna($cislo);

umazat_sledovani($cislo,$prispevek,$strana);//umaže sledování

$del=delka_nadpisu();
$pz=(($prispevek*$del)-6);

$nove[]="";
$pom=0;
for($i=1;$i<$pz;$i++)//1 ze 2
{
$pom++;
$nove[$pom]=$nadpis[$i];
}//end for

for($i1=$pz+$del;$i1<count($nadpis);$i1++)//2 ze 2
{
$pom++;
$nove[$pom]=$nadpis[$i1];
}//end for

$u=fopen($nazev,"w");
fwrite($u,implode($nove,"--TPK--"));
fclose($u);
//-------------------------------------------------
$nazev2="f_topik_{$cislo}_{$prispevek}.php";
unlink($nazev2);

$pm=0;
for($i=1;$i<count($nadpis)/$del;$i++)
{
$nov="f_topik_{$cislo}_{$i}.php";
$str="f_topik_{$cislo}_{$i}.php";

if($prispevek==$i)
{
//print "smazán: $nov<br>";
for($i1=$i;$i1<(count($nadpis)/$del)-1;$i1++)
{
$pm=$i1+1;
$str="f_topik_{$cislo}_{$pm}.php";
$nov="f_topik_{$cislo}_{$i1}.php";
//print "starý: <i>$str</i>  nahrazen za nový: <i>$nov</i><br>";
rename($str,$nov);
}//end for
}//end if pris==i
}//end for
//-------------------------------------------------
return 
"<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Smazání tématu</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Téma bylo odstranìno.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php?kam=forum&cis=$cislo&str=1\" class=\"genmed\"><b>zde</b></a> pro návrat do seznamu témat.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";
}//end else
}
//---------------------------------------------------------------------
function citace_prispevku($co,$jmeno,$predmet,$zprava)
{
if($co==1){return "$predmet";}
if($co==2){return "[;quote=$jmeno;] $zprava [/quote]

";}
}
//---------------------------------------------------------------------
function uloz_upraveny_prispevek($cislo,$prispevek,$predmet,$zprava,$jmeno,$idecko,$typ,$adr,$pozice,$strana)
{
$nazev1="f_topik_{$cislo}_{$prispevek}.php";
$delkasoub=delka_souboru();
$u=fopen($nazev1,"r");
$pris=explode("--ZPR--",fread($u,$delkasoub));
fclose($u);
//typ ukládá na 2x!
//-------------------------------------------------------------
$pora=delka_nadpisu();

if($pozice==1)
{
$nazev="naz_topik_{$cislo}.php";
$u=fopen($nazev,"r");
$nadpis=explode("--TPK--",fread($u,$delkasoub));
fclose($u);

//5 jmeno
//4 ID
//3 typ
$nadpis[($pora*$prispevek)-3]=$typ;
$nadpis[($pora*$prispevek)-4]=$nadpis[($pora*$prispevek)-4];//ID
$nadpis[($pora*$prispevek)-5]=$nadpis[($pora*$prispevek)-5];//jmeno
$nadpis[($pora*$prispevek)-6]=$predmet;

$u=fopen($nazev,"w");
fwrite($u,implode($nadpis,"--TPK--"));
fclose($u);
}
//-------------------------------------------------------------

$del=delka_obsahu();

$pris[($pozice*$del)-7]=$predmet;
$pris[($pozice*$del)-6]=$zprava;
$pris[($pozice*$del)-5]=$typ; //$pris[(($pozice*$del)-1)-3];//dùležitost (zbyteèný!!!)
$pris[($pozice*$del)-4]=$pris[($pozice*$del)-4];//jmeno
$pris[($pozice*$del)-3]=$pris[($pozice*$del)-3];//ideèko
$pris[($pozice*$del)-2]=$pris[($pozice*$del)-2];//$adr; //adresa
$pris[($pozice*$del)-1]="nic";//$pris[($pozice*$del)-1];//nový (datum)
$pris[($pozice*$del)-0]=$pris[($pozice*$del)-0];//datum();

$u=fopen($nazev1,"w");
fwrite($u,implode($pris,"--ZPR--"));
fclose($u);

return "<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Upravení pøíspìvku</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Pøíspìvek byl upraven.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php?kam=obsah_tema&cis=$cislo&pris=$prispevek&str=$strana#pz$pozice\" class=\"genmed\"><b>zde</b></a> pro zobrazení vaší zprávy.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";
}
//---------------------------------------------------------------------
function nacist_prispevek($cislo,$prispevek,$pozice,$co)
{
$nazev1="f_topik_{$cislo}_{$prispevek}.php";
$delkasoub=delka_souboru();
$u=fopen($nazev1,"r");
$pris=explode("--ZPR--",fread($u,$delkasoub));
fclose($u);
$del=delka_obsahu();
return $pris[(($pozice*$del)-1)-$co];
}
//---------------------------------------------------------------------
/*function odeber_zhlednuti($cislo,$prispevek)
{
$nazev="naz_topik_$cislo.php";
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$tema=explode("--TPK--",fread($u,$delkasoub));
fclose($u);

$del=delka_obsahu();
$tema[(($del-2)*$prispevek)]-=1;

$u=fopen($nazev,"w");
fwrite($u,implode($tema,"--TPK--"));
fclose($u);
}*/
//---------------------------------------------------------------------
function pridej_zhlednuti($cislo,$prispevek)
{
$nazev="naz_topik_{$cislo}.php";
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$tema=explode("--TPK--",fread($u,$delkasoub));
fclose($u);

$del=delka_nadpisu();
$tema[($del*$prispevek)]++;

$u=fopen($nazev,"w");
fwrite($u,implode($tema,"--TPK--"));
fclose($u);
}
//---------------------------------------------------------------------
function obrazky_prispevku($typ,$zamek,$nove)
{
if($typ==0 and $nove=="nove")//popø ze souboru
{
 if($zamek=="true")
 {return "<img src=\"images/folder_new.gif\" alt=\"Nové pøíspìvky\" width=\"23\" height=\"23\">";}
  else
 {return "<img src=\"images/folder_lock_new.gif\" alt=\"\" width=\"23\" height=\"23\">";}
}
else
{
 if($typ==1){return "<img src=\"images/folder_sticky.gif\" alt=\"Dùležité\" width=\"23\" height=\"23\">";}
 if($typ==2){return "<img src=\"images/folder_announce.gif\" alt=\"Oznámení\" width=\"23\" height=\"23\">";}

 if($zamek=="true")
 {return "<img src=\"images/folder.gif\" alt=\"Žádné nové pøíspìvky\" width=\"23\" height=\"23\">";}
  else
 {return "<img src=\"images/folder_lock.gif\" alt=\"\" width=\"23\" height=\"23\">";}
}
}
//---------------------------------------------------------------------
function vyprazdni_posledni_prispevek_v_hlavnim($cislo)
{
$nazev="pos_l_dat_um_qpwjdiowefhuifjkhfjksbgfsuidhiouefhuirghwiufhewfbhuskbvsjkvbsdfjkbhasejkfb.php";
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$pris=explode("--POP--",fread($u,$delkasoub));
fclose($u);

$pris[$cislo]="";

$u=fopen($nazev,"w");
fwrite($u,implode($pris,"--POP--"));
fclose($u);
}
//---------------------------------------------------------------------
function nacti_posledni_prispevek_v_hlavnim($cislo)
{
$nazev="pos_l_dat_um_qpwjdiowefhuifjkhfjksbgfsuidhiouefhuirghwiufhewfbhuskbvsjkvbsdfjkbhasejkfb.php";
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$pris=explode("--POP--",fread($u,$delkasoub));
fclose($u);

if(!Empty($pris[$cislo]))
{return $pris[$cislo];}
else
{return "";}
}
//---------------------------------------------------------------------
function uloz_posledni_prispevek_v_hlavnim($cislo,$datum,$jmeno,$idecko,$prispevek,$pozice,$strana)
{
$nazev="pos_l_dat_um_qpwjdiowefhuifjkhfjksbgfsuidhiouefhuirghwiufhewfbhuskbvsjkvbsdfjkbhasejkfb.php";
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$pris=explode("--POP--",fread($u,$delkasoub));
fclose($u);

$odkaz="$datum<br><a href=\"index.php?kam=info_user&kdo=$jmeno&idic=$idecko\">$jmeno</a> <a href=\"index.php?kam=obsah_tema&cis=$cislo&pris=$prispevek&str=$strana#pz$pozice\"><img src=\"images/minipost_goto_read.gif\" alt=\"Zobrazit poslední pøíspìvek\" title=\"Zobrazit poslední pøíspìvek\" border=\"0\"></a>";

$pris[$cislo]=$odkaz;

$u=fopen($nazev,"w");
fwrite($u,implode($pris,"--POP--"));
fclose($u);
}
//---------------------------------------------------------------------
function odeber_odpoved($cislo,$prispevek)
{
$nazev="naz_topik_$cislo.php";
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$tema=explode("--TPK--",fread($u,$delkasoub));
fclose($u);

$del=delka_nadpisu();
$tema[($del*$prispevek)-1]--;

$u=fopen($nazev,"w");
fwrite($u,implode($tema,"--TPK--"));
fclose($u);
}
//---------------------------------------------------------------------
function pridej_odpoved($cislo,$prispevek)
{
$nazev="naz_topik_{$cislo}.php";
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$tema=explode("--TPK--",fread($u,$delkasoub));
fclose($u);

$del=delka_nadpisu();
$tema[($del*$prispevek)-1]++;

$u=fopen($nazev,"w");
fwrite($u,implode($tema,"--TPK--"));
fclose($u);
}
//---------------------------------------------------------------------
function posledni_prispevek_v_topiku($cislo,$prispevek)
{
$nazev1="f_topik_{$cislo}_{$prispevek}.php";
$delkasoub=delka_souboru();
$u=fopen($nazev1,"r");
$pris=explode("--ZPR--",fread($u,$delkasoub));
fclose($u);
$del=delka_obsahu();
$pozice=(count($pris)-1)/$del;
$zobstr=pocet_prispevku_na_strance();
$strana=ceil($pozice/$zobstr);
return "{$pris[count($pris)-1]}<br><a href=\"index.php?kam=info_user&kdo={$pris[count($pris)-5]}&idic={$pris[count($pris)-4]}\">{$pris[count($pris)-5]}</a>
<a href=\"index.php?kam=obsah_tema&cis=$cislo&pris=$prispevek&str=$strana#pz$pozice\"><img src=\"images/minipost_goto_read.gif\" alt=\"Zobrazit poslední pøíspìvek\" title=\"Zobrazit poslední pøíspìvek\" border=\"0\"></a>";
}
//---------------------------------------------------------------------
function pridat_pocet_prispevku($kdo,$idecko)
{
$poct=parametr_uzivatele($kdo,$idecko,20);
$poct++;
upravit_parametr_uzivatele($kdo,$idecko,20,$poct);
}
//---------------------------------------------------------------------
function odebrat_pocet_prispevku($kdo,$idecko)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$kdo and $udaj[$i+13]==$idecko)
{
$poct=parametr_uzivatele($kdo,$idecko,20);
$poct--;
upravit_parametr_uzivatele($kdo,$idecko,20,$poct);
}

}//end for
}
//---------------------------------------------------------------------
function pridat_novy_prispevek($cislo,$prispevek,$predmet,$zprava,$jmeno,$idecko,$typ,$adr,$strana)
{
$nazev1="f_topik_{$cislo}_{$prispevek}.php";
$delkasoub=delka_souboru();
$u=fopen($nazev1,"r");
$pris=explode("--ZPR--",fread($u,$delkasoub));
fclose($u);

$nazev2="f_topik_{$cislo}_{$prispevek}_novota.php";
$u=fopen($nazev2,"w");
fwrite($u,"nove");
fclose($u);

pridej_odpoved($cislo,$prispevek);

pridat_pocet_prispevku($jmeno,$idecko);

$poz=((count($pris)-1)/delka_obsahu())+1;//pozice pøíspìvku

uloz_posledni_prispevek_v_hlavnim($cislo,datum(),$jmeno,$idecko,$prispevek,$poz,$strana);
//uprav_obrazek_na_hlavnim($cislo);
nastavit_sledovani($jmeno,$cislo,$prispevek,$strana);
stav_sledovani_prispevku($cislo,$prispevek,$strana,$poz);

$pris[count($pris)+1]=$predmet;
$pris[count($pris)+2]=$zprava;
$pris[count($pris)+3]=$typ; //dùležitost
$pris[count($pris)+4]=$jmeno;
$pris[count($pris)+5]=$idecko;
$pris[count($pris)+6]=$adr;
$pris[count($pris)+7]="nic";//Date((Date("j")+1).".n.");//nový
$pris[count($pris)+8]=datum();

$u=fopen($nazev1,"w");
fwrite($u,implode($pris,"--ZPR--"));
fclose($u);

return 
"<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Pøíspìvìk byl pøidán</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Pøidal jste nový pøíspìvìk.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                             <td align=\"center\">Kliknìte <a href=\"index.php?kam=obsah_tema&cis=$cislo&pris=$prispevek&str=$strana#pz$poz\" class=\"genmed\"><b>zde</b></a> pro zobrazení vaší zprávy.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";
}
//---------------------------------------------------------------------
function pocet_prispevku($cislo)
{
$nazev="naz_topik_$cislo.php";
if(file_exists($nazev))
{
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$tema=explode("--TPK--",fread($u,$delkasoub));
fclose($u);
$poct=delka_nadpisu();
$del=delka_obsahu();
$poc=0;
for($i=1;$i<count($tema)/$poct;$i++)
{
$poc+=($tema[(($del-2)*$i)+($i-1)]+1);
}
return $poc;
}
else
{return 0;}
}
//---------------------------------------------------------------------
function pocet_temat($cislo)
{
$nazev="naz_topik_$cislo.php";
$delka=delka_nadpisu();
if(file_exists($nazev)==true)
{
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$tema=explode("--TPK--",fread($u,$delkasoub));
fclose($u);
return (count($tema)-1)/$delka;
}
else
{return 0;}
}
//---------------------------------------------------------------------
function upravit_parametr_uzivatele($jmeno,$idecko,$parametr,$hodnota)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$poc=0;
for($i=1;$i<delka_reg_uzivatelu();$i++)
{
if($udaj[$i]==$jmeno and $udaj[$i+13]==$idecko){$poc=$i;}
}
$udaj[$poc+$parametr]=$hodnota;
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"w");     //u registrace
fwrite($u,implode($udaj,"--CL--"));
fclose($u);
}
//---------------------------------------------------------------------
function podpis_uzivatele($povol,$text)
{
//$pod=parametr_uzivatele($jmeno,11); //+15 povol
if($povol==1 and !Empty($text))
{return "<br>_________________<br>$text";}
else
{return "";}
}
//---------------------------------------------------------------------
function byliste_uzivatele($byt,$navic)
{
//$by=parametr_uzivatele($jmeno,8);
if(!Empty($byt))
{
 if(!Empty($navic))
 {
   return $navic.$byt;
 }
 else
 {
   return $byt;
 }
}
else
{return "";}
}
//---------------------------------------------------------------------
/*
function prispevky_uzivatele($jmeno)
{
//return  parametr_uzivatele($jmeno,20);
}
//---------------------------------------------------------------------
function zalozen_uzivatel($jmeno)
{
//return  parametr_uzivatele($jmeno,19);
}
//---------------------------------------------------------------------
function najdi_uzivatele($jmeno)
{
//return  parametr_uzivatele($jmeno,20);
}
*/
//---------------------------------------------------------------------
function avatar_obrazek($cesta)
{
//$av=parametr_uzivatele($jmeno,17);
if(!Empty($cesta))
{return "<img src=\"$cesta\">";}
else
{return "";}
}
//---------------------------------------------------------------------
function icq_uzivatele($ic)
{
//$ic=parametr_uzivatele($jmeno,3);
if(!Empty($ic))
{return "<a href=\"http://www.icq.com/scripts/search.dll?to=$ic\" target=\"_blank\"><img src=\"images/tlacitka/icon_icq_add.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\"></a>";}
else
{return "";}
}
//---------------------------------------------------------------------
function aol_uzivatele($ao)
{
//$ao=parametr_uzivatele($jmeno,4);
if(!Empty($ao))
{return "<a href=\"http://www.aim.com/screenname=$ao\" target=\"_blank\"><img src=\"images/tlacitka/icon_aim.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\"></a>";}
else
{return "";}
}
//---------------------------------------------------------------------
function yahoo_uzivatele($yh)
{
//$yh=parametr_uzivatele($jmeno,6);
if(!Empty($yh))
{return "<a href=\"http://edit.yahoo.com/config/send_webmesg?.target=$yh&.src=pg\" target=\"_blank\"><span class=\"genmed\"><img src=\"images/tlacitka/icon_yim.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\"></a>";}
else
{return "";}
}
//---------------------------------------------------------------------
function msn_uzivatele($ms)
{
//$ms=parametr_uzivatele($jmeno,5);
if(!Empty($ms))
{return "<a href=\"http://search.msn.com/results.aspx?=$ms\" target=\"_blank\"><img src=\"images/tlacitka/icon_msnm.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\"></a>";}
else
{return "";}
}
//---------------------------------------------------------------------
function www_uzivatele($web)
{
//$wb=parametr_uzivatele($jmeno,7);
if(!Empty($web) and $web!="http://")
{return "<a href=\"$web\" target=\"_blank\"><img src=\"images/tlacitka/icon_www.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\"></a>";}
else
{return "";}
}
//---------------------------------------------------------------------
function email_uzivatele($povol,$email)
{
//$em=parametr_uzivatele($jmeno,12);
if($povol=="1")
{return "<a href=\"mailto:$email\"><img src=\"images/tlacitka/icon_email.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" alt=\"Odeslat e-mail\" title=\"Odeslat e-mail\" border=\"0\"></a>";}
else
{return "";}
}
//---------------------------------------------------------------------
function pohlavi_uzivatele($pohlavi)
{
//$pohl=parametr_uzivatele($jmeno,21);
if($pohlavi=="M"){return "<img src=\"images\ikona_pohlavi_muz.gif\" title=\"Muž\">";}
if($pohlavi=="Z"){return "<img src=\"images\ikona_pohlavi_zena.gif\" title=\"Žena\">";}
}
//---------------------------------------------------------------------
function obrazek_typu_uzivatele($cislo)
{
//$obr=parametr_uzivatele($jmeno,22);
if($cislo==1){return "<img src=\"images/ranks/ranks_uzivatel.gif\">";}
if($cislo==7){return "<img src=\"images/ranks/ranks_elektromechanik.gif\">";}
if($cislo==8){return "<img src=\"images/ranks/ranks_administrator.gif\">";}
}
//---------------------------------------------------------------------
function typ_uzivatele($typ)
{
//$tp=parametr_uzivatele($jmeno,16);
if($typ==1){return "Uživatel";}
if($typ==2){return "Elektromechanik";}
if($typ==3){return "Administrátor";}
if($typ==4){return "Object Creator";}
if($typ==5){return "Object Creator & Elektromechanik";}
if($typ==6){return "Programátor";}
if($typ==7){return "Programátor & Object Creator";}
if($typ==8){return "Programátor & Elektromechanik";}
}
//---------------------------------------------------------------------
function prispevek($cislo,$prispevek,$poradi,$parametr)
{
$rozd=delka_obsahu();
$nazev="f_topik_{$cislo}_{$prispevek}.php";

$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$prispevek=explode("--ZPR--",fread($u,$delkasoub));
fclose($u);
return $prispevek[$poradi+$parametr];
}
//---------------------------------------------------------------------
function delka_reg_uzivatelu()
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
return count(explode("--CL--",fread($u,$delkasoub)));
fclose($u);
}
//---------------------------------------------------------------------
function delka_prispevku($cislo,$prispevek)
{
$rozd=delka_obsahu();
$nazev="f_topik_{$cislo}_{$prispevek}.php";

$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$prispevek=explode("--ZPR--",fread($u,$delkasoub));
fclose($u);

return (count($prispevek)-1)/$rozd;
}
//---------------------------------------------------------------------
/*
function polozky_admina_moderatora($jmeno,$idecko)
{
if(parametr_uzivatele($jmeno,$idecko,16)==3)
{return true;}
else
{return false;}
}*/
//---------------------------------------------------------------------
function parametr_uzivatele($uzivatel,$idecko,$parametr)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$poc=0;
for($i=1;$i<delka_reg_uzivatelu();$i++)
{
if($udaj[$i]==$uzivatel and $udaj[$i+13]==$idecko){$poc=$i;}
}//end fors

if($poc!=0)
{return $udaj[$poc+$parametr];}
else
{return -1;}
}
//---------------------------------------------------------------------
/*
function obsah_tema($cislo)
{
$delkasoub=delka_souboru();
$soub="te_ma_qpwdemwriuvjuoiejdcwriuhvneuirbvuiernvenclnqwdpkweoimcqeodcmrievneiuvwioiwrjnvoierjvoijwiojfoiwrjvrvrv.php";
$u=fopen($soub,"r");
$tema=explode("--TM--",fread($u,$delkasoub));
fclose($u);
return $tema[$cislo];
}*/
//---------------------------------------------------------------------
function id_uzivatele($jmeno,$heslo)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$por=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno and $udaj[$i+2]==$heslo){$por=$i;}
}
return $udaj[$por+13];
}
//---------------------------------------------------------------------
function obsah_pozn($cislo)
{
$delkasoub=delka_souboru();
$soub="poz_namky_dlkjfhiwocniwspqwejfowwchnzsiudcmrweiuvbcnwreuivzbuisfnvezuhvbnwrezuisjfhvnerjhkfvherniuvnervjkhejhverhjv.php";
$u=fopen($soub,"r");
$pozn=explode("--PZ--",fread($u,$delkasoub));
fclose($u);
return $pozn[$cislo];
}
//---------------------------------------------------------------------
function nadpis($cislo)
{
$delkasoub=delka_souboru();
$soub="nad_pi_s_qwpdojsniufcojsiufvhjnviurebhfcbvjdoiqpowdfncwdfkjmvnwriufcmireuíhjoiewghvisucjwruvbwiuijfiwuhfuehfiwhufeueueuuueueuckaeinef.php";
$u=fopen($soub,"r");
$nadpis=explode("--NP--",fread($u,$delkasoub));
fclose($u);
return $nadpis[$cislo];
}
//---------------------------------------------------------------------
function delka_nadpisu_hl()
{
$delkasoub=delka_souboru();
$soub="nad_pi_s_qwpdojsniufcojsiufvhjnviurebhfcbvjdoiqpowdfncwdfkjmvnwriufcmireuíhjoiewghvisucjwruvbwiuijfiwuhfuehfiwhufeueueuuueueuckaeinef.php";
$u=fopen($soub,"r");
$nadpis=explode("--NP--",fread($u,$delkasoub));
fclose($u);
return count($nadpis);
}
//---------------------------------------------------------------------
function delka_registrace()
{
$delkasoub=delka_souboru();
$sb_del="pocet_poli_wpfkwrdfsiomvspedfjvirokjwiefoghveiufhjowiehiwresuvieruhnrunvireunbvireuwnwroiujnfoij.php";
$u=fopen($sb_del,"r");
return fread($u,$delkasoub);
fclose($u);
}
//---------------------------------------------------------------------
function delka_obsahu()
{
$delkasoub=delka_souboru();
$nazev="de_lka_pol_e_obsahu_qpwodkcmuibnwsefgmiuenoiwhnrgbineoufvnejfnwlikrjvoiwrnjfvoijveironvwrokfon.php";
$u=fopen($nazev,"r");
return fread($u,$delkasoub);
fclose($u);
}
//---------------------------------------------------------------------
function delka_nadpisu()
{
$delkasoub=delka_souboru();
$nazev="de_lka_pol_e_nadpisu_pqwdjfncwiufnvowienrviundwrnvisujfnwirojwofhwfweljfclpdfkosjcvmfnbnbv.php";
$u=fopen($nazev,"r");
return fread($u,$delkasoub);
fclose($u);
}
//---------------------------------------------------------------------
function pridani_topiku($cis,$subject,$message,$jmeno,$idecko,$topictype,$adr)
{
$nazev="naz_topik_{$cis}.php";
if(file_exists($nazev)==false)
{
$u=fopen($nazev,"w");
fwrite($u,"");
fclose($u);
}

$poct=delka_nadpisu();
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$nadpis=explode("--TPK--",fread($u,$delkasoub));
fclose($u);

$opk=0;
for($i=1;$i<count($nadpis);$i++)
{
if($nadpis[$i]==$subject){$opk++;}
}//end for

if($opk==0)
{
$nadpis[count($nadpis)+1]=$subject;
$nadpis[count($nadpis)+2]=$jmeno;
$nadpis[count($nadpis)+3]=$idecko;
$nadpis[count($nadpis)+4]=$topictype;
$nadpis[count($nadpis)+5]="true";//true: odemknuto
$nadpis[count($nadpis)+6]=0; //odpovìdí
$nadpis[count($nadpis)+7]=0; //zhlédnuto

uloz_posledni_prispevek_v_hlavnim($cis,datum(),$jmeno,$idecko,((count($nadpis)-1)/$poct),1,1);
//uprav_obrazek_na_hlavnim($cis);

$u=fopen($nazev,"w");
fwrite($u,implode($nadpis,"--TPK--"));
fclose($u);
//--------------------------------------------
$cislo=(count($nadpis)-1)/$poct;//pøíspìvek
$nazev1="f_topik_{$cis}_{$cislo}.php";

$nazev2="f_topik_{$cis}_{$cislo}_novota.php";
$u=fopen($nazev2,"w");
fwrite($u,"nove");
fclose($u);

nastavit_sledovani($jmeno,$cis,$cislo,1);
stav_sledovani_prispevku($cis,$cislo,1,1);

if(file_exists($nazev1)==false and $opk==0)
{
$u=fopen($nazev1,"w");
fwrite($u,"");
fclose($u);
}

$delkasoub=delka_souboru();
$u=fopen($nazev1,"r");
$obsah=explode("--ZPR--",fread($u,$delkasoub));
fclose($u);


$obsah[count($obsah)+1]=$subject;//pøedmìt
$obsah[count($obsah)+2]=$message;//zpráva
$obsah[count($obsah)+3]=$topictype;//dùležitost
$obsah[count($obsah)+4]=$jmeno;
$obsah[count($obsah)+5]=$idecko;
$obsah[count($obsah)+6]=$adr;
$obsah[count($obsah)+7]="nic";//Date((Date("j")+1).".n.");//nový
$obsah[count($obsah)+8]=datum();//založeno

$u=fopen($nazev1,"w");
fwrite($u,implode($obsah,"--ZPR--"));
fclose($u);

pridat_pocet_prispevku($jmeno,$idecko);

return 
"<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Téma bylo pøídáno</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Pøidal jste nové téma.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$cislo&str=1#pz1\" class=\"genmed\"><b>zde</b></a> pro zobrazení vaší zprávy.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";
}//end opk==0
else
{
return 
"<table class=\"forumline\" width=\"100%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">
  <tr>
    <td height=\"25\" valign=\"middle\">
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
                            <td class=\"cattitle\"><span class=\"tableTitle\">Napsali jste již existující název tématu</span></td>
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
                        <table width=\"80%\" cellspacing=\"3\" cellpadding=\"2\" border=\"0\" align=\"center\">
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\"><span class=\"genmed\"><b>Napište jiný název tématu, protože tento název již existuje.</b></span></td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align=\"center\">Kliknìte <a href=\"javascript:history.back();\" class=\"genmed\"><b>zde</b></a> pro návrat.</td>
                          </tr>
                          <tr>
                            <td align=\"center\">&nbsp;</td>
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
</td>
  </tr>
</table>";
}//end if else

}
//---------------------------------------------------------------------
function prekopej_text($text)
{
$delkasoub=delka_souboru();
$sb_hes="skr_ypt_zn_ack_y_pqwkdfciournviowemvionvmsvinsokfmwirumviowjdvmiojvmifovjnmwroviksjkmowirkvjkowivjvikmweoivnoiwrejnv.php";
$u=fopen($sb_hes,"r");
$zdroj=explode("--z--",fread($u,$delkasoub));
fclose($u);

$sb_hes="skry_p_t_zn_prevod_qpfomcieufnbviomciwnvisnmvosdmvosfnmvosnvjfdnbslkmvsokfmvosikdmvfolksdvnslkfmvsdfolkvmdolkfvmed.php";
$u=fopen($sb_hes,"r");
$nahrada=explode("--zp--",fread($u,$delkasoub));
fclose($u);

if(count($zdroj)==count($nahrada))
{
$upr[0]=$text;
for($i=1;$i<count($zdroj);$i++)
{
$upr[$i]=str_replace($zdroj[$i],$nahrada[$i],$upr[$i-1]);
}//end for
return $upr[count($zdroj)-1];
}//end if
else
{return "<font color=\"red\"><b>Chyba ".count($zdroj).":".count($nahrada)."</b></font>";}
}
//---------------------------------------------------------------------
function vygeneruj_nazev_obrazku($typ)
{
if($typ=="image/gif"){$konc=".gif";}
if($typ=="image/pjpeg"){$konc=".jpg";}
$slz=0;
for($i=1;$i<10;$i++)
{
$slz.=rand(1,1000);
}//end for
return "$slz$konc";
}
//---------------------------------------------------------------------
function zapomel_heslo($jmeno,$email,$adr)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$ppm=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno and $udaj[$i+1]==$email){$ppm=$i;}
}//end for

$tex="Klient: <b>$jmeno</b> požádal o zaslání hesla. Jeho e-mail: <b>$email</b>, zaslané heslo: <i>{$udaj[$ppm+2]}</i> v: ".Date("H:i:s j.n. Y")." z IP: $adr<br>\n";
$soub="zas_la_ni_h_es_la_qwpfdkcosiovnsriunvsornvsnoijnvsfoinsokjkjnsfjniujbndonrsonkjnskjvnbrfjnjn.php";
$uk=fopen($soub,"a+");
fwrite($uk,$tex);
fclose($uk);

if($ppm!=0)
{
$heslo=$udaj[$ppm+2];
mail($email,"Fugessovo fórum - žádost o heslo","Dobrý den,\n\nVaše žádost o zaslání hesla byla potvrzena.\n\nVaše udaje:\n\n--------------------------\nJméno: $jmeno\nHeslo: $heslo\n--------------------------\n\nDìkuji,\nFugess"); //pro klienta
mail("fugess.martin@centrum.cz","Požádání o poslání hesla","Klient: $jmeno požádal o poslání hesla\nE-mail klienta: $email\nJeho heslo: $heslo\nV: ".Date("H:i:s j.m. Y")."\nJeho IP: $adr"); //pro admina na email
return "true";
}
else
{return "false";}
}
//---------------------------------------------------------------------
function anonymnich($adr)//doøešit!!
{
return pocet_uzivatelu($adr)-((pocet_pritomnych_2()-1)/2);
}
//---------------------------------------------------------------------
function registrovanych()//doøešit!!
{
return ((pocet_pritomnych_2()-1)/2);
}
//---------------------------------------------------------------------
function obnov_pritomne()//doøešit!!
{
$uziv="";
$delkasoub=delka_souboru();
$sb_hes="prito_mni_uziva_te_le_qwpfeocmruivnmeioubnriuvijeriuvnuidbnvikudnvlkjdfnv.php";
$u=fopen($sb_hes,"w");
fwrite($u,$uziv);
//$uziv=explode("--UZ--",fread($u,$delkasoub));
fclose($u);

$soub="ip_na_ser_ve_ru_qwpfocemrimvwgvunisuocnmwriuvnisuvnreiuvnusvhnjwsdcoilkjhnwkvnkwdfv.php";
$u=fopen($soub,"w");
fwrite($u,$uziv);
//$adr=explode("--IP--",fread($u,$delkasoub));
fclose($u);
}
//---------------------------------------------------------------------
function odpocet($cas)//doøešit!!
{
if($cas==59){obnov_pritomne();}//dodìlat!
}
//---------------------------------------------------------------------
function pocet_pritomnych_2()//doøešit!!
{
$delkasoub=delka_souboru();
$sb_hes="prito_mni_uziva_te_le_qwpfeocmruivnmeioubnriuvijeriuvnuidbnvikudnvlkjdfnv.php";
$u=fopen($sb_hes,"r");
$uziv=explode("--UZ--",fread($u,$delkasoub));
fclose($u);

return count($uziv);
}
//---------------------------------------------------------------------
function vypis_uzivatelu($cislo)//doøešit!!
{
$delkasoub=delka_souboru();
$sb_hes="prito_mni_uziva_te_le_qwpfeocmruivnmeioubnriuvijeriuvnuidbnvikudnvlkjdfnv.php";
$u=fopen($sb_hes,"r");
$uziv=explode("--UZ--",fread($u,$delkasoub));
fclose($u);

$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$vyp[]="";
$pcl=0;
for($i=1;$i<(count($uziv)/2);$i=$i+2)
{
$pcl++;
$vyp[$pcl]=$udaj[$uziv[$i]];
}//end if
return $vyp[$cislo];
}
//---------------------------------------------------------------------
function rozlis_dle_adresy($jmeno,$heslo,$adresa)//doøešit!
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$sb_hes="prito_mni_uziva_te_le_qwpfeocmruivnmeioubnriuvijeriuvnuidbnvikudnvlkjdfnv.php";
$u=fopen($sb_hes,"r");
$uziv=explode("--UZ--",fread($u,$delkasoub));
fclose($u);

$pmp=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno and $udaj[$i+2]==$heslo){$pmp=$i;}
}//end for

$ppj=0;
for($i=1;$i<count($uziv);$i++)
{
if($uziv[$i]==$adresa){$ppj++;}
}//end for

if($pmp!=0 and $ppj==0)
{
$uziv[count($uziv)+1]=$pmp;
$uziv[count($uziv)+2]=$adresa;
$soub="prito_mni_uziva_te_le_qwpfeocmruivnmeioubnriuvijeriuvnuidbnvikudnvlkjdfnv.php";
$u=fopen($soub,"w");     //u registrace
fwrite($u,implode($uziv,"--UZ--"));
fclose($u);
}//end if
//return $uziv;//dodìlat výpis!
}
//---------------------------------------------------------------------
function delka_souboru()
{
$soubr="del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,100);
fclose($u);
return $delkasoub;
}
//---------------------------------------------------------------------
function delka_fora($cislo)
{
$delkasoub=delka_souboru();
$soub="del_ky_qwpdfojaedsvinuidfsvjnaosdfnvuaidfghnvsdifviufhvnriugvnsaidfhnasfviodufgnrsforglnasfqwpoidfjajdfioqp.php";
$u=fopen($soub,"r");
$delka=explode("--DL--",fread($u,$delkasoub));
fclose($u);
return $delka[$cislo];
}
//---------------------------------------------------------------------
function pocet_uzivatelu($adresa)//doøešit!!
{
$delkasoub=delka_souboru();
$soub="ip_na_ser_ve_ru_qwpfocemrimvwgvunisuocnmwriuvnisuvnreiuvnusvhnjwsdcoilkjhnwkvnkwdfv.php";
$u=fopen($soub,"r");
$adr=explode("--IP--",fread($u,$delkasoub));
fclose($u);

$prr=0;
for($i=1;$i<count($adr);$i++)
{
if($adr[$i]==$adresa){$prr++;}
}//end for

if($prr==0)
{
$adr[count($adr)+1]=$adresa;
$soub="ip_na_ser_ve_ru_qwpfocemrimvwgvunisuocnmwriuvnisuvnreiuvnusvhnjwsdcoilkjhnwkvnkwdfv.php";
$u=fopen($soub,"w");     //u registrace
fwrite($u,implode($adr,"--IP--"));
fclose($u);
}//emd if
return count($adr)-1;
}
//---------------------------------------------------------------------
function uzivatel($cislo)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

return $udaj[$cislo];
}
//---------------------------------------------------------------------
function posledni_uzivatel()
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$pocet=delka_registrace();

return "<a href=\"index.php?kam=info_user&kdo={$udaj[count($udaj)-$pocet]}&idic={$udaj[(count($udaj)-$pocet)+13]}\" class=\"genmed\">{$udaj[count($udaj)-$pocet]}</a>";
}
//---------------------------------------------------------------------
function pocet_uzivatelu_celkem()
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$pocet=delka_registrace();

return (count($udaj)-1)/$pocet;
}
//---------------------------------------------------------------------
function temata_topiku($tema,$cislo)
{
$poct=delka_nadpisu();
$nazev="naz_topik_{$tema}.php";
if(file_exists($nazev)=="true")
{
$delkasoub=delka_souboru();
$u=fopen($nazev,"r");
$nadpis=explode("--TPK--",fread($u,$delkasoub));
fclose($u);

return $nadpis[(($cislo-1)*$poct)+1];
}
else
{return "<a href=\"index.php\">Téma nebo pøíspìvek neexistuje</a>";}
}
//---------------------------------------------------------------------
function temata_fora($cislo)
{
$delkasoub=delka_souboru();
$soub="te_ma_qpwdemwriuvjuoiejdcwriuhvneuirbvuiernvenclnqwdpkweoimcqeodcmrievneiuvwioiwrjnvoierjvoijwiojfoiwrjvrvrv.php";
$u=fopen($soub,"r");
$tema=explode("--TM--",fread($u,$delkasoub));
fclose($u);
return $tema[$cislo-1];
}
//---------------------------------------------------------------------
function cesta_ve_foru($kde,$ur1,$ur2)
{
$zacat=nazev_fora();
if(!Empty($kde))
{
if($kde=="hledani"){$text="Hledat";}
if($kde=="uzivatele"){$text="Seznam uživatelù";}
if($kde=="skupiny"){$text="Uživatelské skupiny";}
if($kde=="profil"){$text="Profil";}
if($kde=="inbox"){$text="Soukromé zprávy";}
if($kde=="info_user"){$text="Informace o uživateli";}
if($kde=="logoff"){$text="Odhlášení";}
if($kde=="login" or $kde=="prihlaseni"){$text="Pøihlášení";}
if($kde=="registrace"){$text="Registrace";}
//if($kde=="novy_topik"){$text="Nové téma";}
//if($kde=="novy_pris"){$text="Forum";}
if($kde=="zap_heslo"){$text="Zapomenuté heslo";}
if($kde=="vn_tp"){$text="Nevyplnily jste text nebo pøedmìt zprávy";}
if($kde=="vn_pr"){$text="Nevyplnily jste text zprávy";}
//if($kde==""){$text="";}
//if($kde==""){$text="";}
//if($kde==""){$text="";}
if($ur1!=0)
{
if($ur2!=0)
{
$urov=temata_fora($ur1);
$urov1=temata_topiku($ur1,$ur2);
return "<a href=\"index.php\" class=\"nav\">$zacat</a> -> <A href=\"index.php?kam=forum&cis=$ur1&str=1\">$urov</a> -> <A href=\"index.php?kam=obsah_tema&cis=$ur1&pris=$ur2&str=1\">$urov1</a>";
}
else
{
$urov=temata_fora($ur1);
return "<a href=\"index.php\" class=\"nav\">$zacat</a> -> <A href=\"index.php?kam=forum&cis=$ur1&str=1\">$urov</a>";
}//end else if ul2
}
else
{if(Empty($text)){$text="";}
return "<a href=\"index.php\" class=\"nav\">$zacat</a> -> $text";}

}
else
{return "<a href=\"index.php\" class=\"nav\">$zacat</a>";}
}
//---------------------------------------------------------------------
function nazev_fora()
{
$soub="nazev_for_a_pqowemfiuscnmweuinisnciwenfuiwewfwwefwiuwrnvwvuniwubeniuwndeoiunwdoiujn.php";
$u=fopen($soub,"r");
return fread($u,100);
fclose($u);
}
//---------------------------------------------------------------------
function autorizace($cislo)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$pocet=delka_registrace();

$i1=0;
$ciuz=0;
$cis=0;
for($i=1;$i<count($udaj);$i++)
{
$i1=$i1+($pocet+2);
if($cislo==$udaj[$i])
 {
  $cis=$i;
  $ciuz=round($i/$pocet)+1;//èíslo uživatele
 }
}//end for
$soubor="autorizace_no$cislo.php";

if($cis!=0)
{
$udaj[$cis]="";
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"w");
fwrite($u,implode($udaj,"--CL--"));
fclose($u);
unlink($soubor);//smazání autorizaèního souboru
}//end if vymaz 
}
//---------------------------------------------------------------------
function autorizacni_kod($jmeno)
{
$nahc[]=0;
$nazn="";
$delka=count($jmeno);
if($delka<4){$delka=8;}

for($i=0;$i<($delka*10);$i++)
{
$nahc[$i]=rand(10,5000);
$nazn+=$nahc[$i];
}
return $nazn;
}
//---------------------------------------------------------------------
function identifikacni_cislo()
{
$slz=0;
for($i=1;$i<10;$i++)
{
$slz.=rand(1,10000);
}//end for
return $slz;
}
//---------------------------------------------------------------------
function registrace($jmeno,$email,$heslo_1,$heslo_2,$icq,$aim,$msn,$yim,$web,$location,$occupation,$interests,$signature,$viewemail,$notifyreply,$notifypm,$attachsig,$server,$slozka,$adresa,$pohlavi)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$pocp=0;//vyhledání duplikátù
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno){$pocp++;}//jméno email!
if($udaj[$i]==$email){$pocp++;}
}//end for
if($pocp!=0)//kontrola duplikátù
{$stav="false";}

$koema=strpos($email,"@");
if($heslo_1==$heslo_2 and $koema!=0 and $pocp==0)
{
$genjm=autorizacni_kod($jmeno);
$obr="";

$udaj[0]="<?php";//ochrana!!
$udaj[count($udaj)+1]=$jmeno;
$udaj[count($udaj)+2]=$email;
$udaj[count($udaj)+3]=$heslo_1;
$udaj[count($udaj)+4]=$icq;
$udaj[count($udaj)+5]=$aim;
$udaj[count($udaj)+6]=$msn;
$udaj[count($udaj)+7]=$yim;
$udaj[count($udaj)+8]=$web;
$udaj[count($udaj)+9]=$location;
$udaj[count($udaj)+10]=$occupation;
$udaj[count($udaj)+11]=$interests;
$udaj[count($udaj)+12]=$signature;
$udaj[count($udaj)+13]=$viewemail;//zobrazení meilu
$udaj[count($udaj)+14]=identifikacni_cislo();//pøesná identifikace uživatele
$udaj[count($udaj)+15]="nic";//$notifypm;
$udaj[count($udaj)+16]=$attachsig;//zobrazeni podpisu
$udaj[count($udaj)+17]=1; //typ: uživatel
$udaj[count($udaj)+18]=$obr; //cesta obrázku
$udaj[count($udaj)+19]=$genjm;//generované èíslo
$udaj[count($udaj)+20]=Date("j.n.Y");//založení
$udaj[count($udaj)+21]=0;//poèet pøíspìvkù
$udaj[count($udaj)+22]=$pohlavi;//pohlaví
$udaj[count($udaj)+23]=1;//hodnoceni dle pøíspìvkù

$tex="<?
include \"funkce.php\";
autorizace($genjm);
?>
<b>Váš uèet s doèasným èíslem <u><? print $genjm; ?></u> byl aktivován.</b> 
<b>Kliknìte <a href=\"http://$server/$slozka/index.php?kam=login\"><u>zde</u></a> pro pøihlášení.</b>"; //obsah stránky

$soub="autorizace_no$genjm.php";
$uk=fopen($soub,"w");
fwrite($uk,$tex);
fclose($uk);

//soubor s emaily  --EMA--
$tex_me="<?php";
$soub_me="{$jmeno}_pqaovdnsfijnsfvlknvjnsdfivjnsdkjvndxkljvnsfjnvsfvisujdjbvfjsoinv.php";
$uk=fopen($soub_me,"w");
fwrite($uk,$tex_me);
fclose($uk);

$link="http://$server/$slozka/$soub";
logovani_aktivace($adresa,$link,$soub);

mail($email,"Fugessovo fórum - Registrace","Dobrý den,\n\nVaše registrace byla zaznamenána.\nRegistrace zatím není potvrzena. Pro potvrzení klapnìte na následující odkaz, který aktivuje Váš úèet.\n\n$link.\n\nVaše pøihlašovací údaje:\n--------------------------\nJméno: $jmeno\nHeslo: $heslo_1\n--------------------------\n\nTento e-mail si prosím uschovejte.\n\nDìkuji,\nFugess."); //pro klienta
mail("fugess.martin@centrum.cz","Žádost o registraci na Fugessovì fóru","Registruje se klient: $jmeno \ns emailem: $email \ns heslem: $heslo_1 \n Jeho aktivaèni odkaz: $link \nv: ".Date("H:i:s j.m. Y")." \nz IP: $adresa"); //pro admina na email

$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"w");     //u registrace
fwrite($u,implode($udaj,"--CL--"));
fclose($u);
$stav="true";
}//end if rovná se heslo
return $stav;
}
//---------------------------------------------------------------------
function logovani_aktivace($adresa,$souborCesta,$soubor)
{
$delkasoub=delka_souboru();
$sb_hes="seznam_akti_vace_qpewfmonfvdvkmwoibndslkfjmeoijgvkfmwfgnvdkfjiworebpiojweolfiljnoslkmnfoiksdnoesdjrng.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--AT--",fread($u,$delkasoub));
fclose($u);

$udaj[count($udaj)+1]=$soubor;

$sb_hes="seznam_akti_vace_qpewfmonfvdvkmwoibndslkfjmeoijgvkfmwfgnvdkfjiworebpiojweolfiljnoslkmnfoiksdnoesdjrng.php";
$u=fopen($sb_hes,"w");
fwrite($u,implode($udaj,"--AT--"));
fclose($u);

$tex="Vytvoøen link <a href=\"$souborCesta\" target=\"_blank\"><b>$souborCesta</b></a> v: ".Date("H:i:s j.n. Y")." z IP: $adresa<br>\n";
$soub="akt_iv_log_qepfsovjdnviwekjfviuedhwiuegvieusfnwribvizeuhfwriugbvebviewriuhfjfoiwjvoiwrnfnfvnnnv.php";
$uk=fopen($soub,"a+");
fwrite($uk,$tex);
fclose($uk);
}
//---------------------------------------------------------------------
function login($jmeno,$heslo)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$pris=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno and $udaj[$i+2]==$heslo and $udaj[$i+18]=="")
{$pris++;}
}//end for

if($pris==1)
{return "true";}//povoleno
else
{return "false";}
}
//---------------------------------------------------------------------
function hlavni_logovani($kde,$adresa)
{
$tex="Kliknuto na: <b>$kde</b> v: ".Date("H:i:s j.n. Y")." z IP: $adresa<br>\n";
$soub="hlav_ni_log_qpfcmiruhgniewijfveuiccoiwrehnviunfenrzuibirunvowieufniuruwenbfiunbreiunrefgiunreiuniuneiunbugerunb.php";
$uk=fopen($soub,"a+");
fwrite($uk,$tex);
fclose($uk);
}
//---------------------------------------------------------------------
function logovani_pohybu($jmeno,$heslo,$adresa,$cislo,$prispevek)
{
$tex="Uzivatel <b>$jmeno</b> s heslem: $heslo klikl na topik: $cislo, pøíspìvek: $prispevek ".Date("H:i:s j.m. Y")." z IP: $adresa <br>\n";
$soub="poh_yb_po_sstr_qpwjfcsodnvsdalnjaodkjqipojfcuifsncwevbisciusjvnwisvbisucoahncalfvndfuhznbv.php";
$uk=fopen($soub,"a+");
fwrite($uk,$tex);
fclose($uk);
}
//---------------------------------------------------------------------
function logovani_prihlasovani($jmeno,$heslo,$adresa,$stav)
{
if($stav=="true")
{$pov="povoleno";}
else
{$pov="zakázano";}
$tex="Pøihlašování: <b>$jmeno</b> s heslem: <b>$heslo</b> v: ".Date("H:i:s j.m. Y")." z IP: $adresa pøístup: <b>$pov</b><br>\n";
$soub="prih_l_log_qwpofjsuoimwvnieunviueoiwrngvoiweunvzubadflkjofnvoiujsdfnvoikjdfmvoiunedfoibnuoinbqpwoeirdkslcmmbgzhezhgewewwwfnbreuxy.php";
$uk=fopen($soub,"a+");
fwrite($uk,$tex);
fclose($uk);
}
//---------------------------------------------------------------------
function banovani($adresa)
{
$sou_ban="ban_li_di_qpwdfjwoiunvrnvirwezbvbzeuivnwruzniwujenviuubnwieufzuhqzqwvfvwf.php";
$u=fopen($sou_ban,"r");
$ban=explode("--ban--",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$adresa)
{ 
echo "<br><br><br><br><br><h2 align=center>Na tyto stránky máte zákaz vstupu!!</h2>";
exit;
}//end if
}//end for
}
//---------------------------------------------------------------------
function datum()
{
if(date("w")=="0"){$den="nedìle";}
if(date("w")=="1"){$den="pondìlí";}
if(date("w")=="2"){$den="úterý";}
if(date("w")=="3"){$den="støeda";}
if(date("w")=="4"){$den="ètvrtek";}
if(date("w")=="5"){$den="pátek";}
if(date("w")=="6"){$den="sobota";}

if(date("n")=="1"){$mes="leden";}
if(date("n")=="2"){$mes="únor";}
if(date("n")=="3"){$mes="bøezen";}
if(date("n")=="4"){$mes="duben";}
if(date("n")=="5"){$mes="kvìten";}
if(date("n")=="6"){$mes="èerven";}
if(date("n")=="7"){$mes="èervenec";}
if(date("n")=="8"){$mes="srpen";}
if(date("n")=="9"){$mes="záøí";}
if(date("n")=="10"){$mes="øíjen";}
if(date("n")=="11"){$mes="listopad";}
if(date("n")=="12"){$mes="prosinec";}

return "$den, ".date("j")." $mes, ".date("Y H:i");
}
//---------------------------------------------------------------------

//---------------------------------------------------------------------

/*

*/
?>
