<?php
header('Content-type: text/html; charset=UTF-8');
  print
  "vložit, změnit a napozicovat text do obrázku:<br />
  <form action=\"\" method=\"post\">
    <fieldset>
      text: <input type=\"text\" name=\"text\" value=\"".stripslashes(htmlspecialchars($_POST["text"]))."\"><br />
      x: <input type=\"text\" name=\"x\" value=\"{$_POST["x"]}\"><br />
      y: <input type=\"text\" name=\"y\" value=\"{$_POST["y"]}\"><br />
      barva textu: #<input type=\"text\" name=\"barva\" value=\"{$_POST["barva"]}\">(hex)<br />
      <input type=\"submit\" name=\"tlacitko\" value=\"proveď\">
    </fieldset>
  </form>
  <img src=\"obr.php?text=".stripslashes(htmlspecialchars($_POST["text"]))."&x={$_POST["x"]}&y={$_POST["y"]}&barva={$_POST["barva"]}\">
  ";
?>