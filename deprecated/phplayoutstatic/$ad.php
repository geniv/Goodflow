<?php
//dodelat!!
//pres rewrite odsmerovat adresu adminu!!
//a nejak autorizaci
//databaze: xml s base64 kodovanim pro zabezpeceni neregularnicha znaku obsahu!

class StaticLayout
{
  private $prom;

//konstruktor
  public function __construct()
  {
    $dom = new DOMDocument;
    $dom->loadHTMLFile("index.html");
    $xml = simplexml_import_dom($dom);
//jop, takhle by to slo...
//jeste ale v konfiguracce nastavovat udaje a veci co se ma menit...
    $xml->head->title = "Nová super hlavička stránek :D";

    $this->prom = $xml->asXML();
  }

//vystup do textu
  public function __toString()
  {
    $result = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
{$this->prom}";

    return $result;
  }


}

$web = new StaticLayout();
echo $web;

?>
