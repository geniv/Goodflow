<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>0100.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 100.php -->
<?
   class CHracka
   {
      var $Nazev, $Druh, $Barva;
      var $Dodavatel = "Hračky plast s.r.o.";
      var $Cena, $DPH = 0;

      /*
        $zarazeni = 0 (5%)
        $zarazeni = 1 (19%)
      */
      function Dan()
      {
        if($this->DPH)
          return (int)(($this->Cena)*0.19);
        else
          return (int)(($this->Cena)*0.05);
      }

      function Tisk()
      {
        echo "<b>$this->Nazev</b><br>";
        echo "Druh:&nbsp;$this->Druh<br>";
        echo "Barva:&nbsp;$this->Barva<br>";
        echo "Dodavatel:&nbsp;$this->Dodavatel<br>";
        echo "DPH&nbsp;";
        if($this->DPH) echo "(19%)"; else echo "(5%)";
        echo ":&nbsp;".$this->Dan()."&nbsp;Kč";
        echo "<br>Cena zboží s DPH:&nbsp;".($this->Dan()+ $this->Cena)."&nbsp;Kč";
      }
   }

   // vytvoření instance (objektu)
   $hracka = new CHracka;

   // inicializace proměnných objektu
   $hracka->Nazev = "Buldozer";
   $hracka->Druh  = "Elektrické hračky";
   $hracka->Barva = "Žlutá";
   $hracka->Cena  = 650;

   $hracka->Tisk();
?>
     </body>
</html>
