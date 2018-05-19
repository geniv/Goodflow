<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>004.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
    <!-- 004.php -->
    <?
        if($a && $b){
          $soucet=$a+$b;
          echo "Výsledkem součtu čísel $a a $b je $soucet.";
        }
    ?>
       <form action="004.php">
         Zadej hodnoty:<br>
         <input type="text" name="a"><br>
         <input type="text" name="b"><br>
         <input type="submit" value="Výsledek">
       </form>
     </body>
</html>
