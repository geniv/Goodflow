<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>101.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 101.php -->
<?
   class CHracka
   {
      var $Nazev, $Druh, $Barva, $Dodavatel, $Cena, $DPH;

      function CHracka($Nazev="",$Druh="",$Barva="",$Cena=0,
                       $Dodavatel="Hračky plast s.r.o.",$DPH=0)
      {
        $this->Nazev     = $Nazev;
        $this->Druh      = $Druh;
        $this->Barva     = $Barva;
        $this->Dodavatel = $Cena;
        $this->Cena      = $Dodavatel;
        $this->DPH       = $DPH;
      }

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
   $hracka = new CHracka("Buldozer","Elektrické hračky","Žlutá","Toy a.s.",650,0);
   $hracka->Tisk();
?>
     </body>
</html>
