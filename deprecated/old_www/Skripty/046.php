<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>046.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
<body bgcolor="#D6EFFE" text="WHITE">
  <!-- 046.php -->
 <table width="95%">
 <tr><th width="70%">  <!-- sloupec zobrazen� kina -->
  <center><img src="./obr/kino.gif"></center>
  <table style="border-style : groove;">
    <tr><th colspan="14"><hr width="80%" size=10 color="navy">
    <tr><th><th colspan="12" style="border-style : ridge;">
        <font color=navy>P&nbsp;&nbsp;&nbsp;L&nbsp;&nbsp;&nbsp;�&nbsp;&nbsp;
        T&nbsp;&nbsp;&nbsp;N&nbsp;&nbsp;&nbsp;O</font>
    <br><br>
    <?
      for($i=1;$i<165;$i++){
        if($SEDADLO==$i){
          if($Obs[$i]==0){  // zamezit prodeji stejn�ho m�sta
            $Obs[$i]=1;     // je obsazeno
            if($SEDADLO<49){
              $vybrano+=60;   // mno�stv� pen�z
              $vybrano_celkem+=60;
            }
            else if($SEDADLO<133){
              $vybrano+=100;
              $vybrano_celkem+=100;
            }
            else{
              $vybrano+=80;
              $vybrano_celkem+=80;
            }
          }else
            $nezarazovat=1; // neza�azovat do v�pisu objednan�ch m�st
        }else
          if($Obs[$i]<1)
            $Obs[$i]=0;  // voln�
      }

      $misto=1;                       // 1. z�na = 60 K�
      for($rada=0;$rada<4;$rada++){
        echo "<tr><th>";
        for($sedadlo=0;$sedadlo<12;$sedadlo++){
          echo "<th bgcolor=";
          if($Obs[$misto]>0){
            echo "\"BLACK\">";
          }else{
            echo "\"GREEN\">";
            echo $misto;
          }
          $misto++;
        }
        echo "<th>";
      }

      echo "<tr><tr>";                // 2. z�na = 100 K�
      for($rada=4;$rada<10;$rada++){
        echo "<tr>";
        for($sedadlo=0;$sedadlo<14;$sedadlo++){
          echo "<th bgcolor=";
          if($Obs[$misto]>0)
            echo "\"BLACK\">";
          else{
            echo "\"RED\">";
            echo $misto;
          }
          $misto++;
        }
      }
      echo "<tr><br></tr>";  // pr�zdn� ��dek p�ed balk�nem
    ?>
    <tr><th><th colspan="12"  style="border-style : ridge;">
        <font color="navy">B&nbsp;&nbsp;&nbsp;A&nbsp;&nbsp;&nbsp;L&nbsp;&nbsp;
                         K&nbsp;&nbsp;&nbsp;�&nbsp;&nbsp;&nbsp;N</font>
    <?
      echo "<tr><br>";                // 3. z�na (balk�n)= 80 K�
      for($rada=10;$rada<14;$rada++){
        echo "<tr><th><th><th>";
        for($sedadlo=0;$sedadlo<8;$sedadlo++){
          echo "<th bgcolor=";
          if($Obs[$misto]>0)
            echo "\"BLACK\">";
          else{
            echo "\"NAVY\">";
            echo $misto;
          }
          $misto++;
        }
        echo "<th><th><th>";
      }
    ?>
  </table>
  <th width="20%">  <!-- sloupec zad�n� a v�po�t� -->
    <table bgcolor="navy" style="border-style : ridge;">
      <tr><th colspan=2 style="color : yellow;">
             <?
                if(!$vybrano) $vybrano=0;
                if(!$vyb_mista){
                  $vyb_mista="";
                }
                $SEDADLO = (int) $SEDADLO;   // kontrola spr�vn�ho zad�n� sedadla
                if($SEDADLO<1 || $SEDADLO>164) $SEDADLO="";
                if($SEDADLO && !$nezarazovat){
                   if($vyb_mista) $vyb_mista=$vyb_mista.",";
                   $vyb_mista=$vyb_mista."&nbsp;".$SEDADLO;
                }
                echo "&nbsp;Vybran� sedadla: ".$vyb_mista;
             ?>
      <tr><th><? echo "Zaplatit:&nbsp;".$vybrano."&nbsp;K�"; ?></th>
      <tr><th></th>
      <tr><th><? echo "Vybr�no celkem:&nbsp;".($vybrano_celkem-$vybrano)."&nbsp;K�"; ?></th>
         <form method=post>
           <tr><th>&nbsp;</th></tr>
           <tr><th colspan=2>
               <input type=submit value="Zaplatit">
               <input type=hidden name="Obs" value=<? echo $Obs; ?>>
               <input type=hidden name="vybrano_celkem" value=<? echo $vybrano_celkem; ?>>
               </th>
           </tr>
      </form>
    </table>
    <br><br>
    <table bgcolor=navy style="border-style : ridge;">
      <tr><th colspan=2 style="color : yellow;">
             Objedn�vky
          </th>
      </tr>
      <tr><th>&nbsp;</th>
      <tr>
      <form method="post">
        <th>Zadej ��slo sedadla:</th><th><input type=TEXT name="SEDADLO" size=5></th></tr>
        <tr><th colspan=2>&nbsp;</th></tr>
        <tr><th colspan=2><input type=SUBMIT value="Potvrdit objedn�vku"></tr>
      </table>
        <input type=HIDDEN name="Obs" value=<? echo $Obs; ?>>
        <input type=HIDDEN name="vybrano" value=<? echo $vybrano; ?>>
        <input type=HIDDEN name="vyb_mista" value=<? echo $vyb_mista; ?>>
        <input type=HIDDEN name="vybrano_celkem" value=<? echo $vybrano_celkem; ?>>
      </form>
 </table>
</body>
</html>
