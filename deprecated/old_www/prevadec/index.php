<?php
class Convert
{
  function DoMd5()
  {
    return md5($_POST["text"]);
  }
//******************************************************************************
  function DoDoubleMd5()
  {
    return md5(md5($_POST["text"]));
  }
//******************************************************************************
  function ZakudujText()
  {
    return base64_encode($_POST["text"]);
  }
//******************************************************************************
  function DekodujText()
  {
    return base64_decode($_POST["text"]);
  }
//******************************************************************************
  function DoubleKodTextu()
  {
    return base64_encode(base64_encode($_POST["text"]));
  }
//******************************************************************************
  function DoubleDekodTextu()
  {
    return base64_decode(base64_decode($_POST["text"]));
  }
//******************************************************************************
  function mosMakePassword($length = 8) //by jombla
  {
    $salt     = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $makepass = '';
    mt_srand(10000000*(double)microtime());
    for ($i = 0; $i < $length; $i++)
      $makepass .= $salt[mt_rand(0,61)];
    return $makepass;
  }
//******************************************************************************
  function JomblaCrypt()
  {
    $salt = $this->mosMakePassword(16);
    $crypt = md5($_POST["text"].$salt);
    $heslo = $crypt.':'.$salt;

    list($hash, $salt) = explode(':', $heslo);

    return
    "v databázi: {$heslo}";
  }
//upravit toto, katalog dodělat..., program pro zálohu proti mé blbosti!!, seznam udalostí co mám udělat
//layout maxygenu, hostel, tsqm, statistiky
//zalohovací systém, statistky - webové a katalogu!
//******************************************************************************
  function DoCrc32()
  {
    return sprintf("%u\n", crc32($_POST["text"]));
  }
//******************************************************************************
  function DoSha1()
  {
    return sha1($_POST["text"]);
  }
//******************************************************************************
  function DoHash()
  {
    return hash($_POST["typ"], $_POST["text"]);
  }
//******************************************************************************
  function MoznostiHash()
  {
    $pole = hash_algos();
    $result = "<select name=\"typ\">";
    for ($i = 0; $i < count($pole); $i++)
    {
      if ($_POST["typ"] == $pole[$i])
      {
        $oznac = "selected=\"selected\"";
      }
        else
      {
        $oznac = "";
      }
      $result .= "<option $oznac value=\"{$pole[$i]}\">[$i] {$pole[$i]}</option>";
    }
    $result .= "</select>";
    return $result;
  }
//******************************************************************************
  function HtmlEntity()
  {
    return htmlspecialchars($_POST["text"], ENT_QUOTES, false);
  }
//******************************************************************************
  function Revize()
  {
    $nazev = "rev.ver";
    $dat = new SQLiteDatabase($nazev);

    if (filesize($nazev) == 0)
    {
      $dat->queryExec("CREATE TABLE revize (
                      id INTEGER AUTO_INCREMENT PRIMARY KEY,
                      sekce VARCHAR(50),
                      typ VARCHAR(50),
                      text TEXT,
                      datum DATETIME);");
    }

    if (!Empty($_GET["action"]) && !Empty($_POST["text"]))
    {
      $t1 = base64_encode($_GET["action"]);
      $t2 = base64_encode($_POST["typ"]);
      $t3 = base64_encode($_POST["text"]);
      $t4 = base64_encode(date("Y-m-d H:i:s"));

      $dat->queryExec("INSERT INTO revize (id, sekce, typ, text, datum) VALUES(NULL, '{$t1}', '{$t2}', '{$t3}', '{$t4}');");
    }

    if (!Empty($_GET["action"]) && $_GET["action"] == "sqlite")
    {
      $res = $dat->query("SELECT * FROM revize");
      while ($data = $res->fetchObject())
      {
        if ($_GET["subovno"] == "belle")
        {
          $e1 = base64_decode($data->sekce);
          $e2 = base64_decode($data->typ);
          $e3 = base64_decode($data->text);
          $e4 = base64_decode($data->datum);
          $result .= "| {$data->id} | {$e1} | {$e2} | {$e3} | {$e4} |<br />";
        }
          else
        {
          $result .= "| {$data->id} | {$data->sekce} | {$data->typ} | {$data->text} | {$data->datum} |<br />";
        }
      }
      echo "{$result}<br />";
    }
  }
//******************************************************************************
  function Odkazy()
  {
    return
    "kodovací:<br/>
    <a href=\"?action=md5\">do MD5</a><br/>
    <a href=\"?action=dablmd5\">do double MD5</a><br/>
    <a href=\"?action=jombla\">kodování jombly</a><br/>
    <a href=\"?action=crc32\">do crc32</a><br/>
    <a href=\"?action=sha1\">do sha1</a><br/>
    <a href=\"?action=hash\">universal hash</a><br/>
    <br/>
    kodovaci a dekodvací:<br/>
    <a href=\"?action=dobase64\">zakodovat base64</a><br/>
    <a href=\"?action=unbase64\">dekódovat base64</a><br/>
    <br/>
    double kodovaci a dekodvací:<br/>
    <a href=\"?action=dodablbase64\">zakodovat 2base64</a><br/>
    <a href=\"?action=undablbase64\">dekódovat 2base64</a><br/>
    <br/>
    textové:<br/>
    <a href=\"?action=entity\">kodovat html entity</a><br/>
    <br/>
    <br/>";
  }
//******************************************************************************
  function __construct()
  {
    $this->Revize();
    $result =
    "
    {$this->Odkazy()}
    {$this->Sekce()}
    ";
    echo $result;
  }
//******************************************************************************
  function AutoClick($cas, $cesta)
  {
    return "<head><meta http-equiv=\"refresh\" content=\"$cas;URL=$cesta\"></head>";
  }
//******************************************************************************
  function Sekce()
  {
    if (!Empty($_GET["action"]))
    {
      switch ($_GET["action"])
      {
        case "md5":
          $vypis =
          "do md5<br/>
          <form method=\"post\" action=\"\">
            <fieldset>
              <input type=\"text\" name=\"text\" value=\"{$_POST["text"]}\">
              <input type=\"submit\" name=\"tlacitko\" value=\"Proveď\">
            </fieldset>
          </form>";

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["text"]))
          {
            $vypis .= $this->DoMd5();
          }
          return $vypis;
        break;
        //**********************************************************************
        case "dablmd5":
          $vypis =
          "do dabl md5<br/>
          <form method=\"post\" action=\"\">
            <fieldset>
              <input type=\"text\" name=\"text\" value=\"{$_POST["text"]}\">
              <input type=\"submit\" name=\"tlacitko\" value=\"Proveď\">
            </fieldset>
          </form>";

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["text"]))
          {
            $vypis .= $this->DoDoubleMd5();
          }
          return $vypis;
        break;
        //**********************************************************************
        case "dobase64":
          $vypis =
          "decode base64<br/>
          <form method=\"post\" action=\"\">
            <fieldset>
              <input type=\"text\" name=\"text\" value=\"{$_POST["text"]}\">
              <input type=\"submit\" name=\"tlacitko\" value=\"Proveď\">
            </fieldset>
          </form>";

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["text"]))
          {
            $vypis .= $this->ZakudujText();
          }
          return $vypis;
        break;
        //**********************************************************************
        case "unbase64":
          $vypis =
          "encode base64<br/>
          <form method=\"post\" action=\"\">
            <fieldset>
              <input type=\"text\" name=\"text\" value=\"{$_POST["text"]}\">
              <input type=\"submit\" name=\"tlacitko\" value=\"Proveď\">
            </fieldset>
          </form>";

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["text"]))
          {
            $vypis .= $this->DekodujText();
          }
          return $vypis;
        break;
        //**********************************************************************
        case "dodablbase64":
          $vypis =
          "decode 2base64<br/>
          <form method=\"post\" action=\"\">
            <fieldset>
              <input type=\"text\" name=\"text\" value=\"{$_POST["text"]}\">
              <input type=\"submit\" name=\"tlacitko\" value=\"Proveď\">
            </fieldset>
          </form>";

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["text"]))
          {
            $vypis .= $this->DoubleKodTextu();
          }
          return $vypis;
        break;
        //**********************************************************************
        case "undablbase64":
          $vypis =
          "encode 2base64<br/>
          <form method=\"post\" action=\"\">
            <fieldset>
              <input type=\"text\" name=\"text\" value=\"{$_POST["text"]}\">
              <input type=\"submit\" name=\"tlacitko\" value=\"Proveď\">
            </fieldset>
          </form>";

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["text"]))
          {
            $vypis .= $this->DoubleDekodTextu();
          }
          return $vypis;
        break;
        //**********************************************************************
        case "jombla":
          $result =
          "kodování jombly: pasw=16<br/>
          <form method=\"post\">
            <fieldset>
              <input type=\"text\" name=\"text\" value=\"{$_POST["text"]}\">
              <input type=\"submit\" name=\"tlacitko\" value=\"Proveď\">
            </fieldset>
          </form>";

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["text"]))
          {
            $result .= $this->JomblaCrypt();
          }
          return $result;
        break;
        //**********************************************************************
        case "crc32":
          $result =
          "kodování crc32<br/>
          <form method=\"post\">
            <fieldset>
              <input type=\"text\" name=\"text\" value=\"{$_POST["text"]}\">
              <input type=\"submit\" name=\"tlacitko\" value=\"Proveď\">
            </fieldset>
          </form>";

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["text"]))
          {
            $result .= $this->DoCrc32();
          }
          return $result;
        break;
        //**********************************************************************
        case "sha1":
          $result =
          "kodování sha1<br/>
          <form method=\"post\">
            <fieldset>
              <input type=\"text\" name=\"text\" value=\"{$_POST["text"]}\">
              <input type=\"submit\" name=\"tlacitko\" value=\"Proveď\">
            </fieldset>
          </form>";

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["text"]))
          {
            $result .= $this->DoSha1();
          }
          return $result;
        break;
        //**********************************************************************
        case "hash":
          $result =
          "kodování hash<br/>
          <form method=\"post\">
            <fieldset>
              {$this->MoznostiHash()}
              <input type=\"text\" name=\"text\" value=\"{$_POST["text"]}\">
              <input type=\"submit\" name=\"tlacitko\" value=\"Proveď\">
            </fieldset>
          </form>";

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["text"]))
          {
            $result .= $this->DoHash();
          }
          return $result;
        break;
        //**********************************************************************
        case "entity":
          $result =
          "kodován html entit<br/>
          <form method=\"post\">
            <fieldset>
              <textarea name=\"text\" rows=\"10\" cols=\"100\">{$_POST["text"]}</textarea>
              <input type=\"submit\" name=\"tlacitko\" value=\"Proveď\">
            </fieldset>
          </form>";

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["text"]))
          {
            $result .= $this->HtmlEntity();
          }
          return $result;
        break;
        //**********************************************************************
        //**********************************************************************
        //**********************************************************************
      }
    }
  }
//******************************************************************************
}

header("Content-type: text/html; charset=UTF-8");

$prev = new Convert;

?>
