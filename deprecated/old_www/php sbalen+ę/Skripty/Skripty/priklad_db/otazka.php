<?
  Header("Expires: ".GMDate("D, d M Y H:i:s")." GMT"); // neukl�dej do vyrovn�vac� pam�ti
?>

<!-- otazka.php - v�pis v�ech ot�zek datab�ze s odkazy na p�idru�en� akce -->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
        <title>Datab�ze testov�ch ot�zek</title>
        <link rel="stylesheet" href="styl.css">
        <SCRIPT language="javascript" SRC="./skripty/javascript/functions.js"></SCRIPT>
    </head>
    <body>

    <? if(Count($Vymaz)>0): ?>
         <SCRIPT LANGUAGE="JavaScript"> location.href="smazat.php"  </SCRIPT>
    <? endif; ?>

    <? require "./otvdatab.php";
       $dotaz = "SELECT * FROM Otazka";
       @$vysledek = MySQL_Query($dotaz);
    ?>

    <table width="100%">
    <tr>
      <td width="20%">
        <table>
          <tr><td><img src="./obr/tl_vybrat.gif">
                  <b>&nbsp;&nbsp;<font color=blue>Vyber do testu</font></b>
              </td>
          </tr>
          <tr><td><img src="./obr/tl_edit.gif">
                  <b>&nbsp;&nbsp;<font color=green>Aktualizovat polo�ku</font></b>
              </td>
          </tr>
          <tr><td><img src="./obr/tl_smazat.gif">
                  <b>&nbsp;&nbsp;<font color=red>Vymazat polo�ku</font></b>
              </td>
          </tr>
        </table>
      </td>
      <td width="65%">
        <center><img src="./obr/vypis_datab.gif"></center>
        <?echo "<H1 class=NADPIS>(Celkem ot�zek: ".MySQL_Num_Rows($vysledek).")</H1>";?>
      </td>
      <td width="20%" align="right"><b>
        <SCRIPT LANGUAGE="JavaScript">
          document.write(dnes());
        </SCRIPT></b>
        <table>
          <tr><td><img src="./obr/tl_zvuk.gif">
                  <b>&nbsp;&nbsp;<font color="maroon">P�ehr�t zvuk</font></b>
              </td>
          </tr>
          <tr><td><img src="./obr/tl_obr.gif">
                  <b>&nbsp;&nbsp;<font color="#BD9C03">Obr�zek</font></b>
              </td>
          </tr>
        </table>
      </td>
    </tr>
    </table>
<?
        // v�pis skupin ot�zek do mo�n�ho v�b�ru
      $dotaz = "SELECT DISTINCT Skupina FROM Otazka";
      @$skupiny = MySQL_Query($dotaz);
      if(!$skupiny):
        echo "Do�lo k chyb� p�i zpracov�n� dotazu. <br>";
        break;
      endif;
      $radek=0;  // ��d�c� prom�nn� cyklu
      $skup=0;   // prom�nn� pro zji�t�n� ozna�en�ch v�b�r� checkbox� skupin ot�zek
?>
    <form method="post">
    <table width="100%" cellpadding=2 bgcolor="#0563A5">
      <tr align="left"><th width="10%">   
<?      while(@$polozka = MySQL_Fetch_Array($skupiny)):
          if($Skupina[$skup]==$polozka["Skupina"] || !$Skupina){    // ozna�en� checkbox�
            $checked="CHECKED"; // druh� ��st podm�nky pro prvotn� zobrazen� v�ech ot�zek
            $skup++;
          }else{
            $checked="";
          }
          if($radek%5==0 && $radek>0):
?>          </th></tr>
            <tr align="left"><th width="10%">
<?        else: if($radek==0):  ?>
                  <input type=image name="Skupiny" src="./obr/vyb_skup.gif" alt="V�b�r skupin ot�zek">
                  </th>
<?              endif;
          endif;
?>        <th width="18%">
            <input type=checkbox name="Skupina[]" value="<? echo $polozka["Skupina"]; ?>" <? echo $checked; ?>>
                   <font color="#DCDCDC"><b><? echo $polozka["Skupina"]; ?></b></font>
          </th>
