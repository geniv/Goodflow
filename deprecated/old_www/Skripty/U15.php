<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
     <HEAD>
          <TITLE>U15.php</TITLE>
          <META http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </HEAD>
<BODY BGCOLOR="#F4E5B0">
  <!-- U15.php -->
  <DIV ALIGN="CENTER">
    <H1> *** Hra NIMM *** </H1><BR>
  </DIV>
  <DIV ALIGN="JUSTIFY">
    Hra naz�van� NIMM spo��v� v odeb�r�n� z�palek z hrom�dky. Hra za��n� zvolen�m po�tem z�palek
 na stole. Pak se pravideln� st��daj� oba hr��i v odeb�r�n� z�palek z hrom�dky. Mohou odebrat
 jednu a� zvolen� maximum z�palek v jednom tahu. Kdo odebere posledn� z�palku, prohr�v�. Tento
 program je sestaven tak, aby po��ta� vyu��val "vyhr�vaj�c� strategie". P�ijdete na ni i Vy?
  </DIV>
  <HR><BR>
 <?
    if(!$MAX || $MAX<1):
      if($POC<0 || $MAX<0)
        echo "<FONT COLOR=RED><CENTER><B>Mus�te zadat p�irozen� ��slo...</B></CENTER></FONT>";
 ?>
  <FORM>
  <TABLE RULES="NONE" ALIGN="CENTER" CELLPADDING=5 BGCOLOR="#8D5F07">
    <TR><TH COLSPAN=2>&nbsp;</TH></TR>
    <TR><TH><FONT COLOR="WHITE">&nbsp;Zadejte po�et sirek na hrom�dce:&nbsp;</FONT></TH>
        <TD><INPUT TYPE=TEXT NAME="POC" VALUE=<? echo $POC; ?>></TD></TR>
    <TR><TH><FONT COLOR="WHITE">&nbsp;Kolik se m��e odebrat najednou z�palek?&nbsp;</FONT></TH>
        <TD><INPUT TYPE=TEXT NAME="MAX" VALUE=<? echo $MAX; ?>></TD></TR>
  </TABLE><BR>
  <TABLE RULES=NONE ALIGN="CENTER" CELLPADDING=5 BGCOLOR="#8D5F07">
    <TR><TD><INPUT TYPE=SUBMIT VALUE="Spustit hru"></TD></TR>
  </TABLE>
  <INPUT TYPE=HIDDEN NAME="ODEB" VALUE=0>
  </FORM>
 <? else: ?>
  <?
  if($POPRVE && ($ODEB<1 || $ODEB>$MAX)):
    echo "<FONT COLOR=\"RED\"><CENTER><B>Dohodli jsme se, �e odeb�r�me 1 - $MAX z�palek!!!</B></CENTER></FONT>";
  ?><FORM>
  <TABLE RULES="NONE" ALIGN="CENTER" CELLPADDING=5 BGCOLOR="#8D5F07">
    <TR><TH COLSPAN=2>&nbsp;<? echo "<FONT COLOR=WHITE>Na hrom�dce je $POC z�palek.</FONT>"; ?></TH></TR>
    <TR><TH><FONT COLOR="WHITE">&nbsp;Kolik z�palek odeb�r�te Vy?&nbsp;</FONT></TH>
        <TD><INPUT TYPE=TEXT NAME="ODEB">
            <INPUT TYPE=HIDDEN NAME="POC" VALUE=<? echo $POC; ?>>
            <INPUT TYPE=HIDDEN NAME="MAX" VALUE=<? echo $MAX; ?>>
            <INPUT TYPE=HIDDEN NAME="POPRVE" VALUE=1></TD></TR>
  </TABLE><BR>
  <TABLE RULES="NONE" ALIGN="CENTER" CELLPADDING=5 BGCOLOR="#8D5F07">
    <TR><TD><INPUT TYPE=SUBMIT VALUE="Potvrdit"></TD></TR>
  </TABLE>
  </FORM>
<? else:
    $POC-=$ODEB;
    if($POC<1){
      echo "<FONT COLOR=\"RED\"><CENTER><B>Prohr�l jste.</B></CENTER></FONT>";
      echo "<CENTER><FORM><INPUT TYPE=SUBMIT VALUE=\"   OK   \"></FORM></CENTER>";
      exit;
    }
    $Z=$MAX+1;
    // V�po�et hodnoty na vyhr�vaj�c� linii
    $A=($POC-1)%$Z;
    if($A==0){
      --$POC;
      $VYPIS="Odeb�r�m jednu z�palku. Z�st�v� $POC sirek.";
    }else{
      $VYPIS="Odeb�r�m $A z�palky.";
      $POC-=$A;
    }
    if($POC<1){
      echo "<FONT COLOR=\"RED\"><CENTER><B>Prohr�l jsem, gratuluji k �sp�chu.</B></CENTER></FONT>";
      echo "<CENTER><FORM><INPUT TYPE=SUBMIT VALUE=\"   OK   \"></FORM></CENTER>"; // za��tek nov� hry
      exit;
    }
  ?>
  <FORM>
  <TABLE RULES="NONE" ALIGN="CENTER" CELLPADDING=5 BGCOLOR="#8D5F07">
    <TR><TH COLSPAN=2>&nbsp;<? echo "<FONT COLOR=\"WHITE\">".$VYPIS."</FONT>"; ?></TH></TR>
    <TR><TH COLSPAN=2>&nbsp;<? echo "<FONT COLOR=\"WHITE\">Na hrom�dce je $POC z�palek.</FONT>"; ?></TH></TR>
    <TR><TH><FONT COLOR="WHITE">&nbsp;Kolik z�palek odeb�r�te Vy?&nbsp;</FONT></TH>
        <TD><INPUT TYPE=TEXT NAME="ODEB">
            <INPUT TYPE=HIDDEN NAME="POC" VALUE=<? echo $POC; ?>>
            <INPUT TYPE=HIDDEN NAME="MAX" VALUE=<? echo $MAX; ?>>
            <INPUT TYPE=HIDDEN NAME="POPRVE" VALUE=1></TD></TR>
  </TABLE><BR>
  <TABLE RULES="NONE" ALIGN="CENTER" CELLPADDING=5 BGCOLOR="#8D5F07">
    <TR><TD><INPUT TYPE=SUBMIT VALUE="Potvrdit"></TD></TR>
  </TABLE>
  </FORM>
 <? endif; ?>
 <? endif; ?>
</BODY>
</HTML>
