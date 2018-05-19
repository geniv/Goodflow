<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title></title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <style type="text/css">
    .obal {
      width: auto;
    }

    .nadpis {
      position: relative;
      width: auto;
      height: 100px;

      background-color: red;
    }

    .menu {
      position: relative;
      width: 200px;
      height: 300px;
      float: left;

      background-color: yellow;
    }

    .obsah {
      position: relative;
      width: 70%;
      height: 300px;
      float: left;
      border: none;

      background-color: lime;
    }
  </style>
</head>
<body>
<div class="obal">
  <div class="nadpis">nadpis</div>
  <div class="menu">
    <a href="?c=cigarety">Jak škodí cigarety</a>
    <a href="?c=email">Kontakt</a>
  </div>
  <iframe class="obsah" src="<?php echo (!Empty($_GET["c"]) ? $_GET["c"].".html" : ""); ?>"></iframe>
</div>
</body>
</html>