<?        $radek++;
        endwhile;
?>  </tr></table>
    </form>
<?
    $where=""; // vytv��en� ��st where pro SQL dotaz
    for($ii=0;$ii<Count($Skupina);$ii++):
      if($where!="")
        $where=$where." || Skupina='";
      else
        $where=" WHERE Skupina='";
      $where=$where.$Skupina[$ii]."'";
    endfor;
?>
    <table width="100%">
      <tr>
      <td width="10%" align="center" valign="top"></td>
      <td width="75%" align="center" valign="top">
       <table>
        <tr valign="top">
        <td></td>
        <td></td>
        <td>
        <form action="pridat.php">
          <input type=image src="./obr/pridotaz.gif" alt="P�idat novou ot�zku">
        </form>
        </td>
        <td>
        <form action="upravit.php">
          <input type=image src="./obr/upraotaz.gif" alt="Upravit ot�zku">
        </form>
        </td>
        <td>
        <form action="smazat.php">
          <input type=image src="./obr/smazotaz.gif" alt="Smazat ot�zku">
        </form>
        </td>
        <td></td>
        </tr>
       </table>
      </td>
      <td width="15%" align=right>
          <form action="./otazka.php" method="post">
            <b>Hledat: </b><input name="Hledat" size=12 value="<? echo $Hledat ?>">
          </form>
      </td>
      </tr>
    </table>
    <hr color="navy">

