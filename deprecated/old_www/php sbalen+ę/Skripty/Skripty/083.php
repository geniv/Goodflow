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
    <tr><th><font color="#E1D401">V�po�et kvadratick� rovnice</font></th></tr>
    <tr><th>Zadej re�ln� koeficienty</th></tr>
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
          V�sledky zaokrouhlit na cel� ��sla
        </td>
    </tr>
    <tr><th><input type=submit value="V�po�et"></th></tr>
  </table>
  </form>
  <basefont color="black">
<?
  if(!$a){                  // kontrola kvadratick�ho �lenu
    echo "<br><br><center><b>Koeficient kvadratick�ho �lenu ";
    echo "mus� b�t nenulov�.</b></center>";
    if($b!=0){
      echo "<br><center>Jedn� se o line�rn� rovnici s ko�enem ";
      if($Zaokrouhlit)
        $x=Round(-$c/$b);
      else
        $x=-$c/$b;
      echo "<font color=\"red\">x&nbsp;=&nbsp;$x</font></center>.";
    }else{
      if($c!=0)
        echo "<br><center><b>Rovnice nem� �e�en�.</b></center>";
      else
        echo "<br><center><b>Rovnice m� nekone�n� mnoho �e�en�.</b></center>";
    }
  }else{
    if($b==0)
      echo "<br><center>Jedn� se o ryze kvadratickou rovnici.</center>";
    else if($c==0)
      echo "<br><center>Jedn� se o kvadratickou rovnici bez absolutn�ho �lenu.</center>";
    $D=$b*$b-4*$a*$c;       // v�po�et diskriminantu
    if($D<0)
      echo "<br><center>Kvadratick� rovnice
            <b>nem� �e�en� v oboru <i>R</i></b>.</center>";
    else if($D==0){
      echo "<br><center>Kvadratick� rovnice
            <b>m� jeden dvojn�sobn� ko�en </b>";
      $x=-$b/2;
      echo "<font color=\"red\">x&nbsp;=&nbsp;$x</font></center>";
    }else{
      echo "<br><center>Kvadratick� rovnice
            <b>m� dva r�zn� re�ln� ko�eny </b>";
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
