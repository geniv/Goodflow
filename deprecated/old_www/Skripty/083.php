<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>083.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- 083.php -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th><font color="#E1D401">Výpočet kvadratické rovnice</font></th></tr>
    <tr><th>Zadej reálné koeficienty</th></tr>
    <tr><th><hr></th></tr>
    <tr><th>
          <input type=text name="a" size=2 value=<? echo $a; ?>>
                 x<sup>2</sup>&nbsp;+&nbsp;
          <input type=text name="b" size=2 value=<? echo $b; ?>>
                 x&nbsp;+&nbsp;
          <input type=text name="c" size=2 value=
            <? if($c!=0) echo $c; else echo "0";?>>&nbsp;=&nbsp;0
        </th>
    </tr>
    <tr><th><hr></th></tr>
    <tr><td>
          <input type=checkbox name="Zaokrouhlit" <? if($Zaokrouhlit) echo "checked"; ?>>
          Výsledky zaokrouhlit na celá čísla
        </td>
    </tr>
    <tr><th><input type=submit value="Výpočet"></th></tr>
  </table>
  </form>
  <basefont color="black">
<?
  if(!$a){                  // kontrola kvadratického členu
    echo "<br><br><center><b>Koeficient kvadratického členu ";
    echo "musí být nenulový.</b></center>";
    if($b!=0){
      echo "<br><center>Jedná se o lineární rovnici s kořenem ";
      if($Zaokrouhlit)
        $x=Round(-$c/$b);
      else
        $x=-$c/$b;
      echo "<font color=\"red\">x&nbsp;=&nbsp;$x</font></center>.";
    }else{
      if($c!=0)
        echo "<br><center><b>Rovnice nemá řešení.</b></center>";
      else
        echo "<br><center><b>Rovnice má nekonečně mnoho řešení.</b></center>";
    }
  }else{
    if($b==0)
      echo "<br><center>Jedná se o ryze kvadratickou rovnici.</center>";
    else if($c==0)
      echo "<br><center>Jedná se o kvadratickou rovnici bez absolutního členu.</center>";
    $D=$b*$b-4*$a*$c;       // výpočet diskriminantu
    if($D<0)
      echo "<br><center>Kvadratická rovnice
            <b>nemá řešení v oboru <i>R</i></b>.</center>";
    else if($D==0){
      echo "<br><center>Kvadratická rovnice
            <b>má jeden dvojnásobný kořen </b>";
      $x=-$b/2;
      echo "<font color=\"red\">x&nbsp;=&nbsp;$x</font></center>";
    }else{
      echo "<br><center>Kvadratická rovnice
            <b>má dva různé reálné kořeny </b>";
      $x1=(-$b+sqrt($D))/(2*$a);
      $x2=(-$b-sqrt($D))/(2*$a);
      if($Zaokrouhlit){
        $x1=Round($x1);
        $x2=Round($x2);
      }
      echo "<font color=\"red\">x<sub>1</sub>&nbsp;=&nbsp;$x1</font>";
      echo " a <font color=\"red\">x<sub>2</sub>&nbsp;=&nbsp;$x2</font></center>";
    }
  }
?>
     </body>
</html>
