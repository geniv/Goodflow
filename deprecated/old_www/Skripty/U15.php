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
    Hra nazývaná NIMM spočívá v odebírání zápalek z hromádky. Hra začíná zvoleným počtem zápalek
 na stole. Pak se pravidelně střídají oba hráči v odebírání zápalek z hromádky. Mohou odebrat
 jednu až zvolené maximum zápalek v jednom tahu. Kdo odebere poslední zápalku, prohrává. Tento
 program je sestaven tak, aby počítač využíval "vyhrávající strategie". Přijdete na ni i Vy?
  </DIV>
  <HR><BR>
 <?
    if(!$MAX || $MAX<1):
      if($POC<0 || $MAX<0)
        echo "<FONT COLOR=RED><CENTER><B>Musíte zadat přirozené číslo...</B></CENTER></FONT>";
 ?>
  <FORM>
  <TABLE RULES="NONE" ALIGN="CENTER" CELLPADDING=5 BGCOLOR="#8D5F07">
    <TR><TH COLSPAN=2>&nbsp;</TH></TR>
    <TR><TH><FONT COLOR="WHITE">&nbsp;Zadejte počet sirek na hromádce:&nbsp;</FONT></TH>
        <TD><INPUT TYPE=TEXT NAME="POC" VALUE=<? echo $POC; ?>></TD></TR>
    <TR><TH><FONT COLOR="WHITE">&nbsp;Kolik se může odebrat najednou zápalek?&nbsp;</FONT></TH>
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
    echo "<FONT COLOR=\"RED\"><CENTER><B>Dohodli jsme se, že odebíráme 1 - $MAX zápalek!!!</B></CENTER></FONT>";
  ?><FORM>
  <TABLE RULES="NONE" ALIGN="CENTER" CELLPADDING=5 BGCOLOR="#8D5F07">
    <TR><TH COLSPAN=2>&nbsp;<? echo "<FONT COLOR=WHITE>Na hromádce je $POC zápalek.</FONT>"; ?></TH></TR>
    <TR><TH><FONT COLOR="WHITE">&nbsp;Kolik zápalek odebíráte Vy?&nbsp;</FONT></TH>
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
      echo "<FONT COLOR=\"RED\"><CENTER><B>Prohrál jste.</B></CENTER></FONT>";
      echo "<CENTER><FORM><INPUT TYPE=SUBMIT VALUE=\"   OK   \"></FORM></CENTER>";
      exit;
    }
    $Z=$MAX+1;
    // Výpočet hodnoty na vyhrávající linii
    $A=($POC-1)%$Z;
    if($A==0){
      --$POC;
      $VYPIS="Odebírám jednu zápalku. Zůstává $POC sirek.";
    }else{
      $VYPIS="Odebírám $A zápalky.";
      $POC-=$A;
    }
    if($POC<1){
      echo "<FONT COLOR=\"RED\"><CENTER><B>Prohrál jsem, gratuluji k úspěchu.</B></CENTER></FONT>";
      echo "<CENTER><FORM><INPUT TYPE=SUBMIT VALUE=\"   OK   \"></FORM></CENTER>"; // začátek nové hry
      exit;
    }
  ?>
  <FORM>
  <TABLE RULES="NONE" ALIGN="CENTER" CELLPADDING=5 BGCOLOR="#8D5F07">
    <TR><TH COLSPAN=2>&nbsp;<? echo "<FONT COLOR=\"WHITE\">".$VYPIS."</FONT>"; ?></TH></TR>
    <TR><TH COLSPAN=2>&nbsp;<? echo "<FONT COLOR=\"WHITE\">Na hromádce je $POC zápalek.</FONT>"; ?></TH></TR>
    <TR><TH><FONT COLOR="WHITE">&nbsp;Kolik zápalek odebíráte Vy?&nbsp;</FONT></TH>
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
