<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>055.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 055.php -->
<?
  $text = "Obyčejný text\, který chceme 'zobrazit'";
  echo AddSlashes($text); // Vypíše: Obyčejný text\\, který chceme \'zobrazit\'
?>
     </body>
</html>
