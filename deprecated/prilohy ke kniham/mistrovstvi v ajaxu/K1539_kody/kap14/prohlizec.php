<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Určení typu prohlížeče</title>
  </head>

  <body>
    <center>
        <h1>Určení typu prohlížeče</h1>

        <br>
        <?
          if(strpos($_SERVER["HTTP_USER_AGENT"], "MSIE")){
            echo("<marquee><h1>Vítejte na této stránce!</h1></marquee>");
          }
          else {
              echo("<h1>Použijte prosím Internet Explorer</h1>");
          }
        ?>
    </center>
  </body>
</html>
