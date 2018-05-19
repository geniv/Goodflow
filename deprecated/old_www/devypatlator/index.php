<?php
  class Devypatlator
  {
    public function __construct()
    {
      $input = stripslashes($_POST["input"]);
      //stripslashes(htmlspecialchars($_POST["input"], ENT_QUOTES));

      $vystup = "";
      if (!Empty($_POST["tlacitko"]) &&
          !Empty($input))
      {
        $vystup = stripslashes(htmlspecialchars($this->Encode($input), ENT_QUOTES));
      }

      $result = "
      <html>
        <head>
          <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
        </head>
        <body>
          <form method=\"post\">
            <fieldset>
              <textarea name=\"input\" rows=30 cols=150>{$input}</textarea><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"devymatlat\"><br />
            </fieldset>
          </form>
          <pre>{$vystup}</pre>
        </body>
      </html>
      ";

      echo $result;
    }

    private function Encode($text)
    {
      $prevod = array("y$" => "js",
                      "yi" => "ji",
                      "iy" => "ij",
                      "yí" => "jí",
                      "ye" => "je",
                      "Ýe" => "je",
                      "ey" => "ej",
                      "ěy" => "ěj",
                      "Ěy" => "ěj",
                      "yů" => "ju",
                      "ůy" => "ůj",
                      "yu" => "ju",
                      "uy" => "uj",
                      "yá" => "já",
                      "ay" => "aj",
                      "yif" => "jiv",
                      "p\$t" => "prost",
                      "4e" => "fore",
                      "ae" => "ale",
                      "\$" => "s",
                      "§" => "s",
                      "@" => "a",
                      "ß" => "b",
                      "+" => "t",
                      "ŧ" => "t",
                      "??" => "?",
                      "???" => "?",
                      //"tk" => "tak",
                      "upa" => "úplně",
                      "moí" => "mojí",
                      "moe" => "moje",
                      "moee" => "moj",
                      "woe" => "vole",
                      "jou" => "jó",
                      "tyle" => "tydle",
                      "jf" => "jv",
                      "ts" => "c",
                      "q" => "k",
                      "Ł" => "l",
                      "Đ" => "d",
                      "°" => "\"",
                      "Á" => "á",
                      "w" => "v",
                      "Č" => "č",
                      "Ě" => "ě",
                      "Š" => "š",
                      "Ř" => "ř",
                      "Ž" => "ž",
                      "Žh" => "ž",
                      "Ý" => "ý",
                      "Í" => "í",
                      "Íí" => "í",
                      "ÍÍ" => "í",
                      "É" => "é",
                      "ü" => "u",
                      "üü" => "u",
                      "ůů" => "ů",
                      "ůůů" => "ů",
                      "Ů" => "ů",
                      "ŮŮ" => "ů",
                      "ŮŮŮ" => "ů",
                      "uu" => "u",
                      "uuu" => "u",
                      "ůuů" => "ů",
                      "éé" => "é",
                      "ééé" => "é",
                      "ee" => "e",
                      "eee" => "e",
                      "eeee" => "e",
                      "ěě" => "ě",
                      "ěěě" => "ě",
                      "áá" => "á",
                      "ááá" => "á",
                      "aa" => "a",
                      "aaa" => "a",
                      "aaaa" => "a",
                      "0" => "o",
                      "oo" => "o",
                      "doop" => "doop",
                      "ooo" => "ó",
                      "oooo" => "ó",
                      "ooooo" => "ó",
                      "oooooo" => "ó",
                      "ooooooo" => "ó",
                      "oooooooo" => "ó",
                      "ii" => "i",
                      "iii" => "i",
                      "íí" => "í",
                      "ííí" => "í",
                      "yy" => "y",
                      "yyy" => "y",
                      "ýý" => "ý",
                      "ýýý" => "ý",
                      "cc" => "c",
                      "ccc" => "c",
                      "žž" => "ž",
                      "žžž" => "ž",
                      "ěčí" => "ětší",
                      " moi " => " moji ",
                      "moie" => "moje",
                      "zko" => "sko",
                      " Šech" => "všech",
                      " šecko" => "všecko",
                      " Šecko" => "všecko",
                      " šude" => "všude",
                      "Šü" => "všu",
                      "tt" => "t",
                      "éy" => "éj",
                      "shes" => "jseš",
                      "\$ou" => "jsou",
                      "tha" => "ta",
                      "yak" => "jak",
                      "tzz" => "c",
                      "pjd" => "prd",
                      "djŽ" => "drž",
                      "thy" => "ty",
                      "ísh" => "íš",
                      " tk " => " tak ",
                      "tk " => "tak ",
                      "tky" => "taky",
                      "tz" => "c",
                      "něak" => "nějak",
                      "z5" => "zpět",
                      "Đom" => "dům",
                      "vay" => "vají",
                      "pstě" => "prostě",
                      "wáá" => "ver",
                      "ŮuŮ" => "== sem blbá == ",
                      "mmn" => "momen",
                      "barie" => "barbi",
                      "k+z" => "k + z",
                      "k+k" => "k + k",
                      "czi" => "č",
                      "mocz" => "moc",
                      "tyo" => "tyjo",
                      " jk " => " jak ",
                      "eey" => "ej",
                      "nio" => "no",
                      " cc " => " co ",
                      "the" => "tě",
                      "<3" => "(srdíčko)",
                      " upe " => " úplně ",
                      "neci" => "nechci",
                      "twl" => "ty vole",
                      "libofka" => "libovka",
                      "pk" => "pak",
                      "scho" => "sho",
                      "unejst" => "unést",
                      "ae" => "ale",
                      "¤" => "o",
                      "h3" => "he",
                      "t3" => "te",
                      "b3" => "be",
                      "ß3" => "be",
                      "n3" => "ne",
                      "l3" => "le",
                      "v3" => "ve",
                      "v3k" => "vek",
                      "s3" => "se",
                      "\$3" => "se",
                      "r3" => "re",
                      "t3b3" => "tebe",
                      "t3ß3" => "tebe",
                      "p3" => "pe",
                      "\$3\$" => "ses",
                      "dža" => "ja",
                      "btw" => "btw",
                      "new" => "new",
                      "zoo" => "zoo",
                      "x" => "ch",
                      );

      $text = strtolower($text);
      $text = strtr($text, $prevod);
      //$text = strtoupper($text);

      return $text;
    }
  }

  $web = new Devypatlator();
?>
