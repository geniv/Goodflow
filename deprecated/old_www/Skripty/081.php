<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>081.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 081.php -->
<?
   $text="�lu�ou�k� k��";
   echo "<h3>K�dov�n� textu&nbsp;(\"�lu�ou�k� k��\")</h3>";

   echo "<b>K�dov�n� do URL <i>URLEncode()</i></b>:&nbsp;";
   $kod=URLEncode($text);
   echo $kod."<br>";
   echo "<b>Dek�dov�n� �et�zce:</b>&nbsp;".URLDecode($kod);

   echo "<br><br><b>K�dov�n� do URL <i>RawURLEncode()</i></b>:&nbsp;";
   $kod=RawURLEncode($text);
   echo $kod."<br>";
   echo "<b>Dek�dov�n� �et�zce:</b>&nbsp;".RawURLDecode($kod);

   echo "<br><br><b>K�dov�n� <i>Base64_Encode()</i></b>:&nbsp;";
   $kod=Base64_Encode($text);
   echo $kod."<br>";
   echo "<b>Dek�dov�n� �et�zce:</b>&nbsp;".Base64_Decode($kod);

   echo "<br><br><b>K�dov�n� <i>MD5()</i></b>:&nbsp;".MD5($text);

   echo "<br><br><b>K�dov�n� <i>Crypt()</i></b>:&nbsp;".Crypt($text);
?>
     </body>
</html>
