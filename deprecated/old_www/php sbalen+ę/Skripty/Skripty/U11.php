<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U11.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- U11.php -->
    <font color="black"><div align="center">
    <h2>Slo�enka</h2>
  <?
     if($cislo>0 && $cislo<1000):
       $jednotky=array(1=>"jedna","dva","t�i","�ty�i","p�t","�est","sedm","osm","dev�t","deset");
       $nactky=array(11=>"jeden�ct","dvan�ct","t�in�ct","�trn�ct","patn�ct","�estn�ct","sedmn�ct","osmn�ct","devaten�ct");
       $desitky=array(20=>"dvacet",30=>"t�icet",40=>"�ty�icet",50=>"pades�t",60=>"�edes�t",70=>"sedmdes�t",80=>"osmdes�t",90=>"devades�t",100=>"sto");
       $sta=array("sta","set");

       $zaloha_cisla = $cislo;

       if($cislo>100){               // v�pis ��du stovek
         for($i=1;$cislo>99;$i++)
           $cislo-=100;

         if($i>3)
           $vystup.=$jednotky[$i-1]; // sklo�ov�n�
         else if($i==3)
           $vystup.="dv�";

         if($i>4)
           $vystup.=$sta[1];
         else if($i>2)
           $vystup.=$sta[0];
         else
           $vystup.=$desitky[100];
       }

       if($cislo>20){                // v�pis ��du des�tek
         for($i=1;$cislo>9;$i++)
           $cislo-=10;
         $vystup.=$desitky[($i-1)*10];
       }

       if($cislo>10){                // v�pis ��du "-n�ctek"
         for($i=1;$cislo>10;$i++)
           $cislo-=1;
         $vystup.=$nactky[($i-1)+10];
         $cislo=0;                   // ukon�it p�evod
       }

       if($cislo>0){                // v�pis ��du jednotek
         for($i=1;$cislo>0;$i++)
           $cislo-=1;
         $vystup.=$jednotky[($i-1)];
       }

       echo "��slo $zaloha_cisla&nbsp;=&nbsp;\"$vystup\"";
     else:
       echo "<font color=red>��slo nen� z povolen�ho rozsahu!</font>";
     endif;
  ?>
    </div></font><br>

  <!-- formul�� naform�tovan� pomoc� tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>P�evod ��sla na slovn� vyj�d�en�</th></tr>
    <tr><th colspan=2>(1 a� 999)</th></tr>
    <tr><td>Zadej ��slo:&nbsp;</td>
        <td><input type=text name="cislo" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="P�evod"></th></tr>
  </table>
  </form>
     </body>
</html>
