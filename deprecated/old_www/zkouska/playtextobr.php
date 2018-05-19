<?php
  print
  "
  <form action=\"\" method=\"post\">
    <fieldset>
      text: <input type=\"text\" name=\"text\" value=\"{$_POST["text"]}\"><br />
      x: <input type=\"text\" name=\"x\" value=\"{$_POST["x"]}\"><br />
      y: <input type=\"text\" name=\"y\" value=\"{$_POST["y"]}\"><br />
      barva: <input type=\"text\" name=\"barva\" value=\"{$_POST["barva"]}\"><br />
      <input type=\"submit\" name=\"tlacitko\" value=\"proveï\">
    </fieldset>
  </form>
  <img src=\"testobr.php?text={$_POST["text"]}&x={$_POST["x"]}y={$_POST["y"]}&barva={$_POST["barva"]}\">
  ";
?>