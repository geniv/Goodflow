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
    <h2>Složenka</h2>
  <?
     if($cislo>0 && $cislo<1000):
       $jednotky=array(1=>"jedna","dva","tři","čtyři","pět","šest","sedm","osm","devět","deset");
       $nactky=array(11=>"jedenáct","dvanáct","třináct","čtrnáct","patnáct","šestnáct","sedmnáct","osmnáct","devatenáct");
       $desitky=array(20=>"dvacet",30=>"třicet",40=>"čtyřicet",50=>"padesát",60=>"šedesát",70=>"sedmdesát",80=>"osmdesát",90=>"devadesát",100=>"sto");
       $sta=array("sta","set");

       $zaloha_cisla = $cislo;

       if($cislo>100){               // výpis řádu stovek
         for($i=1;$cislo>99;$i++)
           $cislo-=100;

         if($i>3)
           $vystup.=$jednotky[$i-1]; // skloňování
         else if($i==3)
           $vystup.="dvě";

         if($i>4)
           $vystup.=$sta[1];
         else if($i>2)
           $vystup.=$sta[0];
         else
           $vystup.=$desitky[100];
       }

       if($cislo>20){                // výpis řádu desítek
         for($i=1;$cislo>9;$i++)
           $cislo-=10;
         $vystup.=$desitky[($i-1)*10];
       }

       if($cislo>10){                // výpis řádu "-náctek"
         for($i=1;$cislo>10;$i++)
           $cislo-=1;
         $vystup.=$nactky[($i-1)+10];
         $cislo=0;                   // ukončit převod
       }

       if($cislo>0){                // výpis řádu jednotek
         for($i=1;$cislo>0;$i++)
           $cislo-=1;
         $vystup.=$jednotky[($i-1)];
       }

       echo "Číslo $zaloha_cisla&nbsp;=&nbsp;\"$vystup\"";
     else:
       echo "<font color=red>Číslo není z povoleného rozsahu!</font>";
     endif;
  ?>
    </div></font><br>

  <!-- formulář naformátovaný pomocí tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Převod čísla na slovní vyjádření</th></tr>
    <tr><th colspan=2>(1 až 999)</th></tr>
    <tr><td>Zadej číslo:&nbsp;</td>
        <td><input type=text name="cislo" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="Převod"></th></tr>
  </table>
  </form>
     </body>
</html>
