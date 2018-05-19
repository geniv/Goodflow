<?php

  $result = array(
                  "info_admin_uvod_text" => "
          <script type=\"text/javascript\" src=\"%%14%%/jquery-132-yui.js\"></script>
          <script type=\"text/javascript\">
function GetSize(cesta, out_id)
{
  $.post(\"%%13%%ajax_funkce.php\",
        \"action=getsize&cesta=\"+cesta,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}

function GetAdrSize(cesta, rek, out_id)
{
  $.post(\"%%13%%ajax_funkce.php\",
        \"action=getadrsize&cesta=\"+cesta+\"&rek=\"+rek,
          function(theResponse)
          {
            $(\"#\"+out_id).html(theResponse);
          }
        );
}

function ZmeritVse()
{
  GetAdrSize(%%3%%, 'idcelmod');
  GetSize(%%4%%, 'idceldat');
  GetAdrSize(%%6%%, 'idcelweb');
  GetAdrSize(%%7%%, 'idcelsty');
  GetAdrSize(%%8%%, 'idcelskr');
  GetAdrSize(%%9%%, 'idcelobr');
  GetAdrSize(%%5%%, 'idcelzal');
  GetAdrSize(%%10%%, 'idcelsek');
}
</script>
AHOJ toto je nový přídavek :D:D:D
<dl>
  <dt>Počet modulů:</dt>
    <dd>%%1%%</dd>
  <dt>Počet databází:</dt>
    <dd>%%2%%</dd>
  <dt>Velikost všech modulů:</dt>
    <dd><span id=\"idcelmod\">???</span></dd>
  <dt>Velikost všech databází:</dt>
    <dd><span id=\"idceldat\">???</span></dd>
  <dt>Velikost celého webu:</dt>
    <dd><span id=\"idcelweb\">???</span></dd>
  <dt>Velikost stylů:</dt>
    <dd><span id=\"idcelsty\">???</span></dd>
  <dt>Velikost skriptů:</dt>
    <dd><span id=\"idcelskr\">???</span></dd>
  <dt>Velikost obrázků:</dt>
    <dd><span id=\"idcelobr\">???</span></dd>
  <dt>Velikost záloh:</dt>
    <dd><span id=\"idcelzal\">???</span></dd>
  <dt>Velikost sekcí:</dt>
  <dd><span id=\"idcelsek\">???</span></dd>
  <dt id=\"zmerit_vse\"><a href=\"#\" onclick=\"ZmeritVse(); return false\">Změřit všechny velikosti</a></dt>
  <dt>Počet chyb za dnešek:</dt>
    <dd>%%11%%</dd>
%%12%%
</dl>\n",
                  );

  return $result;
?>
