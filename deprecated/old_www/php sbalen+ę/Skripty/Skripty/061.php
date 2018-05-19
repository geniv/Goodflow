<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>061.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 061.php -->
<?
  SRand((double)MicroTime()*1e6);
  $x=Rand(0,100);
  return (int)$x%2;
?>
     </body>
</html>
