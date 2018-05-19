<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>102.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 102.php -->
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
        $this->Cena      = $Cena;
        $this->Dodavatel = $Dodavatel;
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

   class CElekHracka extends CHracka
   {
     var $Baterie;

     function CElekHracka($Nazev="",$Druh="",$Barva="",$Cena=0,
                          $Dodavatel="Hračky plast s.r.o.",$DPH=0,$Baterie="")
     {
       $this->CHracka($Nazev,$Druh,$Barva,$Cena,$Dodavatel,$DPH);
       $this->Baterie=$Baterie;
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
        echo "<br>Baterie: $this->Baterie";
      }
   }

   // vytvoření instance (objektu)
   $hracka = new CElekHracka("Auto Tatra","Osobní","Červená",1199,
                             "Lokvenc & spol.",0,"2 x 1,5V");
   $hracka->Tisk();
?>
     </body>
</html>
