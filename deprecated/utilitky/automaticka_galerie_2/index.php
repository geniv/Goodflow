<?php

class AutoGalerie
{
  private $nazevwebu = "Název webu";

  private $mini_w = 0;  //velikost miniatury - width
  private $mini_h = 240;  //velikost miniatury - height
  private $komprese = 100;  //%

  private $sourcedir = "obr"; //slozka v ktere budou slozky galerii
  private $minidir = "mini";  //kazda podslozka bude mit svuj minidir

  private $formaty = array ("jpg",  //pole podporovanych formatu
                            "png");

  private $get_action = "action"; //get promenna v adrese
  private $get_akce = "akce"; //get promenna v adrese

/**
 *
 * Hlavi vytvareci funkce webu
 *
 * @return vygenerovany web
 */
  public function __construct()
  {
    $result = "";

    $galerie = $this->NactiNazvyGalerii();  //nacteni jmen galerii
    $vypisgalerie = "<a href=\"?{$this->get_action}=\">žádný výběr</a><br />"; //inicializace promenne
    if (is_array($galerie)) //test jestli je nejaky obsah
    {
      for ($i = 0; $i < count($galerie); $i++)  //vypisovaci cyklus galerii
      {
        //vytvoreni slozek minatur
        if (!file_exists("{$this->sourcedir}/{$galerie[$i]}/{$this->minidir}"))
        {
          if (mkdir("{$this->sourcedir}/{$galerie[$i]}/{$this->minidir}", 0777))
          {
            echo "složka: {$this->sourcedir}/{$galerie[$i]}/{$this->minidir} vytvořena";
          }
        }

        //generovani odkazu galerie
        if ($_GET[$this->get_action] == $galerie[$i]) //vyber galerie
        { //oznaceny
          $vypisgalerie .= "galerie: <strong>{$galerie[$i]}</strong><br />";
        }
          else
        { //neoznaceny
          $vypisgalerie .= "galerie: <a href=\"?{$this->get_action}={$galerie[$i]}\"><strong>{$galerie[$i]}</strong></a><br />";
        }
      }
    }

    $obr = "";  //inicializace promenne
    $nazev = "";  //inicializace promenne
    $obsahgalerie = $this->NactiVybranouGalerii();  //nacteni fotek vybrane galerie
    $vypisobsahugalerie = ""; //inicializace promenne
    if (is_array($obsahgalerie["nazev"])) //test jestli je nejaky obsah
    {
      $autoref = false;
      for ($i = 0; $i < count($obsahgalerie["nazev"]); $i++)  //vypisovaci cyklus obsahu galerii
      {
        if (!file_exists($obsahgalerie["mini"][$i]))
        { //zpracovava
          $obr = $obsahgalerie["full"][$i]; //zdroj
          $nazev = $obsahgalerie["mini"][$i]; //cil

          $vypisobsahugalerie .= "
          <p>
          generuje se...<br />
          <strong>{$obsahgalerie["nazev"][$i]}</strong>
          <br /><br />
          </p>
          ";
          $autoref = true;
        }
          else
        { //vykresluje
          $file = "{$this->sourcedir}/{$_GET[$this->get_action]}/{$this->minidir}/{$obsahgalerie["nazev"][$i]}.txt";

          $komentar = ""; //inicializace promenne
          if (file_exists($file)) //overen existence
          {
            $u = fopen($file, "r"); //nacteni komentare
            $komentar = fread($u, (filesize($file) == 0 ? 1 : filesize($file)));
            fclose($u);
          }

          $vypisobsahugalerie .= "
          <p>
          <a href=\"{$obsahgalerie["full"][$i]}\"><img src=\"{$obsahgalerie["mini"][$i]}\" /></a><br />
          <strong>{$obsahgalerie["nazev"][$i]}</strong>
          <a href=\"?{$this->get_action}={$_GET[$this->get_action]}&amp;{$this->get_akce}=com&amp;foto={$obsahgalerie["nazev"][$i]}\">komentář fotky</a>
          <br />
          <tt>{$komentar}</tt>
          <br /><br />
          </p>
        ";
        }
      }
    }

    $meta = "";
    if ($_GET[$this->get_akce] == "com")  //odchyceni akce komentare
    {
      $file = "{$this->sourcedir}/{$_GET[$this->get_action]}/{$this->minidir}/{$_GET["foto"]}.txt"; //nastaveni cesty
      $data = "";
      if (file_exists($file)) //kdyz existuje cte
      {
        $u = fopen($file, "r"); //cte ze souboru
        $data = fread($u, (filesize($file) == 0 ? 1 : filesize($file)));
        fclose($u);
      }
        else
      { //kdyz neexstuje vytvari prazdny
        $u = fopen($file, "w");
        fclose($u);
      }

      $komentar = "
      <fieldset>
        <form method=\"post\">
          napiš ctěný komentář:<br />
          <textarea name=\"komentar\">{$data}</textarea><br />
          <input type=\"submit\" value=\"uložit komentář\" name=\"tlacitko\">
        </form>
      </fieldset>
      ";

      if (!Empty($_POST["komentar"]) && //ceka na zmacknuti tlacitka
          !Empty($_POST["tlacitko"]))
      {
        $u = fopen($file, "w"); //ulozi data do souboru
        fwrite($u, $_POST["komentar"]);
        fclose($u);

        $komentar .= "uloženo"; //text uspesneho ulozeni
        //meta tag na auto refresh
        $meta = "<meta http-equiv=\"refresh\" content=\"1;URL=?{$this->get_action}={$_GET[$this->get_action]}\" />";
      }
    }

    //auto generovani obrazku
    $info = ""; //inicializace promenne
    if (!Empty($obr) && //pokud je nejaky obrazek jeste nezmenseny
        !Empty($nazev))
    {
      $info = $this->ZpracujObrazek($obr, $nazev);  //zavola zmensovaci funkci, zmensuje vzdy od konce
    }

    $titlegalerie = (!Empty($_GET[$this->get_action]) ? " - {$_GET[$this->get_action]}" : "");  //doplneni pomlcky k nazvu

    $obnova = ($autoref ? "<meta http-equiv=\"refresh\" content=\"1;URL=?{$this->get_action}={$_GET[$this->get_action]}\" />" : "");

    $result =
    "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"Geniv &amp; Fugess (GF Design - www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz - www.gfdesign.cz)\" />
    <meta name=\"keywords\" content=\"Automatická galerie by GF Design\" />
    <meta name=\"description\" content=\"Automatická galerie by GF Design\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
    {$meta}{$obnova}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" />
    <title>Automatická galerie by GF Design - {$this->nazevwebu}{$titlegalerie}</title>
  </head>
  <body>
    <h1>{$this->nazevwebu}{$titlegalerie}</h1>

  <p>
    <strong>{$info}</strong>
    <br /><br />
    {$komentar}
  </p>

  <div>
    {$vypisgalerie}
  </div>

<br /><br />

  <div>
    {$vypisobsahugalerie}
  </div>

  </body>
</html>";

    echo $result; //hlavni vypis stranek
  }

/**
 *
 * Nacte jmena galeii
 *
 * @return pole nazvu galerii
 */
  private function NactiNazvyGalerii()
  {
    $result = "";
    $handle = opendir($this->sourcedir);
    $obr = "";
    while($soub = readdir($handle))
    {
      if ($soub != "." &&   //ignorace .
          $soub != ".." &&  //ignorace ..
          is_dir("{$this->sourcedir}/{$soub}"))  //jen adresare
      {
        $result[] = $soub;  //nacte nazvy do pole
      }
    }
    closedir($handle);

    if (!Empty($result))
    {
      sort($result);  //serazeni galerii
    }

    return $result;
  }

/**
 *
 * Nacte fotky dane galerie
 *
 * @return pole nazvu fotek
 */
  private function NactiVybranouGalerii()
  {
    $result = "";
    $selgalerie = $_GET[$this->get_action]; //nasteni nazvu z GET

    if (!Empty($selgalerie))
    {
      $result = "";
      $handle = opendir("{$this->sourcedir}/{$selgalerie}");
      while($soub = readdir($handle))
      {
        $koncovka = explode(".", $soub);  //rozdeleni nazvu pro koncovku
        if ($soub != "." &&   //ignorace .
            $soub != ".." &&  //ignorace ..
            filetype("{$this->sourcedir}/{$selgalerie}/{$soub}") == "file" && //jen soubory
            in_array(strtolower($koncovka[count($koncovka) - 1]), $this->formaty))  //jen dane formaty
        {
          $result["nazev"][] = $soub;  //nacte nazvy do pole
          $result["mini"][] = "{$this->sourcedir}/{$selgalerie}/{$this->minidir}/{$soub}";  //nacte nazvy do pole
          $result["full"][] = "{$this->sourcedir}/{$selgalerie}/{$soub}";  //nacte nazvy do pole
        }
      }
      closedir($handle);

      if (!Empty($result))
      {
        sort($result["nazev"]); //serazeni obrazku
        sort($result["mini"]);  //serazeni obrazku
        sort($result["full"]);  //serazeni obrazku
      }
    }

    return $result;
  }

/**
 *
 * Zpracovani obrazku
 *
 * @param obrazek zdrojova cesta obrazku
 * @param cil cilova cesta obrazku
 */
  private function ZpracujObrazek($obrazek, $cil)
  {
    list($old_w, $old_h) = getimagesize($obrazek);

    if ($this->mini_w != 0 && //pevna velikost
        $this->mini_h != 0)
    {
      if ($old_w <= $this->mini_w &&
          $old_h <= $this->mini_h)
      {
        $new_w = $old_w;  //zanechava
        $new_h = $old_h;
      }
        else
      {
        $new_w = $this->mini_w; //zmensuje
        $new_h = $this->mini_h;
      }
    }
      else
    if ($this->mini_h == 0) //auto dopocitavani vysky
    {
      if ($old_w <= $this->mini_w)
      {
        $new_w = $old_w;  //zanechava
        $new_h = $old_h;
      }
        else
      {
        $new_w = $this->mini_w; //zmensuje
        $new_h = round($old_h / ($old_w / $this->mini_w));
      }
    }
      else
    if ($this->mini_w == 0) //auto dopocitavani sirky
    {
      if ($old_w <= $this->mini_h)
      {
        $new_w = $old_w;  //zanechava
        $new_h = $old_h;
      }
        else
      {
        $new_w = round($old_w / ($old_h / $this->mini_h)); //zmensuje
        $new_h = $this->mini_h;
      }
    }

    $koncovka = explode(".", basename($cil));  //rozdeleni nazvu pro koncovku
    switch (strtolower($koncovka[count($koncovka) - 1]))
    {
      case "jpg":
        //ini_set("memory_limit", "100M");

        $img_old = imagecreatefromjpeg($obrazek);
        $img_new = imagecreatetruecolor($new_w, $new_h);
        imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
        imagejpeg($img_new, $cil, $this->komprese);
        imagedestroy($img_old);
        imagedestroy($img_new);
      break;

      case "png":
        //ini_set("memory_limit", "100M");

        $img_old = imagecreatefrompng($obrazek);
        $img_new = imagecreatetruecolor($new_w, $new_h);
        imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
        imagepng($img_new, $cil, $this->komprese);
        imagedestroy($img_old);
        imagedestroy($img_new);
      break;
    }

    $nazev = basename($cil);

    return "vytvořeno: {$nazev}";
  }
}

$web = new AutoGalerie();
?>