<?
      if(!$vysledek):
        echo "Do�lo k chyb� p�i zpracov�n� dotazu. <br>";
        break;
      endif;
      $dotaz="SELECT * FROM Otazka ".$where." ORDER BY ID_Otazka";
      @$vysledek = MySQL_Query($dotaz);
      if(!$vysledek):
        echo "Zadan�mu krit�riu nevyhovuje ��dn� z�znam.\n";
      else:
        if($Hledat){
          echo "<center><h3><font color=red><b>Hled�n� podle obsahu ot�zky</b></font></h3></center>";
        }
        while(@$zaznam = MySQL_Fetch_Array($vysledek)):
          if(@StrStr($zaznam["Otazka"],$Hledat) || !$Hledat):
           ?> <table width="100%">
              <tr><td width="3%" bgcolor="#0000CD">
                     <input type=checkbox title="Vyber do testu" name="Vyber[]" value="<? echo $zaznam["ID_Otazka"]?>">
                  </td>
                  <td width="3%" bgcolor="#6B8E23">
                     <input type=checkbox title="Editovat polo�ku" onClick='edit("<? echo $zaznam["ID_Otazka"]?>")'>
                  </td>   
                  <td width="3%" bgcolor="#FF4500">
                     <input type=checkbox title="Vymazat polo�ku" onClick='vymaz("<? echo $zaznam["ID_Otazka"]?>")'>
                  </td>   
              <td><? echo "<th colspan=2><div class=CISLO> -- ".$zaznam["ID_Otazka"]." --</div>"; ?></td>
              <td width="3%"> <!-- mezera = pr�zdn� mezisloupec--></td>
           <? if($zaznam["Zvuk"]!="" && $zaznam["Zvuk"]!="none"): ?>
                <td width="3%" bgcolor="#804F08"><input type=checkbox title="P�ehr�t zvuk" onClick='prehrej("<? echo $zaznam["Zvuk"]?>")'></td>
              <? else: ?>
                <td width="3%" bgcolor="#804F08">
                <input type=checkbox disabled title="K ot�zce nen� p�ipojen zvuk">
                </td>
           <? endif; ?>
           <? if($zaznam["Obrazek"]!="" && $zaznam["Obrazek"]!="none"): ?>
                <td width="3%" bgcolor="#EE9D00">
                <input type=checkbox title="Zobrazit obr�zek" onClick='ukaz("<? echo $zaznam["Obrazek"]?>")'>
                </td>
           <? else: ?>
                <td width="3%" bgcolor="#EE9D00">
                <input type=checkbox disabled title="K ot�zce nen� p�ipojen obr�zek">
                </td>
           <? endif; ?>
              </tr><tr><td></td><td></td><td></td>
           <? echo "<td width=\"3%\"></td>";
              echo "<td colspan=2><div class=OTAZKA>".$zaznam["Otazka"]."</div></td>";
              if(!StrStr($zaznam["Spravne"],"1"))
                echo "<tr><td></td><td></td><td></td><td></td><td width=\"2%\" valign=\"top\" align=\"center\"><b>a)</b></td><td> ".$zaznam["OdpovedA"]."</td></tr>"; // povinn� odpov�di A, B
              else
                echo "<tr><td></td><td></td><td></td><td align=\"right\"><img src='./obr/puntik.jpg'></td><td width=\"2%\" valign=\"top\" align=\"center\"><b>a)</b></td><td> ".$zaznam["OdpovedA"]."</td></tr>";
              if(!StrStr($zaznam["Spravne"],"2"))
                echo "<tr><td></td><td></td><td></td><td></td><td width=\"2%\" valign=\"top\" align=\"center\"><b>b)</b></td><td> ".$zaznam["OdpovedB"]."</td></tr>";
              else
                echo "<tr><td></td><td></td><td></td><td align=\"right\"><img src='./obr/puntik.jpg'></td><td width=\"2%\" valign=\"top\" align=\"center\"><b>b)</b></td><td> ".$zaznam["OdpovedB"]."</td></tr>";
              if($zaznam["OdpovedC"]!="")
                if(!StrStr($zaznam["Spravne"],"3"))
                  echo "<tr><td></td><td></td><td></td><td></td><td width=\"2%\" valign=\"top\" align=\"center\"><b>c)</b></td><td>".$zaznam["OdpovedC"]."</td></tr>";
                else
                  echo "<tr><td></td><td></td><td></td><td align=\"right\"><img src='./obr/puntik.jpg'></td><td width=\"2%\" valign=\"top\" align=\"center\"><b>c)</b></td><td> ".$zaznam["OdpovedC"]."</td></tr>";
              if($zaznam["OdpovedD"]!="")
                if(!StrStr($zaznam["Spravne"],"4"))
                  echo "<tr><td></td><td></td><td></td><td></td><td width=\"2%\" valign=\"top\" align=\"center\"><b>d)</b></td><td> ".$zaznam["OdpovedD"]."</td></tr>";
                else
                  echo "<tr><td></td><td></td><td></td><td align=\"right\"><img src='./obr/puntik.jpg'></td><td width=\"2%\" valign=\"top\" align=\"center\"><b>d)</b></td><td> ".$zaznam["OdpovedD"]."</td></tr>";
              if($zaznam["OdpovedE"]!="")
                if(!StrStr($zaznam["Spravne"],"5"))
                  echo "<tr><td></td><td></td><td></td><td></td><td width=\"2%\" valign=\"top\" align=\"center\"><b>e)</b></td><td> ".$zaznam["OdpovedE"]."</td></tr>";
                else
                  echo "<tr><td></td><td></td><td></td><td align=\"right\"><img src='./obr/puntik.jpg'></td><td width=\"2%\" valign=\"top\" align=\"center\"><b>e)</b></td><td> ".$zaznam["OdpovedE"]."</td></tr>";
              if($zaznam["OdpovedF"]!="")
                if(!StrStr($zaznam["Spravne"],"6"))
                  echo "<tr><td></td><td></td><td></td><td></td><td width=\"2%\" valign=\"top\" align=\"center\"><b>f)</b></td><td> ".$zaznam["OdpovedF"]."</td></tr>";
                else
                  echo "<tr><td></td><td></td><td></td><td align=\"right\"><img src='./obr/puntik.jpg'></td><td width=\"2%\" valign=top align=center><b>f)</b></td><td> ".$zaznam["OdpovedF"]."</td></tr>";
?>            </tr><tr></tr><tr></tr>
            </table>
<?          endif;
        endwhile;
      endif;
      MySQL_Close($spojeni);
?>

<? require "./address.php"; ?>

     </body>
</html>
