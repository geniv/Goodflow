<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>081.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 081.php -->
<?
   $text="Žluťoučký kůň";
   echo "<h3>Kódování textu&nbsp;(\"Žluťoučký kůň\")</h3>";

   echo "<b>Kódování do URL <i>URLEncode()</i></b>:&nbsp;";
   $kod=URLEncode($text);
   echo $kod."<br>";
   echo "<b>Dekódování řetězce:</b>&nbsp;".URLDecode($kod);

   echo "<br><br><b>Kódování do URL <i>RawURLEncode()</i></b>:&nbsp;";
   $kod=RawURLEncode($text);
   echo $kod."<br>";
   echo "<b>Dekódování řetězce:</b>&nbsp;".RawURLDecode($kod);

   echo "<br><br><b>Kódování <i>Base64_Encode()</i></b>:&nbsp;";
   $kod=Base64_Encode($text);
   echo $kod."<br>";
   echo "<b>Dekódování řetězce:</b>&nbsp;".Base64_Decode($kod);

   echo "<br><br><b>Kódování <i>MD5()</i></b>:&nbsp;".MD5($text);

   echo "<br><br><b>Kódování <i>Crypt()</i></b>:&nbsp;".Crypt($text);
?>
     </body>
</html>
