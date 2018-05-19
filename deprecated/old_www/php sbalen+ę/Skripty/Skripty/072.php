<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>072.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 072.php -->
<?
  function Objem_valce($polomer,$vyska)
  {
    function Obsah_kruhu($polomer){
      return 3.14*$polomer*$polomer;
    }
    return $vyska*Obsah_kruhu($polomer);
  }

  $pol=10;   // poloměr podstavy
  $v=10;     // výška válce
  echo "Objem válce s poloměrem podstavy $pol (j)\n";
  echo "a výškou $v (j) je ".Objem_valce($pol,$v)." (j<sup>3</sup>).";
?>
     </body>
</html>
