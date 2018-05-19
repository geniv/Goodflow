<?

class Jidlo
{
  //pridat recepty, nejak!
  private $jidlo = array ("toustovy chleba s pomazankou" => array("toustový chleba", "pomazáka"),
                          "tousty se salámem a sýrem" => array("toustovač", "toustový chleba", "salam", "sýr"),
                          "tousty se salámem a sýrem ala loki" => array("toustovač", "šnůra toustovače", "toustový chleba", "salam", "sýr"),
                          "volské oko" => array("vajíčka", "pánev", "olej", "sůl"),
                          //"špagety s kečupem" => array("špagety", "vajíčka", "kečup", "hrnec", ),
                          "chleba s marmeládou" => array("chleba", "marmeláda", "máslo"),
                          "smažená slanina ala františek" => array("veka", "hořčice", "slanina"),
                          "sýrovy salát ala františek (nakrájet na kostky, zamíchat, okořenit)" => array("tvrdý sýr", "olej", "ocet", "cibule", "pepř", "sůl", "cukr"),
                          "kabanusový salát ala františek (pokrájet, zamíchat, nechat uležet)" => array("cilbule", "pórek", "kyselé zelí", "kabanus", "sůl", "pepř"),
                          "kakao s nadrobeným rohlíkem" => array("rohlíky", "granko", "mléko"),
                          "křupky s mlékem" => array("křupky", "mléko"),
                          "ledová káva" => array("ledová káva v sáčku", "mléko"),
                          "celerový salát (nastrouhat, promačknout strouček, majolku, zamíchat, citronka, 'osolit', podavat s rohliky)" => array("celer", "česnek", "majolka", "sůl", "citrónka", "rohlíky"),
                          "mrkvový salát (nastrouhat mrkev, zamichat s tatarkou, sýrem, citronka, osolit, opeprit (pripadne par lzicek smetany), pridat nakrajene vajicko)+rohliky" => array("mrkev", "tatarka", "sýr", "sůl", "pepř", "citrónka", "vajíčka", "rohlíky"),
                          "krupice" => array("mléko", "krupice", "máslo", "sůl", "cukr", "granko"),
                          "rýže na sladko (lite) - (uvařit rýžu + osolit (15-20m), na taliřku pak trochu masla, cukr a granko)" => array("hrnec", "rýže", "sůl", "máslo", "cukr", "granko"),
                          "kuře ala kolej (uvařit testoviny, upect kureci prsni ryzky na oleji s korenim 7 bylinek, nakrajet olivy, papriku a promichat v hrnci)" => array("kuřecí prsní řízky", "olivy", "těstoviny", "paprika", "olej", "pánev", "sůl", "koření kuře 7 bylin"),

/*
                          "" => array(),
                          "" => array(),
                          "" => array(),
*/
                          );

  public function __construct()
  {
    $pol = "";
    $jid = array();
    foreach ($this->jidlo as $jidla)
    {
      $jid = array_merge($jid, $jidla);
    }

    $allfood = "";
    $namefood = "";
    $get_action = $_GET["action"];
    if (!Empty($get_action))
    {
      switch ($get_action)
      {
        case "allfood": //vypis vsech ingredienci
          $poc = 0;
          foreach ($this->jidlo as $indexpolozka => $polozka)
          {
            $allfood .= "<a href=\"?action=food&amp;por={$poc}\">{$indexpolozka}</a><br />";
            $poc++;
          }
        break;

        case "food":  //oznaci vybrane jidlo
          $por = $_GET["por"];
          $naz_jidla = array_keys($this->jidlo);
          $namefood = $naz_jidla[$por];
          $sel_ingredience = $this->jidlo[$naz_jidla[$por]];
        break;
      }
    }

    //oznaci ingredience pod dle vyberu a nebo z postu
    $ingredience = (!Empty($sel_ingredience) ? $sel_ingredience : $_POST["ingredience"]);
    foreach (array_unique($jid) as $index => $polozka)
    {
      $check = (is_array($ingredience) && in_array($polozka, $ingredience) ? " checked=\"checked\"" : "");
      $pol .= ($check ? "<strong>" : "")."{$polozka}".($check ? "</strong>" : "").":<input type=\"checkbox\" name=\"ingredience[]\" value=\"{$polozka}\"{$check} />&nbsp;&nbsp;&nbsp;&nbsp;";
      //zalamovani po X radcich
      if (($index % 8) == 7)
      {
        $pol .= "<br />\n";
      }
    }

    $poc = count($this->jidlo);

    $result = "
<html>
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"GF design - Tvorba webových stránek a systémů (www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GF design\" />
    <meta name=\"description\" content=\"PHPLayout - meta description\" />
    <title>GF - Jídelníček (DEV verze)</title>
  </head>
  <body>
<p><strong>označ dostupné suroviny / nástroje:</strong>
<br />(počet dostupných jídel: {$poc}), vypsat všechna dostupná <a href=\"?action=allfood\">jídla</a></p>
<strong>{$namefood}</strong>
<form method=\"post\">
  <fieldset>
    {$pol}<br />
    <input type=\"submit\" name=\"tlacitko\" value=\"Vyhodnotit\">
  </fieldset>
</form>
{$allfood}";

    if (!Empty($_POST["tlacitko"]))
    {
      $res = "";
      $naz_jidla = array_flip(array_keys($this->jidlo));  //nacteni nazvu, obraceni klicu
      foreach ($this->jidlo as $nazev => $polozky)
      {
        $pol = array();
        foreach ($_POST["ingredience"] as $dostupne)
        {
          //kdyz je dostupne v ingrediencich
          if (in_array($dostupne, $polozky))
          {
            $pol[] = $dostupne;
          }
        }

        sort($pol);
        sort($polozky);

        if ($pol == $polozky)
        {
          $res .= "můžeš ukuchtit: <strong><a href=\"?action=food&amp;por={$naz_jidla[$nazev]}\">{$nazev}</a></strong><br />";
        }
      }

      $result .= $res;
    }

    $result .= "</body></html>";

    echo $result;
  }
}

new Jidlo();
?>
