<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>079.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 079.php -->
<?
   echo "<b>Telegram</b><br><br>";
   $text="prijed teto&hori stodola&hasici v hospode";
   echo "<b>Původní text:</b>&nbsp;$text<br><br>";
   echo "<b>Po větách:</b><br>";
   $radek=StrTok($text,"&");
   while($radek){
     echo $radek."<br>";
     $radek=StrTok("&");
   }
?>
     </body>
</html>
