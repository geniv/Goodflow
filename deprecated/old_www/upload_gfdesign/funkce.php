<?php
class Funkce
{
  public $var;
//******************************************************************************
  function __construct(&$var) //konstruktor funkce
  {
    $this->var = $var;

    if (!$this->var->sqlite = @new SQLiteDatabase($this->var->nazevdb, 0777, $error))
    {
      $this->ErrorMsg($error);
    }

    $this->Instalace(); //volani instalace

    $this->StartSession();  //volani zacatku session

    $this->var->web = "http://{$_SERVER["SERVER_NAME"]}";

    if ($res = @$this->var->sqlite->query("SELECT id, nazev, pripona, trida FROM pripony ORDER BY LOWER(pripona) ASC", NULL, $error))
    {
      for ($i = 0; $i < $res->numRows(); $i++)
      {
        $data = $res->fetchObject();
        $this->var->pripona[$data->pripona] = $data->trida;
        $this->var->priponapopis[$data->pripona] = $data->nazev;
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

/*
    if (!@$this->var->sqlite->queryExec("DROP TABLE hesla", $error))
    {
      $this->ErrorMsg($error);
    }
*/
/*
    if (!@$this->var->sqlite->queryExec("CREATE TABLE hesla (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            login VARCHAR(50),
                                            heslo VARCHAR(50),
                                            cesta VARCHAR(50) UNIQUE,
                                            uzivatel INTEGER,
                                            slozka INTEGER,
                                            podslozka INTEGER);", $error))
    {
      $this->ErrorMsg($error);
    }
*/
  }
//******************************************************************************
  function Menu() //menu stranek
  {
    $menu = ($this->var->pravo == 1 ? $this->var->menuadmin : ($this->var->pravo == 2 ? $this->var->menumod : $this->var->menuuser));
    for ($i = 0; $i < count($menu); $i++)
    {
      $result .=
      "
      <p".($i == (count($menu) - 1) ? " class=\"posledni_polozka_menu\"" : "").">
        <a href=\"?action={$menu[$i]}\" class=\"polozka_{$menu[$i]}".(Empty($_GET["action"]) ? "" : ($menu[$i] == $this->var->orientace[$_GET["action"]] ? " aktivni" : ""))."\" title=\"{$this->var->stranka[$menu[$i]]}\"><span class=\"".(Empty($_GET["action"]) ? "aktivni" : ($menu[$i] == $this->var->orientace[$_GET["action"]] ? "aktivni" : "neaktivni"))."\"></span><em>{$this->var->stranka[$menu[$i]]}</em>".($menu[$i] == "uvod" ? "<strong>Úvod</strong>" : ($menu[$i] == "loginaccess" ? "<strong>Logování</strong>" : ""))."</a>
      </p>
      ";
    }

    return $result;
  }
//******************************************************************************
  function ObsahStranky() //vkladani obsahu stranky
  {
    $kam = $_GET["action"];

    if (!Empty($kam))
    {
      if (file_exists("{$kam}.php"))
      {
        $this->var->kam = $kam;
        $result = include_once "{$this->var->kam}.php";
      }
        else
      {
        $this->var->kam = $this->var->default;
        $result = include_once "{$this->var->kam}.php";
      }
    }
      else
    {
      $this->var->kam = $this->var->default;
      $result = include_once "{$this->var->kam}.php";
    }

    return $result;
  }
//******************************************************************************
  function Pristup()  //overovani prihlaseneho uzivatele
  {
    switch ($this->var->pravo)
    {
      case 0: //user
        $result = in_array($this->var->kam, $this->var->accesuser);
      break;

      case 1: //admin
        $result = true;
      break;

      case 2: //moderator
        $result = in_array($this->var->kam, $this->var->accesmod);
      break;
    }

    return $result;
  }
//******************************************************************************
  function OdkazZ5($zpet = 1) //vracec historie
  {
    $result = "<a href=\"javascript:location.reload();\" title=\"Skus obnovit stránku\"><span></span>Skus obnovit stránku</a>";

    return $result;
  }
//******************************************************************************
  function ErrorMsg($chyba)  //procedura chybove hlasky
  {
    $this->var->chyba =
    "
<div id=\"centralni_chyba\">
  <span class=\"vlevo_obrazek\"></span>
  <p>
    Vyskytla se chyba: <em>{$chyba}</em>
  </p>
  <p>
    {$this->OdkazZ5()}
  </p>

  <span class=\"vpravo_obrazek\"></span>
</div>
        ";
  }
//******************************************************************************
  function AutoClick($cas, $cesta)  //auto kliknuti, procedura
  {
    $this->var->meta = "<meta http-equiv=\"refresh\" content=\"{$cas};URL={$cesta}\" />";
  }
//******************************************************************************
  function KontrolaLogin($login, $heslo)  //prihlasovani uzivatelu
  {
    if ($res = @$this->var->sqlite->query("SELECT
                                          id,
                                          jmeno,
                                          pravo,
                                          strftime('%d.%m.%Y %H:%M:%S', vytvoreno) as vytvoreno,
                                          prostor,
                                          vyprseniucet,
                                          vyprseni,
                                          style
                                          FROM uzivatel
                                          WHERE login='{$login}' AND
                                          heslo='{$heslo}';
                                          ", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();
        $this->var->iduser = $data->id;
        $this->var->jmeno = $data->jmeno;
        $this->var->pravo = $data->pravo;
        $this->var->vytvoreno = $data->vytvoreno;
        $this->var->prostor = $data->prostor;
        $this->var->expiraceucet = $data->vyprseniucet;
        $this->var->expirace = $data->vyprseni;
        $this->var->style = $data->style;

        $this->VytvorSlozkuUzivatele($this->var->jmeno);
        $result = true;
      }
        else
      {
        $result = false;
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function Instalace()  //instalace sqlite databaze
  {
    if (filesize($this->var->nazevdb) == 0)
    {
      if (!@$this->var->sqlite->queryExec ("CREATE TABLE uzivatel (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            login VARCHAR(100) UNIQUE,
                                            heslo VARCHAR(100),
                                            jmeno VARCHAR(50),
                                            pravo INTEGER,
                                            vytvoreno DATETIME,
                                            icq VARCHAR(15),
                                            www VARCHAR(200),
                                            email VARCHAR(100),
                                            prostor INTEGER,
                                            vyprseniucet INTEGER,
                                            vyprseni INTEGER,
                                            style INTEGER);

                                            INSERT INTO uzivatel (id, login, heslo, jmeno, pravo, vytvoreno, www, prostor, vyprseniucet, vyprseni, style, icq, email) VALUES(1, '6342fd9364b41005acce71e244849183', '93f9a5d3507bbd81db94663fd09dc866', 'Geniv', {$this->var->admin}, datetime('now', '+1 hour'), 'www.gfdesign.cz', 100, 0, 0, 1, '312007953', 'geniv@gfdesign.cz');
                                            INSERT INTO uzivatel (id, login, heslo, jmeno, pravo, vytvoreno, www, prostor, vyprseniucet, vyprseni, style, icq, email) VALUES(2, '48acfd8edd4b6009c8257490df01c717', '7c8c47575b1ff8a0a34e871a33b5954f', 'Fugess', {$this->var->admin}, datetime('now', '+1 hour'), 'www.gfdesign.cz', 100, 0, 0, 1, '240720819', 'fugess@gfdesign.cz');
                                            INSERT INTO uzivatel (id, login, heslo, jmeno, pravo, vytvoreno, www, prostor, vyprseniucet, vyprseni, style, icq, email) VALUES(3, '06b586c247dd639a269aa3bbe70fabac', '2750e0d761a4d611073ae2ac3b171753', 'jurkix', {$this->var->admin}, datetime('now', '+1 hour'), 'www.gfdesign.cz', 100, 0, 0, 1, '232426644', 'jurkix@seznam.cz');

                                            CREATE TABLE uzivatel_ma_sdileni (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            uzivatel INTEGER,
                                            sdileni INTEGER);

                                            CREATE TABLE sdileni (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            uzivatel INTEGER,
                                            slozka INTEGER,
                                            podslozka INTEGER);

                                            CREATE TABLE slozka (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            uzivatel INTEGER,
                                            nazev VARCHAR(100),
                                            vytvoreno DATETIME);

                                            CREATE TABLE soubor (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            uzivatel INTEGER,
                                            nazev VARCHAR(200),
                                            vytvoreno DATETIME);

                                            CREATE TABLE podsoubor (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            uzivatel INTEGER,
                                            slozka INTEGER,
                                            nazev VARCHAR(200),
                                            vytvoreno DATETIME);

                                            CREATE TABLE podslozka (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            uzivatel INTEGER,
                                            slozka INTEGER,
                                            nazev VARCHAR(100),
                                            vytvoreno DATETIME);

                                            CREATE TABLE podpodsoubor (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            uzivatel INTEGER,
                                            slozka INTEGER,
                                            podslozka INTEGER,
                                            nazev VARCHAR(200),
                                            vytvoreno DATETIME);

                                            CREATE TABLE pripony (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            nazev VARCHAR(100),
                                            pripona VARCHAR(10) UNIQUE,
                                            trida VARCHAR(50),
                                            zamek BOOL);

                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Složka', 'dir', 'pripona_slozka', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Neznámá přípona', 'unkownfile', 'pripona_nezmama_pripona', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Bez přípony', 'nosuffix', 'pripona_bez_pripony', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'JPG Obrázek', 'jpg', 'pripona_jpg', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'JPEG Obrázek', 'jpeg', 'pripona_jpeg', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PNG Obrázek', 'png', 'pripona_png', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'GIF Obrázek', 'gif', 'pripona_gif', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'BMP Obrázek', 'bmp', 'pripona_bmp', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PSD Obrázek', 'psd', 'pripona_psd', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'TGA Obrázek', 'tga', 'pripona_tga', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'TIF Obrázek', 'tif', 'pripona_tif', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'TIFF Obrázek', 'tiff', 'pripona_tiff', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'ICO Obrázek', 'ico', 'pripona_ico', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PDD Obrázek', 'pdd', 'pripona_pdd', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'IEF Obrázek', 'ief', 'pripona_ief', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor WMA', 'wma', 'pripona_wma', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor AIFF', 'aiff', 'pripona_aiff', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor MP3', 'mp3', 'pripona_mp3', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor OGG', 'ogg', 'pripona_ogg', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor WAV', 'wav', 'pripona_wav', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor VQF', 'vqf', 'pripona_vqf', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor MPC', 'mpc', 'pripona_mpc', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor FLAC', 'flac', 'pripona_flac', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor APE', 'ape', 'pripona_ape', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor AAC', 'aac', 'pripona_aac', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor CDA', 'cda', 'pripona_cda', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor MKV', 'mkv', 'pripona_mkv', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor RAM', 'ram', 'pripona_ram', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor AU', 'au', 'pripona_au', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor MID', 'mid', 'pripona_mid', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor MIDI', 'midi', 'pripona_midi', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor MOD', 'mod', 'pripona_mod', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor SND', 'snd', 'pripona_snd', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor MP2', 'mp2', 'pripona_mp2', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor S3M', 's3m', 'pripona_s3m', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor STM', 'stm', 'pripona_stm', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor ULAW', 'ulaw', 'pripona_ulaw', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor VOC', 'voc', 'pripona_voc', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor XI', 'xi', 'pripona_xi', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Hudební soubor XM', 'xm', 'pripona_xm', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'XLS Dokument', 'xls', 'pripona_xls', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'DOC Dokument', 'doc', 'pripona_doc', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'ODT Dokument', 'odt', 'pripona_odt', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PPT Prezentace', 'ppt', 'pripona_ppt', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PDF Dokument', 'pdf', 'pripona_pdf', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'TXT Dokument', 'txt', 'pripona_txt', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'HTML Dokument', 'html', 'pripona_html', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'WPD Dokument', 'wpd', 'pripona_wpd', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'RTF Dokument', 'rtf', 'pripona_rtf', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'XHTML Dokument', 'xhtml', 'pripona_xhtml', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'HTM Dokument', 'htm', 'pripona_htm', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'AFP Dokument', 'afp', 'pripona_afp', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'URL Dokument', 'url', 'pripona_url', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'HTTP Dokument', 'http', 'pripona_http', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'MSO Dokument', 'mso', 'pripona_mso', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'RSS Dokument', 'rss', 'pripona_rss', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'ONE Dokument', 'one', 'pripona_one', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PS Dokument', 'ps', 'pripona_ps', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'VBS Dokument', 'vbs', 'pripona_vbs', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'VSD Dokument', 'vsd', 'pripona_vsd', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'XSL Dokument', 'xsl', 'pripona_xsl', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'TEX Dokument', 'tex', 'pripona_tex', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'JS Skript', 'js', 'pripona_js', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'CGI Skript', 'cgi', 'pripona_cgi', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'ASP Skript', 'asp', 'pripona_asp', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'CSS Skript', 'css', 'pripona_css', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PHP Skript', 'php', 'pripona_php', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PL Skript', 'pl', 'pripona_pl', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'XML Skript', 'xml', 'pripona_xml', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'H Skript', 'h', 'pripona_h', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'F Skript', 'f', 'pripona_f', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'CPP Skript', 'cpp', 'pripona_cpp', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'C Skript', 'c', 'pripona_c', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Y Skript', 'y', 'pripona_y', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'S Skript', 's', 'pripona_s', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PY Skript', 'py', 'pripona_py', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PYC Skript', 'pyc', 'pripona_pyc', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'P Skript', 'p', 'pripona_p', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'O Skript', 'o', 'pripona_o', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'L Skript', 'l', 'pripona_l', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'J Skript', 'j', 'pripona_j', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'SH Skript', 'sh', 'pripona_sh', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'TTF Font', 'ttf', 'pripona_ttf', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'TTC Font', 'ttc', 'pripona_ttc', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'OTF Font', 'otf', 'pripona_otf', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'FON Font', 'fon', 'pripona_fon', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PFB Font', 'pfb', 'pripona_pfb', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PFM Font', 'pfm', 'pripona_pfm', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Multimediální soubor MP4', 'mp4', 'pripona_mp4', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Multimediální soubor MOV', 'mov', 'pripona_mov', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Multimediální soubor SWF', 'swf', 'pripona_swf', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Multimediální soubor FLA', 'fla', 'pripona_fla', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Multimediální soubor FLV', 'flv', 'pripona_flv', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Multimediální soubor RM', 'rm', 'pripona_rm', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Soubor nápovědy HLP', 'hlp', 'pripona_hlp', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Soubor nápovědy CHM', 'chm', 'pripona_chm', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Soubor informací NFO', 'nfo', 'pripona_nfo', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Instalační balíček DEB', 'deb', 'pripona_deb', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Certifikát CRT', 'crt', 'pripona_crt', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Certifikát DER', 'der', 'pripona_der', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'M3U Playlist', 'm3u', 'pripona_m3u', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PLS Playlist', 'pls', 'pripona_pls', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'MAX Soubor', 'max', 'pripona_max', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'AI Soubor', 'ai', 'pripona_ai', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'DWG Soubor', 'dwg', 'pripona_dwg', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'DWT Soubor', 'dwt', 'pripona_dwt', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'VCR Soubor', 'vcr', 'pripona_vcr', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'CD Soubor', 'cd', 'pripona_cd', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'RGB Soubor', 'rgb', 'pripona_rgb', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'SVG Soubor', 'svg', 'pripona_svg', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'XCF Soubor', 'xcf', 'pripona_xcf', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'XFIG Soubor', 'xfig', 'pripona_xfig', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PIX Soubor', 'pix', 'pripona_pix', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'RES Soubor', 'res', 'pripona_res', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'CDP Soubor', 'cdp', 'pripona_cdp', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PSP Soubor', 'psp', 'pripona_psp', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'DIA Soubor', 'dia', 'pripona_dia', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'MOZ Soubor', 'moz', 'pripona_moz', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'SRC Soubor', 'src', 'pripona_src', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'TMP Soubor', 'tmp', 'pripona_tmp', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Soubor obrazu CUE', 'cue', 'pripona_cue', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Soubor obrazu IMG', 'img', 'pripona_img', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Soubor obrazu ISO', 'iso', 'pripona_iso', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Soubor obrazu MDF', 'mdf', 'pripona_mdf', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Soubor obrazu MDS', 'mds', 'pripona_mds', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Soubor obrazu NGR', 'ngr', 'pripona_ngr', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Soubor obrazu NRG', 'nrg', 'pripona_nrg', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Soubor obrazu CCD', 'ccd', 'pripona_ccd', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'MPEG Video', 'mpeg', 'pripona_mpeg', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'MPG Video', 'mpg', 'pripona_mpg', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'WMV Video', 'wmv', 'pripona_wmv', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'AVI Video', 'avi', 'pripona_avi', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'XVID Video', 'xvid', 'pripona_xvid', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'DIVX Video', 'divx', 'pripona_divx', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'VOB Video', 'vob', 'pripona_vob', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'VCD Video', 'vcd', 'pripona_vcd', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'SVCD Video', 'svcd', 'pripona_svcd', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'MPEG4 Video', 'mpeg4', 'pripona_mpeg4', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'ASF Video', 'asf', 'pripona_asf', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, '3GP Video', '3gp', 'pripona_3gp', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'MP Video', 'mp', 'pripona_mp', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'MP2V Video', 'mp2v', 'pripona_mp2v', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'GZIP Archiv', 'gzip', 'pripona_gzip', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'TGZ Archiv', 'tgz', 'pripona_tgz', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'RAR Archiv', 'rar', 'pripona_rar', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'SITX Archiv', 'sitx', 'pripona_sitx', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'SIT Archiv', 'sit', 'pripona_sit', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'TAR GZ Archiv', 'gz', 'pripona_gz', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'ZIP Archiv', 'zip', 'pripona_zip', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'CAB Archiv', 'cab', 'pripona_cab', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, '7ZIP Archiv', '7zip', 'pripona_7zip', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'ACE Archiv', 'ace', 'pripona_ace', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'ARJ Archiv', 'arj', 'pripona_arj', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, '7Z Archiv', '7z', 'pripona_7z', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'BZ2 Archiv', 'bz2', 'pripona_bz2', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'CBZ Archiv', 'cbz', 'pripona_cbz', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'LHA Archiv', 'lha', 'pripona_lha', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'LHZ Archiv', 'lhz', 'pripona_lhz', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'PAR Archiv', 'par', 'pripona_par', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor DAT', 'dat', 'pripona_dat', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor DLL', 'dll', 'pripona_dll', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor INF', 'inf', 'pripona_inf', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor INI', 'ini', 'pripona_ini', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor BAK', 'bak', 'pripona_bak', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor BAT', 'bat', 'pripona_bat', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor BIN', 'bin', 'pripona_bin', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor BKF', 'bkf', 'pripona_bkf', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor CDR', 'cdr', 'pripona_cdr', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor CMD', 'cmd', 'pripona_cmd', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor COM', 'com', 'pripona_com', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor DMG', 'dmg', 'pripona_dmg', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor EXE', 'exe', 'pripona_exe', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor IP', 'ip', 'pripona_ip', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor IPTHEME', 'iptheme', 'pripona_iptheme', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor JAR', 'jar', 'pripona_jar', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor LOG', 'log', 'pripona_log', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor MDB', 'mdb', 'pripona_mdb', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor MSI', 'msi', 'pripona_msi', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor OCX', 'ocx', 'pripona_ocx', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor RPM', 'rpm', 'pripona_rpm', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor SQL', 'sql', 'pripona_sql', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor SYS', 'sys', 'pripona_sys', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor UHA', 'uha', 'pripona_uha', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor WBA', 'wba', 'pripona_wba', 'true');
                                            INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES(NULL, 'Datový soubor ZAP', 'zap', 'pripona_zap', 'true');

                                            CREATE TABLE statistika (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            session VARCHAR(100),
                                            cas DATETIME,
                                            cas1 DATETIME,
                                            ip VARCHAR(20),
                                            pocet INTEGER,
                                            agent VARCHAR(200),
                                            charset VARCHAR(200),
                                            uzivatel INTEGER,
                                            jmeno VARCHAR(50),
                                            rozliseni_x INTEGER,
                                            rozliseni_y INTEGER,
                                            hloubka INTEGER);

                                            CREATE TABLE logovani (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            jmeno VARCHAR(100),
                                            heslo VARCHAR(100),
                                            stav BOOL,
                                            cas DATETIME,
                                            agent VARCHAR(200),
                                            rozliseni_x INTEGER,
                                            rozliseni_y INTEGER,
                                            ip VARCHAR(20),
                                            session VARCHAR(100),
                                            hloubka INTEGER);

                                            CREATE TABLE adresa (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            ip VARCHAR(20),
                                            uzivatel INTEGER,
                                            jmeno VARCHAR(50),
                                            agent VARCHAR(200),
                                            pocet INTEGER,
                                            cas DATETIME,
                                            rozliseni_x INTEGER,
                                            rozliseni_y INTEGER,
                                            session VARCHAR(100),
                                            hloubka INTEGER);

                                            CREATE TABLE vstup (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            agent VARCHAR(200),
                                            cas DATETIME,
                                            rozliseni_x INTEGER,
                                            rozliseni_y INTEGER,
                                            ip VARCHAR(20),
                                            session VARCHAR(100),
                                            hloubka INTEGER);

                                            CREATE TABLE styles (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            nazev VARCHAR(100) UNIQUE,
                                            slozka VARCHAR(100) UNIQUE);

                                            INSERT INTO styles (id, nazev, slozka) VALUES (1, 'Výchozí styl', 'vychozi_styl');

                                            CREATE TABLE importy (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            styles INTEGER,
                                            cesta VARCHAR(200),
                                            poradi INTEGER);

                                            CREATE TABLE styles_pripony (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            styles INTEGER,
                                            pripona INTEGER);

                                            CREATE TABLE hesla (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            login VARCHAR(50),
                                            heslo VARCHAR(50),
                                            cesta VARCHAR(50) UNIQUE,
                                            uzivatel INTEGER,
                                            slozka INTEGER,
                                            podslozka INTEGER);
                                            ", $error))
      {
        $this->ErrorMsg($error);
      }
      $this->VytvorSlozkuUzivatele("Geniv");  //instalace slozek
      $this->VytvorSlozkuUzivatele("Fugess");
      $this->VytvorSlozkuUzivatele("jurkix");
    }
  }
//******************************************************************************
  function ZbyvaDni($datum, $den) //vypocet kolik zbyva dni
  {//date("j", (mktime(max)-1h) - mktime(now))
    $vyt = strtotime($datum); //max - aktual
    $result = date("j", mktime(date("H", $vyt) - 1, date("i", $vyt), date("s", $vyt), date("n", $vyt), (date("j", $vyt) + $den), date("Y", $vyt)) - mktime(date("H"), date("i"), date("s"), date("n"), date("j"), date("Y")));

    return $result;
  }
//******************************************************************************
  function VyslovnostDnu($den)  //vyslovnost dnu u expirace
  {
    return ($den == 0 ? "Neomezeně" : ($den == 1 ? "{$den} den" : ($den >= 2 && $den <= 4 ? "{$den} dny" : "{$den} dní")));
  }
//******************************************************************************
  function VyslovnostDnuZbyva($den) //vyslovnost dnu u zbyva expirace
  {
    return ($den == 0 ? "{$den} dní" : ($den == 1 ? "{$den} den" : ($den >= 2 && $den <= 4 ? "{$den} dny" : "{$den} dní")));
  }
//******************************************************************************
  function VyslovnostHodin($hodiny) //vyslovnost hodin
  {
    return ($hodiny == 0 ? "{$hodiny} hodin" : ($hodiny == 1 ? "{$hodiny} hodina" : ($hodiny >= 2 && $hodiny <= 4 ? "{$hodiny} hodiny" : "{$hodiny} hodin")));
  }
//******************************************************************************
  function VytvorSlozkuUzivatele($jmeno)  //vyvoro zadanou slozku uzivatele
  {
    if (!file_exists($this->var->userdir)) //automaticke vytvoreni slozky
    {
      @mkdir($this->var->userdir);
      chmod($this->var->userdir, 0777); //zmeni prava pristupu
    }

    if (!file_exists("{$this->var->userdir}/{$jmeno}")) //automaticke vytvoreni slozky
    {
      @mkdir("{$this->var->userdir}/{$jmeno}");
      chmod("{$this->var->userdir}/{$jmeno}", 0777); //zmeni prava prstupu
    }
  }
//******************************************************************************
  function VelikostSouboru($jmeno)  //zjisteni velikosti souboru
  {
    if (file_exists($jmeno) && filetype($jmeno) == "file")
    {
      $result = $this->Velikost(filesize($jmeno));

      return $result;
    }
  }
//******************************************************************************
  function Velikost($size)  //vypocet velikosti souboru
  {
    $symbol = array("B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");

    $exp = 0;
    $converted_value = 0;
    if ($size > 0)
    {
      $exp = floor(log($size) / log(1024));
      $converted_value = ($size / pow(1024, floor($exp)));
    }

    $result = sprintf("%.2f {$symbol[$exp]}", $converted_value);

    return $result;
  }
//******************************************************************************
  function TypSouboru($jmeno, &$popis) //prideleni obrazku danemu typu souboru/slozky
  {
    switch (filetype($jmeno))
    {
      case "dir":
        $result = $this->var->pripona["dir"];
        $popis = $this->var->priponapopis["dir"];
      break;

      case "file":
        $a = explode(".", $jmeno);

        if (count($a) >= 2)
        {
          $suffix = strtolower($a[count($a) - 1]);  //znami/neznami typ souboru
          $result = (array_key_exists($suffix, $this->var->pripona) ? $this->var->pripona[$suffix] : $this->var->pripona["unkownfile"]);
          $popis = (array_key_exists($suffix, $this->var->priponapopis) ? $this->var->priponapopis[$suffix] : $this->var->priponapopis["unkownfile"]);
        }
          else
        {
          $result = $this->var->pripona["nosuffix"];  //bez pripony
          $popis = $this->var->priponapopis["nosuffix"];
        }
      break;
    }

    return $result;
  }
//******************************************************************************
  function ListingMainDir() //prochzeni vlastni slozky prihlaseneho uzivatele
  {
    $zan = $_GET["zan"];  //zanoreni
    settype($zan, "integer");
    $sl = $_GET["sl"];  //cislo slozky
    settype($sl, "integer");
    $psl = $_GET["psl"];  //cslo podslozky
    settype($psl, "integer");

    switch ($zan)
    {
      case 0: //koren
        $i = 0;
        if ($res = @$this->var->sqlite->query("SELECT id, nazev FROM slozka WHERE uzivatel={$this->var->iduser} ORDER BY LOWER(nazev) ASC;", NULL, $error))
        {
          if ($res->numRows() != 0)
          {
            while ($data = $res->fetchObject())
            {
              $cesta = "{$this->var->userdir}/{$this->var->jmeno}/{$data->nazev}";
              $prenos[$i]["cesta"] = $cesta;
              $prenos[$i]["nazev"] = $data->nazev;
              $prenos[$i]["id"] = $data->id;
              $prenos[$i]["slozka"] = true;
              $i++;
            }
          }
        }
          else
        {
          $this->ErrorMsg($error);
        }

        if ($res = @$this->var->sqlite->query("SELECT id, nazev FROM soubor WHERE
                                              uzivatel={$this->var->iduser}
                                              ORDER BY LOWER(soubor.nazev) ASC;", NULL, $error))
        { //vykresleni souboru v korenu
          if ($res->numRows() != 0)
          {
            while ($data = $res->fetchObject())
            {
              $cesta = "{$this->var->userdir}/{$this->var->jmeno}/{$data->nazev}";
              $prenos[$i]["cesta"] = $cesta;
              $prenos[$i]["nazev"] = $data->nazev;
              $prenos[$i]["id"] = $data->id;
              $prenos[$i]["slozka"] = false;
              $i++;
            }
          }
        }
          else
        {
          $this->ErrorMsg($error);
        }

        for ($i = 0; $i < count($prenos); $i++)
        {
          $typ = $this->TypSouboru($prenos[$i]["cesta"], $popis);
          $create = date($this->var->filedateformat, filemtime($prenos[$i]["cesta"]));

$result .=
              "
  <p".(((($i + 1) % 10) == 0) || ($i == (count($prenos) - 1)) ? " class=\"neborder\"" : "").">
    <a href=\"".($prenos[$i]["slozka"] ? "?action=uvod&amp;zan=1&amp;sl={$prenos[$i]["id"]}" : "{$prenos[$i]["cesta"]}")."\" class=\"{$typ}\" title=\"{$prenos[$i]["nazev"]}".($prenos[$i]["slozka"] ? "" : " - {$this->VelikostSouboru($prenos[$i]["cesta"])}")." - {$popis} - {$create}\">
      <span></span>
      ".($prenos[$i]["slozka"] ? ($this->AktivniHeslo(0, 0, $prenos[$i]["id"], $login, $heslo, $id, $this->var->iduser) ? "<cite title=\"Zaheslovaná složka - Login: {$login} - Heslo: {$heslo}\"></cite>" : "") : "")."
      {$prenos[$i]["nazev"]}
    </a>
    ".($prenos[$i]["slozka"] ? "" : "<a href=\"{$prenos[$i]["cesta"]}\" onclick=\"window.open(this.href); return false;\" class=\"vypis_hlavni_strana_otevrit_do_noveho_okna\" title=\"Otevřít soubor: {$prenos[$i]["nazev"]} do nového okna\"></a>
                                     <a href=\"#\" onclick=\"CopyToClipboard('{$this->var->web}/{$prenos[$i]["cesta"]}'); return false;\" class=\"vypis_hlavni_strana_zkopirovat_odkaz_do_schranky\" title=\"Zkopírovat odkaz do schránky\"></a>")."
  </p>
  ".(((($i + 1) % 10) == 0) && ($i != (count($prenos) - 1)) ? "<span class=\"linka_vypis\"></span>" : "")."
  ";
        }
      break;

      case 1: //slozka
        $i = 0;
        if ($res = @$this->var->sqlite->query("SELECT podslozka.id as id, podslozka.nazev as nazev, slozka.nazev as slozka FROM slozka, podslozka WHERE
                                              podslozka.uzivatel={$this->var->iduser} AND
                                              podslozka.slozka={$sl} AND
                                              slozka.id=podslozka.slozka
                                              ORDER BY LOWER(podslozka.nazev) ASC;", NULL, $error))
        {
          if ($res->numRows() != 0)
          {
            while ($data = $res->fetchObject())
            {
              $cesta = "{$this->var->userdir}/{$this->var->jmeno}/{$data->slozka}/{$data->nazev}";
              $prenos[$i]["cesta"] = $cesta;
              $prenos[$i]["protyp"] = $cesta;
              $prenos[$i]["nazev"] = $data->nazev;
              $prenos[$i]["id"] = $sl;
              $prenos[$i]["pid"] = $data->id;
              $prenos[$i]["slozka"] = true;
              $i++;
            }
          }
        }
          else
        {
          $this->ErrorMsg($error);
        }

        if ($res2 = @$this->var->sqlite->query("SELECT podsoubor.id as id, podsoubor.nazev as nazev, slozka.nazev as slozka FROM slozka, podsoubor WHERE
                                                podsoubor.uzivatel={$this->var->iduser} AND
                                                slozka.uzivatel={$this->var->iduser} AND
                                                podsoubor.slozka={$sl} AND
                                                slozka.id=podsoubor.slozka
                                                ORDER BY LOWER(podsoubor.nazev) ASC;", NULL, $error))
        { //vykresleni souboru ve slozce
          if ($res2->numRows() != 0)
          {
            while ($data2 = $res2->fetchObject())
            {
              $protyp = $cesta = "{$this->var->userdir}/{$this->var->jmeno}/{$data2->slozka}/{$data2->nazev}";
              $tajne = $this->TajnaCesta(0, 0, $sl, $this->var->iduser);

              if (!Empty($tajne))
              {
                $cesta = "download.php?action={$tajne}&amp;file={$data2->nazev}";
              }

              $prenos[$i]["cesta"] = $cesta;
              $prenos[$i]["protyp"] = $protyp;
              $prenos[$i]["nazev"] = $data2->nazev;
              $prenos[$i]["id"] = $sl;
              $prenos[$i]["pid"] = $data2->id;
              $prenos[$i]["slozka"] = false;
              $i++;
            }
          }
        }
          else
        {
          $this->ErrorMsg($error);
        }

        for ($i = 0; $i < count($prenos); $i++)
        {
          $typ = $this->TypSouboru($prenos[$i]["protyp"], $popis);
          $create = date($this->var->filedateformat, filemtime($prenos[$i]["protyp"]));

$result .=
              "
  <p".(((($i + 1) % 10) == 0) || ($i == (count($prenos) - 1)) ? " class=\"neborder\"" : "").">
    <a href=\"".($prenos[$i]["slozka"] ? "?action=uvod&amp;zan=2&amp;sl={$prenos[$i]["id"]}&amp;psl={$prenos[$i]["pid"]}" : "{$prenos[$i]["cesta"]}")."\" class=\"{$typ}\" title=\"{$prenos[$i]["nazev"]}".($prenos[$i]["slozka"] ? "" : " - {$this->VelikostSouboru($prenos[$i]["protyp"])}")." - {$popis} - {$create}\">
      <span></span>
      ".($prenos[$i]["slozka"] ? ($this->AktivniHeslo(1, $prenos[$i]["id"], $prenos[$i]["pid"], $login, $heslo, $id, $this->var->iduser) ? "<cite title=\"Zaheslovaná složka - Login: {$login} - Heslo: {$heslo}\"></cite>" : "") : ($this->AktivniHeslo(0, 0, $sl, $login, $heslo, $id, $this->var->iduser) ? "<cite title=\"Zaheslovaný soubor - Login: {$login} - Heslo: {$heslo}\"></cite>" : ""))."
      {$prenos[$i]["nazev"]}
    </a>
    ".($prenos[$i]["slozka"] ? "" : "<a href=\"{$prenos[$i]["cesta"]}\" onclick=\"window.open(this.href); return false;\" class=\"vypis_hlavni_strana_otevrit_do_noveho_okna\" title=\"Otevřít soubor: {$prenos[$i]["nazev"]} do nového okna\"></a>
                                    <a href=\"#\" onclick=\"CopyToClipboard('{$this->var->web}/{$prenos[$i]["cesta"]}'); return false;\" class=\"vypis_hlavni_strana_zkopirovat_odkaz_do_schranky\" title=\"Zkopírovat odkaz do schránky\"></a>")."
  </p>
  ".(((($i + 1) % 10) == 0) && ($i != (count($prenos) - 1)) ? "<span class=\"linka_vypis\"></span>" : "")."
              ";
        }
      break;

      case 2: //podslozka
        if ($res2 = @$this->var->sqlite->query("SELECT podpodsoubor.id as id, podpodsoubor.nazev as nazev, slozka.nazev as slozka, podslozka.nazev as podslozka FROM slozka, podslozka, podpodsoubor WHERE
                                                slozka.uzivatel={$this->var->iduser} AND
                                                podslozka.uzivatel={$this->var->iduser} AND
                                                podpodsoubor.uzivatel={$this->var->iduser} AND
                                                slozka.id=podslozka.slozka AND
                                                podslozka.id=podpodsoubor.podslozka AND
                                                podpodsoubor.slozka={$sl} AND
                                                podpodsoubor.podslozka={$psl}
                                                ORDER BY LOWER(podpodsoubor.nazev) ASC;", NULL, $error))
        { //vykresleni souboru v podslozce
          if ($res2->numRows() != 0)
          {
            $i = 0;
            while ($data2 = $res2->fetchObject())
            {
              $cesta = "{$this->var->userdir}/{$this->var->jmeno}/{$data2->slozka}/{$data2->podslozka}/{$data2->nazev}";
              $create = date($this->var->filedateformat, filemtime($cesta));
              $tajne = $this->TajnaCesta(1, $sl, $psl, $this->var->iduser);
              $typ = $this->TypSouboru($cesta, $popis);
              $protyp = $cesta;

              if (!Empty($tajne))
              {
                $cesta = "download.php?action={$tajne}&amp;file={$data2->nazev}";
              }

              $result .=
              "
  <p".(((($i + 1) % 10) == 0) || ($i == ($res2->numRows() - 1)) ? " class=\"neborder\"" : "").">
    <a href=\"{$cesta}\" class=\"{$typ}\" title=\"{$data2->nazev} - {$this->VelikostSouboru($protyp)} - {$popis} - {$create}\">
      <span></span>".($this->AktivniHeslo(1, $sl, $psl, $login, $heslo, $id, $this->var->iduser) ? "<cite title=\"Zaheslovaný soubor - Login: {$login} - Heslo: {$heslo}\"></cite>" : "")."
      {$data2->nazev}
    </a>
    <a href=\"{$cesta}\" onclick=\"window.open(this.href); return false;\" class=\"vypis_hlavni_strana_otevrit_do_noveho_okna\" title=\"Otevřít soubor: {$data2->nazev} do nového okna\"></a>
    <a href=\"#\" onclick=\"CopyToClipboard('{$this->var->web}/{$cesta}'); return false;\" class=\"vypis_hlavni_strana_zkopirovat_odkaz_do_schranky\" title=\"Zkopírovat odkaz do schránky\"></a>
  </p>
  ".(((($i + 1) % 10) == 0) && ($i != ($res2->numRows() - 1)) ? "<span class=\"linka_vypis\"></span>" : "")."
              "; // {$data2->id}
              $i++;
            }
          }
        }
          else
        {
          $this->ErrorMsg($error);
        }
      break;
    }

    $result .= $this->ShareFile();

    return $result;
  }
//******************************************************************************
  function ListingUser()  //admin vypis uzivatelu a prochazeni slozek
  {
    if ($res = @$this->var->sqlite->query("SELECT id, heslo, jmeno, pravo
                                          FROM uzivatel
                                          ".($this->var->pravo == $this->var->admin ? "ORDER BY LOWER(jmeno) ASC" : ($this->var->pravo == $this->var->moderator ? "WHERE pravo={$this->var->user} OR id={$this->var->iduser} ORDER BY LOWER(jmeno) ASC" : ""))."
                                          ", NULL, $error))
    {
      $poc = $res->numRows();
      if ($poc != 0)
      {
        for ($i = 0; $i < $poc; $i++)
        {
          $data = $res->fetchObject();
          $result .=
          "
  <p".((fmod($i + 1, 10) == 0) || ($i == ($poc - 1)) ? " class=\"neborder\"" : "").">
    <a href=\"?action=info&amp;cislo={$data->id}\" class=\"vypis_uzivatelu_jmeno_{$data->pravo}\" title=\"{$data->jmeno}\">
      <span></span>
      {$data->jmeno}
    </a>
    <a href=\"?action=edituser&amp;cislo={$data->id}\" class=\"vypis_uzivatelu_upravit_uzivatele\" title=\"Upravit\"></a>
    ".($data->id != 1 && $data->id != 2 && $this->var->pravo != $data->pravo ? "
    <a href=\"?action=deluser&amp;cislo={$data->id}\" class=\"vypis_uzivatelu_smazat_uzivatele\" title=\"Smazat\"></a>
    " : "")."
  </p>
  ".((fmod($i + 1, 10) == 0) && ($i != ($poc - 1)) ? "
  <span class=\"linka_vypis\"></span>
  " : "")."
          ";
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $navic = $this->DiffDirUser(); //vymazani slozek bez uzivatele
    $result .= "
<div id=\"vypis_info_uzivatele_hlavni_vypis\">
  <p>
    Celkem uživatelů: <em>{$poc}</em>
  </p>
  <p class=\"neborder\">
    Počet složek navíc: <em>{$navic}</em>
  </p>
</div>
    ";

    return $result;
  }
//******************************************************************************
  function ListingUserDir($cislo, $expirace)  //vypis slozek a souboru v info
  {
    //$cislo = $_GET["cislo"];
    settype($cislo, "integer");

    if ($cislo != 0 &&
        (($this->var->pravo == $this->var->moderator) && ($cislo == 1 || $cislo == 2) ? false : true))
    {
      $jmeno = $this->ReturnValueUserName($cislo);

      $sum = 0;
      if ($res = @$this->var->sqlite->query("SELECT id, nazev FROM slozka WHERE uzivatel={$cislo} ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
      {
        $dir = "{$this->var->userdir}/{$jmeno}";

        $result =
        "
  <ul class=\"prvni_ul vypis_soubory_slozky_info_user\">
    <li><!-- 1 -->
      <span class=\"ikona_obrazek_slozky\"></span><strong>Kořenový adresář</strong>
      <a href=\"#\" onclick=\"Zip('{$dir}'); return false;\" class=\"zabalit_slozku_info_user\" title=\"Zabalit obsah složky\"><em>Zabalit obsah složky</em></a>
      ";

        $uroven1 = $res->numRows(); //pocet slozek v korenu

      //presunuty vypis souboru korene
      if ($res3 = @$this->var->sqlite->query("SELECT id, nazev FROM soubor WHERE uzivatel={$cislo} ORDER BY LOWER(soubor.nazev) ASC;", NULL, $error))
      { //vykresleni souboru v korenu
        $uroven0 = $res3->numRows();
        if ($res3->numRows() != 0)  //koren -> soubor
        {
          $sum += $res3->numRows();
          $koren .= ($uroven1 == 0 ? "      <ul><!-- 2 -->\n" : "");  //kdyz neni zadna slozka v korenu
          $m = 0;
          while ($data3 = $res3->fetchObject()) //koren -> soubor
          {
            $m++;
            $cesta = "{$this->var->userdir}/{$jmeno}/{$data3->nazev}";
            $create = date($this->var->filedateformat, filemtime($cesta));

            $koren .=
            "        <li><!-- 3 -->
            <span class=\"".($m == $res3->numRows() ? "ikona_obrazek_strom_vpravo" : "ikona_obrazek_strom_svisle_vpravo")."\"></span>
            <span class=\"ikona_obrazek_ikony\"></span>
            <strong><a href=\"{$cesta}\" title=\"{$data3->nazev} - {$create}\">{$data3->nazev}</a> ({$this->VelikostSouboru($cesta)})</strong>
            <a href=\"#\" onclick=\"CopyToClipboard('{$this->var->web}/{$cesta}'); return false;\" class=\"odkaz_smazat vypis_soubory_zkopirovat_odkaz_do_schranky\" title=\"Zkopírovat odkaz do schránky\"><em>Zkopírovat odkaz do schránky</em></a>
            <a href=\"{$cesta}\" onclick=\"window.open(this.href); return false;\" class=\"odkaz_smazat vypis_soubory_otevrit_do_noveho_okna\" title=\"Otevřít soubor: {$data3->nazev} do nového okna\"><em>Otevřít tento soubor do nového okna</em></a>
          </li><!-- 3 -->\n";
          }
          $koren .= "      </ul><!-- 2 -->\n";
        }
      }
        else
      {
        $this->ErrorMsg($error);
      }

        if ($res->numRows() != 0)
        {
          $result .= "      <ul><!-- 2 -->\n";
          $n = 0;
          while ($data = $res->fetchObject()) //koren -> slozka
          {
            $dir = "{$this->var->userdir}/{$jmeno}/{$data->nazev}";
            $zamek = $this->AktivniHeslo(0, 0, $data->id, $login, $heslo, $id, $cislo);

            $n++;
            $result .=
            "        <li><!-- 3 -->
            <span class=\"".($uroven0 == 0 && $n == $res->numRows() ? "ikona_obrazek_strom_vpravo" : "ikona_obrazek_strom_svisle_vpravo")."\"></span><span class=\"ikona_obrazek_slozky\"></span>
            <strong>{$data->nazev}</strong>
            <a href=\"#\" onclick=\"Zip('{$dir}'); return false;\" class=\"zabalit_slozku_info_user".($zamek ? " zabalit_slozku_zaheslovana_slozka_info_user" : "")." \" title=\"Zabalit obsah složky\"><em>Zabalit obsah složky</em></a>
            ".($zamek ? "<acronym class=\"background_soubory_lock\"><em>Zaheslovaná složka".($this->var->pravo == $this->var->admin ? " - Login: <span>{$login}</span>, Heslo: <span>{$heslo}</span></em></acronym>" : "</em></acronym>")." " : "")."
            ";

            if ($res1 = @$this->var->sqlite->query("SELECT podslozka.id as id, podslozka.slozka as podslozka, slozka.nazev as slozka, podslozka.nazev as nazev FROM slozka, podslozka
                                                    WHERE
                                                    podslozka.slozka={$data->id} AND
                                                    slozka.id=podslozka.slozka AND
                                                    slozka.uzivatel={$cislo} AND
                                                    podslozka.uzivatel={$cislo} ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
            {
              if ($res1->numRows() != 0)
              {
                $result .= "          <ul><!-- 4 -->\n";
                $o = 0;
                while ($data1 = $res1->fetchObject()) // Koren -> slozka -> podslozka
                {
                  $dir = "{$this->var->userdir}/{$jmeno}/{$data1->slozka}/{$data1->nazev}";
                  $zamek = $this->AktivniHeslo(1, $data->id, $data1->id, $login, $heslo, $id, $cislo);

                  $o++;
                  $result .=
                  "            <li><!-- 5 -->
                <span".($uroven1 == $n && $uroven0 == 0 ? "" : " class=\"ikona_obrazek_strom_svisle\"")."></span>
                <span class=\"".($this->PocetSouboru($cislo, $data->id) == 0 && $o == $res1->numRows() ? "ikona_obrazek_strom_vpravo" : "ikona_obrazek_strom_svisle_vpravo")."\"></span>
                <span class=\"ikona_obrazek_slozky\"></span><strong>{$data1->nazev}</strong>
                <a href=\"#\" onclick=\"Zip('{$dir}'); return false;\" class=\"zabalit_slozku_info_user".($zamek ? " zabalit_slozku_zaheslovana_slozka_info_user" : "")."\" title=\"Zabalit obsah složky\"><em>Zabalit obsah složky</em></a>
                ".($zamek ? "<acronym class=\"background_soubory_lock\"><em>Zaheslovaná složka".($this->var->pravo == $this->var->admin ? " - Login: <span>{$login}</span>, Heslo: <span>{$heslo}</span></em></acronym>" : "</em></acronym>")." " : "")."
                ";

                  if ($res2 = @$this->var->sqlite->query("SELECT id, nazev, slozka, podslozka FROM podpodsoubor WHERE uzivatel={$cislo} AND slozka={$data->id} AND podslozka={$data1->id} ORDER BY LOWER(podpodsoubor.nazev) ASC;", NULL, $error))
                  { //vykresleni souboru v podslozce
                    if ($res2->numRows() != 0)
                    {
                      $sum += $res2->numRows();
                      $result .= "              <ul><!-- 6 -->\n";
                      $q = 0;
                      while ($data2 = $res2->fetchObject()) // Koren -> slozka -> podslozka -> soubor
                      {
                        $q++;
                        $cesta = "{$this->var->userdir}/{$jmeno}/{$data1->slozka}/{$data1->nazev}/{$data2->nazev}";
                        $create = date($this->var->filedateformat, filemtime($cesta));
                        $tajne = $this->TajnaCesta(1, $data->id, $data1->id, $cislo);
                        $velikost = $this->VelikostSouboru($cesta);

                        if (!Empty($tajne))
                        {
                          $cesta = "download.php?action={$tajne}&amp;file={$data2->nazev}";
                        }

                        $result .=
                        "                <li><!-- 7 -->
                    <span".($m != 0 ? " class=\"ikona_obrazek_strom_svisle\"" : "")."></span>
                    <span class=\"".($this->PocetSouboru($cislo, $data->id) != 0 || $o != $res1->numRows() ? "ikona_obrazek_strom_svisle" : "")."\"></span>
                    <span class=\"".($q == $res2->numRows() ? "ikona_obrazek_strom_vpravo" : "ikona_obrazek_strom_svisle_vpravo")."\"></span>
                    <span class=\"ikona_obrazek_ikony\"></span>
                    <strong><a href=\"{$cesta}\" title=\"{$data2->nazev} - {$create}\">{$data2->nazev}</a> ({$velikost})</strong>
                    <a href=\"#\" onclick=\"CopyToClipboard('{$this->var->web}/{$cesta}'); return false;\" class=\"odkaz_smazat vypis_soubory_zkopirovat_odkaz_do_schranky\" title=\"Zkopírovat odkaz do schránky\"><em>Zkopírovat odkaz do schránky</em></a>
                    <a href=\"{$cesta}\" onclick=\"window.open(this.href); return false;\" class=\"odkaz_smazat vypis_soubory_otevrit_do_noveho_okna\" title=\"Otevřít soubor: {$data2->nazev} do nového okna\"><em>Otevřít tento soubor do nového okna</em></a>
                  </li><!-- 7 -->\n";
                      }
                      $result .= "              </ul><!-- 6 -->
              </li><!-- 5 -->\n";
                    }
                      else
                    {
                      $result .= "            </li><!-- 5 -->\n";
                    }
                  }
                    else
                  {
                    $this->ErrorMsg($error);
                  }
                }
                $result .= "          </ul><!-- 4 -->\n";
              }
            }
              else
            {
              $this->ErrorMsg($error);
            }

            if ($res2 = @$this->var->sqlite->query("SELECT id, nazev, slozka FROM podsoubor WHERE uzivatel={$cislo} AND slozka={$data->id} ORDER BY LOWER(podsoubor.nazev) ASC;", NULL, $error))
            { //vykresleni souboru ve slozce
              $uroven2 = $res2->numRows();

              if ($res2->numRows() != 0)
              {
                $result .= "          <ul><!-- 4 -->\n";  //kdyz je nenulovy pocet podslozek
                $sum += $res2->numRows();
                $p = 0;
                while ($data2 = $res2->fetchObject()) //koren -> slozka -> soubor
                {
                  $p++;
                  $cesta = "{$this->var->userdir}/{$jmeno}/{$data->nazev}/{$data2->nazev}";
                  $create = date($this->var->filedateformat, filemtime($cesta));
                  $tajne = $this->TajnaCesta(0, 0, $data->id, $cislo);
                  $velikost = $this->VelikostSouboru($cesta);

                  if (!Empty($tajne))
                  {
                    $cesta = "download.php?action={$tajne}&amp;file={$data2->nazev}";
                  }

                  $result .=
                  "            <li><!-- 5 -->
                <span".($n != $uroven1 || $uroven0 != 0 ? " class=\"ikona_obrazek_strom_svisle\"" : "")."></span>
                <span class=\"".($p == $this->PocetSouboru($cislo, $data->id) ? "ikona_obrazek_strom_vpravo" : "ikona_obrazek_strom_svisle_vpravo")."\"></span>
                <span class=\"ikona_obrazek_ikony\"></span>
                <strong><a href=\"{$cesta}\" title=\"{$data2->nazev} - {$create}\">{$data2->nazev}</a> ({$velikost})</strong>
                <a href=\"#\" onclick=\"CopyToClipboard('{$this->var->web}/{$cesta}'); return false;\" class=\"odkaz_smazat vypis_soubory_zkopirovat_odkaz_do_schranky\" title=\"Zkopírovat odkaz do schránky\"><em>Zkopírovat odkaz do schránky</em></a>
                <a href=\"{$cesta}\" onclick=\"window.open(this.href); return false;\" class=\"odkaz_smazat vypis_soubory_otevrit_do_noveho_okna\" title=\"Otevřít soubor: {$data2->nazev} do nového okna\"><em>Otevřít tento soubor do nového okna</em></a>
              </li><!-- 5 -->\n";
                }
                $result .= "          </ul><!-- 4 -->\n";
              }
            }
              else
            {
              $this->ErrorMsg($error);
            }
            $result .= "        </li><!-- 3 -->\n";
          }
          $result .= ($uroven0 == 0 ? "      </ul><!-- 2 -->\n" : "");  //kdyz neni zadny soubor ve slozce
        }
      }
        else
      {
        $this->ErrorMsg($error);
      }

      $result .= $koren;

      $result .= "  </li><!-- 1 -->
  </ul>";
    }

    $this->KontrolaExpiraceSouboru($cislo, $expirace);

    return $result;
  }
//******************************************************************************
  function ListingProstorSelect() //vyber prostoru pro moderatory
  {
    for ($i = 0; $i < count($this->var->prostorradio) ; $i++)
    {
      $result .=
      "
            <span class=\"input_label_dl_polozka_administrator\" onclick=\"NastavRadio('selprostor{$i}', true);\">
              <input type=\"radio\" name=\"prostor\" id=\"selprostor{$i}\" value=\"{$this->var->prostorradio[$i]}\"".($i == 0 ? " checked=\"checked\"" : "")." />
              <span>{$this->var->prostorradio[$i]} MB</span>
            </span>
      ";
    }

    return $result;
  }
//******************************************************************************
  function ListingProstorSelected($id)  //oznaceny vyber prostoru pro moderatory
  {
    for ($i = 0; $i < count($this->var->prostorradio) ; $i++)
    {
      $result .=
      "
            <span class=\"input_label_dl_polozka_administrator\" onclick=\"NastavRadio('selprostor{$i}', true);\">
              <input type=\"radio\" name=\"prostor\" id=\"selprostor{$i}\" value=\"{$this->var->prostorradio[$i]}\"".($this->var->prostorradio[$i] == $id ? " checked=\"checked\"" : "")." />
              <span>{$this->var->prostorradio[$i]} MB</span>
            </span>
      ";
    }

    return $result;
  }
//******************************************************************************
  function ListingRightSelect() //vyber typu prava
  {
    for ($i = 0; $i < count($this->var->prava) ; $i++)
    {
      $result .=
      "
            <span class=\"input_label_dl_polozka_administrator\" onclick=\"NastavRadio('selpravo{$i}', true);\">
              <input type=\"radio\" name=\"pravo\" id=\"selpravo{$i}\" value=\"{$i}\"".($i == 0 ? " checked=\"checked\"" : "")." />
              <span>{$this->var->prava[$i]}</span>
            </span>
      ";
    }

    return $result;
  }
//******************************************************************************
  function ListingRightSelected($id)  //oznaceny vyber typu prava
  {
    for ($i = 0; $i < count($this->var->prava) ; $i++)
    {
      $result .=
      "
            <span class=\"input_label_dl_polozka_administrator\" onclick=\"NastavRadio('selpravo{$i}', true);\">
              <input type=\"radio\" name=\"pravo\" id=\"selpravo{$i}\" value=\"{$i}\"".($i == $id ? " checked=\"checked\"" : "")." />
              <span>{$this->var->prava[$i]}</span>
            </span>
      ";
    }

    return $result;
  }
//******************************************************************************
  function AddUser()  //prida uzivatele
  {
    $login = md5(md5(stripslashes(htmlspecialchars($_POST["login"])))); //*
    $heslo = md5(md5(stripslashes(htmlspecialchars($_POST["heslo"])))); //*
    $jmeno = stripslashes(htmlspecialchars($_POST["login"])); //kopie login bez md5
    $pravo = $_POST["pravo"];
    settype($pravo, "integer");
    //$datum = date("Y-m-d H:i:s");
    $icq = stripslashes(htmlspecialchars($_POST["icq"]));
    $www = stripslashes(htmlspecialchars($_POST["www"]));
    $email = stripslashes(htmlspecialchars($_POST["email"]));
    $prostor = stripslashes(htmlspecialchars($_POST["prostor"]));
    settype($prostor, "integer");

    $expiraceucet = stripslashes(htmlspecialchars($_POST["expiraceucet"])); //když je false tak den = 0
    $dnyexpiraceucet = stripslashes(htmlspecialchars($_POST["dnyexpiraceucet"]));
    if ($expiraceucet == "false")
    {
      $dnyexpiraceucet = 0;
    }
    settype($dnyexpiraceucet, "integer");

    $expirace = stripslashes(htmlspecialchars($_POST["expirace"])); //když je false tak den = 0
    $dnyexpirace = stripslashes(htmlspecialchars($_POST["dnyexpirace"]));
    if ($expirace == "false")
    {
      $dnyexpirace = 0;
    }
    settype($dnyexpirace, "integer");
    $tlacitko = stripslashes(htmlspecialchars($_POST["tlacitko"])); //*

    if (!Empty($_POST["login"]) &&
        !Empty($_POST["heslo"]) &&
        !Empty($tlacitko))
    {
      if (@$this->var->sqlite->queryExec("INSERT INTO uzivatel (id, login, heslo, jmeno, pravo, vytvoreno, icq, www, email, prostor, vyprseniucet, vyprseni, style) VALUES(NULL, '{$login}', '{$heslo}', '{$jmeno}', {$pravo}, datetime('now', '+1 hour'), '{$icq}', '{$www}', '{$email}', {$prostor}, {$dnyexpiraceucet}, {$dnyexpirace}, 1);", $error))
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Byl přidán uživatel: {$jmeno}\">
                    <p>
                      Byl přidán uživatel: <em>{$jmeno}</em>
                    </p>
                  </div>
        ";
      }
        else
      {
        $this->ErrorMsg($error);
      }
      $this->var->main->AutoClick(2, "?action=user");  //auto kliknuti
      $this->VytvorSlozkuUzivatele($jmeno);
    }

    return $result;
  }
//******************************************************************************
  function ReturnValueUser(&$login, &$heslo, &$icq, &$www, &$email, &$prostor, &$pravo, &$dnyexpiraceucet, &$dnyexpirace, &$vytvoreno, &$style) //vrati hodnoty vybraneho uzivatele
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) &&
        $id != 0 &&
        (($this->var->pravo == $this->var->moderator || ($this->var->pravo == $this->var->admin && $_GET["action"] == "deluser")) && ($id == 1 || $id == 2) ? false : true) &&
        (($this->var->pravo == $this->var->moderator) && $id == $this->var->iduser && $_GET["action"] == "deluser" ? false : true))
    {
      if ($res = @$this->var->sqlite->query("SELECT
                                            id,
                                            jmeno,
                                            pravo,
                                            heslo,
                                            vytvoreno,
                                            icq,
                                            www,
                                            email,
                                            prostor,
                                            vyprseniucet,
                                            vyprseni,
                                            vytvoreno,
                                            style
                                            FROM uzivatel
                                            WHERE id={$id};", NULL, $error))
      {
        $data = $res->fetchObject();
        $login = $data->jmeno;
        $pravo = $data->pravo;
        $heslo = $data->heslo;
        $icq = $data->icq;
        $www = $data->www;
        $email = $data->email;
        $prostor = $data->prostor;
        $dnyexpiraceucet = $data->vyprseniucet;
        $dnyexpirace = $data->vyprseni;
        $vytvoreno = $data->vytvoreno;
        $style = $data->style;
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }
  }
//******************************************************************************
  function EditUser() //upravi daneho uzivatele
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    $login = md5(md5(stripslashes(htmlspecialchars($_POST["login"])))); //*
    $heslo = md5(md5(stripslashes(htmlspecialchars($_POST["heslo"])))); //*
    $oldheslo = $_POST["oldheslo"];
    if (Empty($_POST["heslo"]))
    {
      $heslo = $oldheslo;
    }
    $jmeno = stripslashes(htmlspecialchars($_POST["login"])); //kopie login bez md5
    $pravo = $_POST["pravo"];
    settype($pravo, "integer");
    //$datum = date("Y-m-d H:i:s");
    $icq = stripslashes(htmlspecialchars($_POST["icq"]));
    $www = stripslashes(htmlspecialchars($_POST["www"]));
    $email = stripslashes(htmlspecialchars($_POST["email"]));
    $prostor = stripslashes(htmlspecialchars($_POST["prostor"]));
    settype($prostor, "integer");
    if ($prostor == 0)  //osetreni proti blbosti
    {
      $prostor = 10;
    }

    $expiraceucet = stripslashes(htmlspecialchars($_POST["expiraceucet"])); //když je false tak den = 0
    $dnyexpiraceucet = stripslashes(htmlspecialchars($_POST["dnyexpiraceucet"]));
    if ($expiraceucet == "false")
    {
      $dnyexpiraceucet = 0;
    }
    settype($dnyexpiraceucet, "integer");

    $expirace = stripslashes(htmlspecialchars($_POST["expirace"])); //když je false tak den = 0
    $dnyexpirace = stripslashes(htmlspecialchars($_POST["dnyexpirace"]));
    if ($expirace == "false")
    {
      $dnyexpirace = 0;
    }
    settype($dnyexpirace, "integer");
    $tlacitko = stripslashes(htmlspecialchars($_POST["tlacitko"])); //*

    if (!Empty($_POST["login"]) &&
        $id != 0 &&
        ($this->var->pravo == $this->var->moderator && ($id == 1 || $id == 2) ? false : true) &&
        !Empty($tlacitko))
    {
      if (@$this->var->sqlite->queryExec("UPDATE uzivatel SET login='{$login}',
                                                              heslo='{$heslo}',
                                                              jmeno='{$jmeno}',
                                                              pravo={$pravo},
                                                              icq='{$icq}',
                                                              www='{$www}',
                                                              email='{$email}',
                                                              prostor={$prostor},
                                                              vyprseniucet={$dnyexpiraceucet},
                                                              vyprseni={$dnyexpirace}
                                                              WHERE id={$id};", $error))
      { //vytvoreno='2008-08-25 15:04:00',
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Byl upraven uživatel: {$jmeno}\">
                    <p>
                      Byl upraven uživatel: <em>{$jmeno}</em>
                    </p>
                  </div>
        ";
      }
        else
      {
        $this->ErrorMsg($error);
      }
      $this->var->main->AutoClick(2, "?action=user");  //auto kliknuti
      $this->VytvorSlozkuUzivatele($jmeno);
    }

    return $result;
  }
//******************************************************************************
  function DelUser()  //smaze daneho uzivatele
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($_POST["ano"]) &&
        $id != 0 &&
        (($this->var->pravo == $this->var->moderator || $this->var->pravo == $this->var->admin) && ($id == 1 || $id == 2) ? false : true) &&
        (($this->var->pravo == $this->var->moderator) && $id == $this->var->iduser && $_GET["action"] == "deluser" ? false : true))
    {
      $jmeno = $this->ReturnValueUserName($id); //pro mazani dle jmena
      if (@$this->var->sqlite->queryExec("DELETE FROM uzivatel WHERE id={$id};
                                          DELETE FROM slozka WHERE uzivatel={$id};
                                          DELETE FROM slozka WHERE uzivatel={$id};
                                          DELETE FROM podslozka WHERE uzivatel={$id};
                                          DELETE FROM soubor WHERE uzivatel={$id};
                                          DELETE FROM podsoubor WHERE uzivatel={$id};
                                          DELETE FROM podpodsoubor WHERE uzivatel={$id};
                                          DELETE FROM adresa WHERE jmeno='{$jmeno}';
                                          DELETE FROM hesla WHERE uzivatel={$id};
                                          ", $error))//uzivatel={$id};
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Byl smazán uživatel: {$_POST["login"]}\">
                    <p>
                      Byl smazán uživatel: <em>{$_POST["login"]}</em>
                    </p>
                  </div>
        ";

        $this->var->main->AutoClick(2, "?action=user");  //auto kliknuti
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }
      else
    {
      if (!Empty($_POST["ne"]))
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Smazání uživatele: {$_POST["login"]} bylo stornováno\">
                    <p>
                      Smazání uživatele: <em>{$_POST["login"]}</em> bylo stornováno
                    </p>
                  </div>
        ";
        $this->var->main->AutoClick(2, "?action=user");  //auto kliknuti
      }
    }

    return $result;
  }
 //******************************************************************************
  function DelDirFile($jmeno) //rekurentni mazani slozek a podslozek
  {
    $handle = opendir($jmeno);

    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        if (!(filetype("{$jmeno}/{$soub}") == "file" ? @unlink("{$jmeno}/{$soub}") : @rmdir("{$jmeno}/{$soub}")))
        {
          $this->DelDirFile("{$jmeno}/{$soub}");  //rekurze
        }
      }
    }
    closedir($handle);
  }
//******************************************************************************
  function KontrolaExpiraceUctu() //smaze po expiraci ucet
  {
    if ($res = @$this->var->sqlite->query("SELECT id, vytvoreno, vyprseniucet FROM uzivatel;", NULL, $error))
    {
      while ($data = $res->fetchObject())
      {
        if ($data->vyprseniucet != 0)
        {
          $vyt = strtotime($data->vytvoreno);
          $datum = date("Y-m-d H:i:s", mktime(date("H", $vyt), date("i", $vyt), date("s", $vyt), date("n", $vyt), date("j", $vyt) + $data->vyprseniucet, date("Y", $vyt)));
          if (date("Y-m-d H:i:s") > $datum)
          {
            $jmeno = $this->ReturnValueUserName($data->id); //pro mazani dle jmena
            if (!@$this->var->sqlite->queryExec("DELETE FROM uzivatel WHERE id={$data->id};
                                                 DELETE FROM adresa WHERE jmeno='{$jmeno}';", $error))
            {
              $this->ErrorMsg($error);
            }
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }
  }
//******************************************************************************
  function KontrolaExpiraceSouboru($paruzivatel = 0, $parexpirace = 0) //smaze po expiraci soubor, podsoubor, podpodsoubor; prihlaseneho uzivatele
  {

    $uzivatel = (Empty($paruzivatel) ? $this->var->iduser : $paruzivatel); //id uzivatele
    $expirace = (Empty($parexpirace) ? $this->var->expirace : $parexpirace); //dni expirace
    if ($res = @$this->var->sqlite->query("SELECT id, vytvoreno FROM soubor WHERE uzivatel={$uzivatel};", NULL, $error))
    { //soubor
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          if ($expirace != 0)
          {
            $vyt = strtotime($data->vytvoreno);
            $datum = date("Y-m-d H:i:s", mktime(date("H", $vyt), date("i", $vyt), date("s", $vyt), date("n", $vyt), date("j", $vyt) + $expirace, date("Y", $vyt)));
            if (date("Y-m-d H:i:s") > $datum)
            {
              if (!@$this->var->sqlite->queryExec("DELETE FROM soubor WHERE id={$data->id};", $error))
              {
                $this->ErrorMsg($error);
              }
            }
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    if ($res = @$this->var->sqlite->query("SELECT id, vytvoreno FROM podsoubor WHERE uzivatel={$uzivatel};", NULL, $error))
    { //podsoubor
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          if ($expirace != 0)
          {
            $vyt = strtotime($data->vytvoreno);
            $datum = date("Y-m-d H:i:s", mktime(date("H", $vyt), date("i", $vyt), date("s", $vyt), date("n", $vyt), date("j", $vyt) + $expirace, date("Y", $vyt)));
            if (date("Y-m-d H:i:s") > $datum)
            {
              if (!@$this->var->sqlite->queryExec("DELETE FROM podsoubor WHERE id={$data->id};", $error))
              {
                $this->ErrorMsg($error);
              }
            }
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    if ($res = @$this->var->sqlite->query("SELECT id, vytvoreno FROM podpodsoubor WHERE uzivatel={$uzivatel};", NULL, $error))
    { //podpodsoubor
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          if ($expirace != 0)
          {
            $vyt = strtotime($data->vytvoreno);
            $datum = date("Y-m-d H:i:s", mktime(date("H", $vyt), date("i", $vyt), date("s", $vyt), date("n", $vyt), date("j", $vyt) + $expirace, date("Y", $vyt)));
            if (date("Y-m-d H:i:s") > $datum)
            {
              if (!@$this->var->sqlite->queryExec("DELETE FROM podpodsoubor WHERE id={$data->id};", $error))
              {
                $this->ErrorMsg($error);
              }
            }
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }
  }
//******************************************************************************
  function DiffDirUser() //kontrola sedi-li slozky uzivatelu s uzivateli v db
  {
    if ($res = @$this->var->sqlite->query("SELECT jmeno FROM uzivatel;", NULL, $error))
    {
      $i = 0;
      while ($data = $res->fetchObject())
      {
        $user[$i] = $data->jmeno;
        $i++;
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $j = 0;
    $handle = opendir($this->var->userdir);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        $soubor[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    if (count($soubor) != 0)
    {
      $diff = array_diff($soubor, $user);
      $diff = array_values($diff);

      $result = count($diff);

      $this->DelFullDirUser($diff);
    }
      else
    {
      $result = 0;
    }

    return $result;
  }
//******************************************************************************
  function DelFullDirUser($jmeno) //smaze celou slozku uzivatele
  {
    for ($i = 0; $i < count($jmeno); $i++)
    {
      $this->DelDirFile("{$this->var->userdir}/{$jmeno[$i]}"); //rekurentni mazani nevyhovujicich s
      @rmdir("{$this->var->userdir}/{$jmeno[$i]}"); //smaze slozku neplatneho uzivatele
    }
  }
//******************************************************************************
  function DiffUserDir($dir) //kontrola sedi-li slozky uzivatele s tim co je v db
  {
    $j = 0;
    $cesta = "{$this->var->userdir}/{$this->var->jmeno}";
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "dir")
      {
        $soubor[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    if (count($soubor) != 0)
    {
      $diff = array_diff($soubor, $dir);
      $diff = array_values($diff);

      $result = count($diff);

      $this->DelFullUserDir($diff);
    }
      else
    {
      $result = 0;
    }

    return $result;
  }
//******************************************************************************
  function DelFullUserDir($jmeno) //smaze neodpovdajici slozky v uzivateli
  {
    for ($i = 0; $i < count($jmeno); $i++)
    {
      $this->DelDirFile("{$this->var->userdir}/{$this->var->jmeno}/{$jmeno[$i]}"); //rekurentni mazani nevyhovujicich s
      @rmdir("{$this->var->userdir}/{$this->var->jmeno}/{$jmeno[$i]}"); //smaze slozku neplatneho uzivatele
    }
  }
//******************************************************************************
  function DiffSuffix($pripona)  //porovna zda jsou v priponach nejake obrauky navic
  {
    $j = 0;
    $cesta = "{$this->var->priponydir}";
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $soubor[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    if (count($soubor) != 0)
    {
      $diff = array_diff($soubor, $pripona);
      $diff = array_values($diff);

      $result = count($diff);

      for ($i = 0; $i < count($diff); $i++)
      {
        @unlink("{$cesta}/{$diff[$i]}");
      }
    }
      else
    {
      $result = 0;
    }

    return $result;
  }
//******************************************************************************
  function DiffStyle($nazev)
  {
    $j = 0;
    $cesta = "{$this->var->stylesdir}";
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "dir")
      {
        $soubor[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    if (count($soubor) != 0)
    {
      $diff = array_diff($soubor, $nazev);
      $diff = array_values($diff);

      $result = count($diff);

      for ($i = 0; $i < count($diff); $i++)
      {
        $this->DelDirFile("{$cesta}/{$diff[$i]}"); //rekurentni mazani nevyhovujicich
        @rmdir("{$cesta}/{$diff[$i]}"); //smaze slozku
      }
    }
      else
    {
      $result = 0;
    }

    $j = 0;
    $cesta = "{$this->var->vzhleddir}";
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "dir")
      {
        $soubor[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    if (count($soubor) != 0)
    {
      $diff = array_diff($soubor, $nazev);
      $diff = array_values($diff);

      $result += count($diff);

      for ($i = 0; $i < count($diff); $i++)
      {
        $this->DelDirFile("{$cesta}/{$diff[$i]}"); //rekurentni mazani nevyhovujicich
        @rmdir("{$cesta}/{$diff[$i]}"); //smaze slozku
      }
    }
      else
    {
      $result += 0;
    }

    return $result;
  }
//******************************************************************************
  function DiffImport($style, $cestaimp)
  {
    $j = 0;
    $slozka = $this->VypisNazevSlozky($style);
    $cesta = "{$this->var->stylesdir}/{$slozka}";
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $soubor[$j] = "{$cesta}/{$soub}";  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    if (count($soubor) != 0)
    {
      $diff = array_diff($soubor, $cestaimp);
      $diff = array_values($diff);

      $result = count($diff);

      for ($i = 0; $i < count($diff); $i++)
      {
        @unlink("{$diff[$i]}");
      }
    }
      else
    {
      $result = 0;
    }

    return $result;
  }
//******************************************************************************
  function DiffUserDirDir($slozka, $dir) //kontrola sedi-li slozky uzivatelu ve slozkach
  {
    for ($i = 0; $i < count($slozka); $i++)
    {
      $j = 0;
      $cesta = "{$this->var->userdir}/{$this->var->jmeno}/{$slozka[$i]}";
      $handle = opendir($cesta);
      while($soub = readdir($handle))
      {
        if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "dir")
        {
          $soubor[$j] = $soub;  //nacitani souboru
          $j++;
        }
      }
      closedir($handle);

      if (count($slozka) != 0)
      {
        $diff = array_diff($soubor, $dir);
        $diff = array_values($diff);

        $result = count($diff);

        $this->DelFullUserDirDir($slozka[$i], $diff);
      }
        else
      {
        $result = 0;
      }
    }

    return $result;
  }
//******************************************************************************
  function DelFullUserDirDir($slozka, $jmeno) //smaze neodpovdajici slozky v uzivateli
  {
    for ($i = 0; $i < count($jmeno); $i++)
    {
      $this->DelDirFile("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$jmeno[$i]}"); //rekurentni mazani nevyhovujicich s
      @rmdir("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$jmeno[$i]}"); //smaze slozku neplatneho uzivatele
    }
  }
//******************************************************************************
  function DiffUserFile($file) //kontrola sedi-li soubory uzivatele s tim co je v db
  {
    $j = 0;
    $cesta = "{$this->var->userdir}/{$this->var->jmeno}";
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $soubor[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    if (count($soubor) != 0)
    {
      $diff = array_diff($soubor, $file);
      $diff = array_values($diff);

      $result = count($diff);

      $this->DelFullUserFile($diff);
    }
      else
    {
      $result = 0;
    }

    return $result;
  }
//******************************************************************************
  function DelFullUserFile($jmeno) //smaze neodpovdajici souubory v uzivateli
  {
    for ($i = 0; $i < count($jmeno); $i++)
    {
      //$this->DelDirFile("{$this->var->userdir}/{$this->var->jmeno}/{$jmeno[$i]}"); //rekurentni mazani nevyhovujicich s
      @unlink("{$this->var->userdir}/{$this->var->jmeno}/{$jmeno[$i]}"); //smaze slozku neplatneho uzivatele
    }
  }
//******************************************************************************
  function DiffUserFileFile($slozka, $file) //kontrola sedi-li slozky uzivatelu ve slozkach
  {
    $j = 0;
    $cesta = "{$this->var->userdir}/{$this->var->jmeno}/{$slozka}";
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $soubor[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    if (count($soubor) != 0)
    {
      $diff = array_diff($soubor, $file);
      $diff = array_values($diff);

      $result = count($diff);

      $this->DelFullUserFileFile($slozka, $diff);
    }
      else
    {
      $result = 0;
    }

    return $result;
  }
//******************************************************************************
  function DelFullUserFileFile($slozka, $jmeno) //smaze neodpovdajici soubory v uzivateli
  {
    for ($i = 0; $i < count($jmeno); $i++)
    {
      //$this->DelDirFile("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$jmeno[$i]}"); //rekurentni mazani nevyhovujicich s
      @unlink("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$jmeno[$i]}"); //smaze slozku neplatneho uzivatele
    }
  }
//******************************************************************************
  function DiffUserFileFileFile($slozka, $podslozka, $file) //kontrola sedi-li slozky uzivatelu ve slozkach
  {
      $j = 0;
      $cesta = "{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$podslozka}";
      $handle = opendir($cesta);
      while($soub = readdir($handle))
      {
        if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
        {
          $soubor[$j] = $soub;  //nacitani souboru
          $j++;
        }
      }
      closedir($handle);

      if (count($file) != 0 && count($soubor))
      {
        $diff = array_diff($soubor, $file);
        $diff = array_values($diff);
        $result = count($diff);

        $this->DelFullUserFileFileFile($slozka, $podslozka, $diff);
      }
        else
      {
        $result = 0;
      }

    return $result;
  }
//******************************************************************************
  function DelFullUserFileFileFile($slozka, $podslozka, $jmeno) //smaze neodpovdajici soubory v uzivateli
  {
    for ($i = 0; $i < count($jmeno); $i++)
    {
      //$this->DelDirFile("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$jmeno[$i]}"); //rekurentni mazani nevyhovujicich s
      @unlink("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$podslozka}/{$jmeno[$i]}"); //smaze slozku neplatneho uzivatele
    }
  }
//******************************************************************************
  function OsetreniNazvu($text)  //prevede nebezpecne znaky na bezpecne
  {
    return strtr($text, $this->var->prevod);  //prevede text dle prevadecoho pole
  }
//******************************************************************************
  function KontrolaAutorzace($login, $heslo, $cesta)
  {
    $result = false;

    if ($res = @$this->var->sqlite->query("SELECT id FROM hesla WHERE
                                          login='{$login}' AND
                                          heslo='{$heslo}' AND
                                          cesta='{$cesta}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
         $result = true;
      }
        else
      {
        $result = false;
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function DownloadFileOfDir($login, $heslo, $cesta, $soubor)  //zajisti autorizaci, a vyber souboru
  {
    if ($res = @$this->var->sqlite->query("SELECT uzivatel, slozka, podslozka FROM hesla WHERE
                                          login='{$login}' AND
                                          heslo='{$heslo}' AND
                                          cesta='{$cesta}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();
        $iduzivatel = $data->uzivatel;
        $slozka = $data->slozka;
        $podslozka = $data->podslozka;

        $uzivatel = $this->ReturnValueUserName($iduzivatel);
        $slozka = $this->ZjistiNazevSlozky($slozka);
        if ($podslozka == 0)
        {
          $file = "{$this->var->userdir}/{$uzivatel}/{$slozka}/{$soubor}";
        }
          else
        {
          $podslozka = $this->ZjistiNazevPodslozky($podslozka);
          $file = "{$this->var->userdir}/{$uzivatel}/{$slozka}/{$podslozka}/{$soubor}";
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    //nastavi typ
    header("Content-Type: application/force-download");
    header("Content-Disposition: attachment; filename={$soubor};"); //vrati stream s puvodnim nazvem bez cesty

    $u = fopen($file, "r"); //otevre pro cteni
    $result = fread($u, filesize($file)); //otevre a nacte
    fclose($u); //nakonec zavre

    return $result;
  }
//******************************************************************************
  function AktivniHeslo($zan, $pod, $cislo, &$login, &$heslo, &$id, $uzivatel) //zjisteni zda je heslo aktivi ci nikoli
  {
    if ($res = @$this->var->sqlite->query("SELECT id, login, heslo FROM hesla WHERE
                                            uzivatel={$uzivatel} AND
                                            ".($zan == 0 ?
                                            "slozka={$cislo}AND
                                            podslozka=0" :
                                            "slozka={$pod} AND
                                            podslozka={$cislo}").";", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();
        $login = $data->login;
        $heslo = $data->heslo;
        $id = $data->id;
        $result = true;
      }
        else
      {
        $result = false;
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function TajnaCesta($zan, $pod, $cislo, $uzivatel) //vrati tajnou cestu (slozka - slozka/podslozka )
  {
    if ($res = @$this->var->sqlite->query("SELECT cesta FROM hesla WHERE
                                            uzivatel={$uzivatel} AND
                                            ".($zan == 0 ?
                                            "slozka={$cislo}AND
                                            podslozka=0" :
                                            "slozka={$pod} AND
                                            podslozka={$cislo}").";", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->cesta;
      }
        else
      {
        $result = "";
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function GenerateName() //generuje nahodne jmeno pro adresu
  {
    for ($i = 0; $i < rand(31, 41); $i++)
    {
      switch (rand(0, 2))
      {
        case 0: //cisla
          $result .= chr(rand(48, 57));
        break;

        case 1: //velke pismena
          $result .= chr(rand(65, 90));
        break;

        case 2: //male pismena
          $result .= chr(rand(97, 122));
        break;
      }
    }

    return $result;
  }
//******************************************************************************
  function AddPaswordDir()  //prida heslo na soubor
  {
    $login = $_POST["login"]; //*
    $heslo = $_POST["heslo"]; //*
    $cislo = $_GET["cislo"];  //cislo slozky
    settype($cislo, "integer");

    $zan = $_GET["zan"];  //cislo zanoreni
    settype($zan, "integer");

    $pod = $_GET["pod"];
    settype($pod, "integer");

    $tlacitko = $_POST["tlacitko"]; //*

    if (!Empty($tlacitko) &&
        !Empty($login) &&
        !Empty($heslo) &&
        $cislo != 0)
    {
      $outcesta = $this->GenerateName();  //vygeneruje nahodny nazev souboru
      switch ($zan)
      {
        case 0:
          if (@$this->var->sqlite->queryExec("INSERT INTO hesla (id, login, heslo, cesta, uzivatel, slozka, podslozka) VALUES (NULL, '{$login}', '{$heslo}', '{$outcesta}', {$this->var->iduser}, {$cislo}, 0);", $error))
          {
            $result =
            "
                    <div id=\"nacitani_central\" title=\"Složka byla zaheslována\">
                      <p>
                        Složka byla zaheslována
                      </p>
                    </div>
            ";

            $this->var->main->AutoClick(2, "?action=dir");  //auto kliknuti
          }
            else
          {
            $this->ErrorMsg($error);
          }
        break;

        case 1:
          if (@$this->var->sqlite->queryExec("INSERT INTO hesla (id, login, heslo, cesta, uzivatel, slozka, podslozka) VALUES (NULL, '{$login}', '{$heslo}', '{$outcesta}', {$this->var->iduser}, {$pod}, {$cislo});", $error))
          {
            $result =
            "
                    <div id=\"nacitani_central\" title=\"Složka byla zaheslována\">
                      <p>
                        Složka byla zaheslována
                      </p>
                    </div>
            ";

            $this->var->main->AutoClick(2, "?action=dir");  //auto kliknuti
          }
            else
          {
            $this->ErrorMsg($error);
          }
        break;
      }
    }

    return $result;
  }
//******************************************************************************
  function ReturnValuePaswordDir(&$login, &$heslo)  //vrati hodoty loginu a hesla
  {
    $id = $_GET["id"];  //cislo slozky
    settype($id, "integer");

    if ($res = @$this->var->sqlite->query("SELECT login, heslo FROM hesla WHERE
                                            uzivatel={$this->var->iduser} AND
                                            id={$id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();
        $login = $data->login;
        $heslo = $data->heslo;
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }
  }
//******************************************************************************
  function EditPaswordDir() //upravi zamek
  {
    $login = $_POST["login"]; //*
    $heslo = $_POST["heslo"]; //*
    $id = $_GET["id"];  //id
    settype($id, "integer");

    $tlacitko = $_POST["tlacitko"]; //*

    if (!Empty($tlacitko) &&
        !Empty($login) &&
        !Empty($heslo) &&
        $id != 0)
    {
      if (@$this->var->sqlite->queryExec("UPDATE hesla SET login='{$login}',
                                                           heslo='{$heslo}'
                                                          WHERE
                                                          id={$id} AND
                                                          uzivatel={$this->var->iduser};", $error))
      {
        $result =
        "
                <div id=\"nacitani_central\" title=\"Bylo upraveno zaheslování složky\">
                  <p>
                    Bylo upraveno zaheslování složky
                  </p>
                </div>
        ";

        $this->var->main->AutoClick(2, "?action=dir");  //auto kliknuti
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }

    return $result;
  }
//******************************************************************************
  function DelPaswordDir()  //smaze zamek
  {
    $id = $_GET["id"];  //id
    settype($id, "integer");

    $login = $_POST["login"]; //nazev

    if (!Empty($_POST["ano"]) &&
        $id != 0)
    {
      if (@$this->var->sqlite->queryExec("DELETE FROM hesla WHERE id={$id};", $error))
      {
        $result =
        "
              <div id=\"nacitani_central\" title=\"Byl odstraněn zámek\">
                <p>
                  Byl odstraněn zámek
                </p>
              </div>
        ";

        $this->var->main->AutoClick(2, "?action=dir");  //auto kliknuti
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }
      else
    {
      if (!Empty($_POST["ne"]))
      {
        $result =
        "
              <div id=\"nacitani_central\" title=\"Odstranění zámku bylo stornováno\">
                <p>
                  Odstranění zámku bylo stornováno
                </p>
              </div>
        ";
        $this->var->main->AutoClick(2, "?action=dir");  //auto kliknuti
      }
    }

    return $result;
  }
//******************************************************************************
  function ListingDir() //vypis slozek
  {
    $sum = 0;
    $j = 0;
    if ($res = @$this->var->sqlite->query("SELECT id, nazev FROM slozka WHERE uzivatel={$this->var->iduser} ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
    {
      $result =
      "
<ul class=\"prvni_ul\">
  <li>
    <span class=\"ikona_obrazek_slozky\"></span><strong>Kořenový adresář</strong>";
      if ($res->numRows() != 0)
      {
        $result .="\n    <ul>\n";
        $sum += $res->numRows();
        $i = 0;
        while ($data = $res->fetchObject())
        {
          $dir[$i] = $data->nazev;
          $i++;
          $zamek = $this->AktivniHeslo(0, 0, $data->id, $login, $heslo, $id, $this->var->iduser);

          $result .=
          "      <li>
        <span class=\"".($i == $res->numRows() ? "ikona_obrazek_strom_vpravo" : "ikona_obrazek_strom_svisle_vpravo")."\"></span>
        <span class=\"ikona_obrazek_slozky\"></span><strong>{$data->nazev}</strong>
        <a href=\"?action=editdir&amp;zan=0&amp;cislo={$data->id}\" title=\"Upravit složku\" class=\"odkaz_upravit".($zamek ? " odkaz_upravit_mod_zamek_zamkle" : " odkaz_upravit_mod_zamek")."\"><em>Upravit složku</em></a>
        <a href=\"?action=deldir&amp;zan=0&amp;cislo={$data->id}\" title=\"Smazat složku\" class=\"odkaz_smazat".($zamek ? " odkaz_smazat_mod_zamek_zamkle" : " odkaz_smazat_mod_zamek")."\"><em>Smazat složku</em></a>
        ".($zamek ? "
        <a href=\"?action=editpwd&amp;id={$id}\" title=\"Upravit zámek na složku\" class=\"odkaz_zamek_zmena_hesla\"><em>Upravit zámek na složku</em></a>
        <a href=\"?action=delpwd&amp;id={$id}\" title=\"Smazat zámek na složce\" class=\"odkaz_zamek_smazat_zamek\"><em>Smazat zámek na složce</em></a>
        <acronym><em>Zaheslovaná složka - Login: <span>{$login}</span>, Heslo: <span>{$heslo}</span></em></acronym>
        " :
        "<a href=\"?action=addpwd&amp;zan=0&amp;cislo={$data->id}\" title=\"Zamknout složku\" class=\"odkaz_zamek\"><em>Zamknout složku</em></a>")."
        "; // cesta: {$this->TajnaCesta(0, 0, $data->id, $this->var->iduser)}

          if ($res1 = @$this->var->sqlite->query("SELECT podslozka.id as id, podslozka.slozka as podslozka, slozka.nazev as slozka, podslozka.nazev as nazev FROM slozka, podslozka
                                                  WHERE
                                                  podslozka.slozka={$data->id} AND
                                                  slozka.id=podslozka.slozka AND
                                                  slozka.uzivatel={$this->var->iduser} AND
                                                  podslozka.uzivatel={$this->var->iduser} ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              $sum += $res1->numRows();
              $result .=
              "        <ul>\n";
              $k = 0;
              while ($data1 = $res1->fetchObject())
              {
                $k++;
                $zamek = $this->AktivniHeslo(1, $data1->podslozka, $data1->id, $login, $heslo, $id, $this->var->iduser);
                $result .=
                "          <li>
            <span".($i == $res->numRows() ? "" : " class=\"ikona_obrazek_strom_svisle\"")."></span>
            <span class=\"".($k == $res1->numRows() ? "ikona_obrazek_strom_vpravo" : "ikona_obrazek_strom_svisle_vpravo")."\"></span>
            <span class=\"ikona_obrazek_slozky\"></span><strong>{$data1->nazev}</strong>
            <a href=\"?action=editdir&amp;zan=1&amp;pod={$data1->podslozka}&amp;cislo={$data1->id}\" title=\"Upravit složku\" class=\"odkaz_upravit".($zamek ? " odkaz_upravit_mod_zamek_zamkle" : " odkaz_upravit_mod_zamek")."\"><em>Upravit složku</em></a>
            <a href=\"?action=deldir&amp;zan=1&amp;pod={$data1->podslozka}&amp;cislo={$data1->id}\" title=\"Smazat složku\" class=\"odkaz_smazat".($zamek ? " odkaz_smazat_mod_zamek_zamkle" : " odkaz_smazat_mod_zamek")."\"><em>Smazat složku</em></a>
            ".($zamek ? "
            <a href=\"?action=editpwd&amp;id={$id}\" title=\"Upravit zámek na složku\" class=\"odkaz_zamek_zmena_hesla\"><em>Upravit zámek na složku</em></a>
            <a href=\"?action=delpwd&amp;id={$id}\" title=\"Smazat zámek na složce\" class=\"odkaz_zamek_smazat_zamek\"><em>Smazat zámek na složce</em></a>
            <acronym><em>Zaheslovaná složka - Login: <span>{$login}</span>, Heslo: <span>{$heslo}</span></em></acronym>
            " :
            "<a href=\"?action=addpwd&amp;zan=1&amp;pod={$data1->podslozka}&amp;cislo={$data1->id}\" title=\"Zamknout složku\" class=\"odkaz_zamek\"><em>Zamknout složku</em></a>")."
          </li>
          "; // cesta: {$this->TajnaCesta(1, $data1->podslozka, $data1->id, $this->var->iduser)}
                $slozka[$j] = $data1->slozka;
                $nazev[$j] = $data1->nazev;
                $j++;
              }
              $result .=
              "        </ul>\n";
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }
          $result .=
          "      </li>\n";
        }
        $result .=
        "    </ul>";
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }
    $result .=
    "
  </li>
</ul>
    ";



    $navic = (!Empty($dir) ? $this->DiffUserDir($dir) : 0); //kontroluje slozky v korenu
    $navic1 = (!Empty($slozka) ? $this->DiffUserDirDir($slozka, $nazev) : 0); //kontroluje slozky ve slozkach
    $result .= "
<div id=\"vypis_info_uzivatele_hlavni_vypis\">
  <p>
    Celkem složek: <em>{$sum}</em>
  </p>
  <p class=\"neborder\">
    Počet složek navíc: <em>".($navic + $navic1)."</em>
  </p>
</div>";

    return $result;
  }
//******************************************************************************
  function ListingDirSelect() //vypis slozek v pridavani slozek
  {
    if ($res = @$this->var->sqlite->query("SELECT id, nazev FROM slozka WHERE uzivatel={$this->var->iduser} ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
    {
      $result =
      "
            <span class=\"input_label_dl_polozka_vyber_slozku_soubor\" onclick=\"NastavRadio('seldir0', true);\">
              <input type=\"radio\" name=\"slozka\" id=\"seldir0\" value=\"{$this->var->jmeno}\" checked=\"checked\" />
              <span>Kořenový adresář</span>
            </span>
      ";
      if ($res->numRows() != 0)
      {
        $i = 1;
        while ($data = $res->fetchObject())
        {
          $result .=
          "
            <span class=\"input_label_dl_polozka_vyber_slozku_soubor\" onclick=\"NastavRadio('seldir{$i}', true);\">
              <input type=\"radio\" name=\"slozka\" id=\"seldir{$i}\" value=\"{$this->var->jmeno}/{$data->nazev}\" />
              <span>./{$data->nazev}</span>
            </span>
          ";
          $i++;

          if ($res1 = @$this->var->sqlite->query("SELECT slozka.nazev as slozka, podslozka.nazev as nazev FROM slozka, podslozka
                                                WHERE
                                                podslozka.slozka={$data->id} AND
                                                slozka.id=podslozka.slozka AND
                                                slozka.uzivatel={$this->var->iduser} AND
                                                podslozka.uzivatel={$this->var->iduser} ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              while ($data1 = $res1->fetchObject())
              {
                $result .=
                "
            <span class=\"input_label_dl_polozka_vyber_slozku_soubor\">
              <span>./{$data1->slozka}/{$data1->nazev}</span>
            </span>
                ";//<input type=\"radio\" name=\"slozka\" value=\"{$this->var->jmeno}/{$data->slozka}/{$data->nazev}\" />
              }
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function ListingDirSelectForFile() //vypis slozek v pridavani souboru
  {
    if ($res = @$this->var->sqlite->query("SELECT id, nazev FROM slozka WHERE uzivatel={$this->var->iduser} ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
    {
      $result =
      "
            <span class=\"input_label_dl_polozka_vyber_slozku_soubor\" onclick=\"NastavRadio('seldirfile0', true);\">
              <input type=\"radio\" name=\"slozka\" id=\"seldirfile0\" value=\"{$this->var->jmeno}\" checked=\"checked\" />
              <span>Kořenový adresář</span>
            </span>
      ";
      $i = 1;
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "
            <span class=\"input_label_dl_polozka_vyber_slozku_soubor\" onclick=\"NastavRadio('seldirfile{$i}', true);\">
              <input type=\"radio\" name=\"slozka\" id=\"seldirfile{$i}\" value=\"{$this->var->jmeno}/{$data->nazev}\" />
              <span>./{$data->nazev}</span>
            </span>
          ";
          $i++;

          if ($res1 = @$this->var->sqlite->query("SELECT slozka.nazev as slozka, podslozka.nazev as nazev FROM slozka, podslozka
                                                  WHERE
                                                  podslozka.slozka={$data->id} AND
                                                  slozka.id=podslozka.slozka AND
                                                  slozka.uzivatel={$this->var->iduser} AND
                                                  podslozka.uzivatel={$this->var->iduser}
                                                  ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              while ($data1 = $res1->fetchObject())
              {
                $result .=
                "
            <span class=\"input_label_dl_polozka_vyber_slozku_soubor\" onclick=\"NastavRadio('seldirfile{$i}', true);\">
              <input type=\"radio\" name=\"slozka\" id=\"seldirfile{$i}\" value=\"{$this->var->jmeno}/{$data1->slozka}/{$data1->nazev}\" />
              <span>./{$data1->slozka}/{$data1->nazev}</span>
            </span>
                ";
                $i++;
              }
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function ZjistiIdSlozky($nazev, $idjmeno)  //zjisteni id slozky
  {
    if ($res = @$this->var->sqlite->query("SELECT id FROM slozka WHERE nazev='{$nazev}' AND uzivatel={$idjmeno};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result = $res->fetchObject()->id;
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }

    return $result;
  }
//******************************************************************************
  function ZjistiIdPodslozky($nazev, $idslozka, $idjmeno)  //zjisteni id podslozky
  {
    if ($res = @$this->var->sqlite->query("SELECT id FROM podslozka WHERE nazev='{$nazev}' AND slozka={$idslozka} AND uzivatel={$idjmeno};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result = $res->fetchObject()->id;
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function ZjistiNazevSlozky($id)  //zjisteni nazev podle id
  {
    settype($id, "integer");
    if ($id != 0)
    {
      if ($res = @$this->var->sqlite->query("SELECT nazev FROM slozka WHERE id={$id};", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          $result = $res->fetchObject()->nazev;
        }
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }

    return $result;
  }
//******************************************************************************
  function ZjistiNazevPodslozky($id)  //zjisteni nazev podslozky podle idslozky a id
  {
    settype($id, "integer");
    if ($id != 0)
    {
      if ($res = @$this->var->sqlite->query("SELECT nazev FROM podslozka WHERE id={$id};", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          $result = $res->fetchObject()->nazev;
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }
    }

    return $result;
  }
//******************************************************************************
  function ZkontrolujDuplicituAdresare($nazev)  //zkontroluje duplicitu zadavane slozky
  {
    if ($res = @$this->var->sqlite->query("SELECT nazev FROM slozka WHERE uzivatel={$this->var->iduser};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $poc = 0;
        while ($data = $res->fetchObject())
        {
          if ($nazev == $data->nazev)
          {
            $poc++;
          }
        }
      }
    }
     else
    {
      $this->ErrorMsg($error);
    }

    $result = ($poc == 0 ? $nazev : "{$nazev}_".rand());

    return $result;
  }
//******************************************************************************
  function ZkontrolujDuplicituPodadresare($slozka, $nazev)  //zkontroluje duplicitu zadavane podslozky
  {
    if ($res = @$this->var->sqlite->query("SELECT nazev FROM podslozka WHERE slozka={$slozka} AND uzivatel={$this->var->iduser};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $poc = 0;
        while ($data = $res->fetchObject())
        {
          if ($nazev == $data->nazev)
          {
            $poc++;
          }
        }
      }
    }
     else
    {
      $this->ErrorMsg($error);
    }

    $result = ($poc == 0 ? $nazev : "{$nazev}_".rand());

    return $result;
  }
//******************************************************************************
  function ZkontrolujDuplicituSoboru($nazev, $idjmeno)  //zkontroluje duplicitu zadavenho souboru
  {
    if ($res = @$this->var->sqlite->query("SELECT nazev FROM soubor WHERE uzivatel={$idjmeno};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $poc = 0;
        while ($data = $res->fetchObject())
        {
          if ($nazev == $data->nazev)
          {
            $poc++;
          }
        }
      }
    }
     else
    {
      $this->ErrorMsg($error);
    }

    $result = ($poc == 0 ? $nazev : "{$nazev}_".rand());

    return $result;
  }
//******************************************************************************
  function ZkontrolujDuplicituPodsouboru($slozka, $nazev, $idjmeno)
  {
    if ($res = @$this->var->sqlite->query("SELECT nazev FROM podsoubor WHERE slozka={$slozka} AND uzivatel={$idjmeno};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $poc = 0;
        while ($data = $res->fetchObject())
        {
          if ($nazev == $data->nazev)
          {
            $poc++;
          }
        }
      }
    }
     else
    {
      $this->ErrorMsg($error);
    }

    $result = ($poc == 0 ? $nazev : "{$nazev}_".rand());

    return $result;
  }
//******************************************************************************
  function ZkontrolujDuplicituPodpodsouboru($slozka, $podslozka, $nazev, $idjmeno)
  {
    if ($res = @$this->var->sqlite->query("SELECT nazev FROM podpodsoubor WHERE slozka={$slozka} AND podslozka={$podslozka} AND uzivatel={$idjmeno};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $poc = 0;
        while ($data = $res->fetchObject())
        {
          if ($nazev == $data->nazev)
          {
            $poc++;
          }
        }
      }
    }
     else
    {
      $this->ErrorMsg($error);
    }

    $result = ($poc == 0 ? $nazev : "{$nazev}_".rand());

    return $result;
  }
//******************************************************************************
  function AddDir() //prida slozku
  {
    $nazev = $this->OsetreniNazvu(stripslashes(htmlspecialchars($_POST["nazev"]))); //*
    //$datum = date("Y-m-d H:i:s");
    $slozka = stripslashes(htmlspecialchars($_POST["slozka"]));
    $tlacitko = stripslashes(htmlspecialchars($_POST["tlacitko"])); //*

    if (!Empty($nazev) &&
        !Empty($tlacitko))
    {
      if ($this->var->jmeno == $slozka) //koren
      {
        $nazev = $this->ZkontrolujDuplicituAdresare($nazev);  //kontrola duplicity a opatreni
        if (@$this->var->sqlite->queryExec("INSERT INTO slozka (id, uzivatel, nazev, vytvoreno) VALUES (NULL, {$this->var->iduser}, '{$nazev}', datetime('now', '+1 hour'));", $error))
        {
          $result =
          "
                  <div id=\"nacitani_central\" title=\"Byla vytvořena složka s názvem: {$nazev}\">
                    <p>
                      Byla vytvořena složka s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
          ";

          @mkdir("{$this->var->userdir}/{$this->var->jmeno}/{$nazev}");
          @chmod("{$this->var->userdir}/{$this->var->jmeno}/{$nazev}", 0777); //zmeni prava pristupu

          $this->var->main->AutoClick(2, "?action=dir");  //auto kliknuti
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }
        else
      {
        $a = explode("/", $slozka);
        $id = $this->ZjistiIdSlozky($a[1], $this->var->iduser);

        if (count($a) == 2) //podslozka
        {
          $nazev = $this->ZkontrolujDuplicituPodadresare($id, $nazev);  //kontrola duplicity a opatreni
          if (@$this->var->sqlite->queryExec("INSERT INTO podslozka (id, uzivatel, slozka, nazev, vytvoreno) VALUES (NULL, {$this->var->iduser}, {$id}, '{$nazev}', datetime('now', '+1 hour'));", $error))
          {
            $result =
            "
                  <div id=\"nacitani_central\" title=\"Byla vytvořena složka s názvem: {$nazev}\">
                    <p>
                      Byla vytvořena složka s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
            ";

            @mkdir("{$this->var->userdir}/{$slozka}/{$nazev}");
            @chmod("{$this->var->userdir}/{$slozka}/{$nazev}", 0777); //zmeni prava pristupu

            $this->var->main->AutoClick(2, "?action=dir");  //auto kliknuti
          }
            else
          {
            $this->ErrorMsg($error);
          }
        }
      }
    }

    return $result;
  }
//******************************************************************************
  function ReturnValueDir(&$nazev)  //vrati hodnotu vybrane slozky
  {
    $zan = $_GET["zan"];
    settype($zan, "integer");
    $id = $_GET["cislo"];
    settype($id, "integer");

    if ($id != 0)
    {
      switch ($zan)
      {
        case 0:
          if ($res = @$this->var->sqlite->query("SELECT nazev FROM slozka WHERE id={$id}", NULL, $error))
          {
            $data = $res->fetchObject();
            $nazev = $data->nazev;
          }
            else
          {
            $this->ErrorMsg($error);
          }
        break;

        case 1:
          if ($res = @$this->var->sqlite->query("SELECT nazev FROM podslozka WHERE id={$id}", NULL, $error))
          {
            $data = $res->fetchObject();
            $nazev = $data->nazev;
          }
            else
          {
            $this->ErrorMsg($error);
          }
        break;
      }
    }

  }
//******************************************************************************
  function EditDir()  //edituje slozku
  {
    $nazev = $this->OsetreniNazvu(stripslashes(htmlspecialchars($_POST["nazev"]))); //*
    $oldnazev = stripslashes(htmlspecialchars($_POST["oldnazev"]));
    $zan = $_GET["zan"]; //urci hloubku zanoreni
    settype($zan, "integer");
    $id = $_GET["cislo"]; //urci cislo slozky
    settype($id, "integer");
    $pod = $_GET["pod"]; //urci id slozky
    settype($pod, "integer");
    $tlacitko = stripslashes(htmlspecialchars($_POST["tlacitko"])); //*

    if (!Empty($nazev) &&
        !Empty($id) &&
        $id != 0 &&
        !Empty($tlacitko))
    {
      switch ($zan)
      {
        case 0: //slozka
          $nazev = $this->ZkontrolujDuplicituAdresare($nazev);  //kontrola duplicity a opatreni
          if (@$this->var->sqlite->queryExec("UPDATE slozka SET nazev='{$nazev}' WHERE uzivatel={$this->var->iduser} AND id={$id};", $error))
          {
            $result =
            "
                  <div id=\"nacitani_central\" title=\"Byl upraven název složky: {$nazev}\">
                    <p>
                      Byl upraven název složky: <em>{$nazev}</em>
                    </p>
                  </div>
            ";

            @rename("{$this->var->userdir}/{$this->var->jmeno}/{$oldnazev}", "{$this->var->userdir}/{$this->var->jmeno}/{$nazev}");
            @chmod("{$this->var->userdir}/{$this->var->jmeno}/{$nazev}", 0777); //zmeni prava pristupu

            $this->var->main->AutoClick(2, "?action=dir");  //auto kliknuti
          }
            else
          {
            $this->ErrorMsg($error);
          }
        break;

        case 1: //podslozka
          if ($pod != 0)
          {
            $slozka = $this->ZjistiNazevSlozky($pod);
            $nazev = $this->ZkontrolujDuplicituPodadresare($pod, $nazev);  //kontrola duplicity a opatreni
            if (@$this->var->sqlite->queryExec("UPDATE podslozka SET nazev='{$nazev}' WHERE uzivatel={$this->var->iduser} AND id={$id};", $error))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Byl upraven název složky: {$nazev}\">
                    <p>
                      Byl upraven název složky: <em>{$nazev}</em>
                    </p>
                  </div>
              ";

              @rename("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$oldnazev}", "{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$nazev}");
              @chmod("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$nazev}", 0777); //zmeni prava pristupu

              $this->var->main->AutoClick(2, "?action=dir");  //auto kliknuti
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }
        break;
      }
    }

    return $result;
  }
//******************************************************************************
  function DelDir() //smaze slozku
  {
    $zan = $_GET["zan"]; //urci hloubku zanoreni
    settype($zan, "integer");
    $cislo = $_GET["cislo"]; //urci cislo slozky
    settype($cislo, "integer");
    $pod = $_GET["pod"]; //urci id slozky
    settype($pod, "integer");
    $nazev = $_POST["nazev"]; //nazev

    switch ($zan)
    {
      case 0: //slozka
        if (!Empty($_POST["ano"]) &&
            $cislo != 0)
        {
          if (@$this->var->sqlite->queryExec("DELETE FROM slozka WHERE id={$cislo};
                                              DELETE FROM podsoubor WHERE slozka={$cislo};
                                              DELETE FROM podslozka WHERE slozka={$cislo};
                                              DELETE FROM podpodsoubor WHERE slozka={$cislo};
                                              DELETE FROM hesla WHERE uzivatel={$this->var->iduser} AND slozka={$cislo} AND podslozka=0;", $error))
          {
            $result =
            "
                  <div id=\"nacitani_central\" title=\"Byla smazána složka s názvem: {$nazev}\">
                    <p>
                      Byla smazána složka s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
            ";

            @rmdir("{$this->var->userdir}/{$this->var->jmeno}/{$nazev}");

            $this->var->main->AutoClick(2, "?action=dir");  //auto kliknuti
          }
            else
          {
            $this->ErrorMsg($error);
          }
        }
          else
        {
          if (!Empty($_POST["ne"]))
          {
            $result =
            "
                  <div id=\"nacitani_central\" title=\"Smazání složky s názvem: {$nazev} bylo stornováno\">
                    <p>
                      Smazání složky s názvem: <em>{$nazev}</em> bylo stornováno
                    </p>
                  </div>
            ";
            $this->var->main->AutoClick(2, "?action=dir");  //auto kliknuti
          }
        }
      break;

      case 1: //podslozka
        if (!Empty($_POST["ano"]) &&
            $cislo != 0)
        {
          if (@$this->var->sqlite->queryExec("DELETE FROM podslozka WHERE id={$cislo};
                                              DELETE FROM podpodsoubor WHERE podslozka={$cislo};
                                              DELETE FROM hesla WHERE uzivatel={$this->var->iduser} AND slozka={$pod} AND podslozka={$cislo};", $error))
          {
            $result =
            "
                  <div id=\"nacitani_central\" title=\"Byla smazána složka s názvem: {$nazev}\">
                    <p>
                      Byla smazána složka s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
            ";

            if ($pod != 0)
            {
              $slozka = $this->ZjistiNazevSlozky($pod);
              @rmdir("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$nazev}");
            }

            $this->var->main->AutoClick(2, "?action=dir");  //auto kliknuti
          }
            else
          {
            $this->ErrorMsg($error);
          }
        }
          else
        {
          if (!Empty($_POST["ne"]))
          {
            $result =
            "
                  <div id=\"nacitani_central\" title=\"Smazání složky s názvem: {$nazev} bylo stornováno\">
                    <p>
                      Smazání složky s názvem: <em>{$nazev}</em> bylo stornováno
                    </p>
                  </div>
            ";
            $this->var->main->AutoClick(2, "?action=dir");  //auto kliknuti
          }
        }
      break;
    }

    return $result;
  }
//******************************************************************************
  function ChangeHeader() //zmeni hlavicku podle aktualni cesty a seznamu jinych hlavicek
  {
    $result = $this->var->header[0];  //defaultne nastavi index 0
    for ($i = 0; $i < count($this->var->otherheader); $i++)
    {
      if ($this->var->otherheader[$i] == $this->var->kam) //kdyz najde odpovidajicivyjimku zmeni navratovou hodnotu na index 1
      {
        $result = $this->var->header[1];
      }
    }

    return $result;
  }
//******************************************************************************
  function CurrentSizeSpace($iduser, $full = false)  //aktualni zaplneni daneho mista, aktualni obsazenost, efektivní
  {
    settype($iduser, "integer");
    $size = 0;
    if ($res = @$this->var->sqlite->query("SELECT slozka.id as id, slozka.nazev as nazev, uzivatel.jmeno as jmeno FROM slozka, uzivatel WHERE
                                          uzivatel.id={$iduser} AND
                                          slozka.uzivatel={$iduser} ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject()) //korenovy vypis
        {
          if ($res2 = @$this->var->sqlite->query("SELECT id, nazev FROM podsoubor WHERE uzivatel={$iduser} AND slozka={$data->id} ORDER BY LOWER(podsoubor.nazev) ASC;", NULL, $error))
          { //vykresleni souboru ve slozce
            if ($res2->numRows() != 0)
            {
              while ($data2 = $res2->fetchObject()) //1.vnoreni
              {
                $size += filesize("{$this->var->userdir}/{$data->jmeno}/{$data->nazev}/{$data2->nazev}");
              }
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }

          if ($res1 = @$this->var->sqlite->query("SELECT podslozka.id as id, podslozka.slozka as podslozka, slozka.nazev as slozka, podslozka.nazev as nazev FROM slozka, podslozka
                                                  WHERE
                                                  podslozka.slozka={$data->id} AND
                                                  slozka.id=podslozka.slozka AND
                                                  slozka.uzivatel={$iduser} AND
                                                  podslozka.uzivatel={$iduser} ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              while ($data1 = $res1->fetchObject()) //2.vnoreni
              {
                if ($res2 = @$this->var->sqlite->query("SELECT id, nazev FROM podpodsoubor WHERE uzivatel={$iduser} AND slozka={$data->id} AND podslozka={$data1->id} ORDER BY LOWER(podpodsoubor.nazev) ASC;", NULL, $error))
                { //vykresleni souboru v podslozce
                  if ($res2->numRows() != 0)
                  {
                    while ($data2 = $res2->fetchObject())
                    {
                      $size += filesize("{$this->var->userdir}/{$data->jmeno}/{$data1->slozka}/{$data1->nazev}/{$data2->nazev}");
                    }
                  }
                }
                  else
                {
                  $this->ErrorMsg($error);
                }
              }
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    if ($res = @$this->var->sqlite->query("SELECT soubor.id as id, soubor.nazev as nazev, uzivatel.jmeno as jmeno FROM soubor, uzivatel WHERE
                                          uzivatel.id={$iduser} AND
                                          soubor.uzivatel={$iduser} ORDER BY LOWER(soubor.nazev) ASC;", NULL, $error))
    { //vykresleni souboru v korenu
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $size += filesize("{$this->var->userdir}/{$data->jmeno}/{$data->nazev}");
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $result = ($full ? $size : $this->Velikost($size));

    return $result;
  }
//******************************************************************************
  function VlezeSeSouborNaDisk($iduser, $size, $maxsize)  //overeni zda nahravany soubor vejde na "disk", iduser, velikost souboru, maximum
  {
    $origmaxsize = $maxsize * 1024 * 1024;
    $aktual = $this->CurrentSizeSpace($iduser, true);
    $result = (($size + $aktual) <= $origmaxsize ? "true" : "false");

    return $result;
  }
//******************************************************************************
  function CurrentPercentSizeSpace($iduser, $maxsize)  //procentualni vyjadreni zaplneneho prostoru, efektivní
  {
    $origmaxsize = $maxsize * 1024 * 1024;
    $aktual = $this->CurrentSizeSpace($iduser, true);

    if ($aktual != 0)
    {
      $pocet = $origmaxsize  / $aktual; //zjisti aktualni kus
      $result = ceil(100 / $pocet); //nacpe do 100 rozsahu
    }
      else
    {
      $result = 0;
    }

    return $result;
  }
//******************************************************************************
  function AvailableFreeSpace($iduser, $maxsize)  //zbyva volneho z daneho prostoru, neefektivní
  {
    $origmaxsize = $maxsize * 1024 * 1024;
    $aktual = $this->CurrentSizeSpace($iduser, true);
    $result = $this->Velikost($origmaxsize - $aktual);

    return $result;
  }
//******************************************************************************
  function AvailablePercentFreeSpace($iduser, $maxsize)  //procentualni vyjadreni volneho prostoru, neefektivní
  {
    $result = 100 - $this->CurrentPercentSizeSpace($iduser, $maxsize);

    return $result;
  }
//******************************************************************************
  function PocetSlozek($uzivatel, $slozka = 0, $podslozka = 0)  //vrati pocet slozek
  {
    if (!Empty($uzivatel))
    {
      if (!Empty($slozka) &&
          Empty($podslozka))
      {
        if ($res = @$this->var->sqlite->query("SELECT id FROM slozka WHERE uzivatel={$uzivatel} AND id={$slozka};", NULL, $error))
        {
          $result = $res->numRows(); //pocet slozek v korenu
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }

      if (!Empty($slozka) &&
          !Empty($podslozka))
      {
        if ($res = @$this->var->sqlite->query("SELECT id FROM podslozka WHERE uzivatel={$uzivatel} AND slozka={$slozka} AND id={$podslozka};", NULL, $error))
        {
          $result = $res->numRows(); //pocet slozek v korenu
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }
    }

    return $result;
  }
//******************************************************************************
  function PocetSouboru($uzivatel, $slozka = 0, $podslozka = 0)  //vrati pocet souboru
  {
    if (!Empty($uzivatel))
    {
      if (Empty($slozka) &&
          Empty($podslozka))
      {
        if ($res = @$this->var->sqlite->query("SELECT id FROM soubor WHERE uzivatel={$uzivatel};", NULL, $error))
        {
          $result = $res->numRows(); //pocet slozek v korenu
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }

      if (!Empty($slozka) &&
          Empty($podslozka))
      {
        if ($res = @$this->var->sqlite->query("SELECT id FROM podsoubor WHERE uzivatel={$uzivatel} AND slozka={$slozka};", NULL, $error))
        {
          $result = $res->numRows(); //pocet slozek v korenu
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }

      if (!Empty($slozka) &&
          !Empty($podslozka))
      {
        if ($res = @$this->var->sqlite->query("SELECT id FROM podpodsoubor WHERE uzivatel={$uzivatel} AND slozka={$slozka} AND podslozka={$podslozka};", NULL, $error))
        {
          echo $result = $res->numRows(); //pocet slozek v korenu
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }
    }

    return $result;
  }
//******************************************************************************
  function ListingFile()  //vypise soubory uzivatele
  {
    $sum = 0;
    if ($res = @$this->var->sqlite->query("SELECT id, nazev FROM slozka WHERE uzivatel={$this->var->iduser} ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
    {
      $dir = "{$this->var->userdir}/{$this->var->jmeno}";
      $result =
      "
<ul class=\"prvni_ul\">
  <li><!-- 1 -->
    <span class=\"ikona_obrazek_slozky\"></span><strong>Kořenový adresář</strong>
    <a href=\"?action=file&amp;delall=1\" title=\"Smazat všechny soubory v kořenovém adresáři\" class=\"odkaz_smazat odkaz_smazat_vse\"><em>Smazat všechny soubory v: <cite>kořenovém adresáři</cite></em></a>
    <a href=\"#\" onclick=\"Zip('{$dir}'); return false;\" class=\"odkaz_smazat zabalit_obsah_slozky_nezaheslovana\" title=\"Zabalit obsah složky\"><em>Zabalit obsah složky</em></a>
    ";
      $uroven1 = $res->numRows(); //pocet slozek v korenu

    //presunuty vypis souboru korene
    if ($res3 = @$this->var->sqlite->query("SELECT id, nazev FROM soubor WHERE uzivatel={$this->var->iduser} ORDER BY LOWER(soubor.nazev) ASC;", NULL, $error))
    { //vykresleni souboru v korenu
      $uroven0 = $res3->numRows();  //pocet souboru v korenu
      if ($res3->numRows() != 0)  //koren -> soubor
      {
        $sum += $res3->numRows();
        $i = 0;
        $koren .= ($uroven1 == 0 ? "      <ul><!-- 2 -->\n" : "");  //kdyz neni zadna slozka v korenu
        $m = 0;
        while ($data3 = $res3->fetchObject()) //koren -> soubor
        {
          $m++;
          $cesta = "{$this->var->userdir}/{$this->var->jmeno}/{$data3->nazev}";
          $create = date($this->var->filedateformat, filemtime($cesta));

          $koren .=
          "        <li><!-- 3 -->
          <span class=\"".($m == $res3->numRows() ? "ikona_obrazek_strom_vpravo" : "ikona_obrazek_strom_svisle_vpravo")."\"></span>
          <span class=\"ikona_obrazek_ikony\"></span>
          <strong><a href=\"{$cesta}\" title=\"{$data3->nazev} - {$create}\" class=\"odkaz_soubor\">{$data3->nazev}</a> ({$this->VelikostSouboru($cesta)})</strong>
          <a href=\"?action=editfile&amp;zan=0&amp;cislo={$data3->id}\" title=\"Upravit\" class=\"odkaz_upravit odkaz_upravit_soubory\"><em>Upravit</em></a>
          <a href=\"?action=delfile&amp;zan=0&amp;cislo={$data3->id}\" title=\"Smazat\" class=\"odkaz_smazat odkaz_smazat_soubory\"><em>Smazat</em></a>
          <a href=\"#\" onclick=\"CopyToClipboard('{$this->var->web}/{$cesta}'); return false;\" class=\"odkaz_smazat vypis_soubory_zkopirovat_odkaz_do_schranky\" title=\"Zkopírovat odkaz do schránky\"><em>Zkopírovat odkaz do schránky</em></a>
          <a href=\"{$cesta}\" onclick=\"window.open(this.href); return false;\" class=\"odkaz_smazat vypis_soubory_otevrit_do_noveho_okna\" title=\"Otevřít soubor: {$data3->nazev} do nového okna\"><em>Otevřít soubor<abbr>:</abbr> <cite>{$data3->nazev}</cite> do nového okna</em></a>
        </li><!-- 3 -->\n";
          $file[$i] = $data3->nazev;
          $i++;
        }
        $koren .= "      </ul><!-- 2 -->\n";
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

      if ($res->numRows() != 0)
      {
        $result .= "      <ul><!-- 2 -->\n";
        $n = 0;
        while ($data = $res->fetchObject()) //koren -> slozka
        {
          $n++;
          $zamek = $this->AktivniHeslo(0, 0, $data->id, $login, $heslo, $id, $this->var->iduser);
          $dir = "{$this->var->userdir}/{$this->var->jmeno}/{$data->nazev}";

          $result .=
          "        <li><!-- 3 -->
          <span class=\"".($uroven0 == 0 && $n == $res->numRows() ? "ikona_obrazek_strom_vpravo" : "ikona_obrazek_strom_svisle_vpravo")."\"></span>
          <span class=\"ikona_obrazek_slozky\"></span>
          <strong>{$data->nazev}</strong>
          <a href=\"?action=file&amp;delall=2&amp;cis={$data->id}\" title=\"Smazat všechny soubory ve složce: {$data->nazev}\" class=\"".($zamek ? "odkaz_smazat_vse odkaz_smazat_vse_zaheslovana" : "odkaz_smazat odkaz_smazat_vse")."\"><em>Smazat všechny soubory ve složce: <cite>{$data->nazev}</cite></em></a>
          <a href=\"#\" onclick=\"Zip('{$dir}'); return false;\" class=\"odkaz_smazat ".($zamek ? "zabalit_obsah_slozky" : "zabalit_obsah_slozky_nezaheslovana")."\" title=\"Zabalit obsah složky\"><em>Zabalit obsah složky</em></a>
          ".($zamek ? "<acronym class=\"background_soubory_lock\"><em>Zaheslovaná složka - Login: <span>{$login}</span>, Heslo: <span>{$heslo}</span></em></acronym>" : "")."
          ";

          if ($res1 = @$this->var->sqlite->query("SELECT podslozka.id as id, podslozka.slozka as podslozka, slozka.nazev as slozka, podslozka.nazev as nazev FROM slozka, podslozka
                                                  WHERE
                                                  podslozka.slozka={$data->id} AND
                                                  slozka.id=podslozka.slozka AND
                                                  slozka.uzivatel={$this->var->iduser} AND
                                                  podslozka.uzivatel={$this->var->iduser} ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              $result .= "          <ul><!-- 4 -->\n";
              $o = 0;
              while ($data1 = $res1->fetchObject()) // Koren -> slozka -> podslozka
              {
                $o++;
                $zamek = $this->AktivniHeslo(1, $data->id, $data1->id, $login, $heslo, $id, $this->var->iduser);
                $dir = "{$this->var->userdir}/{$this->var->jmeno}/{$data1->slozka}/{$data1->nazev}";

                $result .=
                "            <li><!-- 5 -->
              <span".($uroven1 == $n && $uroven0 == 0 ? "" : " class=\"ikona_obrazek_strom_svisle\"")."></span>
              <span class=\"".($this->PocetSouboru($this->var->iduser, $data->id) == 0 && $o == $res1->numRows() ? "ikona_obrazek_strom_vpravo" : "ikona_obrazek_strom_svisle_vpravo")."\"></span>
              <span class=\"ikona_obrazek_slozky\"></span>
              <strong>{$data1->nazev}</strong>
              <a href=\"?action=file&amp;delall=3&amp;cis={$data->id}&amp;podcis={$data1->id}\" title=\"Smazat všechny soubory ve složce: {$data1->nazev}\" class=\"".($zamek ? "odkaz_smazat_vse odkaz_smazat_vse_zaheslovana" : "odkaz_smazat odkaz_smazat_vse")."\"><em>Smazat všechny soubory ve složce: <cite>{$data1->nazev}</cite></em></a>
              <a href=\"#\" onclick=\"Zip('{$dir}'); return false;\" class=\"odkaz_smazat ".($zamek ? "zabalit_obsah_slozky" : "zabalit_obsah_slozky_nezaheslovana")."\" title=\"Zabalit obsah složky\"><em>Zabalit obsah složky</em></a>
              ".($zamek ? "<acronym class=\"background_soubory_lock\"><em>Zaheslovaná složka - Login: <span>{$login}</span>, Heslo: <span>{$heslo}</span></em></acronym>" : "")."
              ";

                if ($res2 = @$this->var->sqlite->query("SELECT id, nazev, slozka, podslozka FROM podpodsoubor WHERE uzivatel={$this->var->iduser} AND slozka={$data->id} AND podslozka={$data1->id} ORDER BY LOWER(podpodsoubor.nazev) ASC;", NULL, $error))
                { //vykresleni souboru v podslozce
                  if ($res2->numRows() != 0)
                  {
                    $sum += $res2->numRows();
                    $k = 0;
                    $result .= "              <ul><!-- 6 -->\n";
                    $q = 0;
                    while ($data2 = $res2->fetchObject()) // Koren -> slozka -> podslozka -> soubor
                    {
                      $q++;
                      $cesta = "{$this->var->userdir}/{$this->var->jmeno}/{$data1->slozka}/{$data1->nazev}/{$data2->nazev}";
                      $create = date($this->var->filedateformat, filemtime($cesta));
                      $velikost = $this->VelikostSouboru($cesta);

                      $tajne = $this->TajnaCesta(1, $data->id, $data1->id, $this->var->iduser);

                      if (!Empty($tajne))
                      {
                        $cesta = "download.php?action={$tajne}&amp;file={$data2->nazev}";
                      }

                      $result .=
                      "                <li><!-- 7 -->
                  <span".($m != 0 ? " class=\"ikona_obrazek_strom_svisle\"" : "")."></span>
                  <span class=\"".($this->PocetSouboru($this->var->iduser, $data->id) != 0 || $o != $res1->numRows() ? "ikona_obrazek_strom_svisle" : "")."\"></span>
                  <span class=\"".($q == $res2->numRows() ? "ikona_obrazek_strom_vpravo" : "ikona_obrazek_strom_svisle_vpravo")."\"></span>
                  <span class=\"ikona_obrazek_ikony\"></span>
                  <strong><a href=\"{$cesta}\" title=\"{$data2->nazev} - {$create}\" class=\"odkaz_soubor\">{$data2->nazev}</a> ({$velikost})</strong>
                  <a href=\"?action=editfile&amp;zan=2&amp;pod={$data2->slozka}&amp;ppod={$data2->podslozka}&amp;cislo={$data2->id}\" title=\"Upravit\" class=\"odkaz_upravit odkaz_upravit_soubory\"><em>Upravit</em></a>
                  <a href=\"?action=delfile&amp;zan=2&amp;pod={$data2->slozka}&amp;ppod={$data2->podslozka}&amp;cislo={$data2->id}\" title=\"Smazat\" class=\"odkaz_smazat odkaz_smazat_soubory\"><em>Smazat</em></a>
                  <a href=\"#\" onclick=\"CopyToClipboard('{$this->var->web}/{$cesta}'); return false;\" class=\"odkaz_smazat vypis_soubory_zkopirovat_odkaz_do_schranky\" title=\"Zkopírovat odkaz do schránky\"><em>Zkopírovat odkaz do schránky</em></a>
                  <a href=\"{$cesta}\" onclick=\"window.open(this.href); return false;\" class=\"odkaz_smazat vypis_soubory_otevrit_do_noveho_okna\" title=\"Otevřít soubor: {$data2->nazev} do nového okna\"><em>Otevřít soubor<abbr>:</abbr> <cite>{$data2->nazev}</cite> do nového okna</em></a>
                </li><!-- 7 -->\n";

                      $filefilefile[$k] = $data2->nazev;
                      $k++;
                    }
                    $result .= "              </ul><!-- 6 -->
            </li><!-- 5 -->\n";
                  }
                    else
                  {
                    $result .= "            </li><!-- 5 -->\n";
                  }
                }
                  else
                {
                  $this->ErrorMsg($error);
                }
                //$result .= "            </li><!-- .5 -->\n";
                $navic2 += $this->DiffUserFileFileFile($data1->slozka, $data1->nazev, $filefilefile);
              }
              $result .= "          </ul><!-- 4 -->\n";
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }

          if ($res2 = @$this->var->sqlite->query("SELECT id, nazev, slozka FROM podsoubor WHERE uzivatel={$this->var->iduser} AND slozka={$data->id} ORDER BY LOWER(podsoubor.nazev) ASC;", NULL, $error))
          { //vykresleni souboru ve slozce
            $uroven2 = $res2->numRows();

            if ($res2->numRows() != 0)
            {
              $result .= "          <ul><!-- 4 -->\n";  //kdyz je nenulovy pocet podslozek
              $sum += $res2->numRows();
              $j = 0;
              $p = 0;
              while ($data2 = $res2->fetchObject()) //koren -> slozka -> soubor
              {
                $p++;
                $cesta = "{$this->var->userdir}/{$this->var->jmeno}/{$data->nazev}/{$data2->nazev}";
                $create = date($this->var->filedateformat, filemtime($cesta));

                $tajne = $this->TajnaCesta(0, 0, $data->id, $this->var->iduser);
                $velikost = $this->VelikostSouboru($cesta);

                if (!Empty($tajne))
                {
                  $cesta = "download.php?action={$tajne}&amp;file={$data2->nazev}";
                }

                $result .=
                "            <li><!-- 5 -->
              <span".($n != $uroven1 || $uroven0 != 0 ? " class=\"ikona_obrazek_strom_svisle\"" : "")."></span>
              <span class=\"".($p == $this->PocetSouboru($this->var->iduser, $data->id) ? "ikona_obrazek_strom_vpravo" : "ikona_obrazek_strom_svisle_vpravo")."\"></span>
              <span class=\"ikona_obrazek_ikony\"></span>
              <strong><a href=\"{$cesta}\" title=\"{$data2->nazev} - {$create}\" class=\"odkaz_soubor\">{$data2->nazev}</a> ({$velikost})</strong>
              <a href=\"?action=editfile&amp;zan=1&amp;pod={$data2->slozka}&amp;cislo={$data2->id}\" title=\"Upravit\" class=\"odkaz_upravit odkaz_upravit_soubory\"><em>Upravit</em></a>
              <a href=\"?action=delfile&amp;zan=1&amp;pod={$data2->slozka}&amp;cislo={$data2->id}\" title=\"Smazat\" class=\"odkaz_smazat odkaz_smazat_soubory\"><em>Smazat</em></a>
              <a href=\"#\" onclick=\"CopyToClipboard('{$this->var->web}/{$cesta}'); return false;\" class=\"odkaz_smazat vypis_soubory_zkopirovat_odkaz_do_schranky\" title=\"Zkopírovat odkaz do schránky\"><em>Zkopírovat odkaz do schránky</em></a>
              <a href=\"{$cesta}\" onclick=\"window.open(this.href); return false;\" class=\"odkaz_smazat vypis_soubory_otevrit_do_noveho_okna\" title=\"Otevřít soubor: {$data2->nazev} do nového okna\"><em>Otevřít soubor<abbr>:</abbr> <cite>{$data2->nazev}</cite> do nového okna</em></a>
            </li><!-- 5 -->\n";

                $filefile[$j] = $data2->nazev;
                $j++;
              }
              $result .= "          </ul><!-- 4 -->\n";
              $navic1 += $this->DiffUserFileFile($data->nazev, $filefile);
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }

          $result .= "        </li><!-- 3 -->\n";
        }
        $result .= ($uroven0 == 0 ? "      </ul><!-- 2 -->\n" : "");  //kdyz neni zadny soubor ve slozce
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $result .= $koren;

    $result .= "  </li><!-- 1 -->
</ul>";

    if (!Empty($_GET["delall"]))  //cisteni slozek
    {
      switch ($_GET["delall"])
      {
        case 1:
          $result =
          "
<div id=\"smazat_slozku_soubor\"".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "").">
  <p>
    Chystáš se smazat všechny soubory ve složce:
  </p>
  <p>
    <strong>Kořenový adresář</strong>
  </p>
  <p>
    Opravdu chceš všechny soubory v této složce smazat ?
  </p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <input id=\"tlacitko_ok\" type=\"submit\" value=\"Ano\" name=\"ano\" title=\"Ano\" />
      <input id=\"tlacitko_no\" type=\"submit\" value=\"Ne\" name=\"ne\" title=\"Ne\" />
    </fieldset>
  </form>
</div>
      ";

          if (!Empty($_POST["ano"]))
          {
            if (@$this->var->sqlite->queryExec("DELETE FROM soubor WHERE uzivatel={$this->var->iduser};", $error))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Byly smazány všechny soubory v kořenovém adresáři\">
                    <p>
                      Byly smazány všechny soubory v kořenovém adresáři
                    </p>
                  </div>
              ";
              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }
            else
          {
            if (!Empty($_POST["ne"]))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Smazání všech souborů v kořenovém adresáři bylo stornováno\">
                    <p>
                      Smazání všech souborů v kořenovém adresáři bylo stornováno
                    </p>
                  </div>
              ";
              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
          }
        break;

        case 2:
          $slozka = $_GET["cis"];
          settype($slozka, "integer");
          $nazev = $this->ZjistiNazevSlozky($slozka);
          $result =
          "
<div id=\"smazat_slozku_soubor\"".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "").">
  <p>
    Chystáš se smazat všechny soubory ve složce:
  </p>
  <p>
    <strong>{$nazev}</strong>
  </p>
  <p>
    Opravdu chceš všechny soubory v této složce smazat ?
  </p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <input id=\"tlacitko_ok\" type=\"submit\" value=\"Ano\" name=\"ano\" title=\"Ano\" />
      <input id=\"tlacitko_no\" type=\"submit\" value=\"Ne\" name=\"ne\" title=\"Ne\" />
    </fieldset>
  </form>
</div>
      ";

          if (!Empty($_POST["ano"]))
          {
            if (@$this->var->sqlite->queryExec("DELETE FROM podsoubor WHERE uzivatel={$this->var->iduser} AND slozka={$slozka};", $error))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Byly smazány všechny soubory ve složce: {$nazev}\">
                    <p>
                      Byly smazány všechny soubory ve složce: <em>{$nazev}</em>
                    </p>
                  </div>
              ";
              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }
            else
          {
            if (!Empty($_POST["ne"]))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Smazání všech souborů ve složce: {$nazev} bylo stornováno\">
                    <p>
                      Smazání všech souborů ve složce: <em>{$nazev}</em> bylo stornováno
                    </p>
                  </div>
              ";
              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
          }
        break;

        case 3:
          $slozka = $_GET["cis"];
          settype($slozka, "integer");
          $podslozka = $_GET["podcis"];
          settype($podslozka, "integer");
          $nazev = $this->ZjistiNazevPodslozky($podslozka);
          $result =
          "
<div id=\"smazat_slozku_soubor\"".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "").">
  <p>
    Chystáš se smazat všechny soubory ve složce:
  </p>
  <p>
    <strong>{$nazev}</strong>
  </p>
  <p>
    Opravdu chceš všechny soubory v této složce smazat ?
  </p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <input id=\"tlacitko_ok\" type=\"submit\" value=\"Ano\" name=\"ano\" title=\"Ano\" />
      <input id=\"tlacitko_no\" type=\"submit\" value=\"Ne\" name=\"ne\" title=\"Ne\" />
    </fieldset>
  </form>
</div>
      ";

          if (!Empty($_POST["ano"]))
          {
            if (@$this->var->sqlite->queryExec("DELETE FROM podpodsoubor WHERE uzivatel={$this->var->iduser} AND slozka={$slozka} AND podslozka={$podslozka};", $error))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Byly smazány všechny soubory ve složce: {$nazev}\">
                    <p>
                      Byly smazány všechny soubory ve složce: <em>{$nazev}</em>
                    </p>
                  </div>
              ";

              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }
            else
          {
            if (!Empty($_POST["ne"]))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Smazání všech souborů ve složce: {$nazev} bylo stornováno\">
                    <p>
                      Smazání všech souborů ve složce: <em>{$nazev}</em> bylo stornováno
                    </p>
                  </div>
              ";
              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
          }
        break;
      }
    }

    $navic = (!Empty($file) ? $this->DiffUserFile($file) : 0);

    $result .= "
<div id=\"vypis_info_soubory_hlavni_vypis\">
  <p>
    Celkem souborů: <em>{$sum}</em>
  </p>
  <p class=\"neborder\">
    Počet souborů navíc: <em>".($navic + $navic1 + $navic2)."</em>
  </p>
</div>";

    $this->KontrolaExpiraceSouboru();  //kontroluje expiraci souboru

    return $result;
  }
//******************************************************************************
  function KontrolaDuplicity($cesta, $jmeno)  //zkontroluje duplicitu souboru
  {
    $j = 0;
    $cesta = "{$this->var->userdir}/{$cesta}";
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $soubor[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    if (!Empty($soubor) && in_array($jmeno, $soubor))
    {
      $a = explode(".", $jmeno);
      $prip = $a[count($a) - 1];
      $nazev = substr($jmeno, 0, -(strlen($prip) + 1));
      $rand = rand();
      $result = "{$nazev}_{$rand}.{$prip}";
    }
      else
    {
      $result = $jmeno;
    }

    return $result;
  }
//******************************************************************************
  function PocetInputuUploadu($jmeno, $smer, $pocet)  //pocet inputu v hlavnim uploadu
  {
    if ($pocet > 0)
    {
      switch ($smer)
      {
        case "true":
          $pocet++;
        break;

        case "false":
          $pocet--;
        break;
      }
    }
      else
    {
      $pocet = 1;
    }

    $vysl = ($pocet == 0 ? "{$pocet} <em>vkládacích polí</em>" : ($pocet == 1 ? "{$pocet} <em>vkládací pole</em>" : ($pocet >= 2 && $pocet <= 4 ? "{$pocet} <em>vkládací pole</em>" : "{$pocet} <em>vkládacích polí</em>")));
    $result =
    "
      <dl id=\"label_input_pocet_inputu\">
        <dt>
          {$vysl}
        </dt>
        <dd>
          <a href=\"#\" id=\"pridat_input_file\" onclick=\"PocetHlavniInput('soubory[]', true); return false;\" title=\"Přidat vkládací pole\"><span>Přidat vkládací pole</span></a>
          ".($pocet == 1 ? "<a href=\"#\" id=\"odebrat_input_file\" onclick=\"return false;\" title=\"Odebrat vkládací pole\"><span>Odebrat vkládací pole</span></a>" :
                           "<a href=\"#\" id=\"odebrat_input_file\" onclick=\"PocetHlavniInput('soubory[]', false); return false;\" title=\"Odebrat vkládací pole\"><span>Odebrat vkládací pole</span></a>")."
        </dd>
      </dl>
      <input type=\"hidden\" id=\"poci\" name=\"poci\" value=\"{$pocet}\" />
    "; //  <input type=\"hidden\" id=\"poci\" name=\"poci\" value=\"{$pocet}\" />

    for ($i = 0; $i < $pocet; $i++)
    {
      $result .=
      "
      <dl>
        <dt>
          <label for=\"cesta_k_souboru_label_input_".($i + 1)."\">Cesta k souboru (".($i + 1)."):</label>
        </dt>
        <dd>
          <input type=\"file\" id=\"cesta_k_souboru_label_input_".($i + 1)."\" name=\"{$jmeno}\" />
        </dd>
      </dl>
      ";
    }

    return $result;
  }
//******************************************************************************
  function Upload() //nauploaduje soubor(y) na web
  {
    $cesta = $_POST["slozka"];  //slozka predana pres formu
    $sumsize = 0;

    $multi = $_FILES["soubory"];
    if (count($multi["name"]) != 0)
    {
    $result .= "
<div id=\"nahrany_soubory\">
  <span></span>
  <p>Byly nahrány soubory ...</p>
              ";
      for ($i = 0; $i < count($multi["name"]); $i++)
      {
        $jmeno = $this->KontrolaDuplicity($cesta, $this->OsetreniNazvu($multi["name"][$i]));  //kontrola duplicity
        if (!Empty($jmeno))
        {
          $tmp = $multi["tmp_name"][$i]; //source
          $sumsize += $multi["size"][$i]; //soucet velikost

          if (count(explode(".", $multi["name"][$i])) == 1)
          {
            $jmeno = "{$jmeno}.txt";
          }

          $cil = "{$this->var->userdir}/{$cesta}/{$jmeno}";  //destination
          $errnum = $multi["error"][$i];  //chyby

          if (move_uploaded_file($tmp, $cil))//move_uploaded_file($tmp, $cil)
          {
            $result .= "
      <strong>
        {$jmeno}
      </strong>
                      ";
            $this->AddFile($cesta, $jmeno);
          }
            else
          {
            $result .= "
      <strong>
        Nastala chyba při nahrávání souboru: {$errnum}
      </strong>
                      ";
          }
        } //end if
      } //end for
      $result .= "
  <em>
    Celkově bylo nahráno: <cite>{$this->Velikost($sumsize)}</cite>
  </em>
</div>
      ";
      $this->var->main->AutoClick(3, "?action=file");  //auto kliknuti
    }

    return $result;
  }
//******************************************************************************
  function TestUpravaUbsahu($soubor)  //upravi obsah nebezpecnych souboru pro upload
  {
    $a = explode(".", $soubor);
    $prip = $a[count($a) - 1];

    if (in_array($prip, $this->var->blokfile))  //vyhleda v seznamu jestli jde o nebezpecnou koncovku ci nikoli
    {
      $u = fopen($soubor, "r");
      $data = fread($u, filesize($soubor));
      fclose($u);

      if (strpos($data, "<") != 0)
      {
        $data = htmlentities($data);
        $u = fopen($soubor, "w");
        fwrite($u, $data);
        fclose($u);
      }
    }

    return $result;
  }
//******************************************************************************
  function AddFile($slozka, $nazev)  //prida soubor do databaze
  {
    //$datum = date("Y-m-d H:i:s");
    $this->TestUpravaUbsahu("{$this->var->userdir}/{$slozka}/{$nazev}");

    if ($this->var->jmeno == $slozka) //koren
    {
      if (@$this->var->sqlite->queryExec("INSERT INTO soubor (id, uzivatel, nazev, vytvoreno) VALUES (NULL, {$this->var->iduser}, '{$nazev}', datetime('now', '+1 hour'));", $error))
      {
        @chmod("{$this->var->userdir}/{$this->var->jmeno}/{$nazev}", 0777); //zmeni prava pristupu
      } //uzivatel/login/slozka/slozka/soubour
        else
      {
        $this->ErrorMsg($error);
      }
    }
      else
    {
      $a = explode("/", $slozka);
      $id = $this->ZjistiIdSlozky($a[1], $this->var->iduser); //id slozky

      if (count($a) == 2) //podslozka
      {
        if (@$this->var->sqlite->queryExec("INSERT INTO podsoubor (id, uzivatel, slozka, nazev, vytvoreno) VALUES (NULL, {$this->var->iduser}, {$id}, '{$nazev}', datetime('now', '+1 hour'));", $error))
        {
          @chmod("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$nazev}", 0777); //zmeni prava pristupu
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }

      if (count($a) == 3) //podpodslozka
      {
        $idpod = $this->ZjistiIdPodslozky($a[2], $id, $this->var->iduser);  //id podslolzky
        if (@$this->var->sqlite->queryExec("INSERT INTO podpodsoubor (id, uzivatel, slozka, podslozka, nazev, vytvoreno) VALUES (NULL, {$this->var->iduser}, {$id}, {$idpod}, '{$nazev}', datetime('now', '+1 hour'));", $error))
        {
          @chmod("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$nazev}", 0777); //zmeni prava pristupu
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }
    }

    return $result;
  }
//******************************************************************************
  function ReturnValueFile(&$nazev)  //vrati hodnotu souboru, pres parametr
  {
    $zan = $_GET["zan"];
    settype($zan, "integer");
    $id = $_GET["cislo"];
    settype($id, "integer");

    if ($id != 0)
    {
      switch ($zan)
      {
        case 0:
          if ($res = @$this->var->sqlite->query("SELECT nazev FROM soubor WHERE uzivatel={$this->var->iduser} AND id={$id};", NULL, $error))
          {
            $data = $res->fetchObject();
            $nazev = $data->nazev;
          }
            else
          {
            $this->ErrorMsg($error);
          }
        break;

        case 1:
          if ($res = @$this->var->sqlite->query("SELECT nazev FROM podsoubor WHERE uzivatel={$this->var->iduser} AND id={$id};", NULL, $error))
          {
            $data = $res->fetchObject();
            $nazev = $data->nazev;
          }
            else
          {
            $this->ErrorMsg($error);
          }
        break;

        case 2:
          if ($res = @$this->var->sqlite->query("SELECT nazev FROM podpodsoubor WHERE uzivatel={$this->var->iduser} AND id={$id};", NULL, $error))
          {
            $data = $res->fetchObject();
            $nazev = $data->nazev;
          }
            else
          {
            $this->ErrorMsg($error);
          }
        break;
      }
    }
  }
//******************************************************************************
  function EditFile() //edituje soubor
  {
    $zan = $_POST["zan"]; //cslo zanoreni
    settype($zan, "integer");
    $cislo = $_POST["cislo"]; //id souboru
    settype($cislo, "integer");
    $prip = $_POST["prip"]; //pripona
    $nazev = $this->OsetreniNazvu(stripslashes(htmlspecialchars("{$_POST["nazev"]}.{$prip}")));  //nazev
    $oldnazev = "{$_POST["oldnazev"]}.{$prip}"; //stary nazev
    $pod = $_POST["pod"]; //id slozky
    settype($pod, "integer");
    $ppod = $_POST["ppod"]; //id podslozky
    settype($ppod, "integer");
    $tlacitko = $_POST["tlacitko"];

    if (!Empty($nazev) &&
        !Empty($cislo) &&
        $cislo != 0 &&
        !Empty($tlacitko))
    {
      switch ($zan)
      {
        case 0:
          if (@$this->var->sqlite->queryExec("UPDATE soubor SET nazev='{$nazev}' WHERE uzivatel={$this->var->iduser} AND id={$cislo};", $error))
          {
            $result =
            "
                  <div id=\"nacitani_central\" title=\"Byl upraven název souboru: {$nazev}\">
                    <p>
                      Byl upraven název souboru: <em>{$nazev}</em>
                    </p>
                  </div>
            ";

            @rename("{$this->var->userdir}/{$this->var->jmeno}/{$oldnazev}", "{$this->var->userdir}/{$this->var->jmeno}/{$nazev}");
            @chmod("{$this->var->userdir}/{$this->var->jmeno}/{$nazev}", 0777); //zmeni prava prstupu

            $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
          }
            else
          {
            $this->ErrorMsg($error);
          }
        break;

        case 1:
          if ($pod != 0)
          {
            if (@$this->var->sqlite->queryExec("UPDATE podsoubor SET nazev='{$nazev}' WHERE uzivatel={$this->var->iduser} AND id={$cislo};", $error))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Byl upraven název souboru: {$nazev}\">
                    <p>
                      Byl upraven název souboru: <em>{$nazev}</em>
                    </p>
                  </div>
              ";

              $slozka = $this->ZjistiNazevSlozky($pod);

              @rename("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$oldnazev}", "{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$nazev}");
              @chmod("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$nazev}", 0777); //zmeni prava prstupu

              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }
        break;

        case 2:
          if ($pod != 0 && $ppod != 0)
          {
            if (@$this->var->sqlite->queryExec("UPDATE podpodsoubor SET nazev='{$nazev}' WHERE uzivatel={$this->var->iduser} AND id={$cislo};", $error))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Byl upraven název souboru: {$nazev}\">
                    <p>
                      Byl upraven název souboru: <em>{$nazev}</em>
                    </p>
                  </div>
              ";

              $slozka = $this->ZjistiNazevSlozky($pod);
              $podslozka = $this->ZjistiNazevPodslozky($ppod);

              @rename("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$podslozka}/{$oldnazev}", "{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$podslozka}/{$nazev}");
              @chmod("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$podslozka}/{$nazev}", 0777); //zmeni prava prstupu

              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }
        break;
      }
    }

    return $result;
  }
//******************************************************************************
  function DelFile()  //smaze soubor
  {
    $zan = $_GET["zan"]; //cislo zanoreni
    settype($zan, "integer");
    $cislo = $_GET["cislo"]; //id souboru
    settype($cislo, "integer");
    $nazev = $_POST["nazev"]; //nazev
    $pod = $_GET["pod"]; //id slozky
    settype($pod, "integer");
    $ppod = $_GET["ppod"]; //id podslozky
    settype($ppod, "integer");

    if (!Empty($cislo) &&
        $cislo != 0)
    {
      switch ($zan)
      {
        case 0:
          if (!Empty($_POST["ano"]) &&
              $cislo != 0)
          {
            if (@$this->var->sqlite->queryExec("DELETE FROM soubor WHERE id={$cislo};", $error))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Byl smazán soubor s názvem: {$nazev}\">
                    <p>
                      Byl smazán soubor s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
              ";

              @unlink("{$this->var->userdir}/{$this->var->jmeno}/{$nazev}");

              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }
            else
          {
            if (!Empty($_POST["ne"]))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Smazání souboru s názvem: {$nazev} bylo stornováno\">
                    <p>
                      Smazání souboru s názvem: <em>{$nazev}</em> bylo stornováno
                    </p>
                  </div>
              ";
              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
          }
        break;

        case 1:
          if (!Empty($_POST["ano"]) &&
              $cislo != 0 &&
              $pod != 0)
          {
            if (@$this->var->sqlite->queryExec("DELETE FROM podsoubor WHERE id={$cislo};", $error))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Byl smazán soubor s názvem: {$nazev}\">
                    <p>
                      Byl smazán soubor s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
              ";

              $slozka = $this->ZjistiNazevSlozky($pod);

              @unlink("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$nazev}");

              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }
            else
          {
            if (!Empty($_POST["ne"]))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Smazání souboru s názvem: {$nazev} bylo stornováno\">
                    <p>
                      Smazání souboru s názvem: <em>{$nazev}</em> bylo stornováno
                    </p>
                  </div>
              ";
              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
          }
        break;

        case 2:
          if (!Empty($_POST["ano"]) &&
              $cislo != 0 &&
              $pod != 0 &&
              $ppod != 0)
          {
            if (@$this->var->sqlite->queryExec("DELETE FROM podpodsoubor WHERE id={$cislo};", $error))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Byl smazán soubor s názvem: {$nazev}\">
                    <p>
                      Byl smazán soubor s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
              ";

              $slozka = $this->ZjistiNazevSlozky($pod);
              $podslozka = $this->ZjistiNazevPodslozky($ppod);

              @unlink("{$this->var->userdir}/{$this->var->jmeno}/{$slozka}/{$podslozka}/{$nazev}");

              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }
            else
          {
            if (!Empty($_POST["ne"]))
            {
              $result =
              "
                  <div id=\"nacitani_central\" title=\"Smazání souboru s názvem: {$nazev} bylo stornováno\">
                    <p>
                      Smazání souboru s názvem: <em>{$nazev}</em> bylo stornováno
                    </p>
                  </div>
              ";
              $this->var->main->AutoClick(2, "?action=file");  //auto kliknuti
            }
          }
        break;
      }
    }

    return $result;
  }
//******************************************************************************
  function ReturnValueUserName($idpar = "")  //vrati hodnotu jmena
  {
    if (Empty($idpar))
    {
      $id = $_GET["cislo"];
      settype($id, "integer");
    }
      else
    {
      $id = $idpar;
    }

    if ($id != 0 &&
        (($this->var->pravo == $this->var->moderator || ($this->var->pravo == $this->var->admin && $_GET["action"] == "deluser")) && ($id == 1 || $id == 2) ? false : true) &&
        (($this->var->pravo == $this->var->moderator) && $id == $this->var->iduser && $_GET["action"] == "deluser" ? false : true))
    {
      if ($res = @$this->var->sqlite->query("SELECT jmeno FROM uzivatel WHERE id={$id}", NULL, $error))
      {
        $data = $res->fetchObject();
        $result = $data->jmeno;
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }

    return $result;
  }
//******************************************************************************
  function DrobeckovaNavigace() //drobeckova navigace po strankach
  {
    $result .= ($this->var->kam == "uvod" ? "<a href=\"?action=uvod\" title=\"Kořenový adresář\">Kořenový adresář</a>" : "<a href=\"./\" title=\"{$this->var->stranka["uvod"]}\">{$this->var->stranka["uvod"]}</a>");

    $drobek = $this->var->mapa[$this->var->kam];
    $odkaz = "?action={$_GET["action"]}".
              (!Empty($_GET["cislo"]) ? "&amp;cislo={$_GET["cislo"]}" : "").
              ($_GET["zan"] != "" ? "&amp;zan={$_GET["zan"]}" : "").
              (!Empty($_GET["pod"]) ? "&amp;pod={$_GET["pod"]}" : "").
              (!Empty($_GET["delall"]) ? "&amp;delall={$_GET["delall"]}" : "").
              (!Empty($_GET["cis"]) ? "&amp;cis={$_GET["cis"]}" : "").
              (!Empty($_GET["podcis"]) ? "&amp;podcis={$_GET["podcis"]}" : "").
              (!Empty($_GET["id"]) ? "&amp;id={$_GET["id"]}" : "").
              (!Empty($_GET["ida"]) ? "&amp;ida={$_GET["ida"]}" : "").
              (!Empty($_GET["od"]) ? "&amp;od={$_GET["od"]}" : "").
              (!Empty($_GET["do"]) ? "&amp;do={$_GET["do"]}" : "").
              (!Empty($_GET["style"]) ? "&amp;style={$_GET["style"]}" : "");

    if (count($drobek) > 1)
    {
      for ($i = 0; $i < count($drobek); $i++)
      {
        if (count($drobek) == 2 || count($drobek) == 3)
        {
          switch ($drobek[$i])
          {
            case "info":
              $jmeno = $this->var->main->ReturnValueUserName();
              $plus = ": {$jmeno}";
            break;

            case "import":
              $style = $_GET["style"];
              settype($style, "integer");
              $jmeno = $this->var->main->VypisNazevStylu($style);
              $plus = ": {$jmeno}";
            break;
          }
        }

        $odkaz0 = "?action={$drobek[$i]}".(count($drobek) == 3 && $i == 1 ? (!Empty($_GET["style"]) ? "&amp;style={$_GET["style"]}" : "") : "");

        $result .= " <strong>&raquo;</strong> <a href=\"".(((count($drobek) == 2 && $i == 0) || (count($drobek) == 3 && ($i == 0 || $i == 1))) ? $odkaz0 : $odkaz)."\" title=\"{$this->var->stranka[$drobek[$i]]}{$plus}\">{$this->var->stranka[$drobek[$i]]}".(($i + 2) == count($drobek) || count($drobek) == 2 ? "{$plus}" : "")."</a>";
      }
    }
      else
    {
      if ($drobek == "uvod")
      {
        $sl = $_GET["sl"];  //id slozky
        settype($sl, "integer");
        $psl = $_GET["psl"];  //id podslozky
        settype($psl, "integer");

        if ($sl != 0)
        {
          $slozka = $this->ZjistiNazevSlozky($sl);

          $result .= " <strong>&raquo;</strong> <a href=\"?action={$_GET["action"]}&amp;zan=1&amp;sl={$_GET["sl"]}\" title=\"{$slozka}\">{$slozka}</a>";

          if ($psl != 0)
          {
            $podslozka = $this->ZjistiNazevPodslozky($psl);
            $result .= " <strong>&raquo;</strong> <a href=\"?action={$_GET["action"]}&amp;zan=2&amp;sl={$_GET["sl"]}&amp;psl={$_GET["psl"]}\" title=\"{$podslozka}\">{$podslozka}</a>";
          }
        }
      }
        else
      {
        $result .= " <strong>&raquo;</strong> <a href=\"{$odkaz}\" title=\"{$this->var->stranka[$drobek]}\">{$this->var->stranka[$drobek]}</a>";
      }
    }

    return $result;
  }
//******************************************************************************
  function ListingSuffix()  //vypise pripony
  {
    if ($res = @$this->var->sqlite->query("SELECT id,
                                          nazev,
                                          pripona,
                                          trida,
                                          zamek
                                          FROM pripony
                                          ORDER BY LOWER(pripony.nazev) ASC;
                                          ", NULL, $error))
    {
      $poc = $res->numRows();
      $i = 0;
      if ($poc != 0)
      {
        while($data = $res->fetchObject())
        {
          $result .=
          "
  <p".((fmod($i + 1, 10) == 0) || ($i == ($poc - 1)) ? " class=\"neborder\"" : "").">
    <strong class=\"{$data->trida}\" title=\"{$data->pripona} - {$data->nazev}\">
      <span></span>
      {$data->pripona}
    </strong>
    <a href=\"?action=editsuffix&amp;cislo={$data->id}\" class=\"vypis_pripon_upravit\" title=\"Upravit\"></a>
    ".($data->zamek != "true" ? "
    <a href=\"?action=delsuffix&amp;cislo={$data->id}\" class=\"vypis_pripon_smazat\" title=\"Smazat\"></a>
    " : "<em class=\"vypis_pripon_lock\" title=\"Tato přípona nelze smazat !\"></em>")."
    <em class=\"".(file_exists("{$this->var->priponydir}/{$data->pripona}.png") ? "pripona_existuje" : "pripona_neexistuje")."\" title=\"".(file_exists("{$this->var->priponydir}/{$data->pripona}.png") ? "Obrázek přípony existuje" : "Obrázek přípony neexistuje")."\"></em>
  </p>
  ".(((($i + 1) % 10) == 0) && ($i != (count($prenos) - 1)) ? "<span class=\"linka_vypis\"></span>" : "")."
          ";
          $prip[$i] = "{$data->pripona}.png";
          $i++;
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $navic = (!Empty($prip) ? $this->DiffSuffix($prip) : 0);
    $result .= "
<div id=\"vypis_info_uzivatele_hlavni_vypis\">
  <p>
    Celkem přípon: <em>{$poc}</em>
  </p>
  <p class=\"neborder\">
    Počet přípon navíc: <em>{$navic}</em>
  </p>
</div>
    ";

    return $result;
  }
//******************************************************************************
  function AddSuffix()  //pridani pripony
  {
    $nazev = stripslashes(htmlspecialchars($_POST["nazev"])); //*
    $pripona = stripslashes(htmlspecialchars($_POST["pripona"])); //*
    $trida = stripslashes(htmlspecialchars($_POST["trida"])); //*

    if (!file_exists("{$this->var->priponydir}"))  //vytvori soubor pokud neexistuje
    {
      $a = explode("/", $this->var->priponydir);
      @chmod($a[0], 0777);  //nastaveni prava u 1.urovne
      @mkdir("{$this->var->priponydir}");
      @chmod("{$this->var->priponydir}", 0777); //zmeni prava pristupu
    }

    $jmeno = $_FILES["soubor"]["name"];
    $tmp = $_FILES["soubor"]["tmp_name"]; //source
    $cil = "{$this->var->priponydir}/{$jmeno}";  //destination
    $errnum = $_FILES["soubor"]["error"];

    $tlacitko = stripslashes(htmlspecialchars($_POST["tlacitko"])); //*

    if (file_exists($cil))  //kontrola duplicity
    {
      $a = explode(".", $jmeno);
      $jmeno = "{$a[0]}_".rand().".{$a[count($a) - 1]}";
      $cil = "{$this->var->priponydir}/{$jmeno}";  //destination
    }

    $a = explode(".", $jmeno);
    $prip = strtolower($a[count($a) - 1]);

    if (!Empty($nazev) &&
        !Empty($pripona) &&
        !Empty($trida) &&
        !Empty($tlacitko))
    {
      if (@$this->var->sqlite->queryExec("INSERT INTO pripony (id, nazev, pripona, trida, zamek) VALUES (NULL, '{$nazev}', '{$pripona}', '{$trida}', 'false');", $error))
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Byla vytvořena přípona s názvem: {$nazev}\">
                    <p>
                      Byla vytvořena přípona s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
        ";

        list($w, $h) = getimagesize($tmp);
        if ($prip == "png" && $w <= 128 && $h <= 128) //upload pripony
        {
          if (move_uploaded_file($tmp, $cil))
          {
            $result .=
            "
                    <div id=\"nacitani_central\" title=\"K příponě s názvem: {$nazev} byl nahrán obrázek\">
                      <p>
                        K příponě s názvem: <em>{$nazev}</em> byl nahrán obrázek
                      </p>
                    </div>
            ";
          }
            else
          {
            $result .= "
                  <div id=\"nacitani_central\" title=\"Nastala chyba při nahrávání obrázku: {$errnum}\">
                    <p>
                      Nastala chyba při nahrávání obrázku: <em>{$errnum}</em>
                    </p>
                  </div>
            ";
          }
        }
          else
        {
          if (!Empty($tlacitko) &&
              !Empty($tmp))
          {
            if ($w <= 128 && $h <= 128)
            {
              $result .= "
                  <div id=\"nacitani_central\" title=\"Typ obrázku přípony musí být PNG\">
                    <p>
                      Typ obrázku přípony musí být PNG
                    </p>
                  </div>
              ";
            }
              else
            {
              $result .= "
                  <div id=\"nacitani_central\" title=\"Velikost obrázku musí být do 128x128 px\">
                    <p>
                      Velikost obrázku musí být do 128x128 px
                    </p>
                  </div>
              ";
            }
          }
        } //upload pripony

        $this->var->main->AutoClick(2, "?action=suffix");  //auto kliknuti
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }

    return $result;
  }
//******************************************************************************
  function ReturnValueSuffix(&$nazev, &$pripona, &$trida, &$zamek) //vrati hodnoty pripony dle cisla
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->sqlite->query("SELECT nazev, pripona, trida, zamek FROM pripony WHERE id={$id};", NULL, $error))
      {
        $data = $res->fetchObject();
        $nazev = $data->nazev;
        $pripona = $data->pripona;
        $trida = $data->trida;
        $zamek = $data->zamek;
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }
  }
//******************************************************************************
  function EditSuffix() //upravi priponu + reupload
  {
    $nazev = stripslashes(htmlspecialchars($_POST["nazev"])); //*
    $pripona = stripslashes(htmlspecialchars($_POST["pripona"])); //*
    $trida = stripslashes(htmlspecialchars($_POST["trida"])); //*
    $tlacitko = stripslashes(htmlspecialchars($_POST["tlacitko"])); //*

    $id = $_GET["cislo"];
    settype($id, "integer");

    $jmeno = $_FILES["soubor"]["name"];
    $tmp = $_FILES["soubor"]["tmp_name"]; //source
    $cil = "{$this->var->priponydir}/{$jmeno}";  //destination
    $errnum = $_FILES["soubor"]["error"];

    $a = explode(".", $jmeno);
    $prip = strtolower($a[count($a) - 1]);

    if (!Empty($nazev) &&
        !Empty($pripona) &&
        !Empty($trida) &&
        !Empty($id) &&
        $id != 0 &&
        !Empty($tlacitko))
    {
      if (@$this->var->sqlite->queryExec ("UPDATE pripony SET nazev='{$nazev}',
                                                              pripona='{$pripona}',
                                                              trida='{$trida}'
                                                              WHERE id={$id};", $error))
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Byla upravena přípona s názvem: {$nazev}\">
                    <p>
                      Byla upravena přípona s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
        ";

        list($w, $h) = getimagesize($tmp);
        if ($prip == "png" && $w <= 128 && $h <= 128) //upload pripony
        {
          if (move_uploaded_file($tmp, $cil))
          {
            $result .=
            "
                  <div id=\"nacitani_central\" title=\"K příponě s názvem: {$nazev} byl nahrán obrázek\">
                    <p>
                      K příponě s názvem: <em>{$nazev}</em> byl nahrán obrázek
                    </p>
                  </div>
            ";
          }
            else
          {
            $result .= "
                  <div id=\"nacitani_central\" title=\"Nastala chyba při nahrávání obrázku: {$errnum}\">
                    <p>
                      Nastala chyba při nahrávání obrázku: <em>{$errnum}</em>
                    </p>
                  </div>
            ";
          }
        }
          else
        {
          if (!Empty($tlacitko) &&
              !Empty($tmp))
          {
            if ($w <= 128 && $h <= 128)
            {
              $result .= "
                  <div id=\"nacitani_central\" title=\"Typ obrázku přípony musí být PNG\">
                    <p>
                      Typ obrázku přípony musí být PNG
                    </p>
                  </div>
              ";
            }
              else
            {
              $result .= "
                  <div id=\"nacitani_central\" title=\"Velikost obrázku musí být do 128x128 px\">
                    <p>
                      Velikost obrázku musí být do 128x128 px
                    </p>
                  </div>
              ";
            }
          }
        } //upload pripony

        $this->var->main->AutoClick(2, "?action=suffix");  //auto kliknuti
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }

    return $result;
  }
//******************************************************************************
  function DelSuffix()  //smaze priponu
  {
    $id = $_GET["cislo"];
    settype($pod, "integer");
    $nazev = $_POST["nazev"]; //nazev
    $zamek = $_POST["zamek"];

    if (!Empty($_POST["ano"]) &&
        $id != 0 &&
        $zamek != "true")
    {
      if (@$this->var->sqlite->queryExec("DELETE FROM pripony WHERE id={$id};", $error))
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Byla smazána přípona s názvem: {$nazev}\">
                    <p>
                      Byla smazána přípona s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
        ";

        $this->var->main->AutoClick(2, "?action=suffix");  //auto kliknuti
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }
      else
    {
      if (!Empty($_POST["ne"]))
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Smazání přípony s názvem: {$nazev} bylo stornováno\">
                    <p>
                      Smazání přípony s názvem: <em>{$nazev}</em> bylo stornováno
                    </p>
                  </div>
        ";
        $this->var->main->AutoClick(2, "?action=suffix");  //auto kliknuti
      }
    }

    return $result;
  }
//******************************************************************************
  function ListingStyle() //vypise styly
  {
    if ($res = @$this->var->sqlite->query ("SELECT id,
                                            nazev,
                                            slozka
                                            FROM styles
                                            ORDER BY LOWER(styles.nazev) ASC;
                                            ", NULL, $error))
    {
      $poc = $res->numRows();
      if ($res->numRows() != 0)
      {
        $i = 0;
        while($data = $res->fetchObject())
        {
          $result .=
          "
  <p".((fmod($i + 1, 10) == 0) || ($i == ($poc - 1)) ? " class=\"neborder\"" : "").">
    <a href=\"?action=import&amp;style={$data->id}\" class=\"vypis_stylu_polozka_odkaz\" title=\"{$data->nazev}\">
      <span></span>
      {$data->nazev}
    </a>
    ".($data->id != 1 ? "
    <a href=\"?action=editstyle&amp;cislo={$data->id}\" class=\"vypis_stylu_upravit\" title=\"Upravit\"></a>
    <a href=\"?action=delstyle&amp;cislo={$data->id}\" class=\"vypis_stylu_smazat\" title=\"Smazat\"></a>
    " : "<em class=\"vypis_stylu_lock\" title=\"Tento styl nelze smazat !\"></em>")."
  </p>
  ".((fmod($i + 1, 10) == 0) && ($i != ($poc - 1)) ? "
  <span class=\"linka_vypis\"></span>
  " : "")."
          ";

          $slozka = $data->slozka;  //nazav stylu
          if (!file_exists("{$this->var->stylesdir}"))  //vytvori soubor pokud neexistuje - styl dir
          {
            $a = explode("/", $this->var->stylesdir);
            @chmod($a[0], 0777);  //nastaveni prava u 1.urovne
            @mkdir("{$this->var->stylesdir}");
            @chmod("{$this->var->stylesdir}", 0777); //zmeni prava pristupu
          }

          if (!file_exists("{$this->var->stylesdir}/{$slozka}"))
          {
            @mkdir("{$this->var->stylesdir}/{$slozka}");
            @chmod("{$this->var->stylesdir}/{$slozka}", 0777); //zmeni prava pristupu
          }

          if (!file_exists("{$this->var->vzhleddir}"))  //vytvori soubor pokud neexistuje - vzhled dir
          {
            $a = explode("/", $this->var->vzhleddir);
            @chmod($a[0], 0777);  //nastaveni prava u 1.urovne
            @mkdir("{$this->var->vzhleddir}");
            @chmod("{$this->var->vzhleddir}", 0777); //zmeni prava pristupu
          }

          if (!file_exists("{$this->var->vzhleddir}/{$slozka}"))
          {
            @mkdir("{$this->var->vzhleddir}/{$slozka}");
            @chmod("{$this->var->vzhleddir}/{$slozka}", 0777); //zmeni prava pristupu
          }

          $nazev[$i] = $data->slozka;
          $i++;
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $navic = (!Empty($nazev) ? $this->DiffStyle($nazev) : 0);
    $result .= "
<div id=\"vypis_info_uzivatele_hlavni_vypis\">
  <p>
    Celkem stylů: <em>{$poc}</em>
  </p>
  <p class=\"neborder\">
    Počet stylů navíc: <em>{$navic}</em>
  </p>
</div>
      ";

    return $result;
  }
//******************************************************************************
  function VypisNazevStylu($id) //vypise nazev stylu
  {
    if ($id != 0)
    {
      if ($res = @$this->var->sqlite->query ("SELECT nazev
                                              FROM styles
                                              WHERE id={$id};
                                              ", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          $data = $res->fetchObject();
          $nazev= $data->nazev;
        }
          else
        {
          $nazev = "Styl neexistuje";  //neplatný styl
        }
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }
      else
    {
      $nazev = "Není vybrán styl";
    }

    $result = $nazev;

    return $result;
  }
//******************************************************************************
  function VypisNazevSlozky($id) //vypise nazev slozky stylu
  {
     if ($res = @$this->var->sqlite->query("SELECT slozka
                                            FROM styles
                                            WHERE id={$id};
                                            ", NULL, $error))
    {
      $data = $res->fetchObject();
      $result = $data->slozka;
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function AddStyle() //prida styl a vytvori slozku pro obrazky daneho stylu
  {
    $nazev = stripslashes(htmlspecialchars($_POST["nazev"])); //*
    $slozka = $this->OsetreniNazvu(stripslashes(htmlspecialchars($_POST["slozka"]))); //*
    $tlacitko = stripslashes(htmlspecialchars($_POST["tlacitko"])); //*

    if (!Empty($nazev) &&
        !Empty($slozka) &&
        !Empty($tlacitko))
    {
      if (@$this->var->sqlite->queryExec("INSERT INTO styles (id, nazev, slozka) VALUES (NULL, '{$nazev}', '{$slozka}');", $error))
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Byl vytvořen styl s názvem: {$nazev}\">
                    <p>
                      Byl vytvořen styl s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
        ";

        if (!file_exists("{$this->var->stylesdir}"))  //vytvori soubor pokud neexistuje
        {
          $a = explode("/", $this->var->stylesdir);
          @chmod($a[0], 0777);  //nastaveni prava u 1.urovne
          @mkdir("{$this->var->stylesdir}");
          @chmod("{$this->var->stylesdir}", 0777); //zmeni prava pristupu
        }

        @mkdir("{$this->var->stylesdir}/{$slozka}");
        @chmod("{$this->var->stylesdir}/{$slozka}", 0777); //zmeni prava pristupu

        if (!file_exists("{$this->var->vzhleddir}"))  //vytvori soubor pokud neexistuje
        {
          $a = explode("/", $this->var->vzhleddir);
          @chmod($a[0], 0777);  //nastaveni prava u 1.urovne
          @mkdir("{$this->var->vzhleddir}");
          @chmod("{$this->var->vzhleddir}", 0777); //zmeni prava pristupu
        }

        @mkdir("{$this->var->vzhleddir}/{$slozka}");
        @chmod("{$this->var->vzhleddir}/{$slozka}", 0777); //zmeni prava pristupu

        $this->var->main->AutoClick(2, "?action=style");  //auto kliknuti
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }

    return $result;
  }
//******************************************************************************
  function ReturnValueStyle(&$nazev, &$slozka)  //vrati hodnoty stylu
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if ($id != 0
        && $id != 1
        )
    {
      if ($res = @$this->var->sqlite->query("SELECT nazev, slozka FROM styles WHERE id={$id};", NULL, $error))
      {
        $data = $res->fetchObject();
        $nazev = $data->nazev;
        $slozka = $data->slozka;
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }
  }
//******************************************************************************
  function EditStyle()  //upravi styl
  {
    $nazev = stripslashes(htmlspecialchars($_POST["nazev"])); //*
    $slozka = $this->OsetreniNazvu(stripslashes(htmlspecialchars($_POST["slozka"]))); //*
    $oldslozka = $_POST["oldslozka"];  //stary nazev slozky
    $tlacitko = stripslashes(htmlspecialchars($_POST["tlacitko"])); //*

    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($nazev) &&
        !Empty($slozka) &&
        !Empty($id) &&
        $id != 0 &&
        $id != 1 &&
        !Empty($tlacitko))
    {
      if (@$this->var->sqlite->queryExec("UPDATE styles SET nazev='{$nazev}',
                                                            slozka='{$slozka}'
                                                            WHERE id={$id};", $error))
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Byl upraven styl s názvem: {$nazev}\">
                    <p>
                      Byl upraven styl s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
        ";

        @rename("{$this->var->stylesdir}/{$oldslozka}", "{$this->var->stylesdir}/{$slozka}");
        @chmod("{$this->var->stylesdir}/{$slozka}", 0777); //zmeni prava pristupu

        @rename("{$this->var->vzhleddir}/{$oldslozka}", "{$this->var->vzhleddir}/{$slozka}");
        @chmod("{$this->var->vzhleddir}/{$slozka}", 0777); //zmeni prava pristupu

        $this->var->main->AutoClick(2, "?action=style");  //auto kliknuti
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }

    return $result;
  }
//******************************************************************************
  function DelStyle() //smaze styl i s importy
  {
    $id = $_GET["cislo"];
    settype($id, "integer");
    $nazev = $_POST["nazev"]; //nazev
    $slozka = $_POST["slozka"]; //nazev

    if (!Empty($_POST["ano"]) &&
        $id != 0 &&
        $id != 1)
    {
      if (@$this->var->sqlite->queryExec("DELETE FROM styles WHERE id={$id};
                                          DELETE FROM importy WHERE styles={$id};", $error))
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Byl smazán styl s názvem: {$nazev}\">
                    <p>
                      Byl smazán styl s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
        ";

        $this->DelFullStyle("{$this->var->stylesdir}/{$slozka}");
        $this->DelFullStyle("{$this->var->vzhleddir}/{$slozka}");

        if ($res = @$this->var->sqlite->query("SELECT id
                                              FROM uzivatel
                                              WHERE style={$id};
                                              ", NULL, $error))
        {
          while ($data = $res->fetchObject())
          {
            if (!@$this->var->sqlite->queryExec("UPDATE uzivatel SET style=1 WHERE id={$data->id};", $error))
            {
              $this->ErrorMsg($error);
            }
          }
        }
          else
        {
          $this->ErrorMsg($error);
        }

        $this->var->main->AutoClick(2, "?action=style");  //auto kliknuti
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }
      else
    {
      if (!Empty($_POST["ne"]))
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Smazání stylu s názvem: {$nazev} bylo stornováno\">
                    <p>
                      Smazání stylu s názvem: <em>{$nazev}</em> bylo stornováno
                    </p>
                  </div>
        ";
        $this->var->main->AutoClick(2, "?action=style");  //auto kliknuti
      }
    }

    return $result;
  }
//******************************************************************************
  function DelFullStyle($cesta) //smaze soubory ze slozky stylu
  {
    $this->DelDirFile("{$cesta}"); //rekurentni mazani nevyhovujicich s
    @rmdir("{$cesta}"); //smaze samotnou
  }
//******************************************************************************
  function ListingImport($style)  //vypis importu dle daneho stylu - vykreslovane ajaxem - GET -> POST
  {
    if (!Empty($_POST["id"]))
    {
      $this->PosunPoradi($_POST["id"], $_POST["smer"], $_POST["poradi"]);
    }

    $slozka = $this->VypisNazevSlozky($style);  //slozka stylu
    $nazev = $this->VypisNazevStylu($style);

    $result .=
    "
<p class=\"defaultni_import prvni_import_default\">
  Výpis importů ve stylu s názvem: <cite>{$nazev}</cite>
</p>
<p class=\"defaultni_import\">
  /* import resetu */
  @import url(\"styles/reset.css\");
</p>
<p class=\"defaultni_import\">
  /* import styles */
  @import url(\"styles/styles.css\");
</p>
<p class=\"defaultni_import\">
  /* import pripon */
  @import url(\"ajax.php?action=csspripony\");
</p>
";

    if ($res = @$this->var->sqlite->query("SELECT id,
                                          styles,
                                          cesta,
                                          poradi
                                          FROM importy
                                          WHERE styles={$style}
                                          ORDER BY importy.poradi ASC;
                                          ", NULL, $error))
    {
      $poc = $res->numRows();
      if ($res->numRows() != 0)
      {
        $i = 0;
        while($data = $res->fetchObject())
        {
          $result .=
          "
<p>
  <span class=\"border_vlevo\" title=\"Pořadí importů\">{$data->poradi}</span>
  <span title=\"Identické číslo importu\">{$data->id}</span>
  <span class=\"nazev_importu\" title=\"{$data->cesta}\"><a href=\"{$this->var->stylesdir}/{$slozka}/{$data->cesta}\" title=\"{$this->var->stylesdir}/{$slozka}/{$data->cesta}\">{$this->var->stylesdir}/{$slozka}/{$data->cesta}</a></span>
  ".($i != 0 ? "<a href=\"#\" onclick=\"PresunStyl({$style}, {$data->id}, 'up', {$data->poradi}); return false;\" class=\"posunout_import_nahoru\" title=\"Posunout import o jednu úroveň výš\"></a>" : "<em class=\"posunout_import_nahoru_neaktivni\" title=\"Nelze posunout import o úroveň výš\"></em>")."
  ".($i != ($poc - 1) ? "<a href=\"#\" onclick=\"PresunStyl({$style}, {$data->id}, 'down', {$data->poradi}); return false;\" class=\"posunout_import_dolu\" title=\"Posunout import o jednu úroveň níž\"></a>" : "<em class=\"posunout_import_dolu_neaktivni\" title=\"Nelze posunout import o úroveň níž\"></em>")."
  <a href=\"?action=editimport&amp;style={$_POST["style"]}&amp;cislo={$data->id}\" class=\"upravit_import\" title=\"Upravit\"></a>
  <a href=\"?action=delimport&amp;style={$_POST["style"]}&amp;cislo={$data->id}\" class=\"smazat_import\" title=\"Smazat\"></a>
</p>
          ";
          $cesta[$i] = "{$this->var->stylesdir}/{$slozka}/{$data->cesta}";
          $i++;
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $navic = (!Empty($cesta) ? $this->DiffImport($style, $cesta) : 0);
    $result .= "
<div id=\"vypis_info_uzivatele_hlavni_vypis\">
  <p>
    Celkem importů: <em>{$poc}</em>
  </p>
  <p class=\"neborder\">
    Počet importů navíc: <em>{$navic}</em>
  </p>
</div>
              ";

    return $result;
  }
//******************************************************************************
  function PosunPoradi($id, $smer, $poradi) //posouva prioritu importu
  {
    $style = $_POST["style"];
    settype($style, "integer");
    if ($res = @$this->var->sqlite->query("SELECT id,
                                          poradi
                                          FROM importy
                                          WHERE styles={$style}
                                          ORDER BY importy.poradi ASC;
                                          ", NULL, $error))
    {
      $poc = $res->numRows();
      if ($res->numRows() != 0)
      {
        while($data = $res->fetchObject())
        {
          $pora[$data->id] = $data->poradi;
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $key = array_keys($pora); //pole klicu
    $flipkey = array_flip($key);  //pole klicu jako hodnot

    switch ($smer)
    {
      case "up":
        $cid1 = $key[$flipkey[$id]];
        $cid2 = $key[$flipkey[$id] - 1];

        $mezi = $pora[$cid1]; // 2-->mezi
        $pora[$cid1] = $pora[$cid2];  // 1-->2
        $pora[$cid2] = $mezi; // mezi-->1

        if (!@$this->var->sqlite->queryExec("UPDATE importy SET poradi='{$pora[$cid1]}' WHERE id={$cid1};
                                            UPDATE importy SET poradi='{$pora[$cid2]}' WHERE id={$cid2};", $error))
        {
          $this->ErrorMsg($error);
        }
      break;

      case "down":
        $cid1 = $key[$flipkey[$id]];
        $cid2 = $key[$flipkey[$id] + 1];

        $mezi = $pora[$cid1]; // 1-->mezi
        $pora[$cid1] = $pora[$cid2];  // 2-->1
        $pora[$cid2] = $mezi; // mezi-->2

        if (!@$this->var->sqlite->queryExec("UPDATE importy SET poradi='{$pora[$cid1]}' WHERE id={$cid1};
                                            UPDATE importy SET poradi='{$pora[$cid2]}' WHERE id={$cid2};", $error))
        {
          $this->ErrorMsg($error);
        }
      break;
    }

    return $result;
  }
//******************************************************************************
  function PocetInputu($jmeno, $smer, $pocet)
  {
    if ($pocet > 0)
    {
      switch ($smer)
      {
        case "true":
          $pocet++;
        break;

        case "false":
          $pocet--;
        break;
      }
    }
      else
    {
      $pocet = 1;
    }

    $vysl = ($pocet == 0 ? "{$pocet} inputů typu: <em>file</em>" : ($pocet == 1 ? "{$pocet} input typu: <em>file</em>" : ($pocet >= 2 && $pocet <= 4 ? "{$pocet} inputy typu: <em>file</em>" : "{$pocet} inputů typu: <em>file</em>")));
    $result =
    "
      <dl id=\"label_input_pocet_inputu\">
        <dt>
          {$vysl}
        </dt>
        <dd>
          <a href=\"#\" id=\"pridat_input_file\" onclick=\"PocetInput('soubory[]', true); return false;\" title=\"Přidat input type file\"><span>Přidat input</span></a>
          ".($pocet == 1 ? "<a href=\"#\" id=\"odebrat_input_file\" onclick=\"return false;\" title=\"Odebrat input type file\"><span>Odebrat input</span></a>" :
                           "<a href=\"#\" id=\"odebrat_input_file\" onclick=\"PocetInput('soubory[]', false); return false;\" title=\"Odebrat input type file\"><span>Odebrat input</span></a>")."
        </dd>
      </dl>
      <input type=\"hidden\" id=\"poci\" name=\"poci\" value=\"{$pocet}\" />
    "; //  <input type=\"hidden\" id=\"poci\" name=\"poci\" value=\"{$pocet}\" />

    for ($i = 0; $i < $pocet; $i++)
    {
      $result .=
      "
      <dl>
        <dt>
          <label for=\"cesta_k_obrazk_label_input_".($i + 1)."\">Cesta k obrázku (".($i + 1)."):</label>
        </dt>
        <dd>
          <input type=\"file\" id=\"cesta_k_obrazk_label_input_".($i + 1)."\" name=\"{$jmeno}\" />
        </dd>
      </dl>
      ";
    }

    return $result;
  }
//******************************************************************************
  function AddImport()  //prida import
  {
    $jmeno = $_FILES["soubor"]["name"];
    $tmp = $_FILES["soubor"]["tmp_name"]; //source
    $style = $_GET["style"];
    settype($style, "integer");
    $slozka = $this->VypisNazevSlozky($style);
    $cil = "{$this->var->stylesdir}/{$slozka}/{$jmeno}";  //destination

    if (file_exists($cil))  //kontrola duplicity
    {
      $a = explode(".", $jmeno);
      $jmeno = "{$a[0]}_".rand().".{$a[count($a) - 1]}";
      $cil = "{$this->var->stylesdir}/{$slozka}/{$jmeno}";  //destination
    }

    $errnum = $_FILES["soubor"]["error"];
    $tlacitko = stripslashes(htmlspecialchars($_POST["tlacitko"])); //*
    $a = explode(".", $jmeno);
    $pripona = strtolower($a[count($a) - 1]);

    if ($pripona == "css" &&
        $style != 0 &&
        !Empty($tlacitko))
    {
      if (move_uploaded_file($tmp, $cil))
      {
        if (@$this->var->sqlite->queryExec("INSERT INTO importy (id, styles, cesta, poradi) VALUES (NULL, {$style}, '{$jmeno}', 0);", $error))
        {
          $result =
          "
                  <div id=\"nacitani_central\" title=\"Byl nahrán CSS soubor s názvem: {$jmeno}\">
                    <p>
                      Byl nahrán CSS soubor s názvem: <em>{$jmeno}</em>
                    </p>
                  </div>
          ";

          $id = $this->var->sqlite->lastInsertRowid();  //uprava cisla poradi
          if (!@$this->var->sqlite->queryExec("UPDATE importy SET poradi='{$id}'
                                                                  WHERE
                                                                  id={$id};", $error))
          {
            $this->ErrorMsg($error);
          }

          $this->var->main->AutoClick(2, "?action=import&style={$style}");  //auto kliknuti
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }
        else
      {
        $result = "
                  <div id=\"nacitani_central\" title=\"Nastala chyba při nahrávání CSS souboru: {$errnum}\">
                    <p>
                      Nastala chyba při nahrávání CSS souboru: <em>{$errnum}</em>
                    </p>
                  </div>
                  ";
        $this->var->main->AutoClick(2, "?action=import&style={$style}");  //auto kliknuti
      }
    }
      else
    {
      if (!Empty($tlacitko) &&
          !Empty($tmp))
      {
        $result = "
                  <div id=\"nacitani_central\" title=\"Typ souboru musí být CSS\">
                    <p>
                      Typ souboru musí být CSS
                    </p>
                  </div>
        ";
        $this->var->main->AutoClick(2, "?action=import&style={$style}");  //auto kliknuti
      }
    }

    if (!file_exists("{$this->var->vzhleddir}/{$slozka}"))  //vytvori soubor pokud neexistuje
    {
      $a = explode("/", $this->var->vzhleddir);
      @chmod($a[0], 0777);  //nastaveni prava u 1.urovne
      @mkdir("{$this->var->vzhleddir}/{$slozka}");
      @chmod("{$this->var->vzhleddir}/{$slozka}", 0777); //zmeni prava pristupu
    }

    $multi = $_FILES["soubory"];
    if (count($multi["name"]) != 0)
    {
      for ($i = 0; $i < count($multi["name"]); $i++)
      {
        $jmeno = $multi["name"][$i];
        if (!Empty($jmeno))
        {
          $tmp = $multi["tmp_name"][$i]; //source
          $cil = "{$this->var->vzhleddir}/{$slozka}/{$jmeno}";  //destination

          if (file_exists($cil))  //kontrola duplicity
          {
            $a = explode(".", $jmeno);
            $jmeno = "{$a[0]}_".rand().".{$a[count($a) - 1]}";
            $cil = "{$this->var->vzhleddir}/{$slozka}/{$jmeno}";  //destination
          }

          $errnum = $multi["error"][$i];

          if (move_uploaded_file($tmp, $cil))
          {
            $result .= "
                  <div id=\"nacitani_central\" title=\"Byl nahrán obrázek s názvem: {$jmeno}\">
                    <p>
                      Byl nahrán obrázek s názvem: <em>{$jmeno}</em>
                    </p>
                  </div>
                      ";
          }
            else
          {
            $result .= "
                  <div id=\"nacitani_central\" title=\"Nastala chyba při nahrávání obrázku: {$errnum}\">
                    <p>
                      Nastala chyba při nahrávání obrázku: <em>{$errnum}</em>
                    </p>
                  </div>
                      ";
          }
        } //end if
      } //end for
      $this->var->main->AutoClick(2, "?action=import&style={$style}");  //auto kliknuti
    }

    return $result;
  }
//******************************************************************************
  function ReturnValueImport(&$cesta) //vraceni hodnoty nazvu daneho importu
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->sqlite->query("SELECT cesta FROM importy WHERE id={$id};", NULL, $error))
      {
        $data = $res->fetchObject();
        $cesta = $data->cesta;
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }
  }
//******************************************************************************
  function EditImport() //editace importu
  {
    $pripona = $_POST["pripona"];
    $nazev = stripslashes(htmlspecialchars($_POST["nazev"])); //*
    $oldnazev = "{$_POST["oldnazev"]}.{$pripona}";  //stary nazev
    $style = $_POST["style"];
    settype($style, "integer");
    $slozka = $this->VypisNazevSlozky($style);
    $tlacitko = stripslashes(htmlspecialchars($_POST["tlacitko"])); //*

    $cesta = "{$this->var->stylesdir}/{$slozka}/{$nazev}.{$pripona}";
    if (file_exists($cesta))
    {
      $nazev = "{$nazev}_".rand();
    }

    $nazev = "{$nazev}.{$pripona}"; //spojen nazvu s priponou

    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($_POST["nazev"]) &&
        !Empty($slozka) &&
        !Empty($id) &&
        $id != 0 &&
        !Empty($tlacitko))
    {
      if (@$this->var->sqlite->queryExec ("UPDATE importy SET cesta='{$nazev}'
                                                              WHERE id={$id};", $error))
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Byl upraven import s názvem: {$nazev}\">
                    <p>
                      Byl upraven import s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
        ";

        @rename("{$this->var->stylesdir}/{$slozka}/{$oldnazev}", "{$this->var->stylesdir}/{$slozka}/{$nazev}");
        @chmod("{$this->var->stylesdir}/{$slozka}/{$nazev}", 0777); //zmeni prava pristupu

        $this->var->main->AutoClick(2, "?action=import&style={$style}");  //auto kliknuti
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }

    return $result;
  }
//******************************************************************************
  function DelImport()  //smazani importu
  {
    $id = $_GET["cislo"];
    settype($id, "integer");
    $nazev = $_POST["nazev"]; //nazev
    $style = $_POST["style"]; //styl
    settype($style, "integer");
    $slozka = $this->VypisNazevSlozky($style);

    if (!Empty($_POST["ano"]) &&
        $id != 0)
    {
      if (@$this->var->sqlite->queryExec("DELETE FROM importy WHERE id={$id};", $error))
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Byl smazán import s názvem: {$nazev}\">
                    <p>
                      Byl smazán import s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
        ";

        @unlink("{$this->var->stylesdir}/{$slozka}/{$nazev}");

        $this->var->main->AutoClick(2, "?action=import&style={$style}");  //auto kliknuti
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }
      else
    {
      if (!Empty($_POST["ne"]))
      {
        $result =
        "
                  <div id=\"nacitani_central\" title=\"Smazání importu s názvem: {$nazev} bylo stornováno\">
                    <p>
                      Smazání importu s názvem: <em>{$nazev}</em> bylo stornováno
                    </p>
                  </div>
        ";
        $this->var->main->AutoClick(2, "?action=import&style={$style}");  //auto kliknuti
      }
    }

    return $result;
  }
//******************************************************************************
  function ListingSelectedStyle(&$hlaska) //vypis zvoleneho stylu
  {
    if ($res = @$this->var->sqlite->query ("SELECT id,
                                            nazev
                                            FROM styles
                                            ORDER BY LOWER(styles.nazev) ASC;
                                            ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result =
        "
<div id=\"zapati_vyber_styl\">
  <form method=\"post\" action=\"\">
    <fieldset>
      <dl>
        <dt></dt>
        <dd>
          <strong>--- <span>Vyber styl</span> ---</strong>
          <span class=\"vyber_slozku_obal\">
            <em></em>
        ";
        while($data = $res->fetchObject())
        {
          $result .=
          "
              <span class=\"vyber_slozku_polozku\" onclick=\"NastavRadio('selstyl{$data->id}', true);\">
                <input type=\"radio\" id=\"selstyl{$data->id}\" name=\"setstyle\" value=\"{$data->id}\"".($data->id == $this->var->style ? " checked=\"checked\"" : "")." />
                <span>{$data->nazev}</span>
              </span>
          ";
          $nazev[$data->id] = $data->nazev;
        }
        $result .=
        "
            <em id=\"background_spodek_vyber_styl\"></em>
          </span>
        </dd>
      </dl>
      <input id=\"tl_zmenit_styl\" title=\"Změnit styl\" type=\"submit\" name=\"tlacitko\" value=\"&nbsp;\" />
    </fieldset>
  </form>
</div>
        ";
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $setstyle = $_POST["setstyle"];
    settype($setstyle, "integer");

    if (!Empty($_POST["tlacitko"]) &&
        !Empty($setstyle))
    {
      if (@$this->var->sqlite->queryExec("UPDATE uzivatel SET style={$setstyle}
                                                              WHERE id={$this->var->iduser};", $error))
      {
        $hlaska =
        "
                  <div id=\"nacitani_central_fixni\" title=\"Byl nastaven styl: {$nazev[$setstyle]}\">
                    <p>
                      Byl nastaven styl: <em>{$nazev[$setstyle]}</em>
                    </p>
                  </div>
        ";
      }
        else
      {
        $this->ErrorMsg($error);
      }

      $this->var->main->AutoClick(2, "./");  //auto kliknuti
    }

    return $result;
  }
//******************************************************************************
  function ViewCSS($style) //zabrazi dany styl
  {
    header("Content-type: text/css; charset=UTF-8");

    $result =
    "/* import resetu */
@import url(\"styles/reset.css\");\n
/* import styles */
@import url(\"styles/styles.css\");\n
/* import pripon */
@import url(\"ajax.php?action=csspripony\");\n
/* import ostatnich stylu */\n";

    $slozka = $this->VypisNazevSlozky($style);  //slozka stylu

    if ($res = @$this->var->sqlite->query("SELECT
                                          cesta
                                          FROM importy
                                          WHERE styles={$style}
                                          ORDER BY importy.poradi ASC;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while($data = $res->fetchObject())
        {
          $result .=
          "@import url(\"{$this->var->stylesdir}/{$slozka}/{$data->cesta}\");\n";
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $result .=
    "\n/* Design by Fugess (Martin) */
/* Programming by Geniv */";

    return $result;
  }
//******************************************************************************
  function ViewCssPripony() //vypis css pripon
  {
    header("Content-type: text/css; charset=UTF-8");

    $result =
    "";

    if ($res = @$this->var->sqlite->query("SELECT
                                          pripona,
                                          trida
                                          FROM pripony
                                          ORDER BY pripony.nazev ASC;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while($data = $res->fetchObject())
        {
          $result .=
          "#obal_layout .prihlasen_sekce #vypis_hlavni_strany p a.{$data->trida} span,
#obal_layout .prihlasen_sekce #vypis_pripon p strong.{$data->trida} span {
  background: url({$this->var->priponydir}/{$data->pripona}.png) no-repeat left center;\n}\n\n";
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $result .=
    "/* Design by Fugess (Martin) */
/* Programming by Geniv */";

    return $result;
  }
//******************************************************************************
  function ListingDirVzhled($style, &$hlaska) //vypise jen cisty obsah slozky
  {
    $j = 0;
    $slozka = $this->VypisNazevSlozky($style);
    $cesta = "{$this->var->vzhleddir}/{$slozka}";
    $handle = opendir($cesta);
    $nazev = $this->VypisNazevStylu($style);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $soubor[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    $result .=
    "<div id=\"list_import\"></div>
<p class=\"defaultni_import prvni_import_default\" id=\"mazani_obrazku\">
  <a href=\"?action={$_GET["action"]}&amp;style={$_GET["style"]}&amp;delall=true\" title=\"Smazat všechny obrázky ve stylu s názvem: {$nazev}\">Smazat všechny obrázky ve stylu s názvem: <cite>{$nazev}</cite><span></span></a>
</p>
    ";

    for ($i = 0; $i < count($soubor); $i++) //vypis slozky cyklem
    {
      $result .= "
      <p class=\"import_obrazky\">
        <span class=\"nazev_obrazku\"><a href=\"{$cesta}/{$soubor[$i]}\" title=\"{$cesta}/{$soubor[$i]}\">{$soubor[$i]}</a></span>
        <a href=\"?action={$_GET["action"]}&amp;style={$_GET["style"]}&amp;file={$soubor[$i]}\" class=\"smazat_import\" title=\"Smazat obrázek: {$soubor[$i]}\"></a>
      </p>
      ";
    }

    //hromadne mazani
    if (!Empty($_GET["delall"]))
    {
      $result = "";
      $hlaska =
  "
<div id=\"smazat_slozku_soubor\"".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "").">
  <p>
    Chystáš se smazat všechny obrázky ve stylu s názvem:
  </p>
  <p>
    <strong>{$nazev}</strong>
  </p>
  <p>
    Opravdu chceš všechny obrázky v tomto stylu smazat ?
  </p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <input id=\"tlacitko_ok\" type=\"submit\" value=\"Ano\" name=\"ano\" title=\"Ano\" />
      <input id=\"tlacitko_no\" type=\"submit\" value=\"Ne\" name=\"ne\" title=\"Ne\" />
    </fieldset>
  </form>
</div>
  ";
    }

    if (!Empty($_POST["ano"]) &&
        !Empty($_GET["delall"]))
    {
      $result = "";
      $hlaska =
              "
                  <div id=\"nacitani_central\" title=\"Byly smazány všechny obrázky ze stylu s názvem: {$nazev}\">
                    <p>
                      Byly smazány všechny obrázky ze stylu s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
              ";

      $handle = opendir($cesta);
      while($soub = readdir($handle))
      {
        if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
        {
          @unlink("{$this->var->vzhleddir}/{$slozka}/{$soub}");
        }
      }
      closedir($handle);

      $this->var->main->AutoClick(2, "?action=import&amp;style={$_GET["style"]}");  //auto kliknuti
    }
      else
    {
      if (!Empty($_POST["ne"]) &&
          !Empty($_GET["delall"]))
      {
        $result = "";
        $hlaska =
        "
                  <div id=\"nacitani_central\" title=\"Smazání všech obrázků ze stylu s názvem: {$nazev} bylo stornováno\">
                    <p>
                      Smazání všech obrázků ze stylu s názvem: <em>{$nazev}</em> bylo stornováno
                    </p>
                  </div>
        ";
        $this->var->main->AutoClick(2, "?action=import&amp;style={$_GET["style"]}");  //auto kliknuti
      }
    }

    //jednotlive mazani
    $nazev = $_GET["file"];
    if (!Empty($nazev))
    {
      $result = "";
      $hlaska =
  "
<div id=\"smazat_slozku_soubor\"".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "").">
  <p>
    Chystáš se smazat obrázek s názvem:
  </p>
  <p>
    <strong>{$nazev}</strong>
  </p>
  <p>
    Opravdu chceš tento obrázek smazat ?
  </p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <input id=\"tlacitko_ok\" type=\"submit\" value=\"Ano\" name=\"ano\" title=\"Ano\" />
      <input id=\"tlacitko_no\" type=\"submit\" value=\"Ne\" name=\"ne\" title=\"Ne\" />
      <input type=\"hidden\" value=\"{$nazev}\" name=\"nazev\" />
    </fieldset>
  </form>
</div>
  ";
    }

    if (!Empty($_POST["ano"]) &&
        !Empty($_POST["nazev"]))
    {
      $result = "";
      $hlaska =
              "
                  <div id=\"nacitani_central\" title=\"Byl smazán obrázek s názvem: {$nazev}\">
                    <p>
                      Byl smazán obrázek s názvem: <em>{$nazev}</em>
                    </p>
                  </div>
              ";

      @unlink("{$this->var->vzhleddir}/{$slozka}/{$nazev}");

      $this->var->main->AutoClick(2, "?action=import&amp;style={$_GET["style"]}");  //auto kliknuti
    }
      else
    {
      if (!Empty($_POST["ne"]) &&
        !Empty($_POST["nazev"]))
      {
        $result = "";
        $hlaska =
        "
            <div id=\"nacitani_central\" title=\"Smazání obrázku s názvem: {$nazev} bylo stornováno\">
              <p>
                Smazání obrázku s názvem: <em>{$nazev}</em> bylo stornováno
              </p>
            </div>
        ";
        $this->var->main->AutoClick(2, "?action=import&amp;style={$_GET["style"]}");  //auto kliknuti
      }
    }

    return $result;
  }
//******************************************************************************
//******************************************************************************
/*
          $result .=
          "
  <p".((fmod($i + 1, 10) == 0) || ($i == ($poc - 1)) ? " class=\"neborder\"" : "").">
    <em class=\"vypis_sdileni_polozka\" title=\"\">
      <span></span>
      {$data->jmeno}
    <a href=\"#\" onclick=\"Sdileni({$data->id}, ".(!Empty($do) ? "{$do}" : "0")."); return false;\" class=\"sdileni_od_uzivatele\" title=\"Uživatel: {$data->jmeno} bude sdílet složky pro vybraného uživatele\"></a>

    ".(!Empty($od) && $od != $data->id ? "
    <a href=\"#\" onclick=\"Sdileni(".(!Empty($od) ? "{$od}" : "0").", {$data->id}); return false;\" class=\"sdileni_uzivateli\" title=\"Uživatel: {$data->jmeno} uvidí nasdílené složky od: {$this->ReturnValueUserName($od)}\"></a>
    " : "")."

    </em>
  </p>
  ".((fmod($i + 1, 10) == 0) && ($i != ($poc - 1)) ? "
  <span class=\"linka_vypis\"></span>
  " : "")."
          ";
*/
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
  function AjaxNastaveniSdileni()
  {
    $od = $_POST["od"];  //vypis rozcestniku
    settype($od, "integer");
    $slozka = $_POST["slozka"];
    settype($slozka, "integer");
    $podslozka = $_POST["podslozka"];
    settype($podslozka, "integer");
    $do = $_POST["pro"];
    settype($do, "integer");
    $hodnota = $_POST["hodnota"];
//dodelat...  mus se dynamicky generovat iypis sdileni, smozne rozdeleni - uz je, vypis slozek
    if (!Empty($od) && //ukladani
        !Empty($do))
    {
      switch ($hodnota)
      {
        case "true":  //pridani
          if ($res1 = @$this->var->sqlite->query("SELECT sdileni.id, uzivatel_ma_sdileni.sdileni FROM sdileni, uzivatel_ma_sdileni WHERE
                                                  sdileni.uzivatel={$od} AND
                                                  sdileni.slozka={$slozka} AND
                                                  sdileni.podslozka={$podslozka} AND
                                                  uzivatel_ma_sdileni.uzivatel={$do} AND
                                                  sdileni.id=uzivatel_ma_sdileni.sdileni;
                                                  ", NULL, $error))
          {
            if ($res1->numRows() == 0)
            {
              if (@$this->var->sqlite->queryExec("INSERT INTO sdileni (id, uzivatel, slozka, podslozka) VALUES (NULL, {$od}, {$slozka}, {$podslozka});", $error))  //co ->
              {
                $id = $this->var->sqlite->lastInsertRowid();  //nacte pridane ID
                if (!@$this->var->sqlite->queryExec("INSERT INTO uzivatel_ma_sdileni (id, uzivatel, sdileni) VALUES (NULL, {$do}, {$id});", $error))  //ulozi pro koho jake id slozek, -> pro koho
                {
                  $this->ErrorMsg($error);
                }
              }
                else
              {
                $this->ErrorMsg($error);
              }
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }

          $result = "přidáno sdílení ($od $slozka $podslozka $do $hodnota)";
          //"
          //    <div id=\"nacitani_central\" title=\"Bylo přidáno sdílení od: {$this->ReturnValueUserName($od)} pro: {$this->ReturnValueUserName($do)}\">
          //      <p>
          //        Bylo přidáno sdílení od: <em>{$this->ReturnValueUserName($od)}</em> pro: <em>{$this->ReturnValueUserName($do)}</em>
          //      </p>
          //    </div>
          //";

        break;

        case "false": //smazani
          if ($res = @$this->var->sqlite->query("SELECT id
                                                FROM sdileni
                                                WHERE
                                                uzivatel={$od} AND
                                                slozka={$slozka} AND
                                                podslozka={$podslozka};
                                                ", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $id = $res->fetchObject()->id;
              if (@$this->var->sqlite->queryExec("DELETE FROM sdileni WHERE id={$id}", $error))  //co ->
              {
                if ($res1 = @$this->var->sqlite->query("SELECT id
                                                      FROM uzivatel_ma_sdileni
                                                      WHERE
                                                      uzivatel={$do} AND
                                                      sdileni={$id};
                                                      ", NULL, $error))
                {
                  if ($res1->numRows() == 1)
                  {
                    $id1 = $res1->fetchObject()->id;
                    if (@$this->var->sqlite->queryExec("DELETE FROM uzivatel_ma_sdileni WHERE id={$id1}", $error))  //co ->
                    {
                      $result = "odebráno sdílení ($od $slozka $podslozka $do $hodnota)";
                    }
                      else
                    {
                      $this->ErrorMsg($error);
                    }
                  }
                }
                  else
                {
                  $this->ErrorMsg($error);
                }
              }
                else
              {
                $this->ErrorMsg($error);
              }
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }


        break;
      }
    }

    //$result = "$od $slozka $podslozka $do $hodnota";

    return $result;
  }
//******************************************************************************
  function AjaxVypisUzivateluSdileni()  //vypis sdileni pres ajax
  {
    $od = $_POST["od"];  //vypis rozcestniku
    settype($od, "integer");
    $do = $_POST["pro"];
    settype($do, "integer");

    if ($res = @$this->var->sqlite->query("SELECT id, jmeno FROM uzivatel ORDER BY LOWER(uzivatel.jmeno) ASC;", NULL, $error))
    {
      if (($poc = $res->numRows()) != 0)
      {
        $i = 0;
        while ($data = $res->fetchObject())
        {
          $result .=
          "
  <p".((fmod($i + 1, 10) == 0) || ($i == ($poc - 1)) ? " class=\"neborder\"" : "").">
    <em class=\"vypis_sdileni_polozka\" title=\"\">
      <span></span>
      {$data->jmeno}
    <a href=\"#\" onclick=\"Sdileni({$data->id}, ".(!Empty($do) ? "{$do}" : "0")."); return false;\" class=\"sdileni_od_uzivatele\" title=\"Uživatel: {$data->jmeno} bude sdílet složky pro vybraného uživatele\"></a>
    ".(!Empty($od) && $od != $data->id ? "
    <a href=\"#\" onclick=\"Sdileni(".(!Empty($od) ? "{$od}" : "0").", {$data->id}); return false;\" class=\"sdileni_uzivateli\" title=\"Uživatel: {$data->jmeno} uvidí nasdílené složky od: {$this->ReturnValueUserName($od)}\"></a>
    " : "")."
    </em>
  </p>
  ".((fmod($i + 1, 10) == 0) && ($i != ($poc - 1)) ? "
  <span class=\"linka_vypis\"></span>
  " : "");

          /*
          ?action={$_GET["action"]}&amp;od={$data->id}".(!Empty($do) ? "&amp;do={$do}" : "")."
          ?action={$_GET["action"]}".(!Empty($od) ? "&amp;od={$od}" : "")."&amp;do={$data->id}
          */

          $i++;
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }
/*
    $id = $_GET["id"];
    settype($id, "integer");
    $ida = $_GET["ida"];
    settype($ida, "integer");

    if (!Empty($id) &&  //smazani
        $id != 0 &&
        !Empty($ida) &&
        $ida != 0)
    {
      $hlaska =
      "
<div id=\"smazat_slozku_soubor\"".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "").">
  <p>
    Chystáš se smazat sdílení:
  </p>
  <p>
    <strong>{$id} - {$ida}</strong>
  </p>
  <p>
    Opravdu chceš toto sdílení smazat ?
  </p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <input id=\"tlacitko_ok\" type=\"submit\" value=\"Ano\" name=\"ano\" title=\"Ano\" />
      <input id=\"tlacitko_no\" type=\"submit\" value=\"Ne\" name=\"ne\" title=\"Ne\" />
    </fieldset>
  </form>
</div>
  ";

      if (!Empty($_POST["ano"]) &&
          !Empty($id) &&  //smazani
          $id != 0 &&
          !Empty($ida) &&
          $ida != 0)
      {
        if (@$this->var->sqlite->queryExec("DELETE FROM sdileni WHERE id={$id};
                                            DELETE FROM uzivatel_ma_sdileni WHERE id={$ida};", $error))
        {
          $hlaska = "
            <div id=\"nacitani_central\" title=\"Sdílení: {$id} - {$ida} bylo smazáno\">
              <p>
                Sdílení: <em>{$id} - {$ida}</em> bylo smazáno
              </p>
            </div>
          ";
          $this->var->main->AutoClick(2, "?action=setright");  //auto kliknuti
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }
        else
      {
        if (!Empty($_POST["ne"]))
        {
          $hlaska =
          "
            <div id=\"nacitani_central\" title=\"Smazání sdílení: {$id} - {$ida} bylo stornováno\">
              <p>
                Smazání sdílení: <em>{$id} - {$ida}</em> bylo stornováno
              </p>
            </div>
          ";
          $this->var->main->AutoClick(2, "?action=setright");  //auto kliknuti
        }
      }
    }
*/
    if (!Empty($od) &&  //ukladani formy
        $od != 0 &&
        !Empty($do) &&
        $do != 0 &&
        $od != $do)
    {
      if ($res = @$this->var->sqlite->query("SELECT
                                            sdileni.uzivatel as uzivatel
                                            FROM sdileni, uzivatel_ma_sdileni WHERE
                                            sdileni.id=uzivatel_ma_sdileni.sdileni AND
                                            sdileni.uzivatel={$od} AND
                                            uzivatel_ma_sdileni.uzivatel={$do} AND
                                            sdileni.slozka=0 AND
                                            sdileni.podslozka=0;
                                            ", NULL, $error))
      {
        if ($res->numRows() == 1)
        {
          $data = $res->fetchObject();
          $kor = $data->uzivatel;
        }
      }
        else
      {
        $this->ErrorMsg($error);
      }

      $hlaska .=
      "
<div id=\"pridat_sdileni\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <p>
        &raquo; Nastavení sdílení od: <em>{$this->ReturnValueUserName($od)}</em> pro: <em>{$this->ReturnValueUserName($do)}</em>
      </p>
      <div>
        <span>
          --- Vyber složku / složky ---
        </span>
        <dl>
          <dt><input type=\"checkbox\" id=\"seldirshere0\" onclick=\"NastaveniSdileni({$od}, 0, 0, {$do}, seldirshere0'); return false;\"".($od == $kor ? " checked=\"checked\"" : "")." /></dt>
          <dd onclick=\"NastavCheckBox('seldirshere0'); NastaveniSdileni({$od}, 0, 0, {$do}, 'seldirshere0'); return false;\">Kořenový adresář</dd>
      ";//value=\"{$od}\" name=\"sdileni[]\"

      if ($res = @$this->var->sqlite->query("SELECT id, nazev FROM slozka WHERE uzivatel={$od} ORDER BY LOWER(nazev) ASC;", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          while ($data = $res->fetchObject())
          {
            if ($res2 = @$this->var->sqlite->query("SELECT
                                                    sdileni.uzivatel as uzivatel,
                                                    sdileni.slozka as slozka
                                                    FROM sdileni, uzivatel_ma_sdileni WHERE
                                                    sdileni.id=uzivatel_ma_sdileni.sdileni AND
                                                    sdileni.uzivatel={$od} AND
                                                    uzivatel_ma_sdileni.uzivatel={$do} AND
                                                    sdileni.slozka={$data->id} AND
                                                    sdileni.podslozka=0;
                                                    ", NULL, $error))
            {
              if ($res2->numRows() == 1)
              {
                $data2 = $res2->fetchObject();
                $slo = "{$data2->uzivatel}-{$data2->slozka}";
              }
            }
              else
            {
              $this->ErrorMsg($error);
            }

            $hlaska .=
            "
          <dt><input type=\"checkbox\" id=\"seldirshere{$data->id}\" onclick=\"NastaveniSdileni({$od}, {$data->id}, 0, {$do}, 'seldirshere{$data->id}'); return false;\"".("{$od}-{$data->id}" == $slo ? " checked=\"checked\"" : "")." /></dt>
          <dd onclick=\"NastavCheckBox('seldirshere{$data->id}'); NastaveniSdileni({$od}, {$data->id}, 0, {$do}, 'seldirshere{$data->id}'); return false;\">./{$data->nazev}</dd>
            ";  // name=\"sdileni[]\" value=\"{$od}-{$data->id}\"

            if ($res1 = @$this->var->sqlite->query("SELECT id, nazev FROM podslozka WHERE uzivatel={$od} AND slozka={$data->id} ORDER BY LOWER(nazev) ASC;", NULL, $error))
            {
              if ($res1->numRows() != 0)
              {
                while ($data1 = $res1->fetchObject())
                {
                  if ($res3 = @$this->var->sqlite->query("SELECT
                                                          sdileni.uzivatel as uzivatel,
                                                          sdileni.slozka as slozka,
                                                          sdileni.podslozka as podslozka
                                                          FROM sdileni, uzivatel_ma_sdileni WHERE
                                                          sdileni.id=uzivatel_ma_sdileni.sdileni AND
                                                          sdileni.uzivatel={$od} AND
                                                          uzivatel_ma_sdileni.uzivatel={$do} AND
                                                          sdileni.slozka={$data->id} AND
                                                          sdileni.podslozka={$data1->id};
                                                          ", NULL, $error))
                  {
                    if ($res3->numRows() == 1)
                    {
                      $data3 = $res3->fetchObject();
                      $poslo = "{$data3->uzivatel}-{$data3->slozka}-{$data3->podslozka}";
                    }
                  }
                    else
                  {
                    $this->ErrorMsg($error);
                  }

                  $hlaska .=
                  "
          <dt><input type=\"checkbox\" id=\"seldirshere{$data->id}-{$data1->id}\" onclick=\"NastaveniSdileni({$od}, {$data->id}, {$data1->id}, {$do}, 'seldirshere{$data->id}-{$data1->id}'); return false;\"".("{$od}-{$data->id}-{$data1->id}" == $poslo ? " checked=\"checked\"" : "")." /></dt>
          <dd onclick=\"NastavCheckBox('seldirshere{$data->id}-{$data1->id}'); NastaveniSdileni({$od}, {$data->id}, {$data1->id}, {$do}, 'seldirshere{$data->id}-{$data1->id}'); return false;\">./{$data->nazev}/{$data1->nazev}</dd>
                  ";  // name=\"sdileni[]\" value=\"{$od}-{$data->id}-\"

                }
              }
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }
        }
      }
        else
      {
        $this->ErrorMsg($error);
      }

      $hlaska .=
      "
        </dl>
      </div>
      <span id=\"pridat_sdileni_tl\">
        <input type=\"button\" onclick=\"Sdileni(0, 0);\" value=\"Přidat sdílení\" name=\"tlacitko\" />
      </span>
    </fieldset>
  </form>
</div>
      ";

      $result = $hlaska;

//predelat!! na jednotlive + zmena grafiky tlacitka!
/*
      if (!Empty($_POST["tlacitko"]) && //ukladani
          !Empty($_POST["sdileni"][0]))
      {
        for ($i = 0; $i < count($_POST["sdileni"]) ; $i++)
        {
          $hodnota = explode("-", $_POST["sdileni"][$i]); //uzivatel_ma_sdileni(do), sdileni (od); pro[do] koho co[do]
          settype($hodnota[0], "integer");  //od
          settype($hodnota[1], "integer");  //slozka
          settype($hodnota[2], "integer");  //podslozka

          if ($res1 = @$this->var->sqlite->query("SELECT sdileni.id, uzivatel_ma_sdileni.sdileni FROM sdileni, uzivatel_ma_sdileni WHERE
                                                  sdileni.uzivatel={$hodnota[0]} AND
                                                  sdileni.slozka={$hodnota[1]} AND
                                                  sdileni.podslozka={$hodnota[2]} AND
                                                  uzivatel_ma_sdileni.uzivatel={$do} AND
                                                  sdileni.id=uzivatel_ma_sdileni.sdileni;
                                                  ", NULL, $error))
          {
            if ($res1->numRows() == 0)
            {
              if (@$this->var->sqlite->queryExec("INSERT INTO sdileni (id, uzivatel, slozka, podslozka) VALUES (NULL, {$hodnota[0]}, {$hodnota[1]}, {$hodnota[2]});", $error))  //co ->
              {
                $id = $this->var->sqlite->lastInsertRowid();  //nacte pridane ID
                if (!@$this->var->sqlite->queryExec("INSERT INTO uzivatel_ma_sdileni (id, uzivatel, sdileni) VALUES (NULL, {$do}, {$id});", $error))  //ulozi pro koho jake id slozek, -> pro koho
                {
                  $this->ErrorMsg($error);
                }
              }
                else
              {
                $this->ErrorMsg($error);
              }
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }
        } //end for
        $result = "
            <div id=\"nacitani_central\" title=\"Bylo přidáno sdílení od: {$this->ReturnValueUserName($od)} pro: {$this->ReturnValueUserName($do)}\">
              <p>
                Bylo přidáno sdílení od: <em>{$this->ReturnValueUserName($od)}</em> pro: <em>{$this->ReturnValueUserName($do)}</em>
              </p>
            </div>
        ";
        //$this->var->main->AutoClick(2, "?action=setright");  //auto kliknuti
      }
*/
    }

    return $result;
  }
//******************************************************************************
  function ListingSetRight(&$hlaska)  //vypis nastaveni prava, "sdileni slozek"
  {
    if ($res = @$this->var->sqlite->query("SELECT
                                          sdileni.id as id,
                                          uzivatel_ma_sdileni.id as ida,
                                          u1.jmeno as od,
                                          u2.jmeno as pro,
                                          sdileni.slozka as slozka,
                                          sdileni.podslozka as podslozka
                                          FROM sdileni, uzivatel_ma_sdileni, uzivatel u1, uzivatel u2 WHERE
                                          sdileni.id=uzivatel_ma_sdileni.sdileni AND
                                          sdileni.uzivatel=u1.id AND
                                          uzivatel_ma_sdileni.uzivatel=u2.id
                                          ORDER BY (sdileni.uzivatel) DESC,
                                                   (uzivatel_ma_sdileni.uzivatel) ASC;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $slozka = $this->ZjistiNazevSlozky($data->slozka);
          $podslozka = $this->ZjistiNazevPodslozky($data->podslozka);
          $cesta = "{$this->var->userdir}/{$data->od}".($data->slozka != 0 ? "/{$slozka}" : "").($data->podslozka != 0 ? "/{$podslozka}" : "");

          if (substr($cesta, -1) == "/") //kontroluje zda cesta existuje, jnak ji smaze
          {
            $id = $data->id;
            settype($id, "integer");
            if (!@$this->var->sqlite->queryExec ("DELETE FROM sdileni WHERE id={$id};
                                                  DELETE FROM uzivatel_ma_sdileni WHERE sdileni={$id};", $error)) //potichu odmaze neexistujici slozky
            {
              $this->ErrorMsg($error);
            }
            $result .= "<span class=\"byla_odmazana_polozka\">Byla smazána položka s číslem: <em>{$id}</em></span>";
          }

          $result .=
          "
<strong>
  <span></span>
  <cite>
    {$data->od} sdílí složku pro: {$data->pro} <strong>&raquo;</strong> Kořenový adresář".($data->slozka != 0 ? "/{$slozka}" : "").($data->podslozka != 0 ? "/{$podslozka}" : "")."
  </cite>
  <a href=\"?action={$_GET["action"]}&amp;id={$data->id}&amp;ida={$data->ida}\" class=\"smazat_sdileni\" title=\"Smazat toto sdílení\"><code>Smazat toto sdílení</code></a>
</strong>
          ";
        } //end while
        $result .= "<span class=\"linka_vypis\"></span>";
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }
/*
    $od = $_GET["od"];  //vypis rozcestniku
    settype($od, "integer");
    $do = $_GET["do"];
    settype($do, "integer");

    if ($res = @$this->var->sqlite->query("SELECT id, jmeno FROM uzivatel ORDER BY LOWER(uzivatel.jmeno) ASC;", NULL, $error))
    {
      if (($poc = $res->numRows()) != 0)
      {
        $i = 0;
        while ($data = $res->fetchObject())
        {
          $result .=
          "
  <p".((fmod($i + 1, 10) == 0) || ($i == ($poc - 1)) ? " class=\"neborder\"" : "").">
    <em class=\"vypis_sdileni_polozka\" title=\"\">
      <span></span>
      {$data->jmeno}
    <a href=\"?action={$_GET["action"]}&amp;od={$data->id}".(!Empty($do) ? "&amp;do={$do}" : "")."\" class=\"sdileni_od_uzivatele\" title=\"Uživatel: {$data->jmeno} bude sdílet složky pro vybraného uživatele\"></a>

    ".(!Empty($od) && $od != $data->id ? "
    <a href=\"?action={$_GET["action"]}".(!Empty($od) ? "&amp;od={$od}" : "")."&amp;do={$data->id}\" class=\"sdileni_uzivateli\" title=\"Uživatel: {$data->jmeno} uvidí nasdílené složky od: {$this->ReturnValueUserName($od)}\"></a>
    " : "")."

    </em>
  </p>
  ".((fmod($i + 1, 10) == 0) && ($i != ($poc - 1)) ? "
  <span class=\"linka_vypis\"></span>
  " : "")."
          ";
          $i++;
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }
*/
    $id = $_GET["id"];
    settype($id, "integer");
    $ida = $_GET["ida"];
    settype($ida, "integer");

    if (!Empty($id) &&  //smazani
        $id != 0 &&
        !Empty($ida) &&
        $ida != 0)
    {
      $hlaska =
      "
<div id=\"smazat_slozku_soubor\"".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "").">
  <p>
    Chystáš se smazat sdílení:
  </p>
  <p>
    <strong>{$id} - {$ida}</strong>
  </p>
  <p>
    Opravdu chceš toto sdílení smazat ?
  </p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <input id=\"tlacitko_ok\" type=\"submit\" value=\"Ano\" name=\"ano\" title=\"Ano\" />
      <input id=\"tlacitko_no\" type=\"submit\" value=\"Ne\" name=\"ne\" title=\"Ne\" />
    </fieldset>
  </form>
</div>
  ";

      if (!Empty($_POST["ano"]) &&
          !Empty($id) &&  //smazani
          $id != 0 &&
          !Empty($ida) &&
          $ida != 0)
      {
        if (@$this->var->sqlite->queryExec("DELETE FROM sdileni WHERE id={$id};
                                            DELETE FROM uzivatel_ma_sdileni WHERE id={$ida};", $error))
        {
          $hlaska = "
            <div id=\"nacitani_central\" title=\"Sdílení: {$id} - {$ida} bylo smazáno\">
              <p>
                Sdílení: <em>{$id} - {$ida}</em> bylo smazáno
              </p>
            </div>
          ";
          $this->var->main->AutoClick(2, "?action=setright");  //auto kliknuti
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }
        else
      {
        if (!Empty($_POST["ne"]))
        {
          $hlaska =
          "
            <div id=\"nacitani_central\" title=\"Smazání sdílení: {$id} - {$ida} bylo stornováno\">
              <p>
                Smazání sdílení: <em>{$id} - {$ida}</em> bylo stornováno
              </p>
            </div>
          ";
          $this->var->main->AutoClick(2, "?action=setright");  //auto kliknuti
        }
      }
    }
/*
    if (!Empty($od) &&  //ukladani formy
        $od != 0 &&
        !Empty($do) &&
        $do != 0 &&
        $od != $do)
    {
      if ($res = @$this->var->sqlite->query("SELECT
                                            sdileni.uzivatel as uzivatel
                                            FROM sdileni, uzivatel_ma_sdileni WHERE
                                            sdileni.id=uzivatel_ma_sdileni.sdileni AND
                                            sdileni.uzivatel={$od} AND
                                            uzivatel_ma_sdileni.uzivatel={$do} AND
                                            sdileni.slozka=0 AND
                                            sdileni.podslozka=0;
                                            ", NULL, $error))
      {
        if ($res->numRows() == 1)
        {
          $data = $res->fetchObject();
          $kor = $data->uzivatel;
        }
      }
        else
      {
        $this->ErrorMsg($error);
      }

      $hlaska .=
      "
<div id=\"pridat_sdileni\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <p>
        &raquo; Nastavení sdílení od: <em>{$this->ReturnValueUserName($od)}</em> pro: <em>{$this->ReturnValueUserName($do)}</em>
      </p>
      <div>
        <span>
          --- Vyber složku / složky ---
        </span>
        <dl>
          <dt><input type=\"checkbox\" id=\"seldirshere0\" name=\"sdileni[]\" value=\"{$od}\"".($od == $kor ? " checked=\"checked\"" : "")." /></dt>
          <dd onclick=\"NastavRadio('seldirshere0', true);\">Kořenový adresář</dd>
      ";

      if ($res = @$this->var->sqlite->query("SELECT id, nazev FROM slozka WHERE uzivatel={$od} ORDER BY LOWER(nazev) ASC;", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          $r = 0;
          while ($data = $res->fetchObject())
          {
            if ($res2 = @$this->var->sqlite->query("SELECT
                                                    sdileni.uzivatel as uzivatel,
                                                    sdileni.slozka as slozka
                                                    FROM sdileni, uzivatel_ma_sdileni WHERE
                                                    sdileni.id=uzivatel_ma_sdileni.sdileni AND
                                                    sdileni.uzivatel={$od} AND
                                                    uzivatel_ma_sdileni.uzivatel={$do} AND
                                                    sdileni.slozka={$data->id} AND
                                                    sdileni.podslozka=0;
                                                    ", NULL, $error))
            {
              if ($res2->numRows() == 1)
              {
                $data2 = $res2->fetchObject();
                $slo = "{$data2->uzivatel}-{$data2->slozka}";
              }
            }
              else
            {
              $this->ErrorMsg($error);
            }

            $hlaska .=
            "
          <dt><input type=\"checkbox\" id=\"seldirshere{$data->id}\" name=\"sdileni[]\" value=\"{$od}-{$data->id}\"".("{$od}-{$data->id}" == $slo ? " checked=\"checked\"" : "")." /></dt>
          <dd onclick=\"NastavRadio('seldirshere{$data->id}', true);\">./{$data->nazev}</dd>
            ";

            if ($res1 = @$this->var->sqlite->query("SELECT id, nazev FROM podslozka WHERE uzivatel={$od} AND slozka={$data->id} ORDER BY LOWER(nazev) ASC;", NULL, $error))
            {
              if ($res1->numRows() != 0)
              {
                while ($data1 = $res1->fetchObject())
                {
                  if ($res3 = @$this->var->sqlite->query("SELECT
                                                          sdileni.uzivatel as uzivatel,
                                                          sdileni.slozka as slozka,
                                                          sdileni.podslozka as podslozka
                                                          FROM sdileni, uzivatel_ma_sdileni WHERE
                                                          sdileni.id=uzivatel_ma_sdileni.sdileni AND
                                                          sdileni.uzivatel={$od} AND
                                                          uzivatel_ma_sdileni.uzivatel={$do} AND
                                                          sdileni.slozka={$data->id} AND
                                                          sdileni.podslozka={$data1->id};
                                                          ", NULL, $error))
                  {
                    if ($res3->numRows() == 1)
                    {
                      $data3 = $res3->fetchObject();
                      $poslo = "{$data3->uzivatel}-{$data3->slozka}-{$data3->podslozka}";
                    }
                  }
                    else
                  {
                    $this->ErrorMsg($error);
                  }

                  $hlaska .=  //provizorni | L
                  "
          <dt><input type=\"checkbox\" id=\"seldirshere{$data->id}-{$data1->id}\" name=\"sdileni[]\" value=\"{$od}-{$data->id}-{$data1->id}\"".("{$od}-{$data->id}-{$data1->id}" == $poslo ? " checked=\"checked\"" : "")." /></dt>
          <dd onclick=\"NastavRadio('seldirshere{$data->id}-{$data1->id}', true);\">./{$data->nazev}/{$data1->nazev}</dd>
                  "; // ".(($res->numRows() - 1) != $r ? "|" : ".")."

                }
              }
            }
              else
            {
              $this->ErrorMsg($error);
            }
            $r++;
          }
        }
      }
        else
      {
        $this->ErrorMsg($error);
      }

      $hlaska .=
      "
        </dl>
      </div>
      <span id=\"pridat_sdileni_tl\">
        <input type=\"submit\" value=\"Přidat sdílení\" name=\"tlacitko\" />
      </span>
    </fieldset>
  </form>
</div>
      ";

      if (!Empty($_POST["tlacitko"]) && //ukladani
          !Empty($_POST["sdileni"][0]))
      {
        for ($i = 0; $i < count($_POST["sdileni"]) ; $i++)
        {
          $hodnota = explode("-", $_POST["sdileni"][$i]); //uzivatel_ma_sdileni(do), sdieleni (od); pro[do] koho co[do]
          settype($hodnota[0], "integer");  //od
          settype($hodnota[1], "integer");  //slozka
          settype($hodnota[2], "integer");  //podslozka

          if ($res1 = @$this->var->sqlite->query("SELECT sdileni.id, uzivatel_ma_sdileni.sdileni FROM sdileni, uzivatel_ma_sdileni WHERE
                                                  sdileni.uzivatel={$hodnota[0]} AND
                                                  sdileni.slozka={$hodnota[1]} AND
                                                  sdileni.podslozka={$hodnota[2]} AND
                                                  uzivatel_ma_sdileni.uzivatel={$do} AND
                                                  sdileni.id=uzivatel_ma_sdileni.sdileni;
                                                  ", NULL, $error))
          {
            if ($res1->numRows() == 0)
            {
              if (@$this->var->sqlite->queryExec("INSERT INTO sdileni (id, uzivatel, slozka, podslozka) VALUES (NULL, {$hodnota[0]}, {$hodnota[1]}, {$hodnota[2]});", $error))  //co ->
              {
                $id = $this->var->sqlite->lastInsertRowid();  //nacte pridane ID
                if (!@$this->var->sqlite->queryExec("INSERT INTO uzivatel_ma_sdileni (id, uzivatel, sdileni) VALUES (NULL, {$do}, {$id});", $error))  //ulozi pro koho jake id slozek, -> pro koho
                {
                  $this->ErrorMsg($error);
                }
              }
                else
              {
                $this->ErrorMsg($error);
              }
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }
        } //end for
        $hlaska = "
            <div id=\"nacitani_central\" title=\"Bylo přidáno sdílení od: {$this->ReturnValueUserName($od)} pro: {$this->ReturnValueUserName($do)}\">
              <p>
                Bylo přidáno sdílení od: <em>{$this->ReturnValueUserName($od)}</em> pro: <em>{$this->ReturnValueUserName($do)}</em>
              </p>
            </div>
        ";
        $this->var->main->AutoClick(2, "?action=setright");  //auto kliknuti
      }
    }
*/
    return $result;
  }
//******************************************************************************
  function ShareFile()  //vypis sdilenych slozek uzivatelum
  {
    if ($res = @$this->var->sqlite->query("SELECT
                                          uzivatel.jmeno as jmeno,
                                          sdileni.uzivatel as uzivatel,
                                          sdileni.slozka as slozka,
                                          sdileni.podslozka as podslozka
                                          FROM sdileni, uzivatel_ma_sdileni, uzivatel WHERE
                                          sdileni.id=uzivatel_ma_sdileni.sdileni AND
                                          uzivatel_ma_sdileni.uzivatel={$this->var->iduser} AND
                                          sdileni.uzivatel=uzivatel.id;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $i = 0;
        while($data = $res->fetchObject())
        {
          $jmeno[$i] = $data->jmeno;
          $uzivatel[$i] = $data->uzivatel;
          $slozka[$i] = $data->slozka;
          $podslozka[$i] = $data->podslozka;
          $i++;
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }
//".(((($i + 1) % 10) == 0) && ($i != (count($prenos) - 1)) ? "<span class=\"linka_vypis\"></span>" : "")."
    for ($i = 0; $i < count($slozka); $i++)
    {
      //$result .= "... nasdíleno od {$jmeno[$i]}:";
      $result .= "<span class=\"linka_vypis\"></span>";
      if ($uzivatel[$i] != 0 && $slozka[$i] == 0 && $podslozka[$i] == 0)
      {
        if ($res = @$this->var->sqlite->query("SELECT nazev FROM soubor WHERE uzivatel={$uzivatel[$i]} ORDER BY LOWER(soubor.nazev) ASC;", NULL, $error))
        { //vykresleni souboru v korenu
          if ($res->numRows() != 0)
          {
            $j = 0;
            while ($data = $res->fetchObject())
            {
              $cesta = "{$this->var->userdir}/{$jmeno[$i]}/{$data->nazev}";
              $create = date($this->var->filedateformat, filemtime($cesta));
              $typ = $this->TypSouboru($cesta, $popis);
              $result .=
              "
  <p".(((($j + 1) % 10) == 0) || ($j == ($res->numRows() - 1)) ? " class=\"neborder\"" : "").">
    <a href=\"{$cesta}\" class=\"{$typ}\" title=\"{$data->nazev} - {$this->VelikostSouboru($cesta)} - {$popis} - {$create}\">
      <span></span>
      {$data->nazev}
      <strong title=\"Nasdíleno od: {$jmeno[$i]}\">Nasdíleno od:<em>{$jmeno[$i]}</em></strong>
    </a>
    <a href=\"{$cesta}\" class=\"vypis_sdilenych_hlavni_strana\" title=\"Nasdíleno od: {$jmeno[$i]}\"></a>
    <a href=\"{$cesta}\" onclick=\"window.open(this.href); return false\" class=\"vypis_hlavni_strana_otevrit_do_noveho_okna\" title=\"Otevřít soubor: {$data->nazev} do nového okna\"></a>
    <a href=\"#\" onclick=\"CopyToClipboard('{$this->var->web}/{$cesta}'); return false;\" class=\"vypis_hlavni_strana_zkopirovat_odkaz_do_schranky\" title=\"Zkopírovat odkaz do schránky\"></a>
  </p>
              ";
              $j++;
            }
          }
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }

      if ($uzivatel[$i] != 0 && $slozka[$i] != 0 && $podslozka[$i] == 0)
      {
        if ($res = @$this->var->sqlite->query("SELECT
                                              slozka.nazev as slozka,
                                              podsoubor.nazev as nazev
                                              FROM slozka, podsoubor WHERE
                                              slozka.uzivatel={$uzivatel[$i]} AND
                                              slozka.id=podsoubor.slozka AND
                                              podsoubor.uzivatel={$uzivatel[$i]} AND
                                              podsoubor.slozka={$slozka[$i]}
                                              ORDER BY LOWER(podsoubor.nazev) ASC;", NULL, $error))
        { //vykresleni souboru ve slozce
          if ($res->numRows() != 0)
          {
            $j = 0;
            while ($data = $res->fetchObject())
            {
              $cesta = "{$this->var->userdir}/{$jmeno[$i]}/{$data->slozka}/{$data->nazev}";
              $create = date($this->var->filedateformat, filemtime($cesta));
              $typ = $this->TypSouboru($cesta, $popis);
              $velikost = $this->VelikostSouboru($cesta);

              $tajne = $this->TajnaCesta(0, 0, $slozka[$i], $uzivatel[$i]);

              if (!Empty($tajne))
              {
                $cesta = "download.php?action={$tajne}&amp;file={$data->nazev}";
              }

              $result .=
              "
  <p".(((($j + 1) % 10) == 0) || ($j == ($res->numRows() - 1)) ? " class=\"neborder\"" : "").">
    <a href=\"{$cesta}\" class=\"{$typ}\" title=\"{$data->nazev} - {$velikost} - {$popis} - {$create}\">
      <span></span>".($this->AktivniHeslo(0, 0, $slozka[$i], $login, $heslo, $id, $uzivatel[$i]) ? "<cite title=\"Zaheslovaný soubor\"></cite>" : "")."
      {$data->nazev}
      <strong title=\"Nasdíleno od: {$jmeno[$i]}\">Nasdíleno od:<em>{$jmeno[$i]}</em></strong>
    </a>
    <a href=\"{$cesta}\" class=\"vypis_sdilenych_hlavni_strana\" title=\"Nasdíleno od: {$jmeno[$i]}\"></a>
    <a href=\"{$cesta}\" onclick=\"window.open(this.href); return false\" class=\"vypis_hlavni_strana_otevrit_do_noveho_okna\" title=\"Otevřít soubor: {$data->nazev} do nového okna\"></a>
    <a href=\"#\" onclick=\"CopyToClipboard('{$this->var->web}/{$cesta}'); return false;\" class=\"vypis_hlavni_strana_zkopirovat_odkaz_do_schranky\" title=\"Zkopírovat odkaz do schránky\"></a>
  </p>
              "; // onclick=\"window.open(this.href); return false\"
              $j++;
            }
          }
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }

      if ($uzivatel[$i] != 0 && $slozka[$i] != 0 && $podslozka[$i] != 0)
      {
        if ($res = @$this->var->sqlite->query("SELECT
                                              slozka.nazev as slozka,
                                              podslozka.nazev as podslozka,
                                              podpodsoubor.nazev as nazev
                                              FROM slozka, podslozka, podpodsoubor WHERE
                                              slozka.uzivatel={$uzivatel[$i]} AND
                                              slozka.id=podslozka.slozka AND
                                              podslozka.uzivatel={$uzivatel[$i]} AND
                                              podslozka.id=podpodsoubor.podslozka AND
                                              podpodsoubor.uzivatel={$uzivatel[$i]} AND
                                              podpodsoubor.slozka={$slozka[$i]} AND
                                              podpodsoubor.podslozka={$podslozka[$i]}
                                              ORDER BY LOWER(podpodsoubor.nazev) ASC;", NULL, $error))
        { //vykresleni souboru v podslozce
          if ($res->numRows() != 0)
          {
            $j = 0;
            while ($data = $res->fetchObject())
            {
              $cesta = "{$this->var->userdir}/{$jmeno[$i]}/{$data->slozka}/{$data->podslozka}/{$data->nazev}";
              $create = date($this->var->filedateformat, filemtime($cesta));
              $typ = $this->TypSouboru($cesta, $popis);
              $velikost = $this->VelikostSouboru($cesta);

              $tajne = $this->TajnaCesta(1, $slozka[$i], $podslozka[$i], $uzivatel[$i]);

              if (!Empty($tajne))
              {
                $cesta = "download.php?action={$tajne}&amp;file={$data->nazev}";
              }

              $result .=
              "
  <p".(((($j + 1) % 10) == 0) || ($j == ($res->numRows() - 1)) ? " class=\"neborder\"" : "").">
    <a href=\"{$cesta}\" class=\"{$typ}\" title=\"{$data->nazev} - {$velikost} - {$popis} - {$create}\">
      <span></span>".($this->AktivniHeslo(1, $slozka[$i], $podslozka[$i], $login, $heslo, $id, $uzivatel[$i]) ? "<cite title=\"Zaheslovaný soubor\"></cite>" : "")."
      {$data->nazev}
      <strong title=\"Nasdíleno od: {$jmeno[$i]}\">Nasdíleno od:<em>{$jmeno[$i]}</em></strong>
    </a>
    <a href=\"{$cesta}\" class=\"vypis_sdilenych_hlavni_strana\" title=\"Nasdíleno od: {$jmeno[$i]}\"></a>
    <a href=\"{$cesta}\" onclick=\"window.open(this.href); return false\" class=\"vypis_hlavni_strana_otevrit_do_noveho_okna\" title=\"Otevřít soubor: {$data->nazev} do nového okna\"></a>
    <a href=\"#\" onclick=\"CopyToClipboard('{$this->var->web}/{$cesta}'); return false;\" class=\"vypis_hlavni_strana_zkopirovat_odkaz_do_schranky\" title=\"Zkopírovat odkaz do schránky\"></a>
  </p>
              ";
              $j++;
            }
          }
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }
    }

    return $result;
  }
//******************************************************************************
  function ListingVstupLog()  //vypise logovani vstupu
  {
    $kip = $_SERVER["REMOTE_ADDR"];

    if ($res = @$this->var->sqlite->query("SELECT id,
                                                  agent,
                                                  cas,
                                                  ip,
                                                  rozliseni_x as x,
                                                  rozliseni_y as y,
                                                  hloubka as d
                                                  FROM vstup
                                                  ORDER BY vstup.cas DESC;", NULL, $error))
    {
      $result .=
      "
<p>
  <span class=\"operacni_system\">Operační systém</span>
  <span class=\"prohlizec\">Prohlížeč</span>
  <span class=\"ip\">IP</span>
  <span class=\"hostitel\">Hostitel</span>
  <span class=\"zeme_puvodu\">Země původu</span>
  <span class=\"rozliseni\">Rozlišení</span>
  <span class=\"barevna_hloubka\">Bitů</span>
  <span class=\"prihlasen_v\">Přístup v</span>
  <span class=\"neborder expirace\">Expirace záznamu</span>
</p>
      ";

      if ($res->numRows() != 0)
      {
        $i = 0;
        while ($data = $res->fetchObject())
        {
          $dat = strtotime($data->cas);
          $cas = date("H:i:s d.m.Y", $dat);
          $datum = date("Y-m-d H:i:s", mktime(date("H", $dat), date("i", $dat), date("s", $dat), date("n", $dat) + $this->var->explistvstup, date("j", $dat), date("Y", $dat)));  //expirace statistiky vstupu
          $ip = $data->ip;
          $host = (in_array($kip, $this->var->blok) ? "localhost" : gethostbyaddr($ip)); //host
          $ipnum = $this->VypocetIpNum($ip);
          $agent = $data->agent;
          $os = $this->ZjistiOS($agent);
          $browser = $this->ZjistiBrowser($agent);
          $cas1 = date("H:i:s d.m.Y", strtotime($datum));

          $result .=
          "
<p".($i == ($res->numRows() - 1) ? " class=\"neborder\"" : "").">
  <span class=\"operacni_system\" title=\"{$os}\">{$os}</span>
  <span class=\"prohlizec\" title=\"{$browser}\">{$browser}</span>
  <span class=\"ip\">{$ip}</span>
  <span class=\"hostitel\" title=\"{$host}\">{$host}</span>
  <span class=\"zeme_puvodu\"><a href=\"#\" onclick=\"Zeme({$ipnum});return false;\" title=\"Ukázat zemi\">Ukázat zemi</a></span>
  <span class=\"rozliseni\">{$data->x} x {$data->y}</span>
  <span class=\"barevna_hloubka\">{$data->d}</span>
  <span class=\"prihlasen_v\">{$cas}</span>
  <span class=\"neborder expirace\">{$cas1}</span>
</p>
          ";
          $i++;

          if (date("Y-m-d H:i:s") > $datum) //smaze po necnosti N mesicu
          {
            if (!@$this->var->sqlite->queryExec("DELETE FROM vstup WHERE id={$data->id};", $error))
            {
              $this->ErrorMsg($error);
            }
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function AddVstup() //prida log do vstupu
  {
    //$datum = date("Y-m-d H:i:s");
    $ip = $_SERVER["REMOTE_ADDR"];
    $agent = $_SERVER["HTTP_USER_AGENT"];
    $session = session_id();

    if (!Empty($session))
    {
      if ($res = @$this->var->sqlite->query("SELECT id FROM vstup WHERE session='{$session}' AND agent='{$agent}' AND ip='{$ip}';", NULL, $error))
      {
        if ($res->numRows() == 0) //kdyz neexstuje
        {
          if (!@$this->var->sqlite->queryExec("INSERT INTO vstup (id, agent, cas, rozliseni_x, rozliseni_y, ip, session, hloubka) VALUES (NULL, '{$agent}', datetime('now', '+1 hour'), 0, 0, '{$ip}', '{$session}', 0);", $error))
          {
            $this->ErrorMsg($error);
          }
        }
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }
  }
//******************************************************************************
  function ListingLog() //vypisuje logovani
  {
    $kip = $_SERVER["REMOTE_ADDR"];

    if ($res = @$this->var->sqlite->query("SELECT id,
                                                  jmeno,
                                                  heslo,
                                                  stav,
                                                  cas,
                                                  agent,
                                                  rozliseni_x as x,
                                                  rozliseni_y as y,
                                                  ip,
                                                  hloubka as d
                                                  FROM logovani
                                                  ORDER BY logovani.cas DESC;", NULL, $error))
    {
      $result .=
      "
<p>
  <span class=\"login\">Login</span>
  <span class=\"heslo\">Heslo</span>
  <span class=\"pristup\">Přístup</span>
  <span class=\"operacni_system\">Operační systém</span>
  <span class=\"prohlizec\">Prohlížeč</span>
  <span class=\"ip\">IP</span>
  <span class=\"hostitel\">Hostitel</span>
  <span class=\"zeme_puvodu\">Země původu</span>
  <span class=\"rozliseni\">Rozlišení</span>
  <span class=\"barevna_hloubka\">Bitů</span>
  <span class=\"prihlasen_v\">Přihlášen v</span>
  <span class=\"neborder expirace\">Expirace záznamu</span>
</p>
      ";

      if ($res->numRows() != 0)
      {
        $i = 0;
        while ($data = $res->fetchObject())
        {
          $jmeno = base64_decode($data->jmeno);
          $heslo = ($jmeno == "Geniv" || $jmeno == "Fugess" || $jmeno == "jurkix" ? "———" : base64_decode($data->heslo));
          $stav = ($data->stav ? "<span class=\"povoleny_pristup pristup\" title=\"Povolen\"></span>" : "<span class=\"nepovoleny_pristup pristup\" title=\"Nepovolen\"></span>");
          $dat = strtotime($data->cas);
          $cas = date("H:i:s d.m.Y", $dat);
          $datum = date("Y-m-d H:i:s", mktime(date("H", $dat), date("i", $dat), date("s", $dat), date("n", $dat), date("j", $dat) + $this->var->explog, date("Y", $dat)));  //expirace
          $agent = $data->agent;
          $os = $this->ZjistiOS($agent);
          $browser = $this->ZjistiBrowser($agent);
          $ip = $data->ip;
          $host = (in_array($kip, $this->var->blok) ? "localhost" : gethostbyaddr($ip)); //host
          $ipnum = $this->VypocetIpNum($ip);
          $cas1 = date("H:i:s d.m.Y", strtotime($datum));  //prevod casu pro expiraci

          $result .=
          "
<p".($i == ($res->numRows() - 1) ? " class=\"neborder\"" : "").">
  <span class=\"login\" title=\"{$jmeno}\">{$jmeno}</span>
  <span class=\"heslo\" title=\"{$heslo}\">{$heslo}</span>
  {$stav}
  <span class=\"operacni_system\" title=\"{$os}\">{$os}</span>
  <span class=\"prohlizec\" title=\"{$browser}\">{$browser}</span>
  <span class=\"ip\">{$ip}</span>
  <span class=\"hostitel\" title=\"{$host}\">{$host}</span>
  <span class=\"zeme_puvodu\"><a href=\"#\" onclick=\"Zeme({$ipnum});return false;\" title=\"Ukázat zemi\">Ukázat zemi</a></span>
  <span class=\"rozliseni\">{$data->x} x {$data->y}</span>
  <span class=\"barevna_hloubka\">{$data->d}</span>
  <span class=\"prihlasen_v\">{$cas}</span>
  <span class=\"neborder expirace\">{$cas1}</span>
</p>
          "; //           $ipnum = $this->VypocetIpNum($ip);
          $i++;

          if (date("Y-m-d H:i:s") > $datum)
          {
            if (!@$this->var->sqlite->queryExec("DELETE FROM logovani WHERE id={$data->id};", $error))
            {
              $this->ErrorMsg($error);
            }
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function AddLog($jmeno, $heslo, $stav)  //pridava logovani
  {
    //$datum = date("Y-m-d H:i:s");
    $jmeno = addslashes(base64_encode($jmeno));
    $heslo = addslashes(base64_encode($heslo));
    $ip = $_SERVER["REMOTE_ADDR"];
    $agent = $_SERVER["HTTP_USER_AGENT"];
    $session = session_id();

    if (!@$this->var->sqlite->queryExec("INSERT INTO logovani (id, jmeno, heslo, stav, cas, agent, ip, rozliseni_x, rozliseni_y, session, hloubka) VALUES (NULL, '{$jmeno}', '{$heslo}', '{$stav}', datetime('now', '+1 hour'), '{$agent}', '{$ip}', 0, 0, '{$session}', 0);", $error))
    {
      $this->ErrorMsg($error);
    }
  }
//******************************************************************************
  function ListingStat()  //vypisuje statistku
  {
    $kip = $_SERVER["REMOTE_ADDR"];

    if ($res = @$this->var->sqlite->query("SELECT statistika.id as id,
                                          statistika.session as session,
                                          statistika.cas as cas,
                                          statistika.cas1 as cas1,
                                          statistika.ip as ip,
                                          statistika.pocet as pocet,
                                          statistika.agent as agent,
                                          statistika.charset as charset,
                                          statistika.jmeno as uzivatel,
                                          statistika.rozliseni_x as x,
                                          statistika.rozliseni_y as y,
                                          statistika.hloubka as d
                                          FROM statistika
                                          ORDER BY statistika.cas1 DESC;", NULL, $error))
    {
      $result .=
      "
<p class=\"zaklad_hover\">
  <span class=\"login\">Login</span>
  <span class=\"operacni_system\">Operační systém</span>
  <span class=\"prohlizec\">Prohlížeč</span>
  <span class=\"ip\">IP</span>
  <span class=\"hostitel\">Hostitel</span>
  <span class=\"zeme_puvodu\">Země původu</span>
  <span class=\"rozliseni\">Rozlišení</span>
  <span class=\"barevna_hloubka\">Bitů</span>
  <span class=\"prihlasen_v\">Počítadlo</span>
  <span class=\"expirace\">Expirace záznamu</span>
  <span class=\"neborder charset\">Charset</span>
</p>
<p class=\"vpravo_casy\">
  <span class=\"neborder expirace_prvni\">Zápis počítadla</span>
  <span class=\"neborder expirace\">Čas do připočítání</span>
</p>
<p class=\"neborder vpravo_casy\">
  <span class=\"neborder expirace_prvni\">Zápis vstupu online</span>
  <span class=\"neborder expirace\">Čas do připočítání</span>
</p>
      ";

      if ($res->numRows() != 0)
      {
        $i = 0;
        while ($data = $res->fetchObject())
        {
          $dat = strtotime($data->cas);
          $cas = date("H:i:s d.m.Y", $dat);
          $datum = date("Y-m-d H:i:s", mktime(date("H", $dat), date("i", $dat), date("s", $dat), date("n", $dat) + $this->var->expliststat, date("j", $dat), date("Y", $dat)));  //expirace statistiky
          $dat1 = strtotime($data->cas1); //online
          $cas1 = date("H:i:s d.m.Y", $dat1);
          $datum1 = date("Y-m-d H:i:s", mktime(date("H", $dat1), date("i", $dat1) + $this->var->exppoc, date("s", $dat1), date("n", $dat1), date("j", $dat1), date("Y", $dat1)));  //expirace pocitadla
          $datum2 = date("Y-m-d H:i:s", mktime(date("H", $dat1), date("i", $dat1) + $this->var->exponline, date("s", $dat1), date("n", $dat1), date("j", $dat1), date("Y", $dat1)));  //expirace online
          $ip = $data->ip;
          $host = (in_array($kip, $this->var->blok) ? "localhost" : gethostbyaddr($ip)); //host
          $ipnum = $this->VypocetIpNum($ip);
          $pocet = $data->pocet;
          $agent = $data->agent;
          $os = $this->ZjistiOS($agent);
          $browser = $this->ZjistiBrowser($agent);
          $charset = explode(";", $data->charset);
          $uzivatel = $data->uzivatel;
          $cas2 = date("H:i:s d.m.Y", strtotime($datum));
          $cas3 = date("H:i:s d.m.Y", strtotime($datum1));
          $cas4 = date("H:i:s d.m.Y", strtotime($datum2));


          $result .=
          "
<p class=\"zaklad_hover\">
  <span class=\"login\" title=\"{$uzivatel}\">{$uzivatel}</span>
  <span class=\"operacni_system\" title=\"{$os}\">{$os}</span>
  <span class=\"prohlizec\" title=\"{$browser}\">{$browser}</span>
  <span class=\"ip\">{$ip}</span>
  <span class=\"hostitel\" title=\"{$host}\">{$host}</span>
  <span class=\"zeme_puvodu\"><a href=\"#\" onclick=\"Zeme({$ipnum});return false;\" title=\"Ukázat zemi\">Ukázat zemi</a></span>
  <span class=\"rozliseni\">{$data->x} x {$data->y}</span>
  <span class=\"barevna_hloubka\">{$data->d}</span>
  <span class=\"prihlasen_v\">{$pocet}x</span>
  <span class=\"expirace\">{$cas2}</span>
  <span class=\"neborder charset\">{$charset[0]}</span>
</p>
<p class=\"vpravo_casy\">
  <span class=\"neborder expirace_prvni\">{$cas}</span>
  <span class=\"neborder expirace\">{$cas3}</span>
</p>
<p class=\"".($i == ($res->numRows() - 1) ? "" : "neborder ")."vpravo_casy\">
  <span class=\"neborder expirace_prvni\">{$cas1}</span>
  <span class=\"neborder expirace\">{$cas4}</span>
</p>
          ";
          $i++;

          if (date("Y-m-d H:i:s") > $datum) //smaze po necnosti N mesicu
          {
            if (!@$this->var->sqlite->queryExec("DELETE FROM statistika WHERE id={$data->id};", $error))
            {
              $this->ErrorMsg($error);
            }
          }

        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function AddEditStat()  //pridava a upravuje statistiku
  {
    $session = session_id();
    //$cas = date("Y-m-d H:i:s", $_SERVER["REQUEST_TIME"]);
    $ip = $_SERVER["REMOTE_ADDR"];
    $agent = $_SERVER["HTTP_USER_AGENT"];
    $charset = $_SERVER["HTTP_ACCEPT_CHARSET"];
    $uzivatel = $this->var->iduser;
    settype($uzivatel, "integer");

    if (!Empty($session))  //napln dokud se do cookie nedostane session
    {
      if ($res = @$this->var->sqlite->query("SELECT id, pocet, cas, cas1 FROM statistika WHERE session='{$session}';", NULL, $error))
      {
        if (Empty($charset))  //kdyz je v IE prazdny charset!
        {
          $charset = "---";
        }

        if ($res->numRows() == 0)
        {
          if (!@$this->var->sqlite->queryExec("INSERT INTO statistika (id, session, cas, cas1, ip, pocet, agent, charset, uzivatel, jmeno, rozliseni_x, rozliseni_y, hloubka) VALUES (NULL, '{$session}', datetime('now', '+1 hour'), datetime('now', '+1 hour'), '{$ip}', 1, '{$agent}', '{$charset}', {$uzivatel}, '{$this->var->jmeno}', 0, 0, 0);", $error))
          {
            $this->ErrorMsg($error);
          }
        }
          else
        {
          $data = $res->fetchObject();
          $id = $data->id;
          $poc = $data->pocet + 1;
          $dat = strtotime($data->cas);
          $datum = date("Y-m-d H:i:s", mktime(date("H", $dat), date("i", $dat) + $this->var->exppoc, date("s", $dat), date("n", $dat), date("j", $dat), date("Y", $dat)));  //expirace pocitadla, predpocitane datum
          $dat1 = strtotime($data->cas1); //(cas1)
          $datum1 = date("Y-m-d H:i:s", mktime(date("H", $dat1), date("i", $dat1) + $this->var->exponline, date("s", $dat1), date("n", $dat1), date("j", $dat1), date("Y", $dat1)));  //expirace online, predpocitane datum

          if (date("Y-m-d H:i:s") > $datum) //urci jak dlouho bude rozestup mezi kontrolami - poc
          {
            if (!@$this->var->sqlite->queryExec ("UPDATE statistika SET cas=datetime('now', '+1 hour'),
                                                                        ip='{$ip}',
                                                                        pocet={$poc},
                                                                        agent='{$agent}',
                                                                        charset='{$charset}',
                                                                        uzivatel={$uzivatel},
                                                                        jmeno='{$this->var->jmeno}'
                                                                        WHERE id={$id};", $error))
            {
              $this->ErrorMsg($error);
            }
          }

          if (date("Y-m-d H:i:s") > $datum1) //urci jak dlouho bude rozestup mezi kontrolami - online (cas1)
          {
            if (!@$this->var->sqlite->queryExec ("UPDATE statistika SET cas1=datetime('now', '+1 hour'),
                                                                        ip='{$ip}',
                                                                        agent='{$agent}',
                                                                        charset='{$charset}',
                                                                        uzivatel={$uzivatel},
                                                                        jmeno='{$this->var->jmeno}'
                                                                        WHERE id={$id};", $error))
            {
              $this->ErrorMsg($error);
            }
          }
        }
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }
  }
//******************************************************************************
  function LogResolution($session)  //loguje rozliseni uzivatele podle jeho session id
  {
    $session = session_id();
    $w = $_POST["w"]; //sirka
    settype($w, "integer");
    $h = $_POST["h"]; //vyska
    settype($h, "integer");
    $d = $_POST["d"]; //barevna hloubka
    settype($d, "integer");

    if (!Empty($session))
    {
      if (!@$this->var->sqlite->queryExec("UPDATE vstup SET rozliseni_x={$w},
                                                            rozliseni_y={$h},
                                                            hloubka={$d}
                                                            WHERE session='{$session}';", $error))
      {
        $this->ErrorMsg($error);
      }

      if (!@$this->var->sqlite->queryExec ("UPDATE logovani SET rozliseni_x={$w},
                                                                rozliseni_y={$h},
                                                                hloubka={$d}
                                                                WHERE session='{$session}';", $error))
      {
        $this->ErrorMsg($error);
      }

      if (!@$this->var->sqlite->queryExec ("UPDATE adresa SET rozliseni_x={$w},
                                                              rozliseni_y={$h},
                                                              hloubka={$d}
                                                              WHERE session='{$session}';", $error))
      {
        $this->ErrorMsg($error);
      }

      if (!@$this->var->sqlite->queryExec ("UPDATE statistika SET rozliseni_x={$w},
                                                                  rozliseni_y={$h},
                                                                  hloubka={$d}
                                                                  WHERE session='{$session}';", $error))
      {
        $this->ErrorMsg($error);
      }
    }
  }
//******************************************************************************
  function WebCount() //vypisuje poctadlo webu
  {
    if ($res = @$this->var->sqlite->query("SELECT SUM(pocet) as pocet FROM adresa;", NULL, $error))
    {
      $result = $res->fetchObject()->pocet;
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function OnlineUser() //vypisuje online cleny (cas1)
  {
    if ($res = @$this->var->sqlite->query("SELECT statistika.cas1 as cas,
                                                  statistika.jmeno as jmeno
                                                  FROM statistika
                                                  ORDER BY LOWER(statistika.jmeno) DESC;", NULL, $error)) //+ seskupeni jmen
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $dat = strtotime($data->cas);
          $datum = date("Y-m-d H:i:s", mktime(date("H", $dat), date("i", $dat) + $this->var->exponline, date("s", $dat), date("n", $dat), date("j", $dat), date("Y", $dat)));  //predpocitane datum

          if (date("Y-m-d H:i:s") < $datum) //urc jak dlouho bude rozestup mezi kontrolami
          {
            $result .= "{$data->jmeno}, ";
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $result = substr($result, 0, -2);

    return $result;
  }
//******************************************************************************
  function ZjistiBrowser($agent)  //zjisteni prohlizece
  { //obsaj prejat a opraven z: programy.wz.cz
    $BrowserList = array ("Internet Explorer \\1" => "#MSIE ([a-zA-Z0-9\.]+)#i",
                          "Mozilla Firefox \\2" => "#(Firefox|Phoenix|Firebird)/([a-zA-Z0-9\.]+)#i",
                          "Opera \\1" => "#Opera[ /]([a-zA-Z0-9\.]+)#i",
                          "Netscape \\1" => "#Netscape[0-9]?/([a-zA-Z0-9\.]+)#i",
                          "Safari \\1" => "#Safari/([a-zA-Z0-9\.]+)#i",
                          "Flock \\1" => "#Flock/([a-zA-Z0-9\.]+)#i",
                          "Epiphany \\1" => "#Epiphany/([a-zA-Z0-9\.]+)#i",
                          "Konqueror \\1" => "#Konqueror/([a-zA-Z0-9\.]+)#i",
                          "Maxthon \\1" => "#Maxthon ?([a-zA-Z0-9\.]+)?#i",
                          "K-Meleon \\1" => "#K-Meleon/([a-zA-Z0-9\.]+)#i",
                          "Lynx \\1" => "#Lynx/([a-zA-Z0-9\.]+)#i",
                          "Links \\1" => "#Links .{2}([a-zA-Z0-9\.]+)#i",
                          "ELinks \\3" => "#ELinks([/ ]|(.{2}))([a-zA-Z0-9\.]+)#i",
                          "Debian IceWeasel \\1" => "#(iceweasel)/([a-zA-Z0-9\.]+)#i",
                          "Mozilla SeaMonkey \\1" => "#(SeaMonkey)/([a-zA-Z0-9\.]+)#i",
                          "OmniWeb" => "#OmniWeb#i",
                          "Mozilla \\1" => "#^Mozilla/5\.0.*rv:([a-zA-Z0-9\.]+).*#i",
                          "Netscape Navigator \\1" => "#^Mozilla/([a-zA-Z0-9\.]+)#i",
                          "PHP" => "/PHP/i",
                          "SymbianOS \\1" => "#symbianos/([a-zA-Z0-9\.]+)#i",
                          "Avant Browser" => "/avantbrowser\.com/i",
                          "Camino \\1" => "#(Camino|Chimera)[ /]([a-zA-Z0-9\.]+)#i",
                          "Anonymouse" => "/anonymouse/i",
                          "Danger HipTop" => "/danger hiptop/i",
                          "W3M \\1" => "#w3m/([a-zA-Z0-9\.]+)#i",
                          "Shiira \\1" => "#Shiira[ /]([a-zA-Z0-9\.]+)#i",
                          "Dillo \\1" => "#Dillo[ /]([a-zA-Z0-9\.]+)#i",
                          "Openwave UP.Browser \\1" => "#UP.Browser/([a-zA-Z0-9\.]+)#i",
                          "DoCoMo \\1" => "#DoCoMo/(([a-zA-Z0-9\.]+)[/ ]([a-zA-Z0-9\.]+))#i",
                          "Unbranded Firefox \\1" => "#(bonecho)/([a-zA-Z0-9\.]+)#i",
                          "Kazehakase \\1" => "#Kazehakase/([a-zA-Z0-9\.]+)#i",
                          "Minimo \\1" => "#Minimo/([a-zA-Z0-9\.]+)#i",
                          "MultiZilla \\1" => "#MultiZilla/([a-zA-Z0-9\.]+)#i",
                          "Sony PSP \\2" => "/PSP \(PlayStation Portable\)\; ([a-zA-Z0-9\.]+)/i",
                          "Galeon \\1" => "#Galeon/([a-zA-Z0-9\.]+)#i",
                          "iCab \\1" => "#iCab/([a-zA-Z0-9\.]+)#i",
                          "NetPositive \\1" => "#NetPositive/([a-zA-Z0-9\.]+)#i",
                          "NetNewsWire \\1" => "#NetNewsWire/([a-zA-Z0-9\.]+)#i",
                          "Opera Mini \\1" => "#opera mini/([a-zA-Z0-9]+)#i",
                          "WebPro \\2" => "#WebPro(/([a-zA-Z0-9\.]+))?#i",
                          "Netfront \\1" => "#Netfront/([a-zA-Z0-9\.]+)#i",
                          "Xiino \\1" => "#Xiino/([a-zA-Z0-9\.]+)#i",
                          "Blackberry \\1" => "#Blackberry([0-9]+)?#i",
                          "Orange SPV \\1" => "#SPV ([0-9a-zA-Z\.]+)#i",
                          "LG \\1" => "#LGE-([a-zA-Z0-9]+)#i",
                          "Motorola \\1" => "#MOT-([a-zA-Z0-9]+)#i",
                          "Nokia \\1" => "#Nokia ?([0-9]+)#i",
                          "Nokia N-Gage" => "#NokiaN-Gage#i",
                          "Blazer \\1" => "#Blazer[ /]?([a-zA-Z0-9\.]*)#i",
                          "Siemens \\1" => "#SIE-([a-zA-Z0-9]+)#i",
                          "Samsung \\4" => "#((SEC-)|(SAMSUNG-))((S.H-[a-zA-Z0-9]+)|([a-zA-Z0-9]+))#i",
                          "SonyEricsson \\1" => "#SonyEricsson ?([a-zA-Z0-9]+)#i",
                          "J2ME/MIDP Browser" => "#(j2me|midp)#i",
                          "Neznámý" => "/(.*)/");

    foreach($BrowserList as $Browser => $regexp)
    {
      if (preg_match($regexp, $agent, $matches))
      {
        if ($matches)
        {
          for ($i = 0; $i <= count($matches); $i++)
          {
            $Browser = str_replace("\\{$i}", $matches[$i], $Browser);
          }
        }
        break;
      }
    }

    return trim($Browser);
  }
//******************************************************************************
  function ZjistiOS($agent) //zjisteni operacniho systemu
  { //obsaj prejat a opraven z: programy.wz.cz
    $OSList = array("Windows 3.11" => "/Win16/i",
                    "Windows 95" => "/(Windows.95)|(Win95)/i",
                    "Windows 98" => "/(Windows.98)|(Win98)/i",
                    "Windows 2000" => "/(Windows NT 5\.0)|(Windows 2000)/i",
                    "Windows XP" => "/(Windows NT 5\.1)|(Windows XP)/i",
                    "Windows XP x64" => "/((Windows NT 5\.2).*(Win64))|((Win64).*(Windows NT 5\.2))/i",
                    "Windows Server 2003" => "/Windows NT 5\.2/i",
                    "Windows Vista" => "/Windows NT 6\.0/i",
                    "Windows 7" => "/Windows NT 7\.0/i",
                    "Windows NT 4.0" => "/(Windows NT 4\.0)|(WinNT4\.0)|(WinNT)|(Windows NT)/i",
                    "Windows ME" => "/(Windows ME)|(Win 9x 4\.90)/i",
                    "Microsoft PocketPC" => "/((Windows CE).*(PPC))|((PPC).*(Windows CE))/i",
                    "Microsoft Smartphone" => "/((Windows CE).*(smartphone))|((smartphone).*(Windows CE))/i",
                    "Windows CE" => "/Windows CE/i",
                    "Mandrake Linux" => "/((Linux).*(Mandrake))|((Mandrake).*(Linux))/i",
                    "Mandriva Linux" => "/((Linux).*(Mandriva))|((Mandriva).*(Linux))/i",
                    "SuSE Linux" => "/((Linux).*(SuSE))|((SuSE).*(Linux))/i",
                    "Novell Linux" => "/((Linux).*(Novell))|((Novell).*(Linux))/i",
                    "Kubuntu Linux" => "/((Linux).*(Kubuntu))|((Kubuntu).*(Linux))/i",
                    "Xubuntu Linux" => "/((Linux).*(Xubuntu))|((Xubuntu).*(Linux))/i",
                    "Edubuntu Linux" => "/((Linux).*(Edubuntu))|((Edubuntu).*(Linux))/i",
                    "Ubuntu Linux" => "/((Linux).*(Ubuntu))|((Ubuntu).*(Linux))/i",
                    "Debian GNU/Linux" => "/((Linux).*(Debian))|((Debian).*(Linux))/i",
                    "RedHat Linux" => "/((Linux).*(Red ?Hat))|((Red ?Hat).*(Linux))/i",
                    "Gentoo Linux" => "/((Linux).*(Gentoo))|((Gentoo).*(Linux))/i",
                    "Fedora Linux" => "/((Linux).*(Fedora))|((Fedora).*(Linux))/i",
                    "MEPIS Linux" => "/((Linux).*(MEPIS))|((MEPIS).*(Linux))/i",
                    "Knoppix Linux" => "/((Linux).*(Knoppix))|((Knoppix).*(Linux))/i",
                    "Slackware Linux" => "/((Linux).*(Slackware))|((Slackware).*(Linux))/i",
                    "Xandros Linux" => "/((Linux).*(Xandros))|((Xandros).*(Linux))/i",
                    "Kanotix Linux" => "/((Linux).*(Kanotix))|((Kanotix).*(Linux))/i",
                    "Linux" => "/(Linux)|(X11)/i",
                    "FreeBSD" => "/Free/i",
                    "OpenBSD" => "/OpenBSD/i",
                    "NetBSD" => "/NetBSD/i",
                    "SGI IRIX" => "/IRIX/i",
                    "Sun OS" => "/SunOS/i",
                    "QNX" => "/QNX/i",
                    "BeOS" => "/BeOS/i",
                    "Mac OS X Leopard" => "/(Mac OS).*(Leopard)/i",
                    "Mac OS X" => "/(Mac OS X)/i",
                    "Mac OS" => "/(Mac_PowerPC)|(Macintosh)/i",
                    "OS/2" => "#OS/2#i",
                    "Qtopia" => "/QtEmbedded/i",
                    "Sharp Zaurus \\1" => "/Zaurus ([a-zA-Z0-9\.]+)/i",
                    "Zaurus" => "/Zaurus/i",
                    "Symbian OS" => "/Symbian/i",
                    "Sony Clie" => "#PalmOS/sony/model#i",
                    "Series \\1" => "/Series ([0-9]+)/i",
                    "Nokia \\1" => "/Nokia ([0-9]+)/i",
                    "Siemens \\1" => "/SIE-([a-zA-Z0-9]+)/i",
                    "Dopod \\1" => "/dopod([a-zA-Z0-9]+)/i",
                    "O2 XDA \\1" => "/o2 xda ([a-zA-Z0-9 ]+);/i",
                    "Samsung \\1" => "/SEC-([a-zA-Z0-9]+)/i",
                    "SonyEricsson \\1" => "/SonyEricsson ?([a-zA-Z0-9]+)/i",
                    "Nintendo Wii" => "/Wii/i",
                    "Bot" => "/(crawler)|(Mediapartners-Google)|(Jyxobot)|(morfeo.centrum.cz)|(Gigabot)|(ASAP-LynxViewer)|(ASAP-Web-Sniffer)|(EARTHCOM.info)|(Mozdex)|(SeznamBot)|(Speedy Spider)|(Yahoo! Slurp)|(ZACATEK_CZ_BOT)|(www.yacy.net)|(Googlebot)|(Openbot)|(MSNBot)|(del.icio.us-thumbnails)|(Exabot)|(findlinks)|(Bot,Robot,Spider)/i",
                    "Neznámý" => "/(.*)/");

    foreach($OSList as $OS => $regexp)
    {
      if (preg_match($regexp, $agent, $matches))
      {
        if ($matches)
        {
          for ($i = 0; $i <= count($matches); $i++)
          {
            $OS = str_replace("\\{$i}", $matches[$i], $OS);
          }
          break;
        }
      }
    }

    return trim($OS);
  }
//******************************************************************************
  function ZjistiZemi($ipnum) //vraceni zeme, jen na zavolani
  {
    $this->var->main->StartCas();
    ini_set("memory_limit", "100M");  //nasosne si 100MB

    $sloup = 6;
    $soubor = "./data/GeoIPCountryWhois.csv";
    $u = fopen($soubor, "r");
    $data = explode("+", fread($u, filesize($soubor)));
    fclose($u);

    for ($i = 0; $i <= count($data) / $sloup; $i++)
    {
      $od = $data[($i * $sloup) + 2];
      $do = $data[($i * $sloup) + 3];

      if ($od <= $ipnum && $do >= $ipnum)
      {
        $ozn = $data[($i * $sloup) + 4];
        $zeme = $data[($i * $sloup) + 5];

        $flag = strtolower($ozn); //prevedeni na male pismena
        $result = "
<div id=\"zeme_puvodu\">
  <span style=\"background: url(./obr/vlajky/{$flag}.png) no-repeat center top;\"></span>
  <strong>{$zeme} ({$ozn})</strong>

        ";
        break;
      }
    }

    if (Empty($result))
    {
      $result = "
<div id=\"zeme_puvodu\">
  <strong>Nebyla nalezena země</strong>
      ";
    }

    $result .=
    "
  <em>{$this->var->main->KonecCas()}</em>
  <a href=\"#\" onclick=\"document.getElementById('zeme_puvodu').style.display='none'; return false;\" title=\"Zavřít okno\"></a>
</div>
    ";

    return $result;
  }
//******************************************************************************
  function VypocetIpNum($ip)  //vypocet cisla pro zjisteni zeme z IP
  {
    $a = explode(".", $ip);
    $result = 16777216 * $a[0] + 65536 * $a[1] + 256 * $a[2] + $a[3];

    return $result;
  }
//******************************************************************************
  function ListingIpLog()
  {
    $kip = $_SERVER["REMOTE_ADDR"];

    if ($res = @$this->var->sqlite->query("SELECT adresa.ip as ip,
                                          adresa.pocet as pocet,
                                          adresa.cas as cas,
                                          adresa.jmeno as uzivatel,
                                          adresa.agent as agent,
                                          rozliseni_x as x,
                                          rozliseni_y as y,
                                          hloubka as d
                                          FROM adresa
                                          ORDER BY adresa.pocet DESC,
                                                   adresa.cas DESC;", NULL, $error))
    {
      $result .=
      "
<p class=\"nebordertop\">
  <span class=\"login\">Login</span>
  <span class=\"operacni_system\">Operační systém</span>
  <span class=\"prohlizec\">Prohlížeč</span>
  <span class=\"ip\">IP</span>
  <span class=\"hostitel\">Hostitel</span>
  <span class=\"zeme_puvodu\">Země původu</span>
  <span class=\"rozliseni\">Rozlišení</span>
  <span class=\"barevna_hloubka\">Bitů</span>
  <span class=\"prihlasen_v\">Počítadlo</span>
  <span class=\"expirace\">Zápis počítadla</span>
  <span class=\"neborder expirace\">Čas do připočítání</span>
</p>
      ";
      if ($res->numRows() != 0)
      {
        $i = 0;
        while ($data = $res->fetchObject())
        {
          $dat = strtotime($data->cas);
          $cas = date("H:i:s d.m.Y", $dat);
          $datum = date("Y-m-d H:i:s", mktime(date("H", $dat), date("i", $dat) + $this->var->expip, date("s", $dat), date("n", $dat), date("j", $dat), date("Y", $dat)));  //expirace pricteni
          $ip = $data->ip;
          $host = (in_array($kip, $this->var->blok) ? "localhost" : gethostbyaddr($ip)); //host
          $ipnum = $this->VypocetIpNum($ip);
          $pocet = $data->pocet;
          $uzivatel = $data->uzivatel;
          $agent = $data->agent;
          $os = $this->ZjistiOS($agent);
          $browser = $this->ZjistiBrowser($agent);
          $cas1 = date("H:i:s d.m.Y", strtotime($datum));

          $result .=
          "
<p class=\"nebordertop_polozka".($i == ($res->numRows() - 1) ? " neborder" : "")."\">
  <span class=\"login\" title=\"{$uzivatel}\">{$uzivatel}</span>
  <span class=\"operacni_system\" title=\"{$os}\">{$os}</span>
  <span class=\"prohlizec\" title=\"{$browser}\">{$browser}</span>
  <span class=\"ip\">{$ip}</span>
  <span class=\"hostitel\" title=\"{$host}\">{$host}</span>
  <span class=\"zeme_puvodu\"><a href=\"#\" onclick=\"Zeme({$ipnum});return false;\" title=\"Ukázat zemi\">Ukázat zemi</a></span>
  <span class=\"rozliseni\">{$data->x} x {$data->y}</span>
  <span class=\"barevna_hloubka\">{$data->d}</span>
  <span class=\"prihlasen_v\">{$pocet}x</span>
  <span class=\"expirace\">{$cas}</span>
  <span class=\"neborder expirace\">{$cas1}</span>
</p>
          ";
          $i++;
        }
      }
    }

    return $result;
  }
//******************************************************************************
  function IpLog()  //logovani IP adres do DB
  {
    $ip = $_SERVER["REMOTE_ADDR"];
    $agent = $_SERVER["HTTP_USER_AGENT"]; //ulozeni i prohlizece
    //$nowdatum = date("Y-m-d H:i:s");
    $session = session_id();

    //podminka na jine IP && iduser && AGENT
    if ($res = @$this->var->sqlite->query("SELECT id, pocet, cas FROM adresa WHERE ip='{$ip}' AND uzivatel={$this->var->iduser} AND agent='{$agent}';", NULL, $error))  //vydani podminky pro pridani noveho zaznamu
    {
      if ($res->numRows() == 0) //kdyz neexstuje prida se
      {
        if (!@$this->var->sqlite->queryExec("INSERT INTO adresa (id, ip, uzivatel, jmeno, pocet, cas, agent, rozliseni_x, rozliseni_y, session, hloubka) VALUES (NULL, '{$ip}', {$this->var->iduser}, '{$this->var->jmeno}', 1, datetime('now', '+1 hour'), '{$agent}', 0, 0, '{$session}', 0);", $error))
        {
          $this->ErrorMsg($error);
        }
      }
        else
      {
        $data = $res->fetchObject();
        $id = $data->id;
        $dat = strtotime($data->cas);
        $poc = $data->pocet + 1;
        $datum = date("Y-m-d H:i:s", mktime(date("H", $dat), date("i", $dat) + $this->var->expip, date("s", $dat), date("n", $dat), date("j", $dat), date("Y", $dat)));  //expirace statistiky

        if (date("Y-m-d H:i:s") > $datum) //urci jak dlouho bude rozestup mezi kontrolami - poc
        {
          if (!@$this->var->sqlite->queryExec ("UPDATE adresa SET cas=datetime('now', '+1 hour'),
                                                                  pocet={$poc}
                                                                  WHERE id={$id};", $error))
          {
            $this->ErrorMsg($error);
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }
  }
//******************************************************************************
  function ShowSelectUserIp() //vypise list IP sle vybraneho uzivatele
  {
    $user = $_POST["user"];
    $sum = $_POST["sum"];
    settype($sum, "integer");
    $kip = $_SERVER["REMOTE_ADDR"];

    if (!Empty($user))  //rozkliknuty
    {
      if ($res = @$this->var->sqlite->query("SELECT
                                            adresa.ip as ip,
                                            strftime('%d.%m.%Y %H:%M:%S', cas) as dat,
                                            adresa.agent as agent,
                                            adresa.pocet as pocet,
                                            adresa.rozliseni_x as x,
                                            adresa.rozliseni_y as y,
                                            adresa.hloubka as d
                                            FROM adresa
                                            WHERE adresa.jmeno='{$user}'
                                            ORDER BY datetime(cas) DESC;
                                            ", NULL, $error))
      {
        if ($res->numRows() != 0)
        { // <a href="#" onclick="document.getElementById('zeme_puvodu').style.display='none'; return false;" title="Zavřít okno"></a>
            $result .=
            "
<p id=\"zavrit_vypis_odstavec\">
  <a href=\"#\" onclick=\"document.getElementById('listipuser').style.display='none'; return false;\" title=\"Zavřít výpis\"></a>
</p>
<p>
  <span class=\"operacni_system\">Operační systém</span>
  <span class=\"prohlizec\">Prohlížeč</span>
  <span class=\"ip\">IP</span>
  <span class=\"hostitel\">Hostitel</span>
  <span class=\"zeme_puvodu\">Země původu</span>
  <span class=\"rozliseni\">Rozlišení</span>
  <span class=\"barevna_hloubka\">Bitů</span>
  <span class=\"prihlasen_v\">Počítadlo</span>
  <span class=\"navstevnost\">Návštěvnost</span>
  <span class=\"neborder expirace\">Poslední aktivita</span>
</p>
            ";
          $i = 0;
          while($data = $res->fetchObject())
          {
            $agent = $data->agent;
            $os = $this->ZjistiOS($agent);
            $browser = $this->ZjistiBrowser($agent);
            $host = (in_array($kip, $this->var->blok) ? "localhost" : gethostbyaddr($data->ip)); //host
            $proc = round(($data->pocet / $sum) * 100); //% navstevnost z dane IP
            $ipnum = $this->VypocetIpNum($data->ip);

            $result .=
            "
<p".($i == ($res->numRows() - 1) ? " class=\"neborder_central_vetsi_odsazeni\"" : "").">
  <span class=\"operacni_system\" title=\"{$os}\">{$os}</span>
  <span class=\"prohlizec\" title=\"{$browser}\">{$browser}</span>
  <span class=\"ip\">{$data->ip}</span>
  <span class=\"hostitel\" title=\"{$host}\">{$host}</span>
  <span class=\"zeme_puvodu\"><a href=\"#\" onclick=\"Zeme({$ipnum});return false;\" title=\"Ukázat zemi\">Ukázat zemi</a></span>
  <span class=\"rozliseni\">{$data->x} x {$data->y}</span>
  <span class=\"barevna_hloubka\">{$data->d}</span>
  <span class=\"prihlasen_v\">{$data->pocet}x</span>
  <span class=\"navstevnost\">{$proc}%</span>
  <span class=\"neborder expirace\">{$data->dat}</span>
</p>
            ";
          $i++;
          }
        }
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }

    return $result;
  }
//******************************************************************************
  function SaveSizeUser($jmena, $velikosti) //ulozi velikost slozky - cache
  {
    for ($i = 0; $i < count($jmena); $i++)
    {
      $pole[$i] = "{$jmena[$i]}++{$velikosti[$i]}";
    }

    $soubor = "{$this->var->cachedir}/{$this->var->cachesize}";
    $u = fopen($soubor, "w");
    fwrite($u, implode("--", $pole));
    fclose($u);
  }
//******************************************************************************
  function ShowSizeUser() //nacte velikost slozky - cache
  {
    $soubor = "{$this->var->cachedir}/{$this->var->cachesize}";
    $u = fopen($soubor, "r");
    $pole = explode("--", fread($u, filesize($soubor)));
    fclose($u);

    for ($i = 0; $i < count($pole); $i++)
    {
      $rozdel = explode("++", $pole[$i]);
      $result[$rozdel[0]] = $rozdel[1];
    }

    return $result;
  }
//******************************************************************************
  function ViewStatistic()  //zobrazeni statistik pristupu uzivatelu z konkretnich IP
  {
    $user = $_GET["user"];
    settype($user, "integer");
    $kip = $_SERVER["REMOTE_ADDR"];

    //celkovy staveny cas na strankach
    if ($res = @$this->var->sqlite->query("SELECT
                                          sum(adresa.pocet) as pocet
                                          FROM adresa;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $data = $res->fetchObject();
        $hod = ($this->var->expip * $data->pocet) / 60;
        $pden = explode(".", $hod / 24);
        $den = $pden[0];
        $hodin = $hod - (24 * $den);
        $alltime = "{$this->VyslovnostDnuZbyva($den)}, {$this->VyslovnostHodin($hodin)}";
        $fullhod = $hod;
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    //na rozkliknuti uzivatele - zobrazuje ajax - sjednocovan dle jmena! to je identicke, sqlite cisla ID vraci
    $dat = filemtime("{$this->var->cachedir}/{$this->var->cachesize}");
    $datum = date("Y-m-d H:i:s", mktime(date("H", $dat) + $this->var->reloadcachesize, date("i", $dat), date("s", $dat), date("n", $dat), date("j", $dat), date("Y", $dat)));  //interval refresh dat

    $sizeuser = $this->ShowSizeUser();  //nacteni velikosti slozky z cache
    $flag = false;
    if ($res = @$this->var->sqlite->query("SELECT
                                          adresa.uzivatel as uzivatel,
                                          uzivatel.prostor as prostor,
                                          uzivatel.vytvoreno as vytvoreno,
                                          uzivatel.vyprseniucet as expiraceucet,
                                          uzivatel.style as style,
                                          adresa.jmeno as jmeno,
                                          SUM(adresa.pocet) as pocet
                                          FROM adresa, uzivatel WHERE
                                          uzivatel.id=adresa.uzivatel
                                          GROUP BY adresa.jmeno
                                          ORDER BY sum(adresa.pocet) DESC;
                                          ", NULL, $error))
    {
      $seluser .=
      "
<p class=\"zobraz_statistiky\">
  <span class=\"login\">Login</span>
  <span class=\"prihlasen_v\">Počítadlo</span>
  <span class=\"charset\">Celkový strávený čas na stránkách</span>
  <span class=\"charset\">Využité místo (".(date($this->var->cachedateformat, strtotime($datum))).")</span>
  <span class=\"prihlasen_v\">Zbývá dní</span>
  <span class=\"neborder charset\">Nastavený styl</span>
</p>
      ";

      if ($res->numRows() != 0)
      {
        $i = 0;
        while($data = $res->fetchObject())//{$this->var->main->CurrentSizeSpace($data->uzivatel)}
        {
          $hod = ($this->var->expip * $data->pocet) / 60;
          $pden = explode(".", $hod / 24);  //rozdeleni cisla podle desetine tecky
          $den = $pden[0];
          $hodin = $hod - (24 * $den);
          $proc = round(($hod / $fullhod) * 100);
          $delka = "{$this->VyslovnostDnuZbyva($den)}, {$this->VyslovnostHodin($hodin)} <strong>»</strong> {$proc}%";

          if (Empty($sizeuser[$data->jmeno]))
          {
            $flag = true;
          }

          if (date("Y-m-d H:i:s") > $datum || $flag)
          {
            $jmeno[$i] = $data->jmeno;
            $velikost[$i] = $this->var->main->CurrentSizeSpace($data->uzivatel);
          }

          $seluser .=
          "
<p class=\"zobraz_statistiky".($i == ($res->numRows() - 1) ? " neborder_central" : "")."\">
  <span class=\"login\"><a href=\"#\" onclick=\"ShowListip('{$data->jmeno}', {$data->pocet});document.getElementById('listipuser').style.display='block'; return false;\">{$data->jmeno}</a></span>
  <span class=\"prihlasen_v\">{$data->pocet}x</span>
  <span class=\"charset\">{$delka}</span>
  <span class=\"charset\">{$sizeuser[$data->jmeno]} ".($data->prostor >= 100 && $data->prostor <= 199 ? "ze" : "z")." {$this->var->main->Velikost($data->prostor * 1024 * 1024)}</span>
  <span class=\"prihlasen_v\">".($data->expiraceucet != 0 ? "{$this->var->main->ZbyvaDni($data->vytvoreno, $data->expiraceucet)}" : "<strong>&infin;</strong>")."</span>
  <span class=\"neborder charset\">{$this->var->main->VypisNazevStylu($data->style)}</span>
</p>
          ";
          $i++;
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    if (date("Y-m-d H:i:s") > $datum || $flag) //casovany reload chche pameti
    {
      $this->SaveSizeUser($jmeno, $velikost);
    }

    //data pro statistiku rozliseni
    if ($res = @$this->var->sqlite->query("SELECT
                                          rozliseni_x as x,
                                          rozliseni_y as y
                                          FROM adresa
                                          ORDER BY x ASC;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $i = 0;
        while($data = $res->fetchObject())
        {
          $roz[$i] = "{$data->x} x {$data->y}";
          $i++;
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $rozy = array_values(array_unique($roz)); //odstranen duplcity a vynulovani pole
    sort($rozy);
    $rozpoc = array_count_values($roz); //spocitani jednotlivych polozek

    $rozliseni .=
    "
<p class=\"rozliseni_central\">
  <span class=\"rozliseni\">Rozlišení</span>
  <span class=\"neborder prihlasen_v\">Počítadlo</span>
</p>
    ";

    for ($i = 0; $i < count($rozy); $i++)
    {
      $rozliseni .=
      "
<p class=\"rozliseni_central".($i == (count($rozy) - 1) ? " neborder_central" : "")."\">
  <span class=\"rozliseni\">{$rozy[$i]}</span>
  <span class=\"neborder prihlasen_v\">{$rozpoc[$rozy[$i]]}x</span>
</p>
      ";
    }

    //data pro statistiku hloubky
    if ($res = @$this->var->sqlite->query("SELECT
                                          hloubka as d,
                                          COUNT(hloubka) as poc
                                          FROM adresa
                                          GROUP BY adresa.hloubka
                                          ORDER BY adresa.hloubka ASC;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
      $hloubka .=
      "
<p class=\"barevna_hloubka_central\">
  <span class=\"barevna_hloubka\">Bitů</span>
  <span class=\"neborder prihlasen_v\">Počítadlo</span>
</p>
      ";
      $i = 0;
        while($data = $res->fetchObject())
        {
          $hloubka .=
          "
<p class=\"barevna_hloubka_central".($i == ($res->numRows() - 1) ? " neborder_central" : "")."\">
  <span class=\"barevna_hloubka\">{$data->d}</span>
  <span class=\"neborder prihlasen_v\">{$data->poc}x</span>
</p>
          ";
          $i++;
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    //data pro statistiku prohlizecu a OS
    if ($res = @$this->var->sqlite->query("SELECT
                                          agent
                                          FROM adresa
                                          GROUP BY adresa.agent;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $i = 0;
        while($data = $res->fetchObject())
        {
          $agent = $data->agent;
          $browser[$i] = $this->ZjistiBrowser($agent);
          $os[$i] = $this->ZjistiOS($agent);
          $i++;
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    //vypis OS
    $osy = array_values(array_unique($os)); //odstranen duplcity a vynulovani pole
    sort($osy);
    $sumos = count($osy); //pocet unikatnich OS
    $ospoc = array_count_values($os); //spocitan jednotlivych polozek
    $opsys .=
    "
<p class=\"operacni_system_central\">
  <span class=\"operacni_system\">Operační systém</span>
  <span class=\"neborder prihlasen_v\">Počítadlo</span>
</p>
    ";
    for ($i = 0; $i < count($osy); $i++)
    {
      $opsys .=
      "
<p class=\"operacni_system_central".($i == (count($osy) - 1) ? " neborder_central" : "")."\">
  <span class=\"operacni_system\" title=\"{$osy[$i]}\">{$osy[$i]}</span>
  <span class=\"neborder prihlasen_v\">{$ospoc[$osy[$i]]}x</span>
</p>
      ";
    }

    //vypis browseru
    $browsery = array_values(array_unique($browser)); //odstranen duplcity a vynulovani pole
    sort($browsery);
    $sumbrow = count($browsery);  //pocet unikatnich browseru
    $browserpoc = array_count_values($browser); //spocitan jednotlivych polozek
    $brows .=
    "
<p class=\"prohlizec_central\">
  <span class=\"prohlizec\">Prohlížeč</span>
  <span class=\"neborder prihlasen_v\">Počítadlo</span>
</p>
    ";
    for ($i = 0; $i < count($browsery); $i++)
    {
      $brows .=
      "
<p class=\"prohlizec_central".($i == (count($browsery) - 1) ? " neborder_central" : "")."\">
  <span class=\"prohlizec\" title=\"{$browsery[$i]}\">{$browsery[$i]}</span>
  <span class=\"neborder prihlasen_v\">{$browserpoc[$browsery[$i]]}x</span>
</p>
      ";
    }

    //vypis datumu
    $datumm .=
    "
<p class=\"expirace_central\">
  <span class=\"expirace\">Datum aktivity</span>
  <span class=\"neborder prihlasen_v\">Počítadlo</span>
</p>
    ";
    if ($res = @$this->var->sqlite->query("SELECT
                                          strftime('%d.%m.%Y', cas) as datum,
                                          count(cas) as pocet
                                          FROM adresa
                                          GROUP BY date(cas)
                                          ORDER BY datetime(cas) DESC;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $i = 0;
        while($data = $res->fetchObject())
        {
          $datumm .=
          "
    <p class=\"expirace_central".($i == ($res->numRows() - 1) ? " neborder_central" : "")."\">
      <span class=\"expirace\">{$data->datum}</span>
      <span class=\"neborder prihlasen_v\">{$data->pocet}x</span>
    </p>
          ";
          $i++;
        }
      }
      $sumdat = $res->numRows();
    }
      else
    {
      $this->ErrorMsg($error);
    }

    //vypis IP
    $ipp .=
    "
<p class=\"ip_central\">
  <span class=\"ip\">IP</span>
  <span class=\"hostitel\">Hostitel</span>
  <span class=\"neborder prihlasen_v\">Počítadlo</span>
</p>
    ";
    if ($res = @$this->var->sqlite->query("SELECT
                                          ip,
                                          count(ip) as pocet,
                                          strftime('%d.%m.%Y %H:%M:%S', cas) as dat
                                          FROM adresa
                                          GROUP BY ip
                                          ORDER BY count(ip) DESC, datetime(cas) DESC;
                                          ", NULL, $error)) //ORDER BY pocet DESC, datum ASC;
    {
      if ($res->numRows() != 0)
      {
        $i = 0;
        while($data = $res->fetchObject())
        {
          $host = (in_array($kip, $this->var->blok) ? "localhost" : gethostbyaddr($data->ip)); //host
          $ipp .=
          "
    <p class=\"ip_central".($i == ($res->numRows() - 1) ? " neborder_central" : "")."\">
      <span class=\"ip\">{$data->ip}</span>
      <span class=\"hostitel\" title=\"{$host}".($data->pocet == 1 ? " (vstoupil: {$data->dat})" : "")."\">{$host}</span>
      <span class=\"neborder prihlasen_v\">{$data->pocet}x</span>
    </p>
          ";
          $i++;
        }
      }
      $sumip = $res->numRows();
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $result =
    "
{$seluser}
<div id=\"listipuser\"></div>
{$rozliseni}
{$hloubka}
{$brows}
{$opsys}
{$datumm}
{$ipp}
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet prohlížečů</span>
  <span class=\"neborder charset\">{$sumbrow}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet operačních systémů</span>
  <span class=\"neborder charset\">{$sumos}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet datumů aktivity</span>
  <span class=\"neborder charset\">{$sumdat}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet IP</span>
  <span class=\"neborder charset\">{$sumip}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový strávený čas na stránkách</span>
  <span class=\"neborder charset\">{$alltime}</span>
</p>
    ";

    return $result;
  }
//******************************************************************************
  function SizeStatistic()  //statistika mista
  {
    if ($res = @$this->var->sqlite->query ("SELECT id, prostor
                                            FROM uzivatel
                                            ", NULL, $error))
    {
      if ($res->numRows())
      {
        while($data = $res->fetchObject())
        {
          $prostor += $data->prostor;
          $curprostor += $this->CurrentSizeSpace($data->id, true);
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $origsize = $prostor * 1024 * 1024;
    if ($curprostor != 0)
    {
      $pocet = $origsize / $curprostor;
      $proc = ceil(100 / $pocet);
    }
      else
    {
      $proc = 0;
    }

    $zbyvaproc = 100 - $proc;
    $zbyvavel = $origsize - $curprostor;

    $prostor = $this->Velikost($origsize); //prepocet na spravnou jednotku
    $curprostor = $this->Velikost($curprostor); //aktualni zaplnena velkost
    $zbyvavel = $this->Velikost($zbyvavel); //zbyva aktualni velikosti

    $koren = $this->ZjistiVelikostSlozky("./", $pockoren);
    $obr = $this->ZjistiVelikostSlozky("obr", $pocobr, true);
    $obrpripony = $this->ZjistiVelikostSlozky("{$this->var->priponydir}", $pocobrpripony);
    $obrvzhled = $this->ZjistiVelikostSlozkyRekurzivne("{$this->var->vzhleddir}", $pocobrvzhled, true);
    $style = $this->ZjistiVelikostSlozky("styles", $pocstyle, true);
    $stylevzhled = $this->ZjistiVelikostSlozkyRekurzivne("{$this->var->stylesdir}", $pocstylevzhled, true);

    $result =
    "
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Přidělené místo uživatelům</span>
  <span class=\"neborder charset\">{$prostor}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Zaplněné místo uživateli</span>
  <span class=\"neborder charset\">{$curprostor}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Zbývá místa pro uživatele</span>
  <span class=\"neborder charset\">{$zbyvavel}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Zaplněné místo uživateli <strong>»</strong> %</span>
  <span class=\"neborder charset\">{$proc}%</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Zbývá místa pro uživatele <strong>»</strong> %</span>
  <span class=\"neborder charset\">{$zbyvaproc}%</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Počet souborů v kořenu</span>
  <span class=\"neborder charset\">{$pockoren}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Velikost souborů v kořenu</span>
  <span class=\"neborder charset\">{$koren}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Počet souborů ve složce obr</span>
  <span class=\"neborder charset\">{$pocobr}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Velikost souborů ve složce obr</span>
  <span class=\"neborder charset\">{$this->Velikost($obr)}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Počet obrázků ve složce přípony</span>
  <span class=\"neborder charset\">{$pocobrpripony}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Velikost obrázků ve složce přípony</span>
  <span class=\"neborder charset\">{$obrpripony}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Počet obrázků ve složce {$this->var->vzhleddir}</span>
  <span class=\"neborder charset\">".($pocobrvzhled - $pocobr)."</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Velikost obrázků ve složce {$this->var->vzhleddir}</span>
  <span class=\"neborder charset\">{$this->Velikost($obrvzhled  - $obr)}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Počet souborů ve složce styles</span>
  <span class=\"neborder charset\">{$pocstyle}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Velikost souborů ve složce styles</span>
  <span class=\"neborder charset\">{$this->Velikost($style)}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Počet souborů ve složce {$this->var->stylesdir}</span>
  <span class=\"neborder charset\">".($pocstylevzhled - $pocstyle)."</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Velikost souborů ve složce {$this->var->stylesdir}</span>
  <span class=\"neborder charset\">{$this->Velikost($stylevzhled  - $style)}</span>
</p>
    ";

    return $result;
  }
//******************************************************************************
  function SavePocDir($data) //ulozi data poctu slozek - cache
  {
    $soubor = "{$this->var->cachedir}/{$this->var->cachepocdir}";
    $u = fopen($soubor, "w");
    fwrite($u, implode("--", $data));
    fclose($u);
  }
//******************************************************************************
  function ShowPocDir() //nacte data poctu slozek - cache
  {
    $soubor = "{$this->var->cachedir}/{$this->var->cachepocdir}";
    $u = fopen($soubor, "r");
    $result = explode("--", fread($u, filesize($soubor)));
    fclose($u);

    return $result;
  }
//******************************************************************************
  function OtherStatistic()  //statistika osatnich polozek
  {
    //pocet jednotlivych typu prav
    if ($res = @$this->var->sqlite->query ("SELECT pravo,
                                            count(pravo) as poc
                                            FROM uzivatel
                                            GROUP BY pravo
                                            ORDER BY pravo ASC;
                                            ", NULL, $error))
    {
      if ($res->numRows())
      {
        while($data = $res->fetchObject())
        {
          $prava .= "
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkem {$this->var->prava[$data->pravo]}ů</span>
  <span class=\"neborder charset\">{$data->poc}</span>
</p>
";
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    //pocet pripon co namji obrazek
    if ($res = @$this->var->sqlite->query ("SELECT
                                            pripona
                                            FROM pripony
                                            ", NULL, $error))
    {
      $pocsuffix = 0;
      if ($res->numRows())
      {
        while($data = $res->fetchObject())
        {
          if (!file_exists("{$this->var->priponydir}/{$data->pripona}.png"))
          {
            $pocsuffix++;
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    //pocet stylu a importu
    $sumimport = 0;
    if ($res0 = @$this->var->sqlite->query ("SELECT id
                                            FROM styles;
                                            ", NULL, $error))
    {
      $sumstyle = $res0->numRows();
      if ($res0->numRows() != 0)
      {
        while($data0 = $res0->fetchObject())
        {
          if ($res = @$this->var->sqlite->query("SELECT id
                                                FROM importy
                                                WHERE styles={$data0->id};
                                                ", NULL, $error))
          {
            $sumimport += $res->numRows();
          }
            else
          {
            $this->ErrorMsg($error);
          }
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    //pocet pripon
    if ($res = @$this->var->sqlite->query("SELECT id
                                          FROM pripony;
                                          ", NULL, $error))
    {
      $sumsuffix = $res->numRows();
    }
      else
    {
      $this->ErrorMsg($error);
    }

    //pocet sdileni
    if ($res = @$this->var->sqlite->query("SELECT
                                          sdileni.id as id,
                                          uzivatel_ma_sdileni.id as ida,
                                          u1.jmeno as od,
                                          u2.jmeno as pro,
                                          sdileni.slozka as slozka,
                                          sdileni.podslozka as podslozka
                                          FROM sdileni, uzivatel_ma_sdileni, uzivatel u1, uzivatel u2 WHERE
                                          sdileni.id=uzivatel_ma_sdileni.sdileni AND
                                          sdileni.uzivatel=u1.id AND
                                          uzivatel_ma_sdileni.uzivatel=u2.id;
                                          ", NULL, $error))
    {
      $sumshare = $res->numRows();
    }
      else
    {
      $this->ErrorMsg($error);
    }

    //kolik uzivatelu ma vybrano jaky styl
    if ($res = @$this->var->sqlite->query ("SELECT styles.nazev as nazev,
                                            count(uzivatel.style) as pocet
                                            FROM uzivatel, styles
                                            WHERE uzivatel.style=styles.id
                                            GROUP BY style
                                            ", NULL, $error))
    {
      if ($res->numRows())
      {
        while($data = $res->fetchObject())
        {
          $styl .=
          "
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\"><em>{$data->nazev}</em> používá uživatelů</span>
  <span class=\"neborder charset\">{$data->pocet}</span>
</p>
          ";
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    //kolik zamku je nastavenych
    if ($res = @$this->var->sqlite->query ("SELECT
                                            id
                                            FROM hesla;
                                            ", NULL, $error))
    {
      $poczam = $res->numRows();
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $dat = filemtime("{$this->var->cachedir}/{$this->var->cachepocdir}");
    $datum = date("Y-m-d H:i:s", mktime(date("H", $dat) + $this->var->reloadcachesize, date("i", $dat), date("s", $dat), date("n", $dat), date("j", $dat), date("Y", $dat)));  //interval refresh dat

    if (date("Y-m-d H:i:s") > $datum) //casovany reload chche pameti
    {
      //pocet slozek, souboru a uzivatelu
      $sumdir = 0;
      $sumpoddir = 0;
      $sumpodpoddir = 0;
      $sumfile = 0;
      $sumpodfile = 0;
      $sumpodpodfile = 0;
      $sumpodpodpodfile = 0;
      if ($res0 = @$this->var->sqlite->query ("SELECT id
                                              FROM uzivatel
                                              ", NULL, $error))
      {
        $sumuser = $res0->numRows();
        if ($res0->numRows())
        {
          while($data0 = $res0->fetchObject())
          {
            if ($res = @$this->var->sqlite->query("SELECT id, nazev FROM slozka WHERE uzivatel={$data0->id} ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
            {
              if ($res3 = @$this->var->sqlite->query("SELECT id, nazev FROM soubor WHERE uzivatel={$data0->id} ORDER BY LOWER(soubor.nazev) ASC;", NULL, $error))
              { //vykresleni souboru v korenu
                if ($res3->numRows() != 0)  //koren -> soubor
                {
                  $sumfile += $res3->numRows();
                  $sumpodfile += $res3->numRows();
                }
              }
                else
              {
                $this->ErrorMsg($error);
              }

              if ($res->numRows() != 0)
              {
                $sumdir += $res->numRows(); //soucet slozek
                $sumpoddir += $res->numRows();
                while ($data = $res->fetchObject()) //koren -> slozka
                {
                  if ($res1 = @$this->var->sqlite->query("SELECT podslozka.id as id, podslozka.slozka as podslozka, slozka.nazev as slozka, podslozka.nazev as nazev FROM slozka, podslozka
                                                          WHERE
                                                          podslozka.slozka={$data->id} AND
                                                          slozka.id=podslozka.slozka AND
                                                          slozka.uzivatel={$data0->id} AND
                                                          podslozka.uzivatel={$data0->id} ORDER BY LOWER(slozka.nazev) ASC;", NULL, $error))
                  {
                    if ($res1->numRows() != 0)
                    {
                      $sumdir += $res1->numRows();  //soucet slozek
                      $sumpodpoddir += $res1->numRows();
                      while ($data1 = $res1->fetchObject()) // Koren -> slozka -> podslozka
                      {
                        if ($res2 = @$this->var->sqlite->query("SELECT id, nazev, slozka, podslozka FROM podpodsoubor WHERE uzivatel={$data0->id} AND slozka={$data->id} AND podslozka={$data1->id} ORDER BY LOWER(podpodsoubor.nazev) ASC;", NULL, $error))
                        { //vykresleni souboru v podslozce
                          if ($res2->numRows() != 0) // Koren -> slozka -> podslozka -> soubor
                          {
                            $sumfile += $res2->numRows();
                            $sumpodpodpodfile += $res2->numRows();
                          }
                        }
                          else
                        {
                          $this->ErrorMsg($error);
                        }
                      }
                    }
                  }
                    else
                  {
                    $this->ErrorMsg($error);
                  }

                  if ($res2 = @$this->var->sqlite->query("SELECT id, nazev, slozka FROM podsoubor WHERE uzivatel={$data0->id} AND slozka={$data->id} ORDER BY LOWER(podsoubor.nazev) ASC;", NULL, $error))
                  { //vykresleni souboru ve slozce
                    if ($res2->numRows() != 0) //koren -> slozka -> soubor
                    {
                      $sumfile += $res2->numRows();
                      $sumpodpodfile += $res2->numRows();
                    }
                  }
                    else
                  {
                    $this->ErrorMsg($error);
                  }
                }
              }
            }
              else
            {
              $this->ErrorMsg($error);
            }
          } //konec cyklu uzivatelu
        }
      }
        else
      {
        $this->ErrorMsg($error);
      }

      $cache[0] = $sumuser;
      $cache[1] = $sumfile;
      $cache[2] = $sumpodfile;
      $cache[3] = $sumpodpodfile;
      $cache[4] = $sumpodpodpodfile;
      $cache[5] = $sumdir;
      $cache[6] = $sumpoddir;
      $cache[7] = $sumpodpoddir;

      $this->SavePocDir($cache);
    }

    $cache = $this->ShowPocDir();  //nacteni velikosti slozky z cache
    $sumuser = $cache[0];
    $sumfile = $cache[1];
    $sumpodfile = $cache[2];
    $sumpodpodfile = $cache[3];
    $sumpodpodpodfile = $cache[4];
    $sumdir = $cache[5];
    $sumpoddir = $cache[6];
    $sumpodpoddir = $cache[7];

    $result =
    "
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet uživatelů</span>
  <span class=\"neborder charset\">{$sumuser}</span>
</p>
{$prava}
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Kolik přípon nemá obrázek</span>
  <span class=\"neborder charset\">{$pocsuffix}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet nastavených zámků</span>
  <span class=\"neborder charset\">{$poczam}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Datum obnovení následujících statistik</span>
  <span class=\"neborder charset\">".(date($this->var->cachedateformat, strtotime($datum)))."</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet všech složek</span>
  <span class=\"neborder charset\">{$sumdir}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet sub-složek</span>
  <span class=\"neborder charset\">{$sumpoddir}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet sub-sub-složek</span>
  <span class=\"neborder charset\">{$sumpodpoddir}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet všech souborů</span>
  <span class=\"neborder charset\">{$sumfile}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet sub-souborů</span>
  <span class=\"neborder charset\">{$sumpodfile}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet sub-sub-souborů</span>
  <span class=\"neborder charset\">{$sumpodpodfile}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet sub-sub-sub-souborů</span>
  <span class=\"neborder charset\">{$sumpodpodpodfile}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet stylů</span>
  <span class=\"neborder charset\">{$sumstyle}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet importů</span>
  <span class=\"neborder charset\">{$sumimport}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet přípon</span>
  <span class=\"neborder charset\">{$sumsuffix}</span>
</p>
<p class=\"prohlizec_central_cas_na_strankach neborder_central_ostatni\">
  <span class=\"prohlizec\">Celkový počet položek sdílení</span>
  <span class=\"neborder charset\">{$sumshare}</span>
</p>
{$styl}
    ";

    return $result;
  }
//******************************************************************************
  function ZipFile($cesta)  //zabali soubory - volane z ajaxu
  {
    $handle = opendir($cesta);
    $poc = 0;
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $nazev[$poc] = "{$soub}";
        $fullcesta[$poc] = "{$cesta}/{$soub}";
        $poc++;
      }
    }
    closedir($handle);

    if (count($fullcesta) != 0) //je-li obsah adresare neprazdny
    {
      $zip = new ZipArchive;
      $jmeno = "{$this->GenerateName()}.zip";
      $cil = "{$cesta}/{$jmeno}";
      if ($zip->open($cil, ZipArchive::CREATE))
      {
        for ($i = 0; $i < count($fullcesta); $i++)
        {
          $zip->addFile($fullcesta[$i], $nazev[$i]);
        }
        $zip->close();
      }

      $result = "
<div id=\"flag_zeme\">
  <div id=\"zeme_puvodu\">
    <a href=\"#\" class=\"zkopirovat_do_schranky_odkaz\" onclick=\"CopyToClipboard('{$this->var->web}/{$cil}');return false;\" title=\"Zkopírovat odkaz do schránky\"></a>
    <strong>Čekejte prosím ... </strong>
    <strong>Stažení archivu bude automaticky zahájeno ...</strong>
    <em>Jestli se stažení archivu nezahájilo, tak jej stáhnete <input type=\"button\" value=\"›› zde ‹‹\" onclick=\"location.href='{$cil}';CopyToClipboard('{$this->var->web}/{$cil}');\" id=\"download_button\"></em>
    <a href=\"#\" onclick=\"document.getElementById('zeme_puvodu').style.display='none'; return false;\" title=\"Zavřít okno\"></a>
  </div>
</div>
";
    }
      else
    {
      $result = "
<input type=\"button\" onclick=\"alert('Nelze zabalit prázdný obsah složky !');\" id=\"download_button\" class=\"alert_nelze_zabalit_prazdny_adresar\">
      ";
    }

    return $result;
  }
//******************************************************************************
  function ZjistiVelikostSlozky($cesta, &$poc, $full = false) //zmeri velikost 1 slozky
  {
    $poc = 0;
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $size += filesize("{$cesta}/{$soub}");
        $poc++;
      }
    }
    closedir($handle);

    $result = ($full ? $size : $this->Velikost($size));

    return $result;
  }
//******************************************************************************
  function ZjistiVelikostSlozkyRekurzivne($cesta, &$poc, $full = false) //zmer velikost slozky a vsech podslozek
  {
    $poc = 0;
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $size += filesize("{$cesta}/{$soub}");
        $poc++;
      }
        else
      {
        $size += $this->ZjistiVelikostSlozky("{$cesta}/{$soub}", $pocit, true);
        $poc += $pocit;
      }
    }
    closedir($handle);

    $result = ($full ? $size : $this->Velikost($size));

    return $result;
  }
//******************************************************************************
//******************************************************************************
//******************************************************************************
  function StartSession() //aktvuje session
  {
    session_name("SESSID"); //nastaven jmena
    session_start();

    /* $_COOKIE["SESSID"]
     * $_SERVER["HTTP_USER_AGENT"]
     * $_SERVER["HTTP_ACCEPT_CHARSET"]
     * $_SERVER["REMOTE_ADDR"]
     * date("Y-m-d H:i:s", $_SERVER["REQUEST_TIME"])
     */
  }
//******************************************************************************
  public $start, $konec;
  function MeritCas() //funkce pro vrácení času
  {
    $cas = explode(" ", microtime());
    $soucet = $cas[1] + $cas[0];

    return $soucet;
  }
//******************************************************************************
  function StartCas() //zapis začátku
  {
    $this->start = $this->MeritCas();
  }
//******************************************************************************
  function KonecCas() //zápis konce a finální vypis doby
  {
    $this->konec = $this->MeritCas();
    $cas = Abs(Round(($this->konec - $this->start) * 1000) / 1000); //Abs, výpočet

    return "Stránka byla vygenerována za: {$cas} ms";
  }
//******************************************************************************
}
?>
